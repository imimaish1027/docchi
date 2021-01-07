<header class="l-header">
  <div class="p-header__container">
    <div class="c-logo">Docchi</div>
    @guest
    <ul class="p-header__nav">
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link"><img src="{{ asset('images/theme_li.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ一覧</span></a>
      </li>
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link" href="{{ route('login') }}"><img src="{{ asset('images/login.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">ログイン</span></a>
      </li>
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link" href="{{ route('register') }}"><img src="{{ asset('images/regist.png') }}" class="c-header__nav__icon i-regist"><span class="c-header__nav__title">新規登録</span></a>
      </li>
    </ul>
    @endguest
    @auth
    <ul id="fade-in" class="p-header__nav dropmenu">
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link"><img src="{{ asset('images/theme_li.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ一覧</span></a>
      </li>
      <li class="p-header__nav__one">
        <a class="p-header__nav__one--link"><img src="{{ asset('images/create_theme.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ作成</span></a>
      </li>
      <li class="p-header__nav__one dropdown">
        <a class="p-header__nav__one--link p-header__nav__mypage dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('images/no-avatar.jpeg') }}" class="c-header__nav__icon avatar"></a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">マイテーマ</a>
          <a class="dropdown-item" href="#">ブックマーク</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf<button class="dropdown-item" type="submit">ログアウト</button>
          </form>
        </div>
      </li>
      @endauth
  </div>
</header>