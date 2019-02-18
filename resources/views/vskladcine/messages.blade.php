<div class="wrapper">
    <div class="container">
        <div class="content-title">
            <h1>Сообщения</h1>
        </div>
        <div class="content-wrapper content-messages">
            <div class="sidebar">

                <div class="sidebar__box sidebar__box--panel sidebar__box--bg-light">
                    @if(isset($messages))
                        <div class="message-menu__title">
                            Переписки
                        </div>
                        @foreach($messages as $message)
                            <div class="message-menu">

                                <div class="message-menu__items getFirstDialog">

                                    <div class="message-menu__item showMessage  showMessageRed_{{$message->sender_user_id}}" id="showMessageDialog" data-sender="{{$message->sender_user_id == Auth::user()->id ? $message->user_id : $message->sender_user_id }}" data-message-id="{{ $message->id }}" >

                                        @if(isset($message->avatarHasLink))
                                            <div class="message-menu__item-img">

                                                <img   style="border-radius: 50%;" src="{{ isset($message->avatar) ? $message->avatar: ''}}" alt="">
                                            </div>
                                        @else
                                            <div class="message-menu__item-img">
                                                <img  style="border-radius: 50%;" src="{{ url("img/content/".$message->avatar) }}" alt="">
                                            </div>
                                        @endif
                                        <div class="message-menu__item-content">
                                            <div class="message-menu__item-title">
                                                <input type="hidden" class="senderName" data-sender-name="{{ $message->sender }}" id="sender_user_id" value="{{$message->sender_user_id}}">
                                                {{ $message->sender }}
                                               @if(!$message->is_read)
                                                   @if($message->sender_user_id != Auth::user()->id)
                                                        <div class="message--new" data-flag="1" id="newMessageId_{{$message->sender_user_id}}"></div>
                                                   @endif

                                                @endif
                                            </div>
                                            <div class="message-menu__item-date">
                                                {{ $message->sended_date }}
                                            </div>
                                            <button data-src="#popup-confirm-message" data-sender-id="{{ $message->sender_user_id }}" data-fancybox="" class="message-menu__item-btn-remove removeMessage" title="Удалить">
                                                <svg class="icon icon-basket"><use xlink:href="{{ url("img/icons.svg#icon-basket") }}"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="sidebar__btn-toggle">
                                <svg class="icon icon-arrow"><use xlink:href="{{ url("img/icons.svg#icon-arrow") }}"/></svg>
                            </button>
                        @endforeach
                      @endif

                </div>
            </div>
            <div class="content">
                <div class="content__box content__box--bg-light">
                    <div class="tabs tabs--messages">
                        <div class="tab-content">
                            <div class="tab-pane active" >

                                <div class="comments comments--messages">
                                    <div class="comments__title" id="senderName">
                                    </div>
                                    <div class="comments__items scroll-pane" id="showDialog">
                                        {{--<div class="comment-item" >--}}
                                            {{--<div class="comment-item__main">--}}
                                                {{--<div class="comment-item__img ">--}}
                                                    {{--<svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>--}}
                                                {{--</div>--}}
                                                {{--<div class="comment-item__title">--}}
                                                    {{--Администратор--}}
                                                {{--</div>--}}
                                                {{--<div class="comment-item__message">--}}
                                                    {{--<div class="comment-item__date ">--}}
                                                        {{--26.04.17, 14:32--}}
                                                    {{--</div>--}}
                                                    {{--<div class="comment-item__text">--}}
                                                        {{--Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="comment-item__links">--}}
                                                    {{--<a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="comment-item">--}}
                                            {{--<div class="comment-item__main">--}}
                                                {{--<div class="comment-item__img">--}}
                                                    {{--<svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>--}}
                                                {{--</div>--}}
                                                {{--<div class="comment-item__title">--}}
                                                    {{--Вы--}}
                                                {{--</div>--}}
                                                {{--<div class="comment-item__message">--}}
                                                    {{--<div class="comment-item__date">--}}
                                                        {{--14:28--}}
                                                    {{--</div>--}}
                                                    {{--<div class="comment-item__text">--}}
                                                        {{--Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    </div>
                                    <div class="comment-answer">

                                        <div class="comment-answer__block">
                                            <textarea class="form-control comment-answer__input" id="newMessage" data-sender-id="" placeholder="Напишите сообщение"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-send comment-answer__btn" id="btnSendNewMessage">
                                            <svg class="icon icon-comment-sm"><use xlink:href="{{ url("img/icons.svg#icon-comment-sm") }}"></use></svg>
                                            <span>Отправить</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane">

                                <div class="comments comments--messages">
                                    <div class="comments__title">
                                        Константин А.
                                    </div>
                                    <div class="comments__items scroll-pane">
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Константин А.
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        26.04.17, 14:32
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>

                                                <div class="comment-item__links">
                                                    <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Вы
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        14:28
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        14:32
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>

                                                <div class="comment-item__links">
                                                    <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Константин А.
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        26.04.17, 14:32
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>

                                                <div class="comment-item__links">
                                                    <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Вы
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        14:28
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-answer">
                                        <textarea class="form-control comment-answer__input" placeholder="Напишите сообщение"></textarea>
                                        <button type="submit" class="btn btn-send comment-answer__btn">
                                            <svg class="icon icon-comment-sm"><use xlink:href="{{ url("img/icons.svg#icon-comment-sm") }}"></use></svg>
                                            <span>Отправить</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane">

                                <div class="comments comments--messages">
                                    <div class="comments__title">
                                        Оля Ф.
                                    </div>
                                    <div class="comments__items scroll-pane">
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Оля Ф.
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        26.04.17, 14:32
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>

                                                <div class="comment-item__links">
                                                    <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-answer">
                                        <textarea class="form-control comment-answer__input" placeholder="Напишите сообщение"></textarea>
                                        <button type="submit" class="btn btn-send comment-answer__btn">
                                            <svg class="icon icon-comment-sm"><use xlink:href="{{ url("img/icons.svg#icon-comment-sm") }}"></use></svg>
                                            <span>Отправить</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane">

                                <div class="comments comments--messages">
                                    <div class="comments__title">
                                        Оксана Б.
                                    </div>
                                    <div class="comments__items scroll-pane">
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Оксана Б.
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        26.04.17, 14:32
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>

                                                <div class="comment-item__links">
                                                    <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Вы
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        14:28
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-answer">
                                        <textarea class="form-control comment-answer__input" placeholder="Напишите сообщение"></textarea>
                                        <button type="submit" class="btn btn-send comment-answer__btn">
                                            <svg class="icon icon-comment-sm"><use xlink:href="{{ url("img/icons.svg#icon-comment-sm") }}"></use></svg>
                                            <span>Отправить</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane">

                                <div class="comments comments--messages">
                                    <div class="comments__title">
                                        Саша Г.
                                    </div>
                                    <div class="comments__items scroll-pane">
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Саша Г.
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        26.04.17, 14:32
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>

                                                <div class="comment-item__links">
                                                    <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-item">
                                            <div class="comment-item__main">
                                                <div class="comment-item__img">
                                                    <svg class="icon icon-avatar"><use xlink:href="{{ url("img/icons.svg#icon-avatar") }}"/></svg>
                                                </div>
                                                <div class="comment-item__title">
                                                    Вы
                                                </div>
                                                <div class="comment-item__message">
                                                    <div class="comment-item__date">
                                                        14:28
                                                    </div>
                                                    <div class="comment-item__text">
                                                        Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками. Задача организации, в особенности же консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-answer">
                                        <textarea class="form-control comment-answer__input" placeholder="Напишите сообщение"></textarea>
                                        <button type="submit" class="btn btn-send comment-answer__btn">
                                            <svg class="icon icon-comment-sm"><use xlink:href="{{ url("img/icons.svg#icon-comment-sm") }}"></use></svg>
                                            <span>Отправить</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="message-missing hidden">
            <div>
                <div class="message-missing__title">
                    Переписка отсутствует
                </div>
                <div class="message-missing__subtitle">
                    Вы можете написать любому пользователю, кликнув на его профиль
                    или найти его на странице всех пользователей сервиса
                </div>
                <a href="#" class="btn btn--border btn--white message-missing__btn-link">Перейти на главную</a>
            </div>
        </div>
    </div>
</div>
