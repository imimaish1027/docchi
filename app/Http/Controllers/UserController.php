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

    public function edit()
    {
    }

    public function update()
    {
    }

    public function bookmark($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $bookmarks = Bookmark::where('user_id', $user_id)->orderBy("created_at", "DESC")->paginate(5);

        return view('users.bookmark', ['user' => $user, 'bookmarks' => $bookmarks]);
    }

    public function emailEdit()
    {
    }

    public function emailUpdate()
    {
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
