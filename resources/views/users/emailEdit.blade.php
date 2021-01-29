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
        <div class="p-form__one p-form__text">
          <p class="c-form__one__title">現在のメールアドレス</p>
          <p class="c-email__text">{{ $user->email }}</p>
        </div>

        <div class="p-form__one p-form__text">
          <p class="c-form__one__title">新しいメールアドレス</p>
          <div class="p-form__input">
            <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="c-form__text form-control @error('email') is-invalid @enderror">
          </div>
        </div>
        @error('email')
        <div class="invalid__feedback" role="alert">
          <strong>{{ $message }}</strong>
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