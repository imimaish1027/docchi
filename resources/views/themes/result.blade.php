@extends('layouts.app')

@section('title', 'テーマの回答結果')

@section('content')

<div class="p-main">
  <div class="p-main__container">
    <div class="p-main__heading__answer">
      <div class="p-main__heading__left">
        <p class="c-main__title__text">テーマの回答結果</p>

        <div class="p-tag__group">
          <div class="c-tag__one">朝食</div>
        </div>
      </div>

      <div class="p-main__heading__right">
        <div class="c-post__date">{{ $theme['created_at']->format('Y-m-d') }}</div>
        <div class="p-post__user--answer">
          <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-post__user__img c-avatar">
          <div class="c-post__user__name">{{ $post_user->name }}</div>
        </div>
        <div class="p-bookmark__area"><i class="fas fa-star fa-lg"></i>
          <p class="c-bookmark__count">100</p>
        </div>
      </div>
    </div>

    <div class="p-theme">
      <p class="c-theme__title">{{ $theme->title }}</p>
      <p class="c-theme__note--guide">回答数 50</p>

      <p class="c-theme__note--guide">Aの選択数 {{ $count_answer_a ?? 0}}</p>
      <p class="c-theme__note--guide">Bの選択数 {{ $count_answer_b ?? 0}}</p>

      <div class="p-theme__answer">
        <div class="p-answer__one">
          <div class="c-your__choice @if($choice_number === 1) c-your__choice--this @endif">
            あなたの選択
          </div>
          <div class="p-answer__area p-answer__area--a">
            <img src="{{ asset('/storage/selects/'.$theme->pic_a) }}" class="c-answer__img">
            <p class="c-answer__title c-answer--a">A {{ $theme->answer_a }}</p>
          </div>
        </div>

        <p class="c-theme__note--or">or</p>

        <div class="p-answer__one">
          <div class="c-your__choice @if($choice_number === 2) c-your__choice--this @endif">
            あなたの選択
          </div>
          <div class="p-answer__area p-answer__area--b">
            <img src="{{ asset('/storage/selects/'.$theme->pic_b) }}" class="c-answer__img">
            <p class="c-answer__title c-answer--b">A {{ $theme->answer_b }}</p>
          </div>
        </div>
      </div>

    </div>
    <div class="p-comment">
      <div class="p-comment__heading">
        <p class="c-comment__title">コメント</p>
        <p class="c-comment__count">{{ $count_comment }}件</p>
      </div>
      <div class="p-comment__area">
        <ul class="p-comment__list">
          @foreach($comments as $comment)
          <li class="p-comment__one">
            <div class="p-post__comment__main">
              <div>
                <div class="c-post__comment__user__img">
                  <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-avatar">
                </div>
                <p class="c-post__comment__user__info">
                  {{ $comment->user->age }}@if($comment->user->age)歳　
                  @endif

                  @if($comment->user->gender === 1)♂
                  @elseif($comment->user->gender === 2)♀
                  @endif

                </p>
              </div>

              <div>
                <p class="c-comment__text @if($comment->user->answer['answer'] === 1) c-comment__text--a @elseif($comment->user->answer['answer'] === 2) c-comment__text--b @endif">{{ $comment->body }}</p>
                <div class="c-post__comment__date">{{ $comment->created_at->format('Y-m-d') }}</div>
              </div>
            </div>
          </li>

          @endforeach
        </ul>
        {{ $comments->links() }}
      </div>

      <form method="POST" action="{{ route('themes.comment', $theme->id) }}" enctype='multipart/form-data' class="">
        @csrf
        <div class="p-comment__writing">
          <p class="c-comment__writing__text">コメントを書く</p>
          <div class="p-counter__text">
            <textarea name="body" id="js-count" maxlength="100" class="c-comment__textarea"></textarea>
            <p class="c-count__text"><span id="js-count__view">0</span>/100字</p>
          </div>
          <div class="c-btn__area--comment">
            <button type="submit" class="c-comment__btn btn">
              {{ __('送信') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection