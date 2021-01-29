<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Theme;
use App\Tag;
use App\Answer;
use App\Comment;
use App\Bookmark;

class UserController extends Controller
{
    public function show($user_id)
    {
        $user = User::find($user_id);
        $themes = Theme::where('user_id', $user->id)->paginate(5);

        return view('users.show', ['user' => $user, 'themes' => $themes]);
    }

    public function answer($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $answers = Answer::where('user_id', $user_id)->paginate(5);

        return view('users.answer', ['user' => $user, 'answers' => $answers]);
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'age' => 'required|int|numeric',
            'pic' =>
            'file|image|max:1024|mimes:jpeg,png,jpg',
        ]);

        $user = User::find($user_id);
        $user->name = $request->input('name');
        $user->age = $request->input('age');

        if ($request->pic) {
            $pic = $request->pic->store('public/users');
            $file_name = basename($pic);
            $user->pic = $file_name;
        }

        $user->save();

        return view('users.edit', ['user' => $user]);
    }

    public function bookmark($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $bookmarks = Bookmark::where('user_id', $user_id)->orderBy("created_at", "DESC")->paginate(5);

        return view('users.bookmark', ['user' => $user, 'bookmarks' => $bookmarks]);
    }

    public function emailEdit($user_id)
    {
        $user = User::find($user_id);

        return view('users.emailEdit', ['user' => $user]);
    }

    public function emailUpdate(Request $request, $user_id)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = User::find($user_id);
        $user->email = $request->input('email');

        $user->save();

        return view('users.emailEdit', ['user' => $user]);
    }

    public function passEdit()
    {
    }

    public function passUpdate()
    {
    }

    public function withdraw()
    {
    }

    public function destroy()
    {
    }
}
