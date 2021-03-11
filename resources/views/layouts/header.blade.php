<header class="l-header js-float-menu">
  <div class="p-header__container">
    <a href="{{ route('themes.index') }}" class="c-logo"><img src="{{ asset('images/docchi_logo.png') }}" class="c-logo__img">Docchi</a>

      <div id="js-toggle-sp-menu" class="p-menu__trigger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    @guest
    <nav id="js-toggle-sp-menu-target" class="p-menu">
      <ul class="p-header__nav">
        <li class="p-header__nav__one">
          <a class="p-header__nav__one__link" href="{{ route('themes.index') }}"><img src="{{ asset('images/theme-list-icon.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ一覧</span></a>
        </li>
        <li class="p-header__nav__one">
          <a class="p-header__nav__one__link" href="{{ route('login') }}"><img src="{{ asset('images/login-icon.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">ログイン</span></a>
        </li>
        <li class="p-header__nav__one">
          <a class="p-header__nav__one__link" href="{{ route('register') }}"><img src="{{ asset('images/regist-icon.png') }}" class="c-header__nav__icon i-regist"><span class="c-header__nav__title">新規登録</span></a>
        </li>
      </ul>
    </nav>
    @endguest
      @auth
      <nav id="js-toggle-sp-menu-target" class="p-menu">
        <ul id="fade-in" class="p-header__nav dropmenu">
          <li class="p-header__nav__one">
            <a class="p-header__nav__one__link" href="{{ route('themes.index') }}"><img src="{{ asset('images/theme-list-icon.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ一覧</span></a>
          </li>
          <li class="p-header__nav__one">
            <a class="p-header__nav__one__link" href="{{ route('themes.create') }}"><img src="{{ asset('images/create-theme-icon.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">テーマ作成</span></a>
          </li>
          <li class="p-header__nav__one p-header__dropdown__user dropdown">
            <a class="p-header__nav__one__link p-header__nav__mypage dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @isset(auth()->user()->pic)
              <img src="{{ auth()->user()->pic }}" class="c-header__nav__icon c-avatar">
              @endisset
              @empty(auth()->user()->pic)
              <img src="{{ asset('images/no-avatar.jpeg') }}" class="c-header__nav__icon c-avatar">
              @endempty
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a href="{{ route('users.show', ['id' => auth()->user()->id]) }}" class="dropdown-item">マイテーマ</a>
              <a href="{{ route('users.bookmark', ['id' => auth()->user()->id]) }}" class="dropdown-item">ブックマーク</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">ログアウト</button>
              </form>
            </div>
          </li>
          <li class="p-header__nav__one p-header__nav__user">
            <a class="p-header__nav__one__link" href="{{ route('users.show', ['id' => auth()->user()->id]) }}"><img src="{{ asset('images/mytheme-icon.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">マイテーマ</span></a>
          </li>
          <li class="p-header__nav__one p-header__nav__user">
            <a class="p-header__nav__one__link" href="{{ route('users.bookmark', ['id' => auth()->user()->id]) }}"><img src="{{ asset('images/mybookmark-icon.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">ブックマーク</span></a>
          </li>
          <li class="p-header__nav__one p-header__nav__user">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
                <button class="p-header__nav__one__link" type="submit"><img src="{{ asset('images/logout-icon.png') }}" class="c-header__nav__icon"><span class="c-header__nav__title">ログアウト</span></button>
            </form>
          </li>
        </ul>
      </nav>
      @endauth
  </div>
</header>