<div class="wrapper">
    <div class="container">
        <div class="content-title">
            <input type="text" class="content-title__input" value="Название складчины">
        </div>
        <div class="content-wrapper">
            <div class="sidebar">
                <div class="sidebar__box">
                    <div class="cover-image">
                        <div class="cover-image__img cover-image__img--blur">
                            <img src="{{ url('img/content/img-cover.png') }}" alt="">
                        </div>
                        <div class="cover-image__content">

                            <div>
                                <div class="cover-image__title">
                                    Обложка складчины
                                </div>
                                <div class="cover-image__subtitle">
                                    Минимальный размер 320 X 240 PX
                                </div>
                                <label class="btn btn--block form-file">
                                    <input type="file">
                                    <span>Загрузить изображение</span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="sidebar-toggle active">
                    <div class="sidebar-toggle__content">
                        <div class="sidebar__box sidebar__box--bg-light">
                            <div class="form-show">
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Категория
                                    </div>
                                    <div class="form-item__content">
                                        <select class="selectpicker selectpicker-check" title="Выберите категорию">
                                            <option>Товары и услуги</option>
                                            <option>Физические товары</option>
                                            <option>Тренинги</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Подкатегория
                                    </div>
                                    <div class="form-item__content">
                                        <select class="selectpicker selectpicker-check" title="Выберите подкатегорию">
                                            <option>Здоровье</option>
                                            <option>Дизайн</option>
                                            <option>Бизнес</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Тип складчины
                                    </div>
                                    <div class="form-item__content">
                                        <select class="selectpicker">
                                            <option data-description="Данный тип предполагает, что создатель сам является автором предлагаемого в складчине контента">Авторская</option>
                                            <option>Стандартная</option>
                                            <option>Оптовая</option>
                                            <option>На заказ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-hidden">
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Минимальное количество
                                    </div>
                                    <div class="form-item__content">
                                        <input type="text" class="form-control" value="15">
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Взнос (цена)
                                    </div>
                                    <div class="form-item__content">
                                        <select class="selectpicker">
                                            <option>7 500</option>
                                            <option>10 500</option>
                                            <option>20 500</option>
                                            <option>30 500</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Взнос (комиссия)
                                    </div>
                                    <div class="form-item__content">
                                        <input type="text" class="form-control" value="500">
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__content">
                                        <div class="form-checkbox">
                                            <input type="checkbox" name="form-parameter" id="form-security" class="checkbox checkbox--toggle" checked>
                                            <label for="form-security">Защита отправлений</label>
                                            <input type="checkbox" name="form-parameter" id="form-buy" class="checkbox checkbox--toggle" checked>
                                            <label for="form-buy">Покупка после завершения</label>
                                            <div class="form-item__text">
                                                Разрешить доступ к контенту складчины после её завершения по последней сумме взноса
                                            </div>
                                            <input type="checkbox" name="form-parameter" id="form-data-full" class="checkbox checkbox--toggle" checked>
                                            <label for="form-data-full">Полная форма данных при заказе</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Дата сбора
                                    </div>
                                    <div class="form-item__content">
                                        <div class="form-date">
                                            <input type="text" class="form-control datepicker" readonly placeholder="Выберите дату">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Срок доставки
                                    </div>
                                    <div class="form-item__content">
                                        <select class="selectpicker">
                                            <option>18-25 дней</option>
                                            <option>26-30 дней</option>
                                            <option>31-40 дней</option>
                                            <option>40-50 дней</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__title">
                                        Службы доставки
                                    </div>
                                    <div class="form-item__content">
                                        <div class="form-delivery">
                                            <div class="form-delivery__row">
                                                <div>
                                                    <input type="checkbox" name="delivery" id="delivery-1" class="checkbox">
                                                    <label for="delivery-1">Доставка 1</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="delivery" id="delivery-2" class="checkbox">
                                                    <label for="delivery-2">Доставка 2</label>
                                                </div>
                                            </div>
                                            <div class="form-delivery__row">
                                                <div>
                                                    <input type="checkbox" name="delivery" id="delivery-3" class="checkbox">
                                                    <label for="delivery-3">Доставка 3</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="delivery" id="delivery-4" class="checkbox">
                                                    <label for="delivery-4">Доставка 4</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <div class="form-item__content">
                                        <button type="submit" class="btn btn--block">Создать складчину</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <button class="btn btn--block sidebar-toggle__btn-toggle active">
                        <svg class="icon icon-arrow"><use xlink:href="{{ url('img/icons.svg#icon-arrow') }}"/></svg>
                    </button>

                </div>
            </div>
            <div class="content">
                <div class="content__box content__box--bg-light">

                    <div class="content-text">
                        <div class="editor">
                            <div class="editor__content">
                                <div class="editor__buttons">
                                    <div>
                                        <button type="button" class="btn btn--block active">Добавить заголовок</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn--block btn--border">Абзац</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn--block btn--border">Изображение</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn--block btn--border">Видео</button>
                                    </div>
                                </div>
                                <div class="editor__block">
                                    <textarea rows="10" class="form-control editor__input-title" placeholder="Введите имя заголовка"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="content__box content__box--bg-dark">
                    <div class="tags">
                        <div class="tags__title">
                            Теги
                        </div>
                        <input type="text" placeholder="Укажите теги складчины" class="tags__input">
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>