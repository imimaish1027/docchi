@extends('layouts.app')

@section('title', 'パスワードリセット')

@section('content')

<div class="p-form">

    <p class="c-form__title">パスワードリセット</p>

    <form method="POST" action="{{ route('password.email') }}" class="p-form__main">
        @csrf
        <p class="c-form__note">パスワードを再設定するためのリンクを送ります。</p>

        <div class="p-form__one p-form__text">
            <p class="c-form__one__title">メールアドレス</p>
            <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="c-form__text form-control @error('email') is-invalid @enderror">
        </div>
        @error('email')
        <div class="invalid__feedback" role="alert">
            <strong>{{ $message }}</strong>
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