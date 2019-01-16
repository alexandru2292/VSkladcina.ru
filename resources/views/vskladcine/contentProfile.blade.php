<div class="wrapper">
    <div class="container">
        <div class="content-title">
            <h1>Профиль</h1>
        </div>
        <div class="content-wrapper">
            <div class="sidebar sidebar--profile">
                <div class="sidebar__box">
                    <div class="user">
                        <div class="user__content">
                            <div class="user__img">
                                <img src=" {{ isset(Auth::user()->HasLinkAvatar) ? Auth::user()->avatar : 'img/content/'.Auth::user()->avatar }} " alt="">
                            </div>
                            <div class="user__title">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="user__status">
                                {{ $user->role_user->load('role')->role->name }}
                            </div>
                            <a href="javascript:void(0);" class="btn btn--block user__btn-message">
                                <svg class="icon icon-comment-sm"><use xlink:href="img/icons.svg#icon-comment-sm"></use></svg>
                                <span>Написать сообщение</span>
                            </a>
                        </div>
                        <div class="user__statistics">
                            <div class="statistics">
                                <a href="#" class="statistics__row">
                    <span>
                      Участие
                    </span>

                    <span>
                      24
                    </span>
                                </a>
                                <a href="#" class="statistics__row">
                    <span>
                      Проведено
                    </span>
                                    <span>
                      7
                    </span>
                                </a>
                                <div class="statistics__row">
                    <span>
                      Зарегистрирован
                    </span>
                    <span>
                       {{ date('d.m.Y', strtotime(Auth::user()->created_at)) }}
                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="sidebar__box">
                    <div class="card-show-info">
                        <svg class="icon icon-eye"><use xlink:href="img/icons.svg#icon-eye"/></svg>
                        <div>
                            Так видят вашу карточку другие пользователи
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="tabs">
                    <ul class="nav-tabs" data-toggle="tabs">
                        <li class="active"><a href="#">Настройки</a></li>
                        <li><a href="#">Оплата</a></li>
                        <li><a href="#">Штрафы</a></li>
                        <li><a href="#">Оповещения</a></li>
                        <li><a href="#">Подписки</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="content__box content__box--bg-light">
                                <div class="settings">
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Привязанный аккаунт
                                        </div>
                                        <div class="settings__content">
                                            <div class="settings__social">
                                                <div>
                                                    <ul class="social">
                                                        <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-fb"><use xlink:href="img/icons.svg#icon-fb"/></svg></a></li>
                                                        <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-vk"><use xlink:href="img/icons.svg#icon-vk"/></svg></a></li>
                                                        <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-twitter"><use xlink:href="img/icons.svg#icon-twitter"/></svg></a></li>
                                                        <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-google"><use xlink:href="img/icons.svg#icon-google"/></svg></a></li>
                                                        <li class="social__item"><a class="social__link" href="#"><svg class="icon icon-ok"><use xlink:href="img/icons.svg#icon-ok"/></svg></a></li>
                                                    </ul>
                                                </div>
                                                <div>
                                                    — используется для авторизации
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Фотография профиля
                                        </div>
                                        <div class="settings__content">
                                            <div class="settings__buttons">
                                                <label class="btn form-file">
                                                    <input type="file">
                                                    <span>Загрузить</span>
                                                </label>
                                                <button type="button" class="btn btn--border">Удалить</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Ваше имя
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="Князь Златоусов">
                                            <div class="settings__buttons">
                                                <button type="button" class="btn">Сохранить</button>
                                                <button type="button" class="btn btn--border">Отменить</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Ваш статус
                                        </div>
                                        <div class="settings__content">
                                            <div class="settings__status">
                                                Складчик
                                            </div>
                                            <div class="settings__buttons">
                                                <button type="button" class="btn">Запросить повышение</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            E-mail
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="web.resources.x@gmail.com">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Телефон
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="89539119111">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            ФИО
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="Маркелов Александр Станиславович">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Страна
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="Россия">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Город
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="Томск">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Улица
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="Ленина">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Дом
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="7а">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Квартира
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="7">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Индекс
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="61171">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Серия
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="6**7">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Номер
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="6****7">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Дата выдачи
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="2011-07-05">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Дата рождения
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="1993-05-05">
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Загруженные документы
                                        </div>
                                        <div class="settings__content">
                                            <input type="text" class="form-control settings__input" value="Паспорт.jpg">
                                            <div class="settings__buttons">
                                                <label class="btn form-file">
                                                    <input type="file">
                                                    <span>Загрузить</span>
                                                </label>
                                                <button type="button" class="btn btn--border">Удалить</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="content__box content__box--bg-light">
                                <div class="payment">
                                    <div class="payment__total">
                                        <div>
                                            <div class="payment__total-title">
                                                Сумма на счёте
                                            </div>
                                            <div class="payment__total-amount">
                                                10 рублей
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment__purse">
                                        <div class="payment__purse-title">
                                            Пополнить кошелёк
                                        </div>
                                        <input type="text" class="form-control payment__purse-input" placeholder="Укажите сумму пополнения, например 2 500 Р">
                                        <div class="payment__purse-row">
                                            <a href="javascript:void(0);" class="btn payment__purse-btn">
                                                <svg class="icon icon-pay"><use xlink:href="img/icons.svg#icon-pay"/></svg>
                                                <span>Перейти к пополнению</span>
                                            </a>
                                            <span>— откроется страница пополнения</span>
                                        </div>
                                    </div>
                                    <div class="info-boxes">
                                        <div class="info-boxes__title">
                                            Текущие сборы в которых вы участвуете — 2 500 Р
                                        </div>
                                        <div class="info-boxes__items">
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Интересные курсы по Visual Studio 2015
                                                </div>
                                                <div class="info-box__text">
                                                    Дата сбора — 02.04.17 <br>
                                                    Взнос — 300 Р
                                                </div>

                                            </div>
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Интересные курсы по Photoshop CC
                                                </div>
                                                <div class="info-box__text">
                                                    Дата сбора — 02.04.17 <br>
                                                    Взнос — 300 Р
                                                </div>
                                            </div>
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Интересные курсы по Photoshop CC
                                                </div>
                                                <div class="info-box__text">
                                                    Дата сбора — 02.04.17 <br>
                                                    Взнос — 300 Р
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="content__box content__box--bg-light">
                                <div class="payment">
                                    <div class="payment__total">
                                        <div>
                                            <div class="payment__total-title">
                                                Штрафов на сумму
                                            </div>
                                            <div class="payment__total-amount">
                                                1000 рублей
                                            </div>
                                        </div>
                                        <div>
                                            <div class="payment__total-title">
                                                На счете
                                            </div>
                                            <div class="payment__total-amount">
                                                2700 рублей
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment__purse">
                                        <div class="payment__purse-row">
                                            <a href="javascript:void(0);" class="btn payment__purse-btn">
                                                <svg class="icon icon-pay"><use xlink:href="img/icons.svg#icon-pay"/></svg>
                                                <span>Оплатить из кошелька</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="info-boxes">
                                        <div class="info-boxes__title">
                                            Неоплаченные штрафы
                                        </div>
                                        <div class="info-boxes__items">
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Выход из складчины
                                                </div>
                                                <div class="info-box__text">
                                                    Дата — 02.04.17 <br>
                                                    Штраф — 300 Р
                                                </div>

                                            </div>
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Выход из складчины
                                                </div>
                                                <div class="info-box__text">
                                                    Дата — 02.04.17 <br>
                                                    Штраф — 300 Р
                                                </div>

                                            </div>
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Выход из складчины
                                                </div>
                                                <div class="info-box__text">
                                                    Дата — 02.04.17 <br>
                                                    Штраф — 300 Р
                                                </div>

                                            </div>
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Выход из складчины
                                                </div>
                                                <div class="info-box__text">
                                                    Дата — 02.04.17 <br>
                                                    Штраф — 300 Р
                                                </div>

                                            </div>
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Выход из складчины
                                                </div>
                                                <div class="info-box__text">
                                                    Дата — 02.04.17 <br>
                                                    Штраф — 300 Р
                                                </div>

                                            </div>
                                            <div class="info-box">
                                                <div class="info-box__title">
                                                    Выход из складчины
                                                </div>
                                                <div class="info-box__text">
                                                    Дата — 02.04.17 <br>
                                                    Штраф — 300 Р
                                                </div>

                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="content__box content__box--bg-light">
                                <div class="settings settings--alerts">
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Общие настройки
                                        </div>
                                        <div class="settings__content">
                                            <input type="checkbox" name="important-alerts" id="important-alerts" class="checkbox checkbox--toggle">
                                            <label for="important-alerts">&#8212; важные оповещения</label>
                                            <input type="checkbox" name="admin-messages" id="admin-messages" class="checkbox checkbox--toggle">
                                            <label for="admin-messages">&#8212; сообщения от администратора</label>
                                            <input type="checkbox" name="duplicate-mail" id="duplicate-mail" class="checkbox checkbox--toggle" checked>
                                            <label for="duplicate-mail">&#8212; дублировать на электронную почту</label>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Электронная почта
                                        </div>
                                        <div class="settings__content">
                                            <div class="settings__email">
                                                <div>
                                                    <div class="form-item">
                                                        <select class="selectpicker">
                                                            <option>konstantinopolskiy@mail.com</option>
                                                            <option>konstantinopolskiy@mail.ru</option>
                                                            <option>konstantinopolskiy@mail.inbox</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    &#8212; подтверждена
                                                </div>
                                            </div>
                                            <div class="settings__buttons">
                                                <button type="button" class="btn">Изменить</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__content">
                                            <input type="checkbox" name="limit-alerts" id="limit-alerts" class="checkbox checkbox--toggle" checked>
                                            <label for="limit-alerts">&#8212; ограничить оповещения по местоположению</label>
                                            <div class="form-item">
                                                <select class="selectpicker" title="Выберите город">
                                                    <option>Томск</option>
                                                    <option>Северск</option>
                                                    <option>Кемерово</option>
                                                    <option>Москва</option>
                                                </select>
                                            </div>
                                            <div class="settings__text">
                                                Настройка распространяется на категории с указанием города, Отключите настройку, чтобы получать уведомления независимо от местоположения.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Созданные складчины
                                        </div>
                                        <div class="settings__content">
                                            <input type="checkbox" name="member-signed-up-1" id="member-signed-up-1" class="checkbox checkbox--toggle" checked>
                                            <label for="member-signed-up-1">&#8212; участник записался</label>
                                            <input type="checkbox" name="member-write-out-1" id="member-write-out-1" class="checkbox checkbox--toggle" checked>
                                            <label for="member-write-out-1">&#8212; участник выписался</label>
                                            <input type="checkbox" name="answer-about-amount-1" id="answer-about-amount-1" class="checkbox checkbox--toggle" checked>
                                            <label for="answer-about-amount-1">&#8212; ответ на вопрос о сумме взноса</label>
                                            <input type="checkbox" name="new-public-comment-1" id="new-public-comment-1" class="checkbox checkbox--toggle" checked>
                                            <label for="new-public-comment-1">&#8212; новый публичный комментарий</label>
                                            <input type="checkbox" name="new-private-comment-1" id="new-private-comment-1" class="checkbox checkbox--toggle" checked>
                                            <label for="new-private-comment-1">&#8212; новый приватный комментарий</label>
                                            <input type="checkbox" name="like-comments-1" id="like-comments-1" class="checkbox checkbox--toggle">
                                            <label for="like-comments-1">&#8212; лайки комментариев</label>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Складчины, в которых участвуете
                                        </div>
                                        <div class="settings__content">
                                            <input type="checkbox" name="member-signed-up-2" id="member-signed-up-2" class="checkbox checkbox--toggle" checked>
                                            <label for="member-signed-up-2">&#8212; участник записался</label>
                                            <input type="checkbox" name="member-write-out-2" id="member-write-out-2" class="checkbox checkbox--toggle" checked>
                                            <label for="member-write-out-2">&#8212; участник выписался</label>
                                            <input type="checkbox" name="answer-about-amount-2" id="answer-about-amount-2" class="checkbox checkbox--toggle" checked>
                                            <label for="answer-about-amount-2">&#8212; ответ на вопрос о сумме взноса</label>
                                            <input type="checkbox" name="new-public-comment-2" id="new-public-comment-2" class="checkbox checkbox--toggle" checked>
                                            <label for="new-public-comment-2">&#8212; новый публичный комментарий</label>
                                            <input type="checkbox" name="new-private-comment-2" id="new-private-comment-2" class="checkbox checkbox--toggle" checked>
                                            <label for="new-private-comment-2">&#8212; новый приватный комментарий</label>
                                            <input type="checkbox" name="like-comments-2" id="like-comments-2" class="checkbox checkbox--toggle" checked>
                                            <label for="like-comments-2">&#8212; лайки комментариев</label>
                                        </div>
                                    </div>
                                    <div class="settings__box">
                                        <div class="settings__title">
                                            Отслеживаемые складчины
                                        </div>
                                        <div class="settings__content">
                                            <input type="checkbox" name="member-signed-up-3" id="member-signed-up-3" class="checkbox checkbox--toggle" checked>
                                            <label for="member-signed-up-3">&#8212; участник записался</label>
                                            <input type="checkbox" name="member-write-out-3" id="member-write-out-3" class="checkbox checkbox--toggle" checked>
                                            <label for="member-write-out-3">&#8212; участник выписался</label>
                                            <input type="checkbox" name="answer-about-amount-3" id="answer-about-amount-3" class="checkbox checkbox--toggle" checked>
                                            <label for="answer-about-amount-3">&#8212; ответ на вопрос о сумме взноса</label>
                                            <input type="checkbox" name="new-public-comment-3" id="new-public-comment-3" class="checkbox checkbox--toggle" checked>
                                            <label for="new-public-comment-3">&#8212; новый публичный комментарий</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="content__box content__box--bg-light">
                                <div class="info-boxes">
                                    <div class="info-boxes__title">
                                        Отслеживаемые категории
                                    </div>
                                    <div class="info-boxes__items">
                                        <div class="info-box info-box--categories">
                                            <div class="info-box__title">
                                                Информационные товары и услуги
                                            </div>
                                            <div class="info-box__unsubscribe">
                                                <a href="#" class="btn btn--border info-box__unsubscribe-btn">Отписаться</a>
                                            </div>

                                        </div>
                                        <div class="info-box info-box--categories">
                                            <div class="info-box__title">
                                                Физические товары
                                            </div>
                                        </div>
                                        <div class="info-box info-box--categories">
                                            <div class="info-box__title">
                                                Тренинги
                                            </div>
                                        </div>

                                    </div>
                                    <div class="info-boxes__add">
                                        <div class="info-boxes__add-title">
                                            Добавить категорию
                                        </div>
                                        <div class="info-boxes__add-select">
                                            <div class="form-item">
                                                <select class="selectpicker" title="Выберите категорию">
                                                    <option>Товары и услуги</option>
                                                    <option>Физические товары</option>
                                                    <option>Тренинги</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="info-boxes__add-buttons">
                                            <button class="btn">Добавить</button>
                                            <button class="btn btn--border">Отмена</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="info-boxes">
                                    <div class="info-boxes__title">
                                        Отслеживаемые складчины
                                    </div>
                                    <div class="info-boxes__items">
                                        <div class="info-box">
                                            <div class="info-box__title">
                                                Интересные курсы по Visual Studio 2015, которую могут пригодится
                                            </div>
                                            <div class="info-box__text">
                                                Информационные товары и услуги
                                            </div>
                                            <div class="info-box__unsubscribe">
                                                <a href="#" class="btn btn--border info-box__unsubscribe-btn">Отписаться</a>
                                            </div>

                                        </div>
                                        <div class="info-box">
                                            <div class="info-box__title">
                                                Интересные курсы по Photoshop CC
                                            </div>
                                            <div class="info-box__text">
                                                Физические товары
                                            </div>
                                        </div>
                                        <div class="info-box">
                                            <div class="info-box__title">
                                                Интересные курсы по Visual Studio 2015
                                            </div>
                                            <div class="info-box__text">
                                                Информационные товары и услуги
                                            </div>

                                        </div>
                                        <div class="info-box">
                                            <div class="info-box__title">
                                                Интересные курсы по Photoshop CC
                                            </div>
                                            <div class="info-box__text">
                                                Физические товары
                                            </div>
                                        </div>
                                        <div class="info-box">
                                            <div class="info-box__title">
                                                Интересные курсы по Visual Studio 2015
                                            </div>
                                            <div class="info-box__text">
                                                Информационные товары и услуги
                                            </div>

                                        </div>
                                        <div class="info-box">
                                            <div class="info-box__title">
                                                Интересные курсы по Photoshop CC
                                            </div>
                                            <div class="info-box__text">
                                                Физические товары
                                            </div>
                                        </div>
                                        <div class="info-box">
                                            <div class="info-box__title">
                                                Интересные курсы по Visual Studio 2015
                                            </div>
                                            <div class="info-box__text">
                                                Информационные товары и услуги
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
