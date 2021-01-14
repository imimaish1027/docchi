@extends('layouts.app')

@section('title', 'テーマの回答')

@section('content')

<div class="p-main">
  <div class="p-main__container">
    <div class="p-main__heading__answer">
      <div class="p-main__heading__left">
        <p class="c-main__title__text">テーマの回答</p>
    
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
        <div class="p-bookmark__area"><i class="fas fa-star fa-lg"></i><p class="c-bookmark__count">100</p></div>
      </div>
    </div>

    <div class="p-theme">
      <p class="c-theme__title">{{ $theme->title }}</p>
      <p class="c-theme__note--guide">AかBのどちらかを選んでください。</p>

      <div class="p-theme__answer">
        <div class="p-answer__one">
          <div class="p-answer__area p-answer__area--a">
            <img src="{{ asset('/storage/selects/'.$theme->pic_a) }}" class="c-answer__img">
            <p class="c-answer__title c-answer--a">A {{ $theme->answer_a }}</p>
          </div>
          <button type="submit" class="c-answer__btn c-answer__btn--a btn">
            Aを選ぶ
          </button>
        </div>

        <p class="c-theme__note--or">or</p>

        <div class="p-answer__one">
          <div class="p-answer__area p-answer__area--b">
            <img src="{{ asset('/storage/selects/'.$theme->pic_b) }}" class="c-answer__img">
            <p class="c-answer__title c-answer--b">A {{ $theme->answer_b }}</p>
          </div>
          <button type="submit" class="c-answer__btn c-answer__btn--b btn">
            Aを選ぶ
          </button>
        </div>
      </div>

      <div class="c-btn__area">
        <button type="submit" class="c-result__btn btn">
          回答せず結果を見る
        </button>
      </div>
    </div>
  </div>
</div>

@endsection