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
        <div class="p-theme__answer__one">
          <div class="p-theme__answer__area p-theme__answer--a">
            <img src="{{ asset('/storage/selects/'.$theme->pic_a) }}" class="c-theme__answer__img c-theme__answer__img--a">
            <p class="c-theme__answer__title c-theme__answer__title--a">A {{ $theme->answer_a }}</p>
          </div>
          <button type="submit" class="c-answer__btn c-answer__btn--a btn">
            Aを選ぶ
          </button>
        </div>

        <p class="c-theme__note--or">or</p>

        <div class="p-theme__answer__one">
          <div class="p-theme__answer__area p-theme__answer--b">
          <img src="{{ asset('/storage/selects/'.$theme->pic_b) }}" class="c-theme__answer__img c-theme__answer__img--b">
            <p class="c-theme__answer__title c-theme__answer__title--b">B {{ $theme->answer_b }}</p>
          </div>
          <button type="submit" class="c-answer__btn c-answer__btn--b btn">
            Bを選ぶ
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