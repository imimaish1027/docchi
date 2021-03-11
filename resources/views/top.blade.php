@extends('layouts.app')

@section('title', 'TOP')

@section('content')

<div class="p-jumbotron">
    <img src="{{ asset('images/two_doors.jpg') }}" class="c-jumbotron__img">
    <div class="p-jumbotron__inner">
        <p class="c-jumbotron__text">あなたはどっち？</p>
        <div class="p-btn__area__double">
            <form method="GET" action="{{ route('register') }}" class="p-btn__area__top--regiter">
                @csrf
                <button type="submit" class="c-form__btn btn">
                    新規登録
                </button>
            </form>
            <form method="GET" action="{{ route('login') }}" class="p-btn__area__top--login">
                @csrf
                <button type="submit" class="c-form__btn btn">
                    ログイン
                </button>
            </form>
        </div>

        <div class="p-btn__area">
            <form method="GET" action="{{ route('login.guest') }}" class="p-btn__area__top--guest">
                @csrf
                <button type="submit" class="c-form__btn btn">
                    ゲストログイン
                </button>
            </form>
            <p class="c-jumbotron__note">※メールアドレスとパスワードを入力せずログインいただけます。</p>
        </div>
    </div>
</div>

<div class="p-main">
    <div class="p-top__body__section p-purpose">
        <h2 class="c-top__body__head">Docchiとは？</h2>
        <p class="c-top__body__head__sub">PURPOSE</p>
        <div class="c-top__body__text">
            Docchi(どっち)は、世の中の対になっている2つのものを比較するサービスです。<br>
            どちらが多いのか疑問に思ったことをアンケートとして作成し回答を集計することで、
            選択に迷った時の参考にできるようにすることを目的としています。
        </div>
    </div>

    <div class="p-top__body__section p-features">
        <h2 class="c-top__body__head">できること</h2>
        <p class="c-top__body__head__sub">FEATURES</p>
        <ul class="p-top__list">
            <li class="p-top__list__one">
                <div class="p-features__text">
                    <h3 class="c-features__head">1.テーマを探す</h3>
                    <div class="c-features__body">
                        テーマは2択のお題です。
                        テーマ一覧からタイトルのフリーワード検索ができます。<br>
                        また、テーマ内のタグをクリックすることで、<br>
                        そのタグが登録されている他のテーマの一覧を見ることができます。
                    </div>
                </div>
                <img src="{{ asset('images/search_theme.jpg') }}" class="c-features__img">
            </li>
            <li class="p-top__list__one">
                <div class="p-features__text">
                    <h3 class="c-features__head">2.テーマをブックマークする</h3>
                    <div class="c-features__body">
                        ログインすると、テーマをブックマークできます。<br>
                        ブックマークしたテーマはブックマーク一覧画面で確認でき、<br>
                        回答やコメントが気になるテーマはすぐに見れるので便利です。
                    </div>
                </div>
                <img src="{{ asset('images/bookmark_theme.jpg') }}" class="c-features__img">
            </li>
            <li class="p-top__list__one">
                <div class="p-features__text">
                    <h3 class="c-features__head">3.テーマに回答する</h3>
                    <div class="c-features__body">
                        自分が2択のどちらに当てはまるのか、選択し回答することができます。<br>
                        回答したテーマはコメントができるようになっています。<br>
                        ユーザーのコメントにより、それぞれの意見を参考にできます。
                    </div>
                </div>
                <img src="{{ asset('images/answer_theme.jpg') }}" class="c-features__img">
            </li>
            <li class="p-top__list__one">
                <div class="p-features__text">
                    <h3 class="c-features__head">4.テーマを作る</h3>
                    <div class="c-features__body">
                        ログインすると、新しいテーマを作成できます。<br>
                        自分が気になる2択をテーマにし、回答を集計します。<br>
                        テーマを作成したユーザー自身も回答することができます。
                    </div>
                </div>
                <img src="{{ asset('images/create_theme.jpg') }}" class="c-features__img">
            </li>
        </ul>
    </div>
</div>

@endsection