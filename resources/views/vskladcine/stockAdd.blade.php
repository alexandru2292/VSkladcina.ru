<div class="wrapper">
    <div class="container">
        <div class="content-title">
            <input type="text" class="content-title__input" value="Название складчины">
        </div>
        <div class="content-wrapper">
            <div class="sidebar">
                <form action="">
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
                </form>
            </div>
            <div class="content">
                <div class="content__box content__box--bg-light">
                    <div class="content-text">
                        <div class="editor">
                            {{-- Add Title stock  --}}
                            <div class="editor__content  edit_content__js">
                                <div class="editor__title title__js" style="display: none">
                                    {{ session('textarea_title') }}
                                </div>
                                <div class="editor__text show_paragraph" style="display: none">
                                        {{ session("text_paragraph") }}
                                </div>
                                <div class="editor__image show_img" style="display: none">
                                    <span></span>
                                </div>
                                <div class="editor__buttons add_buttons ">
                                    <div>
                                        <button type="button" class="btn btn--block active add_title" id="add_title__js">Добавить заголовок</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn--block btn--border add_paragraph" id="">Абзац</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn--block btn--border add_img" id="">Изображение</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn--block btn--border add_video" id="">Видео</button>
                                    </div>
                                </div>
                            {{-- ADD TITLE  --}}
                                <div class="editor__block add_title__js" >
                                    <textarea rows="10" class="form-control editor__input-title" id="textarea_title" name="title"  placeholder="Введите имя заголовка">{{ session('textarea_title') ? session('textarea_title') : '' }}</textarea>
                                </div>
                            {{-- ADD PARAGRAPH--}}
                                <div class="editor__block add_paragraph__js" style="display: none">
                                    <textarea rows="15" class="form-control editor__input-text " id="textarea_paragraph" placeholder="Напишите что-нибудь">{{ session("text_paragraph") ? session("text_paragraph") : ''}}</textarea>
                                </div>
                            {{-- ADD IMAGE --}}
                                <div class="editor__block add_image__js" style="display: none">
                                    <div class="editor__block-img">
                                        <div>
                                            <div class="editor__drag-and-drop">
                                                Перетащите изображения сюда
                                            </div>
                                        </div>
                                        <div>
                                            <label class="btn form-file editor__attach">
                                                <input type="file">
                                                <span>Прикрепить  с диска</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            {{-- ADD VIDEO --}}
                                <div class="editor__block add_video__js" style="display: none">
                                    <textarea rows="15" class="form-control editor__input-text" placeholder="Вставьте ссылку на ролик Youtube и нажмите Enter"></textarea>
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