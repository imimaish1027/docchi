@extends('layouts.app')

@section('title', 'ブックマーク')

@section('content')

<div class="p-main">
  <div class="p-main__container p-user">

    @include('layouts.sidebar')

    <div class="p-mytheme">
      <div class="p-user__head__bookmark">
        <p class="c-bookmark__head">ブックマーク</p>
      </div>

      <ul class="p-theme__list__user">
        @foreach($bookmarks as $bookmark)

        <li class="p-theme__one p-theme__one__user">
          @if(auth()->user() && $bookmark->theme->answers->contains('user_id', auth()->user()->id))
          <div class="c-theme__one__title">
            <a href="{{ route('themes.result', ['id' => $bookmark->theme->id]) }}" class="c-theme__link">
              {{ $bookmark->theme->title }}
            </a>
          </div>
          @else
          <div class="c-theme__one__title">
            <a href="{{ route('themes.show', ['id' => $bookmark->theme->id]) }}" class="c-theme__link">
              {{ $bookmark->theme->title }}
            </a>
          </div>
          @endif

          <div class="p-theme__answer p-theme__answer--bookmark">
            <div class="p-theme__list__answer__one">
              <div class="p-list__answer__area p-answer__area--a">
                <img src="{{ asset('/storage/selects/'.$bookmark->theme->pic_a) }}" class="c-list__answer__img">
                <p class="c-list__answer__title c-answer--a">{{ $bookmark->theme->answer_a }}</p>
              </div>
            </div>

            <p class="c-theme__note--or">or</p>

            <div class="p-theme__list__answer__one">
              <div class="p-list__answer__area p-answer__area--b">
                <img src="{{ asset('/storage/selects/'.$bookmark->theme->pic_b) }}" class="c-list__answer__img">
                <p class="c-list__answer__title c-answer--b">{{ $bookmark->theme->answer_b }}</p>
              </div>
            </div>
          </div>
          <ul class="p-tag__group">
            @foreach($bookmark->theme->tags as $tag)
            <li class="c-tag__one">
              <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="c-tag__link">
                {{ $tag->name }}
              </a>
            </li>
            @endforeach
          </ul>
          <div class="p-theme__info">
            <ul class="p-icon__count">
              <li class="p-icon__count__one"><img src="{{ asset('images/answer-icon.png') }}" class="c-icon"><span class="c-count__number">{{ $bookmark->theme->answers->count() }}</span></li>
              <li class="p-icon__count__one"><img src="{{ asset('images/comment-icon.png') }}" class="c-icon"><span class="c-count__number">{{ $bookmark->theme->comments->count() }}</span></li>
              <theme-bookmark :initial-is-bookmarked-by='@json($bookmark->theme->isBookmarkedBy(Auth::user()))' :initial-count-bookmarks='@json($bookmark->theme->count_bookmarks)' :authorized='@json(Auth::check())' endpoint="{{ route('themes.bookmark', ['id' => $bookmark->theme->id]) }}">
              </theme-bookmark>
            </ul>
            <div class="p-post__info">
              <a href="{{ route('users.show', ['id' => $bookmark->theme->user->id]) }}" class="p-post__info__user">
                @isset( $bookmark->theme->user->pic )
                <img src="{{ asset('/storage/users/'.$bookmark->theme->user->pic) }}" class="c-post__avatar">
                @endisset
                @empty( $bookmark->theme->user->pic )
                <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-post__avatar">
                @endempty
                <span class="c-user__name__balloon">{{ $bookmark->theme->user->name }}</span>
              </a>
              <p class="c-list__post__date">{{ $bookmark->theme->created_at->format('Y-m-d') }}</p>
            </div>
          </div>
        </li>

        @endforeach
      </ul>
      {{ $bookmarks->links() }}
    </div>

  </div>
</div>

@endsection