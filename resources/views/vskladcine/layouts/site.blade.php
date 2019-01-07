<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Вскладчине</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
</head>
@php
    $router = app()->make('router');
    $uri = $router->getCurrentRoute()->uri;
@endphp
<body class="{{ $uri == "404" ? 'page-404' : '' }}" >

@if($uri != "404")
<div class="bg-stars">
    <div class="bg-stars__star-1"></div>
    <div class="bg-stars__star-2"></div>
    <div class="bg-stars__star-3"></div>
</div>
@endif



@yield('header')
@yield('content')


<div id="popup-feedback" class="popup popup-feedback">
    <div class="popup-title">Обратная связь с администратором</div>
    <form action="#" class="form-validate">
        <div class="form-group">
            <input type="text" name="message" required class="form-control" placeholder="Напишите сообщение…">
        </div>
        <div class="form-group">
            <input type="email" name="email" required class="form-control" placeholder="Ваша почта для ответа">
        </div>
        <div class="form-group form-agreement">
            <input type="checkbox" name="agreement" id="agreement" class="checkbox checkbox--toggle">
            <label for="agreement">Я согласен с <a href="#">условиями обработки данных</a> на данном сайте</label>
        </div>
        <div class="form-group form-buttons">
            <button type="submit" class="btn btn-send">
                <svg class="icon icon-comment-sm"><use xlink:href="img/icons.svg#icon-comment-sm"/></svg>
                <span>Отправить</span>
            </button>
            <button type="submit" class="btn btn--border" data-fancybox-close>
                <span>Отмена</span>
            </button>
        </div>
    </form>

