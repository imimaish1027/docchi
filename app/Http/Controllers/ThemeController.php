<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Theme;
use App\Tag;
use App\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        $users = User::all();
        return view('themes.index', ['themes' => $themes, 'users' => $users]);
    }

    public function show($theme_id)
    {
        $auth_user = Auth::user();
        $theme = Theme::find($theme_id);
        $post_user = User::where('id', $theme->user_id)->first();

        if ($auth_user && DB::table('answers')->where('user_id', $auth_user->id)->where('theme_id', $theme->id)->exists()) {
            $answer_flg = Answer::where('user_id', $auth_user->id)->where('theme_id', $theme_id)->first();

            $count_answer_a = DB::table('answers')->where('theme_id', $theme->id)->where('answer', 1)->count();
            $count_answer_b = DB::table('answers')->where('theme_id', $theme->id)->where('answer', 2)->count();

            $auth_user = Auth::user();
            if ($auth_user) {
                $user_choice = Answer::where('user_id', $auth_user->id)->where('theme_id', $theme_id)->first();
                if ($user_choice) {
                    $choice_number = $user_choice->answer;
                } else {
                    $choice_number = 0;
                }
            } else {
                $choice_number = 0;
            }

            if ($answer_flg) {
                if ($auth_user->id === $answer_flg->user_id) {
                    return view('themes.result', [
                        'theme' => $theme,
                        'post_user' => $post_user,
                        'count_answer_a' => $count_answer_a,
                        'count_answer_b' => $count_answer_b,
                        'choice_number' => $choice_number
                    ]);
                }
            }
        } else {
            return view('themes.show', ['theme' => $theme, 'post_user' => $post_user]);
        }
    }

    public function answer(Request $request, $theme_id)
    {
        $auth_user = Auth::user();

        $answer = new Answer;
        $answer->user_id = $auth_user->id;
        $answer->theme_id = $theme_id;
        $answer->answer = $request->answer;
        $answer->save();

        $theme = Theme::find($theme_id);
        $post_user = User::where('id', $theme->user_id)->first();

        return redirect()->route('themes.result', ['id' => $theme_id]);
    }

    public function result($theme_id)
    {
        $theme = Theme::find($theme_id);
        $post_user = User::where('id', $theme->user_id)->first();

        $count_answer_a = DB::table('answers')->where('theme_id', $theme_id)->where('answer', 1)->count();
        $count_answer_b = DB::table('answers')->where('theme_id', $theme_id)->where('answer', 2)->count();

        $auth_user = Auth::user();
        if ($auth_user) {
            $user_choice = Answer::where('user_id', $auth_user->id)->where('theme_id', $theme_id)->first();
            if ($user_choice) {
                $choice_number = $user_choice->answer;
            } else {
                $choice_number = 0;
            }
        } else {
            $choice_number = 0;
        }

        return view('themes.result', [
            'theme' => $theme,
            'post_user' => $post_user,
            'count_answer_a' => $count_answer_a,
            'count_answer_b' => $count_answer_b,
            'choice_number' => $choice_number
        ]);
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
            'tag' => 'string|max:10|nullable',
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

        if ($request->input('tag')) {
            $tag = new Tag;
            $tag->name = $request->input('tag');
            $tag->save();
        }

        return redirect()->route('themes.index');
    }

    public function edit($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/themes/create');
        }

        $theme = Theme::find($id);
        return view('themes.edit', ['theme' => $theme]);
    }

    public function update(Request $request, $id)
    {
        if (!ctype_digit($id)) {
            return redirect('/themes/create');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'answer_a' => 'required|string|max:255',
            'pic_a' =>
            'file|image|max:1024|mimes:jpeg,png,jpg',
            'answer_b' => 'required|string|max:255',
            'pic_b' =>
            'file|image|max:1024|mimes:jpeg,png,jpg',
            'tag' => 'string|max:10|nullable',
        ]);

        $theme = Theme::find($id);
        $theme->fill($request->all())->save();

        if ($request->input('tag')) {
            $tag = new Tag;
            $tag->name = $request->input('tag');
            $tag->save();
        }

        return redirect()->route('themes.index');
    }

    public function destroy($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/themes/create');
        }

        Theme::find($id)->delete();

        return redirect()->route('themes.index');
    }
}
