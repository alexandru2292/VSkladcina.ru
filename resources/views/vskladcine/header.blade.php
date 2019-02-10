
<header class="header">
    <div class="container">
        <div class="header__row">
            <div class="header__left">
                <button type="button" class="header__menu-toggle">
                    <span>Меню</span>
                </button>
                <button type="button" class="header__menu-toggle-mobile">
                    <span>Меню</span>
                </button>
                <div class="header__logo">
                    <a href="/" class="logo"><img class="logo__img" src="{{ url('img/logo.png') }}" width="149" height="47" alt=""></a>
                </div>
                <div class="header__menu">
                    <ul class="menu">
                        <li>
                            <a href="#" class="menu__dropdown-link">
                                <svg class="icon icon-arrow"><use xlink:href="{{ url('img/icons.svg#icon-arrow') }}"/></svg>
                                Информаци
                            </a>
                            <ul class="menu__submenu">
                                <li><a href="#">О проекте</a></li>
                                <li><a href="#">Миссия</a></li>
                                <li><a href="#">Возможности</a></li>
                                <li><a href="#">Правила и инструкции</a></li>
                                <li><a href="#">Вопросы и предложения</a></li>
                                <li><a href="#">Темы для обсуждения</a></li>
                                <li><a href="#">Приглашаем авторов</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Пользователи</a></li>

                    </ul>
                </div>
            </div>
            <div class="header__right">
                @if(Auth::check())
                    @if( Auth::user()->role_user->load('role')->role->alias  == "Admin" || Auth::user()->role_user->load('role')->role->alias  == "Moderator")
                        <a href="{{  route('stockEdit')}}" class="btn btn-stock addStock">
                            <i class="icon icon-plus"></i>
                            <span>Создать складчину</span>
                        </a>
                    @endif

                @endif
                <a href="#" class="btn btn-stock">
                    <svg class="icon icon-star"><use xlink:href="{{ url('img/icons.svg#icon-star') }}"/></svg>
                    <span>Мои складчины</span>
                </a>
                <div class="header__buttons">
                    <div class="buttons-items">
                        <div class="dropdown dropdown--comments">
                            @php
                                $newMessage = true;
                            @endphp
                            <a href="{{ url("/messages") }}" class="btn-toggle btn-toggle--reminder btn-toggle{{ isset($newMessage) ? "--active" : '' }}">
                                <span><svg class="icon icon-comment"><use xlink:href="{{ url('img/icons.svg#icon-comment') }}"/></svg></span>
                            </a>
                        </div>
                        <div class="dropdown dropdown--reminder">
                            <a href="#" class="btn-toggle btn-toggle--reminder btn-toggle--active">
                                <span><svg class="icon icon-bell"><use xlink:href="{{ url('img/icons.svg#icon-bell') }}"/></svg></span>
                            </a>
                        </div>



                         @if(Auth::check())
                            <div class="dropdown">
                                <button class="dropdown-toggle btn-toggle btn-toggle--user" type="button" data-toggle="dropdown">
                                    <span><svg class="icon icon-user"><use xlink:href="{{ url('img/icons.svg#icon-user') }}"/></svg></span>
                                </button>
                                <div class="dropdown-menu">
                                    <ul class="dropdown-menu inner">
                                        <li><a href="#">Мои складчины</a></li>
                                        <li><a href="{{ route('profileIndex') }}">Настройки</a></li>
                                        <li><a href="{{ route('logout') }}">Выход</a></li>
                                    </ul>
                                </div>
                            </div>
                             @else
                            <div class="dropdown dropdown-auth btnOpenAuth">
                                <button class="dropdown-toggle btn-toggle btn-toggle--user" id="btnCloseOpen"  type="button" data-toggle="dropdown">
                                    <span><svg class="icon icon-user"><use xlink:href="{{ url('img/icons.svg#icon-user') }}"/></svg></span>
                                </button>
                                <div class="dropdown-menu openAuth">
                                    <div class="authorization">
                                        <div class="authorization__title">
                                            Авторизация
                                        </div>
                                        <div class="authorization__social">
                                            <ul class="social">
                                                <li class="social__item"><a class="social__link" href="{{url('/redirect')}}"><svg class="icon icon-fb"><use xlink:href="{{ url('img/icons.svg#icon-fb') }}"/></svg></a></li>
                                                <li class="social__item"><a class="social__link" href="{{ url('/vkauth') }}"><svg class="icon icon-vk"><use xlink:href="{{ url('img/icons.svg#icon-vk') }}"/></svg></a></li>
                                                <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-twitter"><use xlink:href="{{ url('img/icons.svg#icon-twitter') }}"/></svg></a></li>
                                                <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-google"><use xlink:href="{{ url('img/icons.svg#icon-google') }}"/></svg></a></li>
                                                <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-ok"><use xlink:href="{{ url('img/icons.svg#icon-ok') }}"/></svg></a></li>
                                            </ul>
                                        </div>
                                        <div class="authorization__title">
                                            Авторизация
                                        </div>
                                        <form  action="{{ route('login') }}" method="POST" class="form-validate">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="Электронная почта">
                                                @if(session('loginError') && !$errors->isEmpty())
                                                    <input type="hidden" id="loginError" value="{{session('loginError')}}">
                                                @endif
                                                @if ($errors->has('email'))
                                                    <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                                       {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password"  required class="form-control" placeholder="Пароль">
                                                @if ($errors->has('password'))
                                                    <span id="errorPassword" role="alert" style="color: #de4444; font-weight: 300">
                                                       {{ $errors->first('password') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group form-buttons">
                                                <button type="submit" class="btn btn-login">
                                                    <span>Войти</span>
                                                </button>
                                            </div>
                                            <div class="form-group form-links">
                                                <a href="javascript:void(0);" data-src="#popup-registration" data-fancybox="">Я не зарегистрирован</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                         @endif


                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
