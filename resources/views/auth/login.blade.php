@extends('layouts.app')

@section('title', 'ログイン')

@section('content')

<div class="p-form">

    <p class="c-form__title">ログイン</p>

    <form method="POST" action="{{ route('login') }}" class="p-form__main">
        @csrf
        <div class="p-form__one p-form__text">
            <p class="c-form__one__title">メールアドレス</p>
            <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="c-form__text form-control @error('email') is-invalid @enderror">
        </div>
        @error('email')
        <div class="invalid__feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <div class="p-form__one p-form__text">
            <p class="c-form__one__title">パスワード</p>
            <input type="password" name="password" id="password" value="" autocomplete="password" autocomplete="new-password" class="c-form__text password @error('password') is-invalid @enderror">
        </div>
        @error('password')
        <div class="invalid__feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <div class="c-btn__area">
            <button type="submit" class="c-form__btn btn">
                {{ __('ログイン') }}
            </button>
        </div>

        <div class="p-form__remember">
            <div class="p-form__remember__group">
                <input type="checkbox" name="remember" id="remember" class="c-form__remember checkbox" {{ old('remember') ? 'checked' : '' }}>
                <label class="c-form__remember__label" for="remember">{{ __('ログイン情報を保持する') }}</label>
            </div>
            <a href="{{ route('password.request') }}" class="c-login__option">パスワードを忘れた場合</a>
        </div>
    </form>
</div>

@endsection