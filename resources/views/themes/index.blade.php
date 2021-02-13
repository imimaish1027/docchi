@extends('layouts.app')

@section('title', 'テーマ一覧')

@section('content')

<div class="p-main">
  <div class="p-main__container">
    <div class="p-main__heading__list">
      <div class="p-main__heading__up">
        <p class="c-main__title__text">
          @isset($keyword) 『 {{ $keyword }} 』@endisset @empty($keyword) すべて@endemptyのテーマ一覧
        </p>
      </div>

      <form method="GET" action="{{ route('themes.index') }}">
        <div class="p-main__heading__down">
          <div class="p-form__search p-keyword__search__area">
            {{ csrf_field() }}
            <input name="keyword" type="text" value="{{ $keyword }}" placeholder="キーワードを入力" class="c-form__search__box" autocomplete="off" />
            <button type="submit" class="c-form__search__btn"><i class="fas fa-search"></i></button>

          </div>
          <div class="p-sort__area">
            <select id="sort" name="sort" class="c-sort">
              <option value="newPost" {{ $sortBy == 'newPost' ? 'selected' : '' }}>新着順</option>
              <option value="countAnswer" {{ $sortBy == 'countAnswer' ? 'selected' : '' }}>回答数順</option>
              <option value="countComment" {{ $sortBy == 'countComment' ? 'selected' : '' }}>コメント数順</option>
              <option value="countBookmark" {{ $sortBy == 'countBookmark' ? 'selected' : '' }}>ブックマーク数順</option>
            </select>
          </div>
        </div>
      </form>
    </div>

    <ul class="p-theme__list">
      @foreach($themes as $theme)

      <li class="p-theme__one p-theme__one__index">
        @if(auth()->user() && $theme->answers->contains('user_id', auth()->user()->id))
        <div class="c-theme__one__title">
          <a href="{{ route('themes.result', ['id' => $theme->id]) }}" class="c-theme__link">
            {{ $theme->title }}
          </a>
        </div>
        @else
        <div class="c-theme__one__title">
          <a href="{{ route('themes.show', ['id' => $theme->id]) }}" class="c-theme__link">
            {{ $theme->title }}
          </a>
        </div>
        @endif

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
          @foreach($theme->tags as $tag)
          <li class="c-tag__one">
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="c-tag__link">
              {{ $tag->name }}
            </a>
          </li>
          @endforeach
        </ul>
        <div class="p-theme__info">
          <ul class="p-icon__count">
            <li class="p-icon__count__one"><img src="{{ asset('images/answer-icon.png') }}" class="c-icon"><span class="c-count__number">{{ $theme->answers->count() }}</span></li>
            <li class="p-icon__count__one"><img src="{{ asset('images/comment-icon.png') }}" class="c-icon"><span class="c-count__number">{{ $theme->comments->count() }}</span></li>
            <theme-bookmark :initial-is-bookmarked-by='@json($theme->isBookmarkedBy(Auth::user()))' :initial-count-bookmarks='@json($theme->count_bookmarks)' :authorized='@json(Auth::check())' endpoint="{{ route('themes.bookmark', ['id' => $theme->id]) }}">
            </theme-bookmark>
          </ul>
          <div class="p-post__info">
            <a href="{{ route('users.show', ['id' => $theme->user->id]) }}" class="p-post__info__user">
              @isset( $theme->user->pic )
              <img src="{{ asset('/storage/users/'.$theme->user->pic) }}" class="c-post__avatar">
              @endisset
              @empty( $theme->user->pic )
              <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-post__avatar">
              @endempty
              <span class="c-user__name__balloon">{{ $theme->user->name }}</span>
            </a>
            <p class="c-list__post__date">{{ $theme->created_at->format('Y-m-d') }}</p>
          </div>
        </div>
      </li>

      @endforeach
    </ul>
    {{ $themes->appends(request()->query())->links() }}
  </div>
</div>

@endsection