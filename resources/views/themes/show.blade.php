@extends('layouts.app')

@section('title', 'テーマの回答')

@section('content')

<div class="p-main">
  <div class="p-main__container">
    <div class="p-main__heading__answer">
      <div class="p-main__heading__left">
        <p class="c-main__title__text">テーマの回答</p>

        <ul class="p-tag__group">
          @foreach($theme->tags as $tag)
          <li class="c-tag__one">
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="c-tag__link">
              {{ $tag->name }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>

      <div class="p-main__heading__right">
        <div class="c-post__date">{{ $theme['created_at']->format('Y-m-d') }}</div>
        <div class="p-post__user--answer">
          <a href="{{ route('users.show', ['id' => $theme->user->id]) }}" class="c-post__user__img c-avatar">
            @isset( $theme->user->pic )
            <img src="{{ asset('/storage/users/'.$theme->user->pic) }}" class="c-post__user__img c-avatar">
            @endisset
            @empty( $theme->user->pic )
            <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-post__avatar">
            @endempty
          </a>
          <a href="{{ route('users.show', ['id' => $theme->user->id]) }}" class="c-user__link">
            <div class="c-post__user__name">{{ $post_user->name }}</div>
          </a>
        </div>
        <div class="p-bookmark__area">
          @Auth
          @can('edit', $theme)
          <a href="{{ route('themes.edit', ['id' => $theme->id]) }}" class="c-theme__link c-theme__edit__link">編集</a>
          @endcan
          @endauth
          <theme-bookmark :initial-is-bookmarked-by='@json($theme->isBookmarkedBy(Auth::user()))' :initial-count-bookmarks='@json($theme->count_bookmarks)' :authorized='@json(Auth::check())' endpoint="{{ route('themes.bookmark', ['id' => $theme->id]) }}">
          </theme-bookmark>
        </div>
      </div>
    </div>

    <div class="p-theme">
      <p class="c-theme__title">{{ $theme->title }}</p>
      <p class="c-theme__note--guide">AかBのどちらかを選んでください。</p>

      <form method="POST" action="{{ route('themes.answer', $theme->id) }}" enctype='multipart/form-data'>
        @csrf
        <div class="p-theme__answer p-theme__answer--which">
          <div class="p-answer__one">
            <div class="p-answer__area p-answer__area--a">
              <img src="{{ asset('/storage/selects/'.$theme->pic_a) }}" class="c-answer__img">
              <p class="c-answer__title c-answer--a">A. {{ $theme->answer_a }}</p>
            </div>
            @auth
            <button type="submit" name="answer" value="1" class="c-answer__btn c-answer__btn--a btn">
              <input type="hidden" name="post_user" value="{{ $post_user }}">
              @endauth
              @guest
              <button type="submit" name="answer" value="1" class="c-answer__btn c-answer__btn--a btn" disabled style="cursor:not-allowed;">
                <input type="hidden" name="post_user" value="{{ $post_user }}">
                @endguest
                Aを選ぶ
              </button>
          </div>

          <p class="c-theme__note--or">or</p>

          <div class="p-answer__one">
            <div class="p-answer__area p-answer__area--b">
              <img src="{{ asset('/storage/selects/'.$theme->pic_b) }}" class="c-answer__img">
              <p class="c-answer__title c-answer--b">B. {{ $theme->answer_b }}</p>
            </div>
            @auth
            <button type="submit" name="answer" value="2" class="c-answer__btn c-answer__btn--b btn">
              <input type="hidden" name="post_user" value="{{ $post_user }}">
              @endauth
              @guest
              <button type="submit" name="answer" value="2" class="c-answer__btn c-answer__btn--b btn" disabled style="cursor:not-allowed;">
                <input type="hidden" name="post_user" value="{{ $post_user }}">
                @endguest
                Bを選ぶ
              </button>
          </div>
        </div>
      </form>

      <div class="c-btn__area">
        <button type="submit" class="c-result__btn btn">
          <a href="{{ route('themes.result', ['id' => $theme->id]) }}" class="c-theme__result__link">
            回答せず結果を見る
          </a>
        </button>
      </div>
    </div>
  </div>
</div>

@endsection