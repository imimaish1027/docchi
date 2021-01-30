<div class="l-sidebar">
  <div class="p-user__info">
    @isset( $user->pic )
    <img src="{{ asset('/storage/users/'.$user->pic) }}" class="c-user__img">
    @endisset
    @empty( $user->pic )
    <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-user__img">
    @endempty
    <p class="c-user__name">{{ $user->name }}</p>
    <p class="c-user__age__gender">20代　♂</p>

    <div class="p-count__themes">
      <div class="p-count__post__themes">
        <a class="c-post__theme__link" href="{{ route('users.show', ['id' => $user->id]) }}">
          投稿
        </a>
        <br>
        <a class="c-post__theme__link" href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->themes->count()}}</a>

      </div>
      <div class="p-count__answer__themes">
        <a class="c-answer__theme__link" href="{{ route('users.answer', ['id' => $user->id]) }}">
          回答
        </a>
        <br>
        <a class="c-answer__theme__link" href="{{ route('users.answer', ['id' => $user->id]) }}">
          {{ $user->answer->count() }}
        </a>
      </div>
    </div>
  </div>

  @if( Auth::id() === $user->id )
  <div class="p-user__nav">
    <ul class="p-user__nav__list">
      <li class="p-user__nav__one">
        <div class="c-user__nav__icon__box">
          <img src="{{ asset('images/mytheme-icon.png') }}" class="c-user__nav__icon">
        </div>
        <img src="{{ asset('images/mytheme_select-icon.png') }}" class="c-user__nav__icon--active">　マイテーマ
      </li>
      <a href="{{route('users.bookmark', $user->id)}}">
        <li class="p-user__nav__one">
          <div class="c-user__nav__icon__box">
            <img src="{{ asset('images/mybookmark-icon.png') }}" class="c-user__nav__icon">
          </div>
          <img src="{{ asset('images/mybookmark_select-icon.png') }}" class="c-user__nav__icon--active">　ブックマーク
        </li>
      </a>
      <a href="{{route('users.edit', $user->id)}}">
        <li class="p-user__nav__one">
          <div class="c-user__nav__icon__box">
            <img src="{{ asset('images/prof_edit-icon.png') }}" class="c-user__nav__icon">
          </div>
          <img src="{{ asset('images/prof_edit_select-icon.png') }}" class="c-user__nav__icon--active">　プロフィール編集
        </li>
      </a>
      <a href="{{route('users.emailEdit', $user->id)}}">
        <li class="p-user__nav__one">
          <div class="c-user__nav__icon__box">
            <img src="{{ asset('images/email_change-icon.png') }}" class="c-user__nav__icon">
          </div>
          <img src="{{ asset('images/email_change_select-icon.png') }}" class="c-user__nav__icon--active">　メールアドレス変更
        </li>
      </a>
      <a href="{{route('users.passEdit', $user->id)}}">
        <li class="p-user__nav__one">
          <div class="c-user__nav__icon__box">
            <img src="{{ asset('images/pass_change-icon.png') }}" class="c-user__nav__icon">
          </div>
          <img src="{{ asset('images/pass_change_select-icon.png') }}" class="c-user__nav__icon--active">　パスワード変更
        </li>
      </a>
      <li class="p-user__nav__one">
        <div class="c-user__nav__icon__box">
          <img src="{{ asset('images/withdraw-icon.png') }}" class="c-user__nav__icon">
        </div>
        <img src="{{ asset('images/withdraw_select-icon.png') }}" class="c-user__nav__icon--active">　アカウント削除
      </li>
    </ul>
  </div>
  @endif

</div>