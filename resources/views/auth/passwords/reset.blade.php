@extends('layouts.app')

@section('title', 'パスワードリセット')

@section('content')

<div class="p-form">

    <p class="c-form__title">パスワードリセット</p>

    <form method="POST" action="{{ route('password.update') }}" class="p-form__main">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="p-form__one p-form__text">
            <p class="c-form__one__title">メールアドレス</p>
            <input id="email" type="text" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" class="c-form__text form-control @error('email') is-invalid @enderror">
        </div>
        @error('email')
        <div class="invalid__feedback" role="alert">
            <div class="c-error__empty__area"></div>
            <strong class="c-error__text__area">{{ $message }}</strong>
        </div>
        @enderror

        <div class="p-form__one p-form__text">
            <p class="c-form__one__title">パスワード</p>
            <input type="password" name="password" id="password" autocomplete="password" autocomplete="new-password" class="c-form__text password @error('password') is-invalid @enderror">
        </div>
        @error('password')
        <div class="invalid__feedback" role="alert">
            <div class="c-error__empty__area"></div>
            <strong class="c-error__text__area">{{ $message }}</strong>
        </div>
        @enderror
        <div class="p-form__one p-form__text">
            <p class="c-form__one__title">パスワード(確認)</p>
            <input type="password" name="password_confirmation" id="password-confirm" autocomplete="password" autocomplete="new-password" class="c-form__text password @error('confirm') is-invalid @enderror">
        </div>
        @error('confirm')
        <div class="invalid__feedback" role="alert">
            <div class="c-error__empty__area"></div>
            <strong class="c-error__text__area">{{ $message }}</strong>
        </div>
        @enderror

        <div class="c-btn__area">
            <button type="submit" class="c-form__btn btn">
                {{ __('送信') }}
            </button>
        </div>

    </form>
</div>

@endsection