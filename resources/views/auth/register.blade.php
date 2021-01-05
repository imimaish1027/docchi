@extends('layouts.app')

@section('title', '新規登録')

@section('content')

<div class="p-form">
  <div class="p-form__title">
    <p class="c-form__title__text">新規登録</p>
  </div>
  <form method="POST" action="{{ route('register') }}" class="p-form__main">
    {{ csrf_field() }}
    <div class="p-form__one">
      <p class="c-form__one__title">ユーザー名</p>
      <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" class="c-form__text form-control @error('name') is-invalid @enderror">
      @if(@error)
      <div class="error-message-field">
        @error('name')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
      </div>
      @endif
    </div>
    <div class="p-form__one">
      <p class="c-form__one__title">メールアドレス</p>
      <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="c-form__text form-control @error('email') is-invalid @enderror">
      @if(@error)
      <div class="error-message-field">
        @error('email')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
      </div>
      @endif
    </div>
    <div class="p-form__one">
      <p class="c-form__one__title">性別</p>
      <div class="p-form__check">
        <div class="p-form__check__one">
          <input class="c-form__check__input" type="radio" id="man" name="man" value="1">
          <label class="c-form__check__label" for="man">♂</label>
        </div>
        <div class="p-form__check__one">
          <input class="c-form__check__input" type="radio" id="woman" name="woman" value="2" checked="checked">
          <label class="c-form__check__label" for="woman">♀</label>
        </div>
      </div>
    </div>
    <div class="p-form__one">
      <p class="c-form__one__title">年齢</p>
      <input class="" type="number" id="age" name="age" max=100 min=0>
    </div>
    <div class="p-form__one">
      <p class="c-form__one__title">パスワード</p>
      <input id="password" type="password" name="password" value="" autocomplete="password" autocomplete="new-password" class="c-form__text @error('password') is-invalid @enderror">
      @if(@error)
      <div class=" error-message-field">
        @error('password')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
      </div>
      @endif
    </div>
    <div class="p-form__one">
      <p class="c-form__one__title">パスワード(確認)</p>
      <input id="password_confirm" type="password" name="password_confirm" value="" autocomplete="password" autocomplete="new-password" class="c-form__text @error('password_confirm') is-invalid @enderror">
      @if(@error)
      <div class="error-message-field">
        @error('password_confirm')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
      </div>
      @endif
    </div>

    <button type="submit" class="c-form__btn btn">
      {{ __('登録') }}
    </button>
  </form>
</div>

@endsection