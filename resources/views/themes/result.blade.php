@extends('layouts.app')

@section('title', 'テーマの回答結果')

@section('content')

<div class="p-main">
  <div class="p-main__container">
    <div class="p-main__heading__answer">
      <div class="p-main__heading__left">
        <p class="c-main__title__text">テーマの回答結果</p>

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
          <theme-bookmark :initial-is-bookmarked-by='@json($theme->isBookmarkedBy(Auth::user()))' :initial-count-bookmarks='@json($theme->count_bookmarks)' :authorized='@json(Auth::check())' endpoint="{{ route('themes.bookmark', ['id' => $theme->id]) }}">
          </theme-bookmark>
        </div>
      </div>
    </div>

    <div class="p-theme">
      <p class="c-theme__title">{{ $theme->title }}</p>

      <page-pie :answer-subjects="{{ $answer_subject }}" :count-answers="{{ $count_answer }}" :percentage-answers="{{ $percentage_answer }}"></page-pie>
      <p class="c-answer__count c-answer__count--total">総回答数　{{ $total_count_answer ?? 0}}件</p>

      <div class="p-theme__answer p-theme__answer--result">
        <div class="p-answer__one">
          <div class="c-your__choice @if($choice_number === 1) c-your__choice--this @endif">
            あなたの回答
          </div>
          <div class="p-answer__area p-answer__area--a">
            <img src="{{ asset('/storage/selects/'.$theme->pic_a) }}" class="c-answer__img">
            <p class="c-answer__title c-answer--a">A. {{ $theme->answer_a }}</p>
          </div>
          <p class="c-answer__count c-answer__count--a">{{ $percentage_answer_a ?? 0}}％</p>
        </div>

        <p class="c-theme__note--or">or</p>

        <div class="p-answer__one">
          <div class="c-your__choice @if($choice_number === 2) c-your__choice--this @endif">
            あなたの回答
          </div>
          <div class="p-answer__area p-answer__area--b">
            <img src="{{ asset('/storage/selects/'.$theme->pic_b) }}" class="c-answer__img">
            <p class="c-answer__title c-answer--b">B. {{ $theme->answer_b }}</p>
          </div>
          <p class="c-answer__count c-answer__count--b">{{ $percentage_answer_b ?? 0}}％</p>
        </div>
      </div>

    </div>
    <div class="p-comment">
      <div class="p-comment__heading">
        <p class="c-comment__title">コメント</p>
        <p class="c-comment__count">{{ $count_comment ?? 0}}件</p>
      </div>
      <div class="p-comment__area">
        <ul class="p-comment__list">
          @forelse($comments as $comment)

          <li class="p-comment__one">
            <div class="p-post__comment__main">
              <div class="p-post__comment__user">
                <a href="{{ route('users.show', ['id' => $theme->user->id]) }}" class="c-post__comment__user__img">
                  @isset( $comment->user->pic )
                  <img src="{{ asset('/storage/users/'.$comment->user->pic) }}" class="c-avatar">
                  @endisset
                  @empty( $comment->user->pic )
                  <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-avatar">
                  @endempty
                </a>
                <p class="c-post__comment__user__info">
                  @switch($comment->user->age)
                  @case(9 < $comment->user->age && $comment->user->age < 20) 10代 @break @case(19 < $comment->user->age && $comment->user->age < 30) 20代 @break @case(29 < $comment->user->age && $comment->user->age < 40) 30代 @break @case(39 < $comment->user->age && $comment->user->age < 50) 40代 @break @case(49 < $comment->user->age && $comment->user->age < 60) 50代 @break @case(59 < $comment->user->age && $comment->user->age < 70) 60代 @break @case(69 < $comment->user->age && $comment->user->age < 80) 70代 @break @case(79 < $comment->user->age && $comment->user->age < 90) 80代 @break @case(89 < $comment->user->age && $comment->user->age < 100) 90代 @break @default @endswitch @if($comment->user->gender === 1) ♂
                                      @elseif($comment->user->gender === 2) ♀
                                      @endif
                </p>
              </div>
              <div class="p-post__comment__content">
                <p class="c-comment__text @if($comment->user->answers[0]['answer'] === 1) c-comment__text--a @elseif($comment->user->answers[0]['answer'] === 2) c-comment__text--b @endif">{{ $comment->body }}</p>
                <div class="c-post__comment__date">{{ $comment->created_at->format('Y-m-d') }}</div>
              </div>
            </div>
          </li>
          @empty
          <p class="c-comment__note">コメントは投稿されていません。</p>
          @endforelse
          {{ $comments->links() }}
        </ul>
      </div>

      <form method="POST" action="{{ route('themes.comment', $theme->id) }}" enctype='multipart/form-data' class="">
        @csrf
        <div class="p-comment__writing">
          <p class="c-comment__writing__text">コメントを書く</p>
          @if(auth()->user() && $theme->answers->contains('user_id', auth()->user()->id))
          <div class="p-counter__text">
            <textarea name="body" id="js-count" maxlength="100" class="c-comment__textarea"></textarea>
            <p class="c-count__text"><span id="js-count__view">0</span>/100字</p>
          </div>
          <div class="c-btn__area--comment">
            <button type="submit" class="c-comment__btn btn">
              送信
            </button>
          </div>
          @else
          <div class="p-counter__text">
            <textarea name="body" id="js-count" maxlength="100" class="c-comment__textarea c-comment__textarea--block" disabled>回答したユーザーのみコメントできます。</textarea>
            <p class="c-count__text"><span id="js-count__view">0</span>/100字</p>
          </div>
          <div class="c-btn__area--comment">
            <button type="submit" class="c-comment__btn btn" disabled>
              送信
            </button>
          </div>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>

@endsection