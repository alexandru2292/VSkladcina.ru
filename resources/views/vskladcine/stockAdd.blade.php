<div class="wrapper">
    <div class="container">
        <div class="content-title" style="text-align: center">
            <input type="text" class="content-title__input" name="name"  id="stockName" value="{{ session('stockName') ? session('stockName') : "Название складчины" }}">
            <span id="errorName" style="color: #de4444; font-weight: 300; margin-top: -50px">
            </span>
        </div>
        <div class="content-wrapper">
            <div class="sidebar">
                <form action="{{ route("stockStore") }}"  method="POST" enctype="multipart/form-data">
                    @csrf
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
                                    <label class="btn btn--block form-file" >
                                        <input type="file" name="min_img" id="min_img">
                                        <span>Загрузить изображение</span>
                                        <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                           {{ $errors->first('min_img') }}
                                        </span>
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
                                            <select class="selectpicker selectpicker-check" name="category_id" title="Выберите категорию">
                                                <option>Товары и услуги</option>
                                                <option>Физические товары</option>
                                                <option>Тренинги</option>
                                            </select>
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('category_id') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Подкатегория
                                        </div>
                                        <div class="form-item__content">
                                            <select class="selectpicker selectpicker-check" name="subcategory_id" title="Выберите подкатегорию">
                                                <option>Здоровье</option>
                                                <option>Дизайн</option>
                                                <option>Бизнес</option>
                                            </select>
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('subcategory_id') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Тип складчины
                                        </div>
                                        <div class="form-item__content">
                                            <select class="selectpicker" name="type_id">
                                                <option data-description="Данный тип предполагает, что создатель сам является автором предлагаемого в складчине контента">Авторская</option>
                                                <option>Стандартная</option>
                                                <option>Оптовая</option>
                                                <option>На заказ</option>
                                            </select>
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('type_id') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-hidden">
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Минимальное количество
                                        </div>
                                        <div class="form-item__content">
                                            <input type="text" class="form-control" name="min_count" value="15">
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('min_count') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Взнос (цена)
                                        </div>
                                        <div class="form-item__content">
                                            <select class="selectpicker" name="price_contribution">
                                                <option>7 500</option>
                                                <option>10 500</option>
                                                <option>20 500</option>
                                                <option>30 500</option>
                                            </select>
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('price_contribution') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Взнос (комиссия)
                                        </div>
                                        <div class="form-item__content">
                                            <input type="text" class="form-control" name="commission_contribution" value="500">
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('commission_contribution') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__content">
                                            <div class="form-checkbox">
                                                <input type="checkbox" name="sended_protection" id="form-security" class="checkbox checkbox--toggle" checked>
                                                <label for="form-security">Защита отправлений</label>
                                                <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                                   {{ $errors->first('email') }}
                                                </span>
                                                <input type="checkbox" name="purchase_after" id="form-buy" class="checkbox checkbox--toggle" checked>
                                                <label for="form-buy">Покупка после завершения</label>
                                                <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                                   {{ $errors->first('email') }}
                                                </span>
                                                <div class="form-item__text">
                                                    Разрешить доступ к контенту складчины после её завершения по последней сумме взноса
                                                </div>
                                                <input type="checkbox" name="full_form" id="form-data-full" class="checkbox checkbox--toggle" checked>
                                                <label for="form-data-full">Полная форма данных при заказе</label>
                                                <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                                   {{ $errors->first('sended_protection') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Дата сбора
                                        </div>
                                        <div class="form-item__content">
                                            <div class="form-date">
                                                <input type="text" name="date_collection" class="form-control datepicker" readonly placeholder="Выберите дату">
                                                <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                                   {{ $errors->first('date_collection') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Срок доставки
                                        </div>
                                        <div class="form-item__content">
                                            <select class="selectpicker" name="delivery_term">
                                                <option>18-25 дней</option>
                                                <option>26-30 дней</option>
                                                <option>31-40 дней</option>
                                                <option>40-50 дней</option>
                                            </select>
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('delivery_term') }}
                                            </span>
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
                                                        <input type="checkbox" name="delivery[]" value="Доставка 1" id="delivery-1" class="checkbox">
                                                        <label for="delivery-1">Доставка 1</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="delivery[]" value="Доставка 2" id="delivery-2" class="checkbox">
                                                        <label for="delivery-2">Доставка 2</label>
                                                    </div>
                                                </div>
                                                <div class="form-delivery__row">
                                                    <div>
                                                        <input type="checkbox" name="delivery[]" value="Доставка 3" id="delivery-3" class="checkbox">
                                                        <label for="delivery-3">Доставка 3</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="delivery[]" value="Доставка 4" id="delivery-4" class="checkbox">
                                                        <label for="delivery-4">Доставка 4</label>
                                                    </div>
                                                </div>
                                                <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                                   {{ $errors->first('delivery') }}
                                                </span>
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
                                    {{ session('textarea_title')}}
                                </div>
                                <div class="editor__text show_paragraph" style="display: none">
                                        {{ session("text_paragraph") }}
                                </div>
                                <div class="editor__image show_img" style="display: none">
                                    @php
                                        $imgName = session('showImg');
                                    @endphp
                                    <input type="hidden" id="nameImg" value="<?=$imgName?>">
                                    <span id="showImg" style="background-image: url('/img/content/<?=$imgName?>') ">

                                    </span>
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
                                        <button type="button" class="btn btn--block btn--border add_video" id="addYuLinkBtn">Видео</button>
                                    </div>
                                </div>
                            {{-- ADD TITLE  --}}
                                <div class="editor__block add_title__js" >
                                    <textarea rows="10" class="form-control editor__input-title" id="textarea_title" name="title"  placeholder="Введите имя заголовка">{{ session('textarea_title') ? session('textarea_title') : '' }}</textarea>
                                    <span id="errorTitle" style="color: #de4444; font-weight: 300">
                                        <br>
                                    </span>
                                </div>
                            {{-- ADD PARAGRAPH--}}
                                <div class="editor__block add_paragraph__js" style="display: none">
                                    <textarea rows="15" class="form-control editor__input-text " id="textarea_paragraph" placeholder="Напишите что-нибудь">{{ session("text_paragraph") ? session("text_paragraph") : ''}}</textarea>
                                    <span id="errorParagraph" style="color: #de4444; font-weight: 300">
                                        <br>
                                    </span>
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
                                                <input type="file" name="img" class="add_image__js" id="img__js">
                                                <span>Прикрепить  с диска</span>
                                            </label>
                                        </div>

                                    </div>

                                    <span id="errorImg" style="color: #de4444; font-weight: 300">
                                        <br>
                                    </span>

                                </div>
                            {{-- ADD VIDEO --}}
                                <div class="editor__block add_video__js" style="display: none">
                                    <textarea rows="15" class="form-control editor__input-text" id="yt_link" placeholder="Вставьте ссылку на ролик Youtube">{{ session('textareaYtLink') ? session('textareaYtLink') : '' }}</textarea>
                                    <div id="videoContainer" style="margin-top: -180px; display: none">
                                        {{--Here is open the iframe yotube--}}
                                    </div>
                                    <span id="errorYtLink" style="color: #de4444; font-weight: 300">
                                        <br>
                                    </span>
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
                        <input type="text" id="stockTags" placeholder="Укажите теги складчины" value="{{ session('stockTags') ? session('stockTags') : ''}}" class="tags__input">
                        <span id="errorTags">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>