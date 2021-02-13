@extends('layouts.app')

@section('title', 'メールアドレス変更')

@section('content')

<div class="p-main">
  <div class="p-main__container p-user">

    @include('layouts.sidebar')

    <div class="p-form__user">
      <p class="c-form__title">メールアドレス変更</p>

      <form method="POST" action="{{ route('users.emailUpdate', $user->id) }}" enctype='multipart/form-data' class="p-form__main">
        @csrf
        @method('PUT')
        @if (Auth::id() == 1)
        <p class="c-danger__text">※ゲストユーザーではメールアドレスを変更できません。</p>
        @endif
        <div class="p-form__one p-form__text">
          <p class="c-form__one__title">現在のメールアドレス</p>
          <p class="c-email__text">{{ $user->email }}</p>
        </div>

        <div class="p-form__one p-form__text">
          <p class="c-form__one__title">新しいメールアドレス</p>
          <div class="p-form__input">
            @if (Auth::id() == 1)
            <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="c-form__text form-control" disabled>
            @else
            <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="c-form__text form-control @error('email') is-invalid @enderror">
            @endif
          </div>
        </div>
        @error('email')
        <div class="invalid__feedback" role="alert">
          <div class="c-error__empty__area"></div>
          <strong class="c-error__text__area">{{ $message }}</strong>
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