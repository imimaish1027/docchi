<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Theme;
use App\Tag;
use App\Answer;
use App\Comment;
use App\Http\Requests\ThemeRequest;
use App\Http\Requests\ThemeEditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        switch ($request->sort) {
            case 'newPost':
                $themes = Theme::query()
                    ->when($request->has('keyword'), function ($query) use ($keyword) {
                        $query->where('title', 'like', '%' . $keyword . '%');
                    })->orderBy('created_at', 'desc')->paginate(10);
                break;
            case 'countAnswer':
                $themes = Theme::query()
                    ->when($request->has('keyword'), function ($query) use ($keyword) {
                        $query->where('title', 'like', '%' . $keyword . '%');
                    })->withCount('answers')->orderBy('answers_count', 'desc')->paginate(10);
                break;
            case 'countComment':
                $themes = Theme::query()
                    ->when($request->has('keyword'), function ($query) use ($keyword) {
                        $query->where('title', 'like', '%' . $keyword . '%');
                    })->withCount('comments')->orderBy('comments_count', 'desc')->paginate(10);
                break;
            case 'countBookmark':
                $themes = Theme::query()
                    ->when($request->has('keyword'), function ($query) use ($keyword) {
                        $query->where('title', 'like', '%' . $keyword . '%');
                    })->withCount('bookmarks')->orderBy('bookmarks_count', 'desc')->paginate(10);
                break;
            case '':
                $themes = Theme::query()
                    ->when($request->has('keyword'), function ($query) use ($keyword) {
                        $query->where('title', 'like', '%' . $keyword . '%');
                    })->orderBy('created_at', 'desc')->paginate(10);
                break;
        }

        $users = User::all();

        return view('themes.index', ['themes' => $themes, 'users' => $users, 'keyword' => $keyword])->with('sortBy', $request->sort);
    }

    public function show($theme_id)
    {
        $auth_user = Auth::user();
        $theme = Theme::find($theme_id);
        $post_user = User::where('id', $theme->user_id)->first();

        $answer_a_subject = $theme->answer_a;
        $answer_b_subject = $theme->answer_b;
        $answer_subject = json_encode([$answer_b_subject, $answer_a_subject]);

        if ($auth_user && DB::table('answers')->where('user_id', $auth_user->id)->where('theme_id', $theme->id)->exists()) {
            $answer_flg = Answer::where('user_id', $auth_user->id)->where('theme_id', $theme_id)->first();

            $count_answer_a = DB::table('answers')->where('theme_id', $theme->id)->where('answer', 1)->count();
            $count_answer_b = DB::table('answers')->where('theme_id', $theme->id)->where('answer', 2)->count();
            $count_answer = json_encode([$count_answer_b, $count_answer_a]);
            $total_count_answer = $count_answer_a + $count_answer_b;

            $percentage_answer_a = round(($count_answer_a / $total_count_answer) * 100);
            $percentage_answer_b = round(($count_answer_b / $total_count_answer) * 100);
            $percentage_answer = json_encode([$percentage_answer_b, $percentage_answer_a]);

            $comments = Comment::where('theme_id', $theme_id)->orderBy('created_at', 'desc')->paginate(5);
            $count_comment = Comment::where('theme_id', $theme_id)->count();

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
                        'answer_subject' => $answer_subject,
                        'count_answer_a' => $count_answer_a,
                        'count_answer_b' => $count_answer_b,
                        'count_answer' => $count_answer,
                        'total_count_answer' => $total_count_answer,
                        'percentage_answer_a' => $percentage_answer_a,
                        'percentage_answer_b' => $percentage_answer_b,
                        'percentage_answer' => $percentage_answer,
                        'choice_number' => $choice_number,
                        'comments' => $comments,
                        'count_comment' => $count_comment,
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

        $answer_a_subject = $theme->answer_a;
        $answer_b_subject = $theme->answer_b;
        $answer_subject = json_encode([$answer_b_subject, $answer_a_subject]);

        $count_answer_a = Answer::where('theme_id', $theme_id)->where('answer', 1)->count();
        $count_answer_b = Answer::where('theme_id', $theme_id)->where('answer', 2)->count();
        $count_answer = json_encode([$count_answer_b, $count_answer_a]);
        $total_count_answer = $count_answer_a + $count_answer_b;

        if($total_count_answer === 0) {
            $percentage_answer_a = 0;
            $percentage_answer_b = 0;
            $percentage_answer = json_encode([0, 0]);
        } else {
            $percentage_answer_a = round(($count_answer_a / $total_count_answer) * 100);
            $percentage_answer_b = round(($count_answer_b / $total_count_answer) * 100);
            $percentage_answer = json_encode([$percentage_answer_b, $percentage_answer_a]);
        }

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

        $comments = Comment::where('theme_id', $theme_id)->orderBy('created_at', 'desc')->paginate(5);
        $count_comment = Comment::where('theme_id', $theme_id)->count();

        return view('themes.result', [
            'theme' => $theme,
            'post_user' => $post_user,
            'answer_subject' => $answer_subject,
            'count_answer_a' => $count_answer_a,
            'count_answer_b' => $count_answer_b,
            'count_answer' => $count_answer,
            'total_count_answer' => $total_count_answer,
            'percentage_answer_a' => $percentage_answer_a,
            'percentage_answer_b' => $percentage_answer_b,
            'percentage_answer' => $percentage_answer,
            'choice_number' => $choice_number,
            'comments' => $comments,
            'count_comment' => $count_comment,
        ]);
    }

    public function create()
    {
        $auth = Auth::user();

        return view('themes.create', ['auth' => $auth,]);
    }

    public function store(ThemeRequest $request, Theme $theme)
    {
        $theme->user_id = $request->user()->id;

        $theme->fill($request->validated())->save();

        $pic_a = $request->pic_a->store('public/selects');
        $file_name_a = basename($pic_a);
        $theme->pic_a = $file_name_a;

        $pic_b = $request->pic_b->store('public/selects');
        $file_name_b = basename($pic_b);
        $theme->pic_b = $file_name_b;

        $request->tags->each(function ($tagName) use ($theme) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $theme->tags()->attach($tag);
        });

        $theme->save();

        return redirect()->route('themes.index')->with('success_message', 'テーマを作成しました。');
    }

    public function edit(Theme $theme, $id)
    {
        if (!ctype_digit($id)) {
            return redirect('/themes/create');
        }

        $theme = Theme::find($id);
        $tagNames = $theme->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('themes.edit', ['theme' => $theme, 'tagNames' => $tagNames,]);
    }

    public function update(ThemeEditRequest $request, $id)
    {
        if (!ctype_digit($id)) {
            return redirect('/themes/create');
        }

        $theme = Theme::find($id);

        $theme->tags()->detach();
        $request->tags->each(function ($tagName) use ($theme) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $theme->tags()->attach($tag);
        });

        $theme->user_id = $request->user()->id;

        $theme->fill($request->validated())->save();

        if (isset($request->pic_a)) {
            $pic_a = $request->pic_a->store('public/selects');
            $file_name_a = basename($pic_a);
            $theme->pic_a = $file_name_a;
        }

        if (isset($request->pic_b)) {
            $pic_b = $request->pic_b->store('public/selects');
            $file_name_b = basename($pic_b);
            $theme->pic_b = $file_name_b;
        }

        $theme->save();

        if ($request->input('tag')) {
            $tag = new Tag;
            $tag->name = $request->input('tag');
            $tag->save();
        }

        return redirect()->route('themes.index')->with('success_message', 'テーマを編集しました。');
    }

    public function destroy($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/themes/create');
        }

        Theme::find($id)->delete();

        return redirect()->route('themes.index')->with('success_message', 'テーマを削除しました。');
    }

    public function comment(Request $request, $theme_id)
    {
        $request->validate([
            'body' => 'required|string|max:100',
        ]);

        $auth_user = Auth::user();

        $comment = new Comment;
        $comment->user_id = $auth_user->id;
        $comment->theme_id = $theme_id;
        $comment->body = $request->body;
        $comment->save();

        return redirect()->back();
    }

    public function bookmark(Request $request, Theme $theme)
    {
        $path = $request->path();
        $theme_id = preg_replace('/[^0-9]/', '', $path);
        $theme = Theme::find($theme_id);
        $theme->bookmarks()->detach($request->user()->id);
        $theme->bookmarks()->sync($request->user()->id);

        return [
            'id' => $theme->id,
            'countBookmarks' => $theme->count_bookmarks,
        ];
    }

    public function unbookmark(Request $request, Theme $theme)
    {
        $theme->bookmarks()->detach($request->user()->id);

        return [
            'id' => $theme->id,
            'countBookmarks' => $theme->count_bookmarks,
        ];
    }
}