</div>
<div id="popup-registration" class="popup popup-registration">
    <div class="popup-title">Регистрация</div>
    <form action="{{ route('registerUser') }}"  method="POST" class="form-validate">
        @csrf
        <div class="form-inline">
            <div class="form-group">
                <input type="text" name="name"  class="form-control" value="{{ old('name') }}" placeholder="Имя" required>
                @if ($errors->has('name'))
                    <span class="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                         <input type="hidden" id="errName" value="{{  $errors->first('name') }}">
                       {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="email" name="email"  class="form-control" value="{{ old('email') }}" placeholder="panyakin@mail.com" required>
                @if ($errors->has('email'))
                    <span class="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                         <input type="hidden" id="errEmail" name="errorEmail" value="{{  $errors->first('email') }}">
                       {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password"  class="form-control" placeholder="Пароль" required>

                @if ($errors->has('password'))
                    <span class="errorPassword" role="alert" style="color: #de4444; font-weight: 300">
                        <input type="hidden" id="errPassword" name="errorPassword" value="{{  $errors->first('password') }}">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Повторите пароль" required>
            </div>
        </div>
        <div class="form-group form-agreement">
            <input type="checkbox" name="agreement" id="agreement-register" class="checkbox checkbox--toggle" required>
            <label for="agreement-register">Я согласен с <a href="#">условиями обработки данных</a> на данном сайте</label>
        </div>
        <div class="form-group form-buttons">
            <button type="submit" class="btn btn--grey btn-register">
                <span>Зарегистрироваться</span>
            </button>
        </div>
    </form>

</div>
<div id="popup-categories" class="popup popup-categories active">
    <div class="popup-title">Выберите категорию</div>
    <div class="popup-subtitle">
        <a href="#">Показать все складчины</a>
    </div>
    <div class="categories">
        <ul class="categories__menu">
            <li class="active">
                <a href="#">
                    Информационные товары и услуги
                    <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                </a>
                <div class="categories__subcategories">
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Хобби и увлечения</a></li>
                            <li><a href="#">Программирование</a></li>
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Хобби и увлечения</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Хобби и увлечения</a></li>
                            <li><a href="#">Программирование</a></li>
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Хобби и увлечения</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Хобби и увлечения</a></li>
                            <li><a href="#">Программирование</a></li>
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Хобби и увлечения</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Хобби и увлечения</a></li>
                            <li><a href="#">Программирование</a></li>
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Хобби и увлечения</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#">
                    Физические товары
                    <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                </a>
                <div class="categories__subcategories">
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Курсы по программированию</a></li>
                            <li><a href="#">Курсы по администрированию</a></li>
                            <li><a href="#">Курсы по бизнесу</a></li>
                            <li><a href="#">Бухгалтерия и финансы</a></li>
                            <li><a href="#">Курсы по SEO и SMM</a></li>
                            <li><a href="#">Курсы по дизайну</a></li>
                            <li><a href="#">Курсы по фото и видео</a></li>
                            <li><a href="#">Курсы по музыке</a></li>
                            <li><a href="#">Электронные книги</a></li>
                            <li><a href="#">Курсы по здоровью</a></li>


                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Курсы по программированию</a></li>
                            <li><a href="#">Курсы по администрированию</a></li>
                            <li><a href="#">Курсы по бизнесу</a></li>
                            <li><a href="#">Бухгалтерия и финансы</a></li>
                            <li><a href="#">Курсы по SEO и SMM</a></li>
                            <li><a href="#">Курсы по дизайну</a></li>
                            <li><a href="#">Курсы по фото и видео</a></li>
                            <li><a href="#">Курсы по музыке</a></li>
                            <li><a href="#">Электронные книги</a></li>
                            <li><a href="#">Курсы по здоровью</a></li>


                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Курсы по программированию</a></li>
                            <li><a href="#">Курсы по администрированию</a></li>
                            <li><a href="#">Курсы по бизнесу</a></li>
                            <li><a href="#">Бухгалтерия и финансы</a></li>
                            <li><a href="#">Курсы по SEO и SMM</a></li>
                            <li><a href="#">Курсы по дизайну</a></li>
                            <li><a href="#">Курсы по фото и видео</a></li>
                            <li><a href="#">Курсы по музыке</a></li>
                            <li><a href="#">Электронные книги</a></li>
                            <li><a href="#">Курсы по здоровью</a></li>


                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Курсы по программированию</a></li>
                            <li><a href="#">Курсы по администрированию</a></li>
                            <li><a href="#">Курсы по бизнесу</a></li>
                            <li><a href="#">Бухгалтерия и финансы</a></li>
                            <li><a href="#">Курсы по SEO и SMM</a></li>
                            <li><a href="#">Курсы по дизайну</a></li>
                            <li><a href="#">Курсы по фото и видео</a></li>
                            <li><a href="#">Курсы по музыке</a></li>
                            <li><a href="#">Электронные книги</a></li>
                            <li><a href="#">Курсы по здоровью</a></li>


                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#">
                    Тренинги
                    <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                </a>
                <div class="categories__subcategories">
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Курсы по самообороне</a></li>
                            <li><a href="#">Отдых и путешествия</a></li>
                            <li><a href="#">Курсы по психологии</a></li>
                            <li><a href="#">Курсы по эзотерике</a></li>
                            <li><a href="#">Курсы по соблазнению</a></li>
                            <li><a href="#">Имидж и стиль</a></li>
                            <li><a href="#">Дети и родители</a></li>
                            <li><a href="#">Школа и репетиторство</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Курсы по самообороне</a></li>
                            <li><a href="#">Отдых и путешествия</a></li>
                            <li><a href="#">Курсы по психологии</a></li>
                            <li><a href="#">Курсы по эзотерике</a></li>
                            <li><a href="#">Курсы по соблазнению</a></li>
                            <li><a href="#">Имидж и стиль</a></li>
                            <li><a href="#">Дети и родители</a></li>
                            <li><a href="#">Школа и репетиторство</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Курсы по самообороне</a></li>
                            <li><a href="#">Отдых и путешествия</a></li>
                            <li><a href="#">Курсы по психологии</a></li>
                            <li><a href="#">Курсы по эзотерике</a></li>
                            <li><a href="#">Курсы по соблазнению</a></li>
                            <li><a href="#">Имидж и стиль</a></li>
                            <li><a href="#">Дети и родители</a></li>
                            <li><a href="#">Школа и репетиторство</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Курсы по самообороне</a></li>
                            <li><a href="#">Отдых и путешествия</a></li>
                            <li><a href="#">Курсы по психологии</a></li>
                            <li><a href="#">Курсы по эзотерике</a></li>
                            <li><a href="#">Курсы по соблазнению</a></li>
                            <li><a href="#">Имидж и стиль</a></li>
                            <li><a href="#">Дети и родители</a></li>
                            <li><a href="#">Школа и репетиторство</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#">
                    Информационные товары и услуги
                    <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                </a>
                <div class="categories__subcategories">
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Хобби и рукоделие</a></li>
                            <li><a href="#">Строительство и ремонт</a></li>
                            <li><a href="#">Сад и огород</a></li>
                            <li><a href="#">Авто-мото</a></li>
                            <li><a href="#">Скрипты и программы</a></li>
                            <li><a href="#">Шаблоны и темы</a></li>
                            <li><a href="#">Базы и каталоги</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Хобби и рукоделие</a></li>
                            <li><a href="#">Строительство и ремонт</a></li>
                            <li><a href="#">Сад и огород</a></li>
                            <li><a href="#">Авто-мото</a></li>
                            <li><a href="#">Скрипты и программы</a></li>
                            <li><a href="#">Шаблоны и темы</a></li>
                            <li><a href="#">Базы и каталоги</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Хобби и рукоделие</a></li>
                            <li><a href="#">Строительство и ремонт</a></li>
                            <li><a href="#">Сад и огород</a></li>
                            <li><a href="#">Авто-мото</a></li>
                            <li><a href="#">Скрипты и программы</a></li>
                            <li><a href="#">Шаблоны и темы</a></li>
                            <li><a href="#">Базы и каталоги</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Хобби и рукоделие</a></li>
                            <li><a href="#">Строительство и ремонт</a></li>
                            <li><a href="#">Сад и огород</a></li>
                            <li><a href="#">Авто-мото</a></li>
                            <li><a href="#">Скрипты и программы</a></li>
                            <li><a href="#">Шаблоны и темы</a></li>
                            <li><a href="#">Базы и каталоги</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#">
                    Физические товары
                    <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                </a>
                <div class="categories__subcategories">
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Покер, ставки, казино</a></li>
                            <li><a href="#">Спортивные события</a></li>
                            <li><a href="#">Форекс и инвестиции</a></li>
                            <li><a href="#">Доступ к платным ресурсам</a></li>
                            <li><a href="#">Иностранные языки</a></li>
                            <li><a href="#">Разные аудио и видеокурсы</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Покер, ставки, казино</a></li>
                            <li><a href="#">Спортивные события</a></li>
                            <li><a href="#">Форекс и инвестиции</a></li>
                            <li><a href="#">Доступ к платным ресурсам</a></li>
                            <li><a href="#">Иностранные языки</a></li>
                            <li><a href="#">Разные аудио и видеокурсы</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Покер, ставки, казино</a></li>
                            <li><a href="#">Спортивные события</a></li>
                            <li><a href="#">Форекс и инвестиции</a></li>
                            <li><a href="#">Доступ к платным ресурсам</a></li>
                            <li><a href="#">Иностранные языки</a></li>
                            <li><a href="#">Разные аудио и видеокурсы</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Покер, ставки, казино</a></li>
                            <li><a href="#">Спортивные события</a></li>
                            <li><a href="#">Форекс и инвестиции</a></li>
                            <li><a href="#">Доступ к платным ресурсам</a></li>
                            <li><a href="#">Иностранные языки</a></li>
                            <li><a href="#">Разные аудио и видеокурсы</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#">
                    Тренинги
                    <svg class="icon icon-arrow"><use xlink:href="img/icons.svg#icon-arrow"/></svg>
                </a>
                <div class="categories__subcategories">
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Курсы по программированию</a></li>
                            <li><a href="#">Курсы по администрированию</a></li>
                            <li><a href="#">Курсы по бизнесу</a></li>
                            <li><a href="#">Бухгалтерия и финансы</a></li>
                            <li><a href="#">Курсы по SEO и SMM</a></li>
                            <li><a href="#">Курсы по дизайну</a></li>
                            <li><a href="#">Курсы по фото и видео</a></li>
                            <li><a href="#">Курсы по музыке</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Курсы по программированию</a></li>
                            <li><a href="#">Курсы по администрированию</a></li>
                            <li><a href="#">Курсы по бизнесу</a></li>
                            <li><a href="#">Бухгалтерия и финансы</a></li>
                            <li><a href="#">Курсы по SEO и SMM</a></li>
                            <li><a href="#">Курсы по дизайну</a></li>
                            <li><a href="#">Курсы по фото и видео</a></li>
                            <li><a href="#">Курсы по музыке</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Курсы по программированию</a></li>
                            <li><a href="#">Курсы по администрированию</a></li>
                            <li><a href="#">Курсы по бизнесу</a></li>
                            <li><a href="#">Бухгалтерия и финансы</a></li>
                            <li><a href="#">Курсы по SEO и SMM</a></li>
                            <li><a href="#">Курсы по дизайну</a></li>
                            <li><a href="#">Курсы по фото и видео</a></li>
                            <li><a href="#">Курсы по музыке</a></li>
                        </ul>
                    </div>
                    <div class="categories__column">
                        <ul class="categories__submenu">
                            <li><a href="#">Бизнес и свое дело</a></li>
                            <li><a href="#">Дизайн и креатив</a></li>
                            <li><a href="#">Здоровье и быт</a></li>
                            <li><a href="#">Психология и отношения</a></li>
                            <li><a href="#">Курсы по программированию</a></li>
                            <li><a href="#">Курсы по администрированию</a></li>
                            <li><a href="#">Курсы по бизнесу</a></li>
                            <li><a href="#">Бухгалтерия и финансы</a></li>
                            <li><a href="#">Курсы по SEO и SMM</a></li>
                            <li><a href="#">Курсы по дизайну</a></li>
                            <li><a href="#">Курсы по фото и видео</a></li>
                            <li><a href="#">Курсы по музыке</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="js/libs.min.js"></script>
<script src="js/scripts.js"></script>
<script src="js/MyScript.js"></script>
</body>
</html>
