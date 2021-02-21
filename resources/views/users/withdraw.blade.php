@extends('layouts.app')

@section('title', 'アカウント削除')

@section('content')

<div class="p-main">
  <div class="p-main__container p-user">

    @include('layouts.sidebar')

    <div class="p-form__user">
      <p class="c-form__title">アカウント削除</p>

      <form method="POST" action="{{ route('users.destroy', $user->id) }}" enctype='multipart/form-data' class="p-form__main">
        @csrf
        @method('DELETE')

        @if (Auth::id() == 1)
        <p class="c-danger__text">※ゲストユーザーでは退会できません。</p>
        @else
        <p>アカウントを削除すると、作成したテーマやブックマーク情報などすべて削除されます。
          本当に退会しますか？</p>
        @endif

        <div class="p-btn__area">
          @if (Auth::id() == 1)
          <button type="submit" class="c-form__btn btn" disabled>
            @else
            <button type="submit" class="c-form__btn btn">
              @endif
              {{ __('退会する') }}
            </button>
        </div>
      </form>
    </div>

  </div>
</div>

@endsection