@extends('layouts.app')

@section('title', 'テーマ一覧')

@section('content')

<div class="p-main">
  <div class="p-main__container">
    <div class="p-main__heading__list">
      <div class="p-main__heading__up">
        <p class="c-main__title__text">すべてのテーマ一覧</p>
      </div>

      <div class="p-main__heading__down">
        <div class="p-keyword__search__area">
          <form method="GET" action="" class="p-form__search">
            <input name="search" type="text" placeholder="キーワードを入力" class="c-form__search__box" />
            <button type="submit" class="c-form__search__btn"><i class="fas fa-search"></i></button>
          </form>
        </div>
        <div class="p-sort__area">
          <select name="sort" id="sort" class="c-sort">
            <option value="1" checked>新着順</option>
            <option value="2">投票数順</option>
            <option value="3">コメント数順</option>
            <option value="4">ブックマーク数順</option>
          </select>
        </div>
      </div>
    </div>

    <ul class="p-theme__list">
      @foreach($themes as $theme)

      <li class="p-theme__one p-theme__one__index">
        <p class="c-theme__one__title">{{ $theme->title }}</p>
        <div class="p-theme__answer p-theme__answer--index">
          <div class="p-theme__list__answer__one">
            <div class="p-list__answer__area p-answer__area--a">
              <img src="{{ asset('/storage/selects/'.$theme->pic_a) }}" class="c-list__answer__img">
              <p class="c-list__answer__title c-answer--a">{{ $theme->answer_a }}</p>
            </div>
          </div>

          <p class="c-theme__note--or">or</p>

          <div class="p-theme__list__answer__one">
            <div class="p-list__answer__area p-answer__area--b">
              <img src="{{ asset('/storage/selects/'.$theme->pic_b) }}" class="c-list__answer__img">
              <p class="c-list__answer__title c-answer--b">{{ $theme->answer_b }}</p>
            </div>
          </div>
        </div>
        <ul class="p-tag__group">
          <li class="c-tag__one">タグ1</li>
          <li class="c-tag__one">タグ2</li>
        </ul>
        <div class="p-theme__info">
          <ul class="p-icon__count">
            <li class="p-icon__count__one"><img src="{{ asset('images/answer-icon.png') }}" class="c-icon"><span class="c-count__number">10</span></li>
            <li class="p-icon__count__one"><img src="{{ asset('images/comment-icon.png') }}" class="c-icon"><span class="c-count__number">10</span></li>
            <theme-bookmark :initial-is-bookmarked-by='@json($theme->isBookmarkedBy(Auth::user()))' :initial-count-bookmarks='@json($theme->count_bookmarks)' :authorized='@json(Auth::check())' endpoint="{{ route('themes.bookmark', ['id' => $theme->id]) }}">
            </theme-bookmark>
          </ul>
          <div class="p-post__info">
            <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-post__avatar">
            <p class="c-list__post__date">{{ $theme->created_at->format('Y-m-d') }}</p>
          </div>
        </div>
      </li>

      @endforeach
    </ul>
    {{ $themes->links() }}
  </div>
</div>

@endsection