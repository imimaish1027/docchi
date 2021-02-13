<div class="l-sidebar">
  <div class="p-user__info">
    @isset( $user->pic )
    <img src="{{ asset('/storage/users/'.$user->pic) }}" class="c-user__img">
    @endisset
    @empty( $user->pic )
    <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-user__img">
    @endempty
    <p class="c-user__name">{{ $user->name }}</p>
    <p class="c-user__age__gender">@switch($user->age)
      @case(9 < $user->age && $user->age < 20) 10代 @break @case(19 < $user->age && $user->age < 30) 20代 @break @case(29 < $user->age && $user->age < 40) 30代 @break @case(39 < $user->age && $user->age < 50) 40代 @break @case(49 < $user->age && $user->age < 60) 50代 @break @case(59 < $user->age && $user->age < 70) 60代 @break @case(69 < $user->age && $user->age < 80) 70代 @break @case(79 < $user->age && $user->age < 90) 80代 @break @case(89 < $user->age && $user->age < 100) 90代 @break @default @endswitch 　@if($user->gender === 1) ♂
                          @elseif($user->gender === 2) ♀
                          @endif</p>

    <div class="p-count__themes">
      <div class="p-count__post__themes">
        <a class="c-post__theme__link" href="{{ route('users.show', ['id' => $user->id]) }}">
          投稿
        </a>
        <br>
        <a class="c-post__theme__link" href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->themes->count() ?? 0 }}</a>

      </div>
      <div class="p-count__answer__themes">
        <a class="c-answer__theme__link" href="{{ route('users.answer', ['id' => $user->id]) }}">
          回答
        </a>
        <br>
        <a class="c-answer__theme__link" href="{{ route('users.answer', ['id' => $user->id]) }}">
          @isset($user->answers)
          {{ $user->answers->count() }}
          @endisset
          @empty($user->answers)
          0
          @endempty
        </a>
      </div>
    </div>
  </div>

  @if( Auth::id() === $user->id )
  <div class="p-user__nav">
    <ul class="p-user__nav__list">

      <a href="{{ route('users.show', ['id' => $user->id]) }}">
        <li class="p-user__nav__one">
          <div class="c-user__nav__icon__box">
            <img src="{{ asset('images/mytheme-icon.png') }}" class="c-user__nav__icon">
          </div>
          <img src="{{ asset('images/mytheme_select-icon.png') }}" class="c-user__nav__icon--active">　マイテーマ
        </li>
      </a>

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
      <a href="{{route('users.withdraw', $user->id)}}">
        <li class="p-user__nav__one">
          <div class="c-user__nav__icon__box">
            <img src="{{ asset('images/withdraw-icon.png') }}" class="c-user__nav__icon">
          </div>
          <img src="{{ asset('images/withdraw_select-icon.png') }}" class="c-user__nav__icon--active">　アカウント削除
        </li>
      </a>
    </ul>
  </div>
  @endif

</div>