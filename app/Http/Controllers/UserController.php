<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EmailRequest;
use App\User;
use App\Theme;
use App\Tag;
use App\Answer;
use App\Comment;
use App\Bookmark;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function show($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }
        $user = User::where('id', $user_id)->first();
        $themes = Theme::with('user', 'answers', 'comments', 'bookmarks', 'tags')->where('user_id', $user_id)->paginate(5);

        return view('users.show', ['user' => $user, 'themes' => $themes]);
    }

    public function answer($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $answers = Answer::with('theme.user', 'theme.answers', 'theme.comments', 'theme.bookmarks', 'theme.tags')->where('user_id', $user_id)->paginate(5);

        return view('users.answer', ['user' => $user, 'answers' => $answers]);
    }

    public function edit($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }
        $user = User::find($user_id);
        $this->authorize('view', $user);

        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, $user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }
        $user = User::find($user_id);

        if ($request->pic) {
            $pic = $request->pic->store('public/users');
            $file_name = basename($pic);
            $user->pic = $file_name;
        }

        $user->fill($request->validated())->save();
        
        return redirect()->route('users.edit', ['id' => $user->id])->with('success_message', 'プロフィールを更新しました。');
 
    }

    public function bookmark($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }
        $user = User::where('id', $user_id)->first();
        $this->authorize('view', $user);
        $bookmarks = Bookmark::with('theme.user', 'theme.answers', 'theme.comments', 'theme.bookmarks', 'theme.tags')->where('user_id', $user_id)->orderBy("created_at", "DESC")->paginate(5);

        return view('users.bookmark', ['user' => $user, 'bookmarks' => $bookmarks]);
    }

    public function emailEdit($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }
        $user = User::find($user_id);
        $this->authorize('view', $user);

        return view('users.emailEdit', ['user' => $user]);
    }

    public function emailUpdate(EmailRequest $request, $user_id)
    {
        $user = User::find($user_id);

        $user->fill($request->validated())->save();

        return redirect()->route('users.emailEdit',['id' => $user->id])->with('success_message', 'メールアドレスを変更しました。');
    }

    public function passEdit($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }
        $user = User::find($user_id);
        $this->authorize('view', $user);

        return view('users.passEdit', ['user' => $user]);
    }

    public function passUpdate(Request $request, $user_id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'confirm' => ['required', 'same:password'],
        ]);

        $user = User::find($user_id);
        $user->password = Hash::make($request->password);

        $user->save();

        $themes = Theme::where('user_id', $user->id)->paginate(5);

        return redirect()->route('users.passEdit', ['id' => $user->id])->with('success_message', 'パスワードを変更しました。');
    }

    public function withdraw($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }
        $user = User::find($user_id);
        $this->authorize('view', $user);

        return view('users.withdraw', ['user' => $user]);
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return redirect()->route('themes.index')->with('success_message', '退会が完了しました。');
    }
}
