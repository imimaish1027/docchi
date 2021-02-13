@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')

<div class="p-main">
  <div class="p-main__container p-user">

    @include('layouts.sidebar')

    <div class="p-form__user">
      <p class="c-form__title">プロフィール編集</p>

      <form method="POST" action="{{ route('users.update', $user->id) }}" enctype='multipart/form-data' class="p-form__main">
        @csrf
        @if (Auth::id() == 1)
        <p class="c-danger__text">※ゲストユーザーでは名前を編集できません。</p>
        @endif
        <div class="p-form__one p-form__text">
          <p class="c-form__one__title">ユーザー名</p>
          <div class="p-form__input">
            @if (Auth::id() == 1)
            <input id="name" type="text" name="name" value="{{ $user->name }}" autocomplete="name" class="c-form__text form-control @error('name') is-invalid @enderror" readonly>
            @else
            <input id="name" type="text" name="name" value="{{ $user->name }}" autocomplete="name" class="c-form__text form-control @error('name') is-invalid @enderror">
            @endif
          </div>
        </div>
        @error('name')
        <div class="invalid__feedback" role="alert">
          {{ $message }}
        </div>
        @enderror

        <div class="p-form__one p-form__number">
          <p class="c-form__one__title">年齢</p>
          <div class="p-form__input p-form__number__group">
            <input type="number" name="age" id="age" value="{{ $user->age }}" max=100 min=0 class="c-form__number form-control @error('age') is-invalid @enderror">
            <p class=" c-form__number__text">歳</p>
          </div>
        </div>
        @error('age')
        <div class="invalid__feedback" role="alert">
          {{ $message }}
        </div>
        @enderror

        <div class="p-form__one p-form__pic">
          <p class="c-form__one__title">プロフィール画像</p>
          <div class="p-form__input">
            <label class="p-form__pic__one p-area__drop  form-control @error('pic') is-invalid @enderror">
              <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
              <input id="pic" type="file" name="pic" value="{{ old('pic') }}" class="c-form__pic">
              <p class="c-area__drop__text">クリックorドラッグ&ドロップで<br>画像をアップロード</p>
            </label>
          </div>
        </div>
        @error('pic')
        <div class="invalid__feedback c-error__pic__text" role="alert">
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