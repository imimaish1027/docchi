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

        @if (Auth::id() == 1)
        <p class="c-danger__text">※ゲストユーザーではパスワードを変更できません。</p>
        @endif
        <div class="p-form__one p-form__text">
          <p class="c-form__one__title">パスワード</p>
          <div class="p-form__input">
            @if (Auth::id() == 1)
            <input type="password" name="password" id="password" value="" autocomplete="password" autocomplete="new-password" class="c-form__text password c-password__disabled" disabled>
            @else
            <input type="password" name="password" id="password" value="" autocomplete="password" autocomplete="new-password" class="c-form__text password @error('password') is-invalid @enderror">
            @endif
          </div>
        </div>
        @error('password')
        <div class="invalid__feedback" role="alert">
          {{ $message }}
        </div>
        @enderror

        <div class="p-form__one p-form__text ">
          <p class="c-form__one__title">パスワード(確認)</p>
          <div class="p-form__input">
            @if (Auth::id() == 1)
            <input type="password" name="confirm" id="confirm" value="" autocomplete="password" autocomplete="new-password" class="c-form__text password c-password__disabled" disabled>
            @else
            <input type="password" name="confirm" id="confirm" value="" autocomplete="password" autocomplete="new-password" class="c-form__text password @error('confirm') is-invalid @enderror">
            @endif
          </div>
        </div>
        @error('confirm')
        <div class="invalid__feedback" role="alert">
          {{ $message }}
        </div>
        @enderror

        <div class="p-btn__area">
          @if (Auth::id() == 1)
          <button type="submit" class="c-form__btn btn" disabled>
            {{ __('変更') }}
          </button>
          @else
          <button type="submit" class="c-form__btn btn">
            {{ __('変更') }}
          </button>
          @endif
        </div>
      </form>
    </div>

  </div>
</div>

@endsection