@extends('layouts.app')

@section('title', '新規登録')

@section('content')

<div class="p-form">

  <p class="c-form__title">新規登録</p>

  <form method="POST" action="{{ route('register') }}" class="p-form__main">
    @csrf
    <div class="p-form__one p-form__text">
      <p class="c-form__one__title">ユーザー名</p>
      <div class="p-form__input">
        <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" class="c-form__text form-control @error('name') is-invalid @enderror">
      </div>
    </div>
    @error('name')
    <div class="invalid__feedback" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @enderror

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

    <div class="p-form__one p-form__check">
      <p class="c-form__one__title">性別</p>
      <div class="p-form__input p-form__check__group">
        <div class="p-gender__check p-gender--man">
          <input type="radio" name="gender" id="man" value="1" checked class="c-form__check__input checkbox">
          <label class="c-gender__label--man" for="man">♂</label>
        </div>
        <div class="p-gender__check p-gender--woman">
          <input type="radio" name="gender" id="woman" value="2" class="c-form__check__input checkbox">
          <label class="c-gender__label--woman" for="woman">♀</label>
        </div>
      </div>
    </div>

    <div class="p-form__one p-form__number">
      <p class="c-form__one__title">年齢</p>
      <div class="p-form__input p-form__number__group">
        <input type="number" name="age" id="age" value="{{ old('age') }}" max=100 min=0 class="c-form__number form-control @error('age') is-invalid @enderror">
        <p class=" c-form__number__text">歳</p>
      </div>
    </div>
    @error('age')
    <div class="invalid__feedback" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @enderror

    <div class="p-form__one p-form__text">
      <p class="c-form__one__title">パスワード</p>
      <div class="p-form__input">
        <input type="password" name="password" id="password" value="" autocomplete="password" autocomplete="new-password" class="c-form__text password @error('password') is-invalid @enderror">
      </div>
    </div>
    @error('password')
    <div class="invalid__feedback" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @enderror
    <div class="p-form__one p-form__text ">
      <p class="c-form__one__title">パスワード(確認)</p>
      <div class="p-form__input">
        <input type="password" name="confirm" id="confirm" value="" autocomplete="password" autocomplete="new-password" class="c-form__text password @error('confirm') is-invalid @enderror">
      </div>
    </div>
    @error('confirm')
    <div class="invalid__feedback" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @enderror

    <div class="c-btn__area">
      <button type="submit" class="c-form__btn btn">
        {{ __('登録する') }}
      </button>
    </div>
  </form>
</div>

@endsection