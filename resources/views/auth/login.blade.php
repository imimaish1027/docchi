@extends('layouts.app')

@section('title', 'ログイン')

@section('content')

<div class="p-form">

    <p class="c-form__title">ログイン</p>

    <form method="POST" action="{{ route('login') }}" class="p-form__main">
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

        <div class="p-btn__area">
            <button type="submit" class="c-form__btn btn">
                ログイン
            </button>
        </div>

        <div class="p-btn__area p-btn__area--guest">
            <button type="submit" class="c-form__btn btn">
                <a href="{{ route('login.guest') }}" class="c-guest__link">
                    ゲストログイン
                </a>
            </button>
        </div>

        <div class="p-btn__area">
            <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="c-provider__btn btn">
                <i class="fab fa-google mr-1"></i>Googleでログイン
            </a>
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