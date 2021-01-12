<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Theme;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    public function index()
    {
    }

    public function show($id)
    {
        $theme = Theme::find($id);
        $post_user = User::where('id', $theme->user_id)->first();
        return view('themes.show', ['theme' => $theme, 'post_user' => $post_user]);
    }

    public function answer()
    {
    }

    public function result()
    {
    }

    public function create()
    {
        $auth = Auth::user();
        return view('themes.create', ['auth' => $auth]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'answer_a' => 'required|string|max:255',
            'pic_a' =>
            'required|file|image|max:1024|mimes:jpeg,png,jpg',
            'answer_b' => 'required|string|max:255',
            'pic_b' =>
            'required|file|image|max:1024|mimes:jpeg,png,jpg',
            'tag' => 'string|max:10',
        ]);

        $theme = new Theme;
        $theme->user_id = $request->user()->id;
        $theme->title = $request->input('title');
        $theme->answer_a = $request->input('answer_a');

        $pic_a = $request->pic_a->store('public/selects');
        $file_name_a = basename($pic_a);
        $theme->pic_a = $file_name_a;

        $theme->answer_b = $request->input('answer_b');

        $pic_b = $request->pic_b->store('public/selects');
        $file_name_b = basename($pic_b);
        $theme->pic_b = $file_name_b;

        $theme->save();

        $tag = new Tag;
        $tag->name = $request->input('tag');
        $tag->save();

        return redirect()->route('home');
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
