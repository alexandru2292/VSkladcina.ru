<div class="wrapper">
    <div class="container">
        <div class="content-title" style="text-align: center">
            <input type="text"  autocomplete="off" class="content-title__input" name="name"  id="stockName"  placeholder="Название складчины" value="{{ session('stockName') ? session('stockName') : "" }}">
            <span id="errorName" style="color: #de4444; font-weight: 300; margin-top: -8px; display: none">
                <br>
            </span>
            <input type="text" autocomplete="off"  class="content-title__input subtitleStock" name="subtitle"   id="textarea_paragraph"  placeholder="Краткое дополнение" value="{{ session('text_paragraph') ? session('text_paragraph') : "" }}">
            {{--<input  class="content-title__input" style="font-size: 25px; color: white" id="textarea_paragraph" placeholder="Напишите что-нибудь" value="{{ session("text_paragraph") ? session("text_paragraph") : ''}}">--}}
            <span id="errorParagraph" style="color: #de4444; font-weight: 300; margin-bottom: 10px; display: none">
                <br>
            </span>
        </div>
        <div class="content-wrapper">
            <div class="sidebar">
                <form action="javascript:;"  method="POST" id="stockForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="sidebar__box">
                        <div class="cover-image">
                            <div class="cover-image__img cover-image__img--blur" id="ShowBlurClass">
                                <img id="showImgMin" src="{{ url('img/content/card-photo-2.png') }}" alt="">
                                <input type="hidden" id="old_img" value="">
                            </div>
                            <div class="cover-image__content">
                                <div>
                                    <div class="cover-image__title">
                                        Обложка складчины
                                    </div>
                                    <div class="cover-image__subtitle">
                                        Минимальный размер 320 X 240 PX
                                    </div>
                                    <span id="ImgMinError" role="alert" style="color: #de4444; font-weight: 300">
                                    </span>

                                    <label class="btn btn--block form-file" >
                                        <input type="file" name="min_img" id="min_img">
                                        <span>Загрузить изображение</span>
                                        <br>

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
                                        <div class="form-item__content form_item_category">
                                            <select class="selectpicker  selectpicker-check" name="category_id" id="category" title="Выберите категорию">
                                               @if(isset($catSubTypes['categories']))
                                                    @foreach($catSubTypes['categories'] as $item)
                                                        @if($item->desc)
                                                            <option value="{{ $item->id }}" data-description="{{ $item->desc }}">{{ $item->name }}</option>
                                                        @else
                                                            <option  value="{{ $item->id }}" >{{ $item->name }}</option>
                                                        @endif
                                                    @endforeach
                                               @endif
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
                                                @if(isset($catSubTypes['subcategories']))
                                                    @foreach($catSubTypes['subcategories'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
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
                                            <select class="selectpicker" id="type_id" name="type_id">
                                                @if(isset($catSubTypes['types']))
                                                    @foreach($catSubTypes['types'] as $item)
                                                       <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('type_id') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-hidden">
                                    <div class="form-item">
                                        <div class="form-item__title" id="min_count">
                                            Минимальное количество
                                        </div>
                                        <div class="form-item__content">
                                            <input type="text" class="form-control" name="min_count" value="15">
                                            <span id="errorEmail" role="alert" style="color: #de4444; font-weight: 300">
                                               {{ $errors->first('min_count') }}
                                            </span>
                                            <span id="errorMinCount" role="alert" style="color: #de4444; font-weight: 300"></span>
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
                                            <span id="errorContrPrice" role="alert" style="color: #de4444; font-weight: 300">

                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Взнос (комиссия)
                                        </div>
                                        <div class="form-item__content">
                                            <input type="text" class="form-control" name="commission_contribution" value="500">
                                            <span id="errorContrComiss" role="alert" style="color: #de4444; font-weight: 300"></span>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__content">
                                            <div class="form-checkbox">
                                                <input type="checkbox" name="sended_protection" id="form-security" class="checkbox checkbox--toggle" checked>
                                                <label for="form-security">Защита отправлений</label>

                                                <input type="checkbox" name="purchase_after" id="form-buy" class="checkbox checkbox--toggle" checked>
                                                <label for="form-buy">Покупка после завершения</label>

                                                <div class="form-item__text">
                                                    Разрешить доступ к контенту складчины после её завершения по последней сумме взноса
                                                </div>
                                                <input type="checkbox" name="full_form" id="form-data-full" class="checkbox checkbox--toggle" checked>
                                                <label for="form-data-full">Полная форма данных при заказе</label>

                                            </div>
                                            <span id="errorDelivery" role="alert" style="color: #de4444; font-weight: 300"></span>

                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="form-item__title">
                                            Дата сбора
                                        </div>
                                        <div class="form-item__content">
                                            <div class="form-date">
                                                <input type="text" name="date_collection" class="form-control datepicker" readonly placeholder="Выберите дату">
                                                <span id="errorDateColl" role="alert" style="color: #de4444; font-weight: 300"></span>
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
                                                <span id="errorDelivery2" style="color: #de4444; font-weight: 300"></span>

                                            </div>
                                        </div>
                                        <span id="success" style="color: #008e05; font-weight: 300; text-align: center; display: none">
                                                <br>

                                        </span>
                                    </div>

                                    <div class="form-item">
                                        <div class="form-item__content">
                                            <button type="submit" class="btn btn--block" role="{{ Auth::user()->role_user->load('role')->role->name }}" id="createStock">
                                                @if( Auth::user()->role_user->load('role')->role->name  == "Admin")
                                                    Опубликовать
                                                    @elseif(Auth::user()->role_user->load('role')->role->name  == "Moderator")
                                                    Опубликовать
                                                    @else
                                                    Отправить на проверку
                                                @endif
                                            </button>
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

            {{--Anulat--}}
                                {{--<div class="editor__title title__js" style="display: none">--}}
                                    {{--{{ session('textarea_title')}}--}}
                                {{--</div>--}}
                                {{--<div class="editor__text show_paragraph" style="display: none">--}}
                                        {{--{{ session("text_paragraph") }}--}}
                                {{--</div>--}}
                                {{--<div class="editor__image show_img" style="display: none">--}}
                                    @php
                                        $imgName = session('showImg');
                                    @endphp
                                    <input type="hidden" id="nameImg" value="<?=$imgName?>">
                                    <span id="showImg" style="background-image: url('/img/content/<?=$imgName?>') ">
                                        <input type="hidden" id="BigImgHidden" value="<?=$imgName?>">
                                    </span>
                                {{--</div>--}}
                                {{--<div class="editor__buttons add_buttons ">--}}
                                    {{--<div>--}}
                                        {{--<button type="button" class="btn btn--block active add_title" id="add_title__js">Добавить заголовок</button>--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--<button type="button" class="btn btn--block btn--border add_paragraph" id="">Абзац</button>--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--<button type="button" class="btn btn--block btn--border add_img" id="">Изображение</button>--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--<button type="button" class="btn btn--block btn--border add_video" id="addYuLinkBtn">Видео</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{-- ADD TITLE  --}}
                                {{--<div class="editor__block add_title__js" >--}}
                                    {{--<textarea rows="10" class="form-control editor__input-title" id="textarea_title" name="title"  placeholder="Введите имя заголовка">{{ session('textarea_title') ? session('textarea_title') : '' }}</textarea>--}}
                                    {{--<span id="errorTitle" style="color: #de4444; font-weight: 300">--}}
                                        {{--<br>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{-- ADD PARAGRAPH--}}
                                {{--<div class="editor__block add_paragraph__js" style="display: none">--}}
                                    {{--<textarea rows="15" class="form-control editor__input-text " id="textarea_paragraph" placeholder="Напишите что-нибудь">{{ session("text_paragraph") ? session("text_paragraph") : ''}}</textarea>--}}
                                    {{--<span id="errorParagraph" style="color: #de4444; font-weight: 300">--}}
                                        {{--<br>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{-- ADD IMAGE --}}
                                {{--<div class="editor__block add_image__js" style="display: none">--}}
                                    {{--<div class="editor__block-img">--}}
                                        {{--<div>--}}
                                            {{--<div class="editor__drag-and-drop">--}}
                                                {{--Перетащите изображения сюда--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div>--}}
                                            {{--<label class="btn form-file editor__attach">--}}
                                                {{--<input type="file" name="img" class="add_image__js" id="img__js">--}}
                                                {{--<span>Прикрепить  с диска</span>--}}
                                            {{--</label>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}

                                    {{--<span id="errorImg" style="color: #de4444; font-weight: 300">--}}
                                        {{--<br>--}}
                                    {{--</span>--}}

                                {{--</div>--}}
                            {{-- ADD VIDEO --}}
                                {{--<div class="editor__block add_video__js" style="display: none">--}}
                                    {{--<textarea rows="15" class="form-control editor__input-text" id="yt_link" placeholder="Вставьте ссылку на ролик Youtube">{{ session('textareaYtLink') ? session('textareaYtLink') : '' }}</textarea>--}}
                                    {{--<div id="videoContainer" style="margin-top: -180px; display: none">--}}
                                        {{--Here is open the iframe yotube--}}
                                    {{--</div>--}}
                                    {{--<span id="errorYtLink" style="color: #de4444; font-weight: 300">--}}
                                        {{--<br>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
            {{-- /Anulat --}}

                                {{--<a href="#" class="btn-sm upload-img-btn" id="uploadImgCK" data-toggle="modal" data-target="#myModal">--}}
                                    {{--<img src="{{ url("css/images/upload.png") }}" width="20" height="20" alt=""><span> Загружать</span></a>--}}
                                {{--<input type="file" id="image-input" style="display: none;">--}}

                                <div class="editor__block " >
                                    <textarea rows="15" class="form-control " id="stockInfo" name="description" placeholder="Напишите что-нибудь">Напишите что-нибудь</textarea>
                                    <span id="infoStockError" style="color: #de4444; font-weight: 300">
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
                        <input type="text" autocomplete="off" id="stockTags" placeholder="Укажите теги складчины" value="{{ session('stockTags') ? session('stockTags') : ''}}" class="tags__input">
                        <span id="errorTags">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="popup-link-image" class="popup popup-feedback">
    <div class="popup-title">Скопируйте линк, нажмите на "Изображение" и вставьте его в поле "Сcылка"</div>

    <input id="url_field" style="width: 100%; outline: none; padding: 5px; border-radius: 3px;" type="url" value="">
    <div id="successCopied" style="color: #3accc6; font-size: 20px; text-align: center; display: none;">
        Вы успешно скопировали путь к изображение
    </div>
    <div style="width: 100%; text-align: center; padding-top: 10px">
        <input id="copyLinnk" style="margin: auto;text-align: center" class="btn btn-group-sm" value="Копировать">
    </div>
</div>