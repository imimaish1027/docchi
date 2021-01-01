<header class="l-header">
  <div class="p-header__container">
    <div class="c-logo">Choice</div>
    @guest
    <ul class="p-header__nav">
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link"><img src="{{ asset('images/theme_li.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ一覧</span></a>
      </li>
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link"><img src="{{ asset('images/login.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">ログイン</span></a>
      </li>
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link"><img src="{{ asset('images/regist.png') }}" class="c-header__nav__icon i-regist"><span class="c-header__nav__title">新規登録</span></a>
      </li>
    </ul>
    @endguest
    @auth
    <ul class="p-header__nav">
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link"><img src="{{ asset('images/theme_li.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ一覧</span></a>
      </li>
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link"><img src="{{ asset('images/create_theme.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ作成</span></a>
      </li>
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link p-header__nav__mypage"><img src="{{ asset('images/no-avatar.jpeg') }}" class="c-header__nav__icon avatar"><i class="fas fa-caret-down triangle"></i></a>
      </li>
    </ul>
    @endauth
  </div>
</header>