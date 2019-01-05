
<div class="menu-mobile">
    <div class="buttons-items">
        <div class="dropdown dropdown--comments">
            <a href="#" class="btn-toggle btn-toggle--reminder btn-toggle--active">
                <span><svg class="icon icon-comment"><use xlink:href="img/icons.svg#icon-comment"/></svg></span>
            </a>
        </div>
        <div class="dropdown dropdown--reminder">
            <a href="#" class="btn-toggle btn-toggle--reminder btn-toggle--active">
                <span><svg class="icon icon-bell"><use xlink:href="img/icons.svg#icon-bell"/></svg></span>
            </a>
        </div>
        <div class="dropdown dropdown-auth">
            <button class="dropdown-toggle btn-toggle btn-toggle--user" type="button" data-toggle="dropdown">
                <span><svg class="icon icon-user"><use xlink:href="img/icons.svg#icon-user"/></svg></span>
            </button>
            <div class="dropdown-menu">
                <div class="authorization">
                    <div class="authorization__title">
                        Авторизация
                    </div>
                    <div class="authorization__social">
                        <ul class="social">
                            <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-fb"><use xlink:href="img/icons.svg#icon-fb"/></svg></a></li>
                            <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-vk"><use xlink:href="img/icons.svg#icon-vk"/></svg></a></li>
                            <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-twitter"><use xlink:href="img/icons.svg#icon-twitter"/></svg></a></li>
                            <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-google"><use xlink:href="img/icons.svg#icon-google"/></svg></a></li>
                            <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-ok"><use xlink:href="img/icons.svg#icon-ok"/></svg></a></li>
                        </ul>
                    </div>
                    <div class="authorization__title">
                        Авторизация
                    </div>
                    <form action="#" class="form-validate">
                        <div class="form-group">
                            <input type="text" name="name" required class="form-control" placeholder="Ваше имя">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" required class="form-control" placeholder="Электронная почта">
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
    </div>
    <a href="#" class="btn btn-stock">
        <svg class="icon icon-star"><use xlink:href="img/icons.svg#icon-star"/></svg>
        <span>Мои складчины</span>
    </a>
    <ul class="menu">
        <li>
            <a href="#" class="menu__dropdown-link">
                <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                Профиль
            </a>
            <ul class="menu__submenu active">
                <li><a href="#">Настройки</a></li>
                <li><a href="#">Выйти</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu__dropdown-link">
                <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                Информация
            </a>
            <ul class="menu__submenu active">
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
    <button type="button" class="menu-mobile__btn-close">
        <span>Закрыть</span>
    </button>
</div>
<div class="wrapper">
    <div class="container">
        <div class="content-title">
            <div class="select-category">
                <a href="javascript:void(0);" data-src="#popup-categories" data-fancybox="" class="select-category__link">
                    <span>Все категории</span>
                    <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                </a>
            </div>
        </div>

        <div class="filters-wrapper">
            <div class="search">
                <form action="#">
                    <input type="text" placeholder="Поиск" class="search__input" value="Visual studio">
                    <button type="button" class="search__btn-clear">
                        <span>Очистить</span>
                    </button>
                    <button type="submit" class="search__btn-submit">
                        <svg class="icon icon-search">
                            <use xlink:href="img/icons.svg#icon-search"/>
                        </svg>
                        <span>Поиск</span>
                    </button>
                </form>
            </div>
            <button type="button" class="filters-btn-toggle">
                <svg class="icon icon-filter"><use xlink:href="img/icons.svg#icon-filter"/></svg>
            </button>
            <div class="filters">
                <div class="filters__title">
                    Фильтр и сортировка
                </div>
                <button type="button" class="filters__btn-close">
                    <span>Закрыть</span>
                </button>
                <div class="filters__items">
                    <div class="filter-item">
                        <select class="selectpicker selectpicker--default">
                            <option>Все складчины</option>
                            <option>Участвую</option>
                            <option>Организую</option>
                            <option>Оплатил</option>
                            <option>Не оплатил</option>
                            <option>Слежу</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <select class="selectpicker">
                            <option>Любой тип</option>
                            <option>Авторская</option>
                            <option>Стандартная</option>
                            <option>Оптовая</option>
                            <option>На заказ</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <select class="selectpicker">
                            <option>Любой город</option>
                            <option>Томск</option>
                            <option>Северск</option>
                            <option>Кемерово</option>
                            <option>Москва</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="cards-items">
            @if(isset($stocks))
                @foreach($stocks as $stock)
                    <div class="card-item">
                        <div class="card-item__in">
                            <div class="card-item__bg-image" style="background-image: url('img/content/cards/{{ $stock->img }}')">
                                <div class="card-item__title">
                                    {{ $stock->title }}
                                </div>
                                <div class="card-item__date">
                                    {{ $stock->day }} {{ $stock->month }} {{ $stock->year }}
                                </div>
                            </div>
                            <div class="card-item__info">
                                @if($stock->status == "finished")
                                    <div class="status status--finished">
                                        <div class="status__row">
                                            <div>
                                                Завершена
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($stock->status == "collection")
                                    <div class="status status--collection">
                                        <div class="status__row">
                                            <div>
                                                Идёт сбор
                                            </div>
                                            <div>
                                                67%
                                            </div>
                                        </div>
                                        <div class="status__line">
                                            <div style="width: 67%"></div>
                                        </div>
                                    </div>
                                @endif

                                @if($stock->status == "is_open")
                                    <div class="status">
                                        <div class="status__row">
                                            <div>
                                                Открыта
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($stock->status == "completed")
                                    <div class="status status--completed">
                                        <div class="status__row">
                                            <div>
                                                Сбор завершен
                                            </div>
                                        </div>
                                        <div class="status__line">
                                            <div></div>
                                        </div>
                                    </div>
                                @endif

                                <div class="card-item__table">
                                    <table>
                                        <tr>
                                            <td>Тип складчины</td>
                                            <td>{{ $stock->type }}</td>
                                        </tr>
                                        <tr>
                                            <td>Цена</td>
                                            <td>{{ $stock->price }} Р</td>
                                        </tr>
                                        <tr>
                                            <td>Взнос</td>
                                            <td>{{ $stock->contribution }} Р</td>
                                        </tr>
                                        <tr>
                                            <td>Дата сбора</td>
                                            <td>21 января 2017 г.</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-item__rating">
                                    <div class="stars">
                                        {{-- the star display logic is in the StockRepository    --}}
                                        {!! $stock->starsView !!}
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="cards-show">
            <a href="#" class="cards-show__link">
                <span>Показать следующие</span>
            </a>
        </div>
    </div>
</div>
<button type="button" data-src="#popup-feedback" data-fancybox="" class="connection-btn">
    <svg class="icon icon-feedback"><use xlink:href="img/icons.svg#icon-feedback"/></svg>
</button>
