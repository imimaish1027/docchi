@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('content')

<div class="p-form">

  <p class="c-form__title">お問い合わせ</p>

  <form method="POST" action="{{ route('contact.confirm') }}" enctype='multipart/form-data' class="p-form__main">
    @csrf

    <div class="p-form__one p-form__text">
      <p class="c-form__one__title">メールアドレス</p>
      <div class="p-form__input">
        <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="c-form__text form-control @error('email') is-invalid @enderror">
      </div>
    </div>
    @error('email')
    <div class="invalid__feedback" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @enderror

    <div class="p-form__one p-form__text">
      <p class="c-form__one__title">件名</p>
      <div class="p-form__input">
        <input id="title" type="text" name="title" value="{{ old('title') }}" autocomplete="title" class="c-form__text form-control @error('title') is-invalid @enderror">
      </div>
    </div>
    @error('title')
    <div class="invalid__feedback" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @enderror

    <div class="p-form__one p-form__text">
      <p class="c-form__one__title">お問い合わせ内容</p>
      <div class="p-form__input">
        <textarea name="body" class="c-contact__textarea">{{ old('body') }}</textarea>
      </div>
    </div>
    @error('subject')
    <div class="invalid__feedback" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @enderror

    <div class="p-btn__area">
      <button type="submit" class="c-contact__btn btn">
        {{ __('入力内容確認') }}
      </button>
    </div>
  </form>
</div>

@endsection