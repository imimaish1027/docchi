@extends('layouts.app')

@section('title', 'パスワード変更')

@section('content')

<div class="p-main">
  <div class="p-main__container p-user">

    @include('layouts.sidebar')

    <div class="p-form__user">
      <p class="c-form__title">パスワード変更</p>

      <form method="POST" action="{{ route('users.passUpdate', $user->id) }}" enctype='multipart/form-data' class="p-form__main">
        @csrf
        @method('PUT')

        <div class="p-form__one p-form__text">
          <p class="c-form__one__title">パスワード</p>
          <div class="p-form__input">
            <input type="password" name="password" id="password" value="" autocomplete="password" autocomplete="new-password" class="c-form__text password @error('password') is-invalid @enderror">
          </div>
        </div>
        @error('password')
        <div class="invalid__feedback" role="alert">
          <div class="c-error__empty__area"></div>
          <strong class="c-error__text__area">{{ $message }}</strong>
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
          <div class="c-error__empty__area"></div>
          <strong class="c-error__text__area">{{ $message }}</strong>
        </div>
        @enderror

        <div class="p-btn__area">
          <button type="submit" class="c-form__btn btn">
            {{ __('変更') }}
          </button>
        </div>
      </form>
    </div>

  </div>
</div>

@endsection