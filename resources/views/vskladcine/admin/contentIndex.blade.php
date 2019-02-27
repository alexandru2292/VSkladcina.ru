<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Панель Администрирование
            <small>Отображены все добавленные складчины </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="col-md-100">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Все складчины</h3>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Имя</th>
                            <th>Фото</th>
                            <th>Тип складчины</th>
                            <th>Мин. количество</th>
                            <th>Взнос</th>
                            <th>Действие</th>
                        </tr>

                     @if(isset($stocks))
                            @foreach($stocks as $i => $stock)
                                <tr id="stock_{{ $stock->id }}">
                                    <td>{{$stock->id}}.</td>
                                    <td> <a href="{{ route("showCard", ['id' => $stock->id, 'allStatus' => 1])  }}" style="text-decoration: none" target="_blank"> {{ $stock->name }}</a></td>
                                    <td>
                                        <a href="{{ route("showCard", ['id' => $stock->id, 'allStatus' => 1])  }}" style="text-decoration: none" target="_blank"><img width="120" height="100" src="{{url("img/content/cards/$stock->min_img")}}" alt="">
                                        </a>

                                    </td>
                                    <td>
                                        {{ $stock->hasType->name }}
                                    </td>
                                    <td>{{ isset($stock->min_count) ? $stock->min_count : '' }} </td>
                                    <td>{{ isset($stock->price_contribution) ? $stock->price_contribution : '' }} Р</td>
                                    <td style="text-align: center;"><a href="#" class="badge bg-red btn-delete-stock"  id="btn-delete-stock" data-stock-id="{{$stock->id}}"  style="margin-top: 35%">Удалить</a></td>
                                    {{--<td>--}}
                                    {{--<button class='btn btn-danger btn-xs launchConfirm' type="button" name="remove_levels"><span class="fa fa-times"></span> delete</button></td>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                     @endif
                    </table>
                </div>
                <!-- /.box-body -->
                <div style="display: flex; justify-content: flex-end; margin-right: 1%">{{ $stocks->links(config("settings.theme").'.vendor.pagination.default') }}</div>
            </div>



        </div>



        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><h3>Вы точно желаете удалить складчину?</h3></p>
                {{--<p><h3><a href="{{ route('deleteStock', ['id'=> 1]) }}">Da</a></h3></p>--}}
                <button class="btn btn-danger" id="confirm-msg-delete" data-stock-id="" data-fancybox-close>
                    <span>Да</span>
                </button>
                <button class="btn btn-no" style="background-color: #3c8dbc; color: white">
                    <span>Нет</span>
                </button>
            </div>
        </div>


 {{-- SUCCESS MODAL --}}
        <div id="successModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><h2>Message</h2></p>
            </div>
        </div>
    </section>

    <!-- /.content -->
</div>



