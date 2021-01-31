@extends('layouts.app')

@section('title', 'お問い合わせ確認')

@section('content')

<div class="p-form">

  <p class="c-form__title">お問い合わせ確認</p>

  <form method="POST" action="{{ route('contact.send') }}" enctype='multipart/form-data' class="p-form__main">
    @csrf

    <div class="p-form__one p-form__text">
      <p class="c-form__one__title">メールアドレス</p>
      <div class="p-form__input">
        {{ $inputs['email'] }}
        <input name="email" value="{{ $inputs['email'] }}" type="hidden">
      </div>
    </div>

    <div class="p-form__one p-form__text">
      <p class="c-form__one__title">件名</p>
      <div class="p-form__input">
        {{ $inputs['title'] }}
        <input name="title" value="{{ $inputs['title'] }}" type="hidden">
      </div>
    </div>

    <div class="p-form__one p-form__text">
      <p class="c-form__one__title">お問い合わせ内容</p>
      <div class="p-form__input">
        {!! nl2br(e($inputs['body'])) !!}
        <input name="body" value="{{ $inputs['body'] }}" type="hidden">
      </div>
    </div>

    <div class="p-btn__area p-btn__area--double">
      <button type="submit" name="action" value="submit" class="c-contact__btn btn">
        送信
      </button>
      <button type="submit" name="action" value="back" class="c-contact__btn c-btn--down btn">
        入力内容修正
      </button>
    </div>
  </form>
</div>

@endsection