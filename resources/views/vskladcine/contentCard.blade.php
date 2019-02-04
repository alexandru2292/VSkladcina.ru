<div class="wrapper">
    <div class="container">
        <div class="content-title content-title--card">
            <h1>{{ $stock->name }}</h1>

            <div class="content-title__subtitle">
                {{ $stock->subtitle }}
            </div>
        </div>
        <div class="content-wrapper">
            <div class="sidebar">
                <div class="sidebar__box">
                    <div class="cover-image">
                        <div class="cover-image__img">
                            <img src="{{ url("img/content/cards/$stock->min_img") }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="sidebar-toggle">
                    <div class="sidebar-toggle__content">
                        <div class="sidebar__box sidebar__box--bg-light">

                            {{-- All status  --}}

                            @if($stock->status == "moderation")
                                <div class="status status">
                                    <div class="status__title">
                                        Статус
                                    </div>
                                    <div class="statusCard" >
                                        <select class="selectpicker" id="stockStatus" style="min-width: 250px " >
                                            <option value="moderation">На модерации</option>
                                            <option value="is_open">Опубликовано</option>
                                            <option value="on_editing">На переделку</option>
                                       </select>
                                    </div>
                                    <div class="card-buttons">

                                        <button type="submit" id="confirm" class="btn btn--block">Подтвердить</button>
                                    </div>


                                </div>
                            @endif
                            @if($stock->status == "finished")
                                <div class="status status--finished">
                                    <div class="status__title">
                                        Статус
                                    </div>
                                    <div class="status__row">
                                        <div>
                                            Завершена
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($stock->status == "collection")
                                <div class="status status--collection">
                                    <div class="status__title">
                                        Статус
                                    </div>
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
                                    <div class="status__title">
                                        Статус
                                    </div>
                                    <div class="status__row">
                                        <div>
                                            Открыта
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($stock->status == "completed")
                                <div class="status status--completed">
                                    <div class="status__title">
                                        Статус
                                    </div>
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

                            <div class="card-info">
                                <div class="card-info__item">
                                    Тип складчины
                                    <span>{{ $stock->hasType->name  }}</span>
                                </div>
                               @if(isset($stock->type_contribution))
                                    <div class="card-info__item">
                                        Тип взноса
                                        <span>{{ $stock->type_contribution }}</span>
                                    </div>
                               @endif
                                <div class="card-info__item">
                                    Минимальное количество
                                    <span>{{ isset($stock->min_count) ? $stock->min_count : '' }} </span>
                                </div>
                                <div class="card-info__item">
                                    Взнос
                                    <span>{{ $stock->price_contribution }} Р</span>
                                </div>
                                <div class="card-info__item">
                                    Дата сбора
                                    <span>{{ $stock->date_collection['d'] }} {{ $stock->date_collection['m'] }} {{ $stock->date_collection['Y'] }} г.</span>
                                </div>

                {{-- TREBUIE DE FINISAT AFISAREA --}}
                                <div class="card-info__item">
                                    Складчики
                                    <span>{{ $stock->countFollowers }}</span>
                                </div>
                                <div class="card-info__item">
                                    Создатель
                                    <div class="user-item-small">
                                        <div class="user-item-small__img">
                                            <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                <img src="{{url("img/content/photo-user.png") }}" alt="">
                                            </a>
                                        </div>
                                        <div class="user-item-small__title">
                                            <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                Оля Ф.
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating">
                                    <div class="rating__title">
                                        Обязательная оценка
                                    </div>
                                    <div class="rating__row">
                                        <div class="rating__parameter-title">
                                            Уникальность контента
                                        </div>
                                        <div class="rating__stars">
                                            <div class="stars stars--select">
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating__row">
                                        <div class="rating__parameter-title">
                                            Доступность
                                        </div>
                                        <div class="rating__stars">
                                            <div class="stars stars--select">
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating__title">
                                        Оценка качества контента
                                    </div>

                                    <div class="rating__row">
                                        <div class="rating__parameter-title">
                                            <input type="checkbox" id="video-quality" name="video-quality" class="checkbox checkbox--toggle">
                                            <label for="video-quality">&#8212; качество видео</label>
                                        </div>
                                        <div class="rating__stars disabled">
                                            <div class="stars stars--select">
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating__row">
                                        <div class="rating__parameter-title">
                                            <input type="checkbox" id="sound-quality" name="sound-quality" class="checkbox checkbox--toggle">
                                            <label for="sound-quality">&#8212; качество звука</label>
                                        </div>
                                        <div class="rating__stars disabled">
                                            <div class="stars stars--select">
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating__row">
                                        <div class="rating__parameter-title">
                                            <input type="checkbox" id="image-quality" name="image-quality" class="checkbox checkbox--toggle" checked>
                                            <label for="image-quality">&#8212; качество изображений</label>
                                        </div>
                                        <div class="rating__stars">
                                            <div class="stars stars--select">
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating__row">
                                        <div class="rating__parameter-title">
                                            <input type="checkbox" id="text-quality" name="text-quality" class="checkbox checkbox--toggle" checked>
                                            <label for="text-quality">&#8212; качество текста</label>
                                        </div>
                                        <div class="rating__stars">
                                            <div class="stars stars--select">
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item star-item--active">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                                <div class="star-item">
                                                    <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rating__comment">
                                        <div class="rating__title">
                                            Комментарий эксперта
                                        </div>
                                        <textarea class="form-control rating__input" placeholder="Добавьте комментарий"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-buttons">
                                @if(Auth::user()->id != $stock->hasUser->id)
                                    @if(isset($hasFollower) && $hasFollower->hasFollower)
                                        <a href="javascript:;" class="btn btn--red btn--block btn-entry unfollowed" onclick="unfollowed({{$stock->id}});" id="unfollowed">
                                            <svg class="icon icon-entry"><use xlink:href="{{ url("img/icons.svg#icon-entry") }}"/></svg>
                                            <span>Выписаться из складчины</span>
                                        </a>
                                        @else
                                        <a href="javascript:;" class="btn btn--block btn-entry" data-stock-id="{{$stock->id}}" id="follows">
                                            <svg class="icon icon-entry"><use xlink:href="{{ url("img/icons.svg#icon-entry") }}"/></svg>
                                            <span>Записаться в складчину</span>
                                        </a>
                                    @endif
                                        <a href="javascript:;" class="btn btn--red btn--block btn-entry unfollowed"  onclick="unfollowed({{$stock->id}});"  style="display: none;">
                                            <svg class="icon icon-entry"><use xlink:href="{{ url("img/icons.svg#icon-entry") }}"/></svg>
                                            <span>Выписаться из складчины</span>
                                        </a>


                                @endif

                                <a href="#" class="btn btn--block">
                                    <span>Сохранить оценку</span>
                                </a>
                            </div>

                        </div>
                        <div class="sidebar__box sidebar__box--bg-dark">
                            <div class="statistics">
                                <div class="statistics__row">
                      <span>
                        Создана
                      </span>
                                    <span>
                        23.02.2016
                      </span>
                                </div>
                                <div class="statistics__row">
                      <span>
                        Обновлена
                      </span>
                                    <span>
                        24.02.2016
                      </span>
                                </div>
                                <div class="statistics__row">
                      <span>
                        Активность
                      </span>
                                    <span>
                        14:51, 23.02.2016
                      </span>
                                </div>
                                <div class="statistics__row">
                      <span>
                        Просмотров
                      </span>
                                    <span>
                        1456
                      </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn--block sidebar-toggle__btn-toggle active">
                        <svg class="icon icon-arrow"><use xlink:href="{{ url("img/icons.svg#icon-arrow") }}"/></svg>
                    </button>

                </div>
                <div class="sidebar__box">
                    <div class="card-complain">
                        <a href="javascript:void(0);" data-src="#popup-complain" data-fancybox="" class="card-complain__link">Пожаловаться на складчину</a>
                    </div>
                </div>
            </div>
{{-- /TREBUIE DE FINISAT AFISAREA --}}

            <div class="content">
                <div class="tabs">
                    <ul class="nav-tabs" data-toggle="tabs">
                        <li class="active"><a href="#">Информация</a></li>
                        <li><a href="#">Общение</a></li>
                        <li><a href="#">Активность</a></li>
                        <li><a href="#">Складчики</a></li>
                        <li><a href="#">Оценка</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="content__box content__box--bg-light">
                                <div class="content-text">
                                    <a href="javascript:void(0);" class="link-share">
                                        <svg class="icon icon-share"><use xlink:href="{{ url("img/icons.svg#icon-share") }}"/></svg>
                                    </a> <br>

                                   <span> {!!   $stock->description !!}</span>

                                </div>
                            </div>
                            <div class="content__box content__box--bg-dark">
                                <div class="tags">
                                    <div class="tags__title">
                                        Теги
                                    </div>
                                    <div class="tags__list">
                                        {!! $stock->tags !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="content__box content__box--bg-light">
                                <div class="top-filters">
                                    <div>
                                        <ul class="top-filters__menu">
                                            <li class="active"><a href="javascript:void(0);">Публичный канал</a></li>
                                            <li><a href="javascript:void(0);">Приватный канал</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="comments">
                                    <div class="comments__add-answer">
                                        <div class="comment-answer">
                                            <div class="comment-answer__title">
                                                Написать комментарий
                                            </div>
                                            <textarea class="form-control comment-answer__input" placeholder="Поделитесь своим мнением"></textarea>
                                            <button type="submit" class="btn btn-send comment-answer__btn">
                                                <svg class="icon icon-comment-sm"><use xlink:href="{{ url("img/icons.svg#icon-comment-sm") }}"></use></svg>
                                                <span>Оставить комментарий</span>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="comments__count">
                                        <span>Комментарии</span> — 235
                                    </div>
                                    <div class="comments__items">
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <a href="javascript:void(0);" data-src="#popup-user" data-fancybox=""><svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg></a>
                                                </div>
                                                <div class="comment-item__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">Константин А.</a>
                                                </div>
                                                <a href="#" class="comment-item__link-like">
                                                    <span>23</span>
                                                    <svg class="icon icon-heart"><use xlink:href="{{url("img/icons.svg#icon-heart") }}"/></svg>
                                                </a>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        26.04.17, 14:32
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>

                                                <div class="comment-item__links">
                                                    <a href="#" class="comment-item__link-answer">Ответить</a>
                                                    <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                                </div>
                                            </div>
                                            <div class="comment-item__inner">
                                                <div class="comment-item">
                                                    <div class="comment-item__main">
                                                        <div class="comment-item__img">
                                                            <a href="javascript:void(0)" data-src="#popup-user" data-fancybox=""><svg class="icon icon-avatar"><use xlink:href="img/icons.svg#icon-avatar"/></svg></a>
                                                        </div>
                                                        <div class="comment-item__title">
                                                            <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">Оля Ф.</a> <span><svg class="icon icon-arrow-comment"><use xlink:href="img/icons.svg#icon-arrow-comment"/></svg>Константин А.</span>
                                                        </div>
                                                        <a href="#" class="comment-item__link-like comment-item__link-like--active">
                                                            <span>2</span>
                                                            <svg class="icon icon-heart"><use xlink:href="{{url("img/icons.svg#icon-heart") }}"/></svg>
                                                        </a>

                                                        <div class="comment-item__message">
                                                            <div class="comment-item__date">
                                                                26.04.17, 14:32
                                                            </div>
                                                            <div class="comment-item__text">
                                                                Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="comment-item">
                                                    <div class="comment-item__main">
                                                        <div class="comment-item__img">

                                                            <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                                <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                            </a>
                                                        </div>
                                                        <div class="comment-item__title">
                                                            <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">Оля Ф.</a> <span><svg class="icon icon-arrow-comment"><use xlink:href="{{ url("img/icons.svg#icon-arrow-comment") }}"/></svg>Константин А.</span>
                                                        </div>
                                                        <a href="#" class="comment-item__link-like comment-item__link-like--active">
                                                            <span>2</span>
                                                            <svg class="icon icon-heart"><use xlink:href="{{ url("img/icons.svg#icon-heart") }} "/></svg>
                                                        </a>

                                                        <div class="comment-item__message">
                                                            <div class="comment-item__date">
                                                                26.04.17, 14:32
                                                            </div>
                                                            <div class="comment-item__text">
                                                                Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="comment-answer">
                                                    <textarea class="form-control comment-answer__input" placeholder="Напишите ответ"></textarea>
                                                    <button type="submit" class="btn btn-send comment-answer__btn">
                                                        <svg class="icon icon-comment-sm"><use xlink:href="{{ url("img/icons.svg#icon-comment-sm") }}"></use></svg>
                                                        <span>Оставить комментарий</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">

                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                    </a>
                                                </div>
                                                <div class="comment-item__row">
                                                    <div>
                                                        <div class="comment-item__title">

                                                            <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                                Константин А.
                                                            </a>
                                                        </div>
                                                        <div class="comment-item__date">
                                                            26.04.17, 14:32
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="#" class="comment-item__link-like">
                                                            <span>23</span>
                                                            <svg class="icon icon-heart"><use xlink:href="{{ url("img/icons.svg#icon-heart") }} "/></svg>
                                                        </a>
                                                    </div>
                                                </div>


                                                <div class="comment-item__text">
                                                    Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                </div>
                                                <div class="comment-item__links">
                                                    <a href="#" class="comment-item__link-answer">Ответить</a>
                                                    <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="content__box content__box--bg-light">
                                <div class="top-filters">
                                    <div>
                                        <ul class="top-filters__menu">
                                            <li class="active"><a href="javascript:void(0);">Все</a></li>
                                            <li><a href="javascript:void(0);">Важное</a></li>
                                            <li><a href="javascript:void(0);">Участники</a></li>
                                            <li><a href="javascript:void(0);">Комментарии</a></li>
                                            <li><a href="javascript:void(0);">Лайки</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="top-filters__reset">
                                            <svg class="icon icon-calc"><use xlink:href="{{ url("img/icons.svg#icon-calc") }}"/></svg>
                                            <span>сбросить</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="notifications">
                                    <div class="notifications__date">
                                        Сегодня
                                    </div>
                                    <div class="notifications__items">
                                        <div class="notification-item notification-item--like">
                                            <div class="notification-item__icon">
                                                <svg class="icon icon-heart"><use xlink:href="{{ url("img/icons.svg#icon-heart") }} "/></svg>
                                            </div>
                                            <div class="notification-item__title">

                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    @katrina
                                                </a>
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                            <div class="notification-item__info">
                                                <div class="notification-item__text">
                                                    Задача организации, в особенности же консультация с широким активом требуют от нас анализа
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification-item notification-item--rating">
                                            <div class="notification-item__icon">
                                                <svg class="icon icon-star-2"><use xlink:href="{{ url("img/icons.svg#icon-star") }} -2"/></svg>
                                            </div>
                                            <div class="notification-item__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    Константин Панякин
                                                </a>
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                            <div class="notification-item__info">
                                                <div class="stars">
                                                    <div class="star-item star-item--active">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                    <div class="star-item star-item--active">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                    <div class="star-item star-item--active">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                    <div class="star-item star-item--active">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                    <div class="star-item">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification-item notification-item--user">
                                            <div class="notification-item__icon">
                                                <svg class="icon icon-user-2"><use xlink:href="{{ url("img/icons.svg#icon-user-2") }} "/></svg>
                                            </div>
                                            <div class="notification-item__title">
                                                Добавлен складчик
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                            <div class="notification-item__info">
                                                <div class="user-item-small">
                                                    <div class="user-item-small__img">
                                                        <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                            <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                        </a>
                                                    </div>
                                                    <div class="user-item-small__title">
                                                        <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                            Оля Ф.
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification-item notification-item--comment">
                                            <div class="notification-item__icon">
                                                <svg class="icon icon-comment-2"><use xlink:href="{{ url("img/icons.svg#icon-comment-2") }}"/></svg>
                                            </div>
                                            <div class="notification-item__title">

                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    Константин Панякин
                                                </a>
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                            <div class="notification-item__info">
                                                <div class="notification-item__text">
                                                    Задача организации, в особенности же консультация с широким активом требуют от нас анализа
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification-item notification-item--process">
                                            <div class="notification-item__title">
                                                Начался сбор
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                        </div>
                                        <div class="notification-item notification-item--process">
                                            <div class="notification-item__title">
                                                Запрос на экспертную оценку
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notifications__date">
                                        23.04.17
                                    </div>
                                    <div class="notifications__items">
                                        <div class="notification-item notification-item--like">
                                            <div class="notification-item__icon">
                                                <svg class="icon icon-heart"><use xlink:href="{{ url("img/icons.svg#icon-heart") }} "/></svg>
                                            </div>
                                            <div class="notification-item__title">

                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    @katrina
                                                </a>
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                            <div class="notification-item__info">
                                                <div class="notification-item__text">
                                                    Задача организации, в особенности же консультация с широким активом требуют от нас анализа
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification-item notification-item--rating">
                                            <div class="notification-item__icon">
                                                <svg class="icon icon-star-2"><use xlink:href="{{ url("img/icons.svg#icon-star") }} -2"/></svg>
                                            </div>
                                            <div class="notification-item__title">

                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    Константин Панякин
                                                </a>
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                            <div class="notification-item__info">
                                                <div class="stars">
                                                    <div class="star-item star-item--active">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                    <div class="star-item star-item--active">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                    <div class="star-item star-item--active">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                    <div class="star-item star-item--active">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                    <div class="star-item">
                                                        <svg class="icon icon-star"><use xlink:href="{{ url("img/icons.svg#icon-star") }} "/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification-item notification-item--user">
                                            <div class="notification-item__icon">
                                                <svg class="icon icon-user-2"><use xlink:href="{{ url("img/icons.svg#icon-user-2") }} "/></svg>
                                            </div>
                                            <div class="notification-item__title">
                                                Добавлен складчик
                                            </div>
                                            <div class="notification-item__date">
                                                26 октября 2016 г., 14:32
                                            </div>
                                            <div class="notification-item__info">
                                                <div class="user-item-small">
                                                    <div class="user-item-small__img">
                                                        <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                            <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                        </a>
                                                    </div>
                                                    <div class="user-item-small__title">
                                                        <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                            Оля Ф.
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="content__box content__box--bg-light">
                                <div class="folders">
                                    <div class="folders__count">
                                        65 складчиков
                                    </div>
                                    <div class="folders__items">
                                        <div class="user-item-small">
                                            <div class="user-item-small__img">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                </a>
                                            </div>
                                            <div class="user-item-small__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    Оля Ф.
                                                </a>
                                            </div>
                                        </div>
                                        <div class="user-item-small">
                                            <div class="user-item-small__img">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                </a>
                                            </div>
                                            <div class="user-item-small__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    @kovalsky
                                                </a>
                                            </div>
                                        </div>
                                        <div class="user-item-small">
                                            <div class="user-item-small__img">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                </a>
                                            </div>
                                            <div class="user-item-small__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    Оля Ф.
                                                </a>
                                            </div>
                                        </div>
                                        <div class="user-item-small">
                                            <div class="user-item-small__img">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                </a>
                                            </div>
                                            <div class="user-item-small__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    @kovalsky
                                                </a>
                                            </div>
                                        </div>
                                        <div class="user-item-small">
                                            <div class="user-item-small__img">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                </a>
                                            </div>
                                            <div class="user-item-small__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    Оля Ф.
                                                </a>
                                            </div>
                                        </div>
                                        <div class="user-item-small">
                                            <div class="user-item-small__img">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                </a>
                                            </div>
                                            <div class="user-item-small__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    @kovalsky
                                                </a>
                                            </div>
                                        </div>
                                        <div class="user-item-small">
                                            <div class="user-item-small__img">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                </a>
                                            </div>
                                            <div class="user-item-small__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    Оля Ф.
                                                </a>
                                            </div>
                                        </div>
                                        <div class="user-item-small">
                                            <div class="user-item-small__img">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                </a>
                                            </div>
                                            <div class="user-item-small__title">
                                                <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                    @kovalsky
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="content__box content__box--bg-light">
                                <div class="top-filters">
                                    <div>
                                        <ul class="top-filters__menu">
                                            <li><a href="javascript:void(0);">Оценка эксперта</a></li>
                                            <li class="active"><a href="javascript:void(0);">5</a></li>
                                            <li><a href="javascript:void(0);">4</a></li>
                                            <li><a href="javascript:void(0);">3</a></li>
                                            <li><a href="javascript:void(0);">2</a></li>
                                            <li><a href="javascript:void(0);">1</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="rating">
                                    <div class="folders">
                                        <div class="folders__count">
                                            23 оценки
                                        </div>
                                        <div class="folders__items">
                                            <div class="user-item-small">
                                                <div class="user-item-small__img">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                    </a>
                                                </div>
                                                <div class="user-item-small__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        Оля Ф.
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="user-item-small">
                                                <div class="user-item-small__img">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <img src="{{ url("img/content/avatar.png") }} " alt="">
                                                    </a>
                                                </div>
                                                <div class="user-item-small__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        @kovalsky
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="user-item-small">
                                                <div class="user-item-small__img">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                    </a>
                                                </div>
                                                <div class="user-item-small__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        Оля Ф.
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="user-item-small">
                                                <div class="user-item-small__img">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <img src="{{ url("img/content/avatar.png") }} " alt="">
                                                    </a>
                                                </div>
                                                <div class="user-item-small__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        @kovalsky
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="user-item-small">
                                                <div class="user-item-small__img">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                    </a>
                                                </div>
                                                <div class="user-item-small__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        Оля Ф.
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="user-item-small">
                                                <div class="user-item-small__img">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <img src="{{ url("img/content/avatar.png") }} " alt="">
                                                    </a>
                                                </div>
                                                <div class="user-item-small__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        @kovalsky
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="user-item-small">
                                                <div class="user-item-small__img">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <img src="{{ url("img/content/photo-user.png") }} " alt="">
                                                    </a>
                                                </div>
                                                <div class="user-item-small__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        Оля Ф.
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="user-item-small">
                                                <div class="user-item-small__img">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        <img src="{{ url("img/content/avatar.png") }} " alt="">
                                                    </a>
                                                </div>
                                                <div class="user-item-small__title">
                                                    <a href="javascript:void(0)" data-src="#popup-user" data-fancybox="">
                                                        @kovalsky
                                                    </a>
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
</div>