<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Theme;
use App\User;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function show(Request $request, string $name)
    {
        $users = User::all();

        $selected_tag = Tag::where('name', $name)->first();
        $selected_tag_name = $selected_tag->name;

        $keyword = $request->input('keyword');

        if($keyword) {
            $themes = Theme::query()
                ->when($request->has('keyword'), function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                })->orderBy('created_at', 'desc')->paginate(10);
            return view('themes.index', ['themes' => $themes, 'users' => $users, 'keyword' => $keyword])->with('sortBy', 'newPost');
        }

        switch ($request->sort) {
            case 'newPost':
                $themes = Theme::join('theme_tag', 'themes.id', '=', 'theme_tag.theme_id')->join('tags', 'theme_tag.tag_id', '=', 'tags.id')
                    ->when($selected_tag_name, function ($query) use ($selected_tag_name) {
                        $query->where('tags.name', '=', $selected_tag_name);
                    })->withCount('tags')->orderBy('themes.created_at', 'desc')->paginate(10);
                break;
            case 'countAnswer':
                $themes = Theme::join('theme_tag', 'themes.id', '=', 'theme_tag.theme_id')->join('tags', 'theme_tag.tag_id', '=', 'tags.id')
                    ->when($selected_tag_name, function ($query) use ($selected_tag_name) {
                        $query->where('tags.name', '=', $selected_tag_name);
                    })->withCount('answers')->orderBy('answers_count', 'desc')->paginate(10);
                break;
            case 'countComment':
                $themes = Theme::join('theme_tag', 'themes.id', '=', 'theme_tag.theme_id')->join('tags', 'theme_tag.tag_id', '=', 'tags.id')
                    ->when($selected_tag_name, function ($query) use ($selected_tag_name) {
                        $query->where('tags.name', '=', $selected_tag_name);
                    })->withCount('comments')->orderBy('comments_count', 'desc')->paginate(10);
                break;
            case 'countBookmark':
                $themes = Theme::join('theme_tag', 'themes.id', '=', 'theme_tag.theme_id')->join('tags', 'theme_tag.tag_id', '=', 'tags.id')
                    ->when($selected_tag_name, function ($query) use ($selected_tag_name) {
                        $query->where('tags.name', '=', $selected_tag_name);
                    })->withCount('bookmarks')->orderBy('bookmarks_count', 'desc')->paginate(10);
                break;
            case '':
                $themes = Theme::join('theme_tag', 'themes.id', '=', 'theme_tag.theme_id')->join('tags', 'theme_tag.tag_id', '=', 'tags.id')
                    ->when($selected_tag_name, function ($query) use ($selected_tag_name) {
                        $query->where('tags.name', '=', $selected_tag_name);
                    })->withCount('tags')->orderBy('themes.created_at', 'desc')->paginate(10);
                break;
        }

        return view('tags.show', ['themes' => $themes, 'users' => $users, 'selected_tag' => $selected_tag])->with('sortBy', $request->sort);
    }
}
