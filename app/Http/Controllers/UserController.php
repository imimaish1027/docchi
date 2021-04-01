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
use Storage;
use AWS;

class UserController extends Controller
{
    public function show($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }
        $user = User::where('id', $user_id)->first();
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }

        $themes = Theme::with('user', 'answers', 'comments', 'bookmarks', 'tags')->where('user_id', $user_id)->paginate(5);
        foreach ($themes as $theme) {
            $path_a = url($theme->pic_a);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path_a);
            $client = AWS::createClient('cloudfront');
            $theme->pic_a = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);

            $path_b = url($theme->pic_b);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path_b);
            $theme->pic_b = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }

        return view('users.show', ['user' => $user, 'themes' => $themes]);
    }

    public function answer($user_id)
    {
        $user = User::where('id', $user_id)->first();
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }

        $answers = Answer::with('theme.user', 'theme.answers', 'theme.comments', 'theme.bookmarks', 'theme.tags')->where('user_id', $user_id)->paginate(5);
        foreach ($answers as $answer) {
            $path_a = url($answer->theme->pic_a);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path_a);
            $client = AWS::createClient('cloudfront');
            $answer->theme->pic_a = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);

            $path_b = url($answer->theme->pic_b);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path_b);
            $answer->theme->pic_b = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }

        return view('users.answer', ['user' => $user, 'answers' => $answers]);
    }

    public function edit($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }

        $user = User::find($user_id);
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }

        $this->authorize('view', $user);

        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, $user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }

        $user = User::find($user_id);
        if (isset($request->pic)) {
            $path = url($request->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }

        if (isset($request->pic)) {
            $image = $request->file('pic');
            $path = Storage::disk('s3')->putFile('/users', $image, 'public');
            $user->pic = Storage::disk('s3')->url($path);
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
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }
        $this->authorize('view', $user);

        $bookmarks = Bookmark::with('theme.user', 'theme.answers', 'theme.comments', 'theme.bookmarks', 'theme.tags')->where('user_id', $user_id)->orderBy("created_at", "DESC")->paginate(5);
        foreach ($bookmarks as $bookmark) {
            $path_a = url($bookmark->theme->pic_a);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path_a);
            $client = AWS::createClient('cloudfront');
            $bookmark->theme->pic_a = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);

            $path_b = url($bookmark->theme->pic_b);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path_b);
            $bookmark->theme->pic_b = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }

        return view('users.bookmark', ['user' => $user, 'bookmarks' => $bookmarks]);
    }

    public function emailEdit($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }

        $user = User::find($user_id);
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }
        $this->authorize('view', $user);

        return view('users.emailEdit', ['user' => $user]);
    }

    public function emailUpdate(EmailRequest $request, $user_id)
    {
        $user = User::find($user_id);
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }

        $user->fill($request->validated())->save();

        return redirect()->route('users.emailEdit',['id' => $user->id])->with('success_message', 'メールアドレスを変更しました。');
    }

    public function passEdit($user_id)
    {
        if (!ctype_digit($user_id)) {
            return redirect('/themes');
        }

        $user = User::find($user_id);
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }
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
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }
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
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }
        $this->authorize('view', $user);

        return view('users.withdraw', ['user' => $user]);
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        if (isset($user->pic)) {
            $path = url($user->pic);
            $url = str_replace(config('aws.bucket_url'), config('aws.cloudfront_url'), $path);
            $client = AWS::createClient('cloudfront');
            $user->pic = $client->getSignedUrl([
                'url' => $url,
                'expires' => time() + 60,
                'private_key' => base_path(config('aws.cloudfront_private_key')),
                'key_pair_id' => config('aws.cloudfront_key_pair_id')
            ]);
        }
        $user->delete();

        return redirect()->route('themes.index')->with('success_message', '退会が完了しました。');
    }
}
