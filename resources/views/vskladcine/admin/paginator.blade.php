@php
    $perPage = 5;
$page = 0;
@endphp


@if($paginator->total() > $perPage)
    <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">
            @if($paginator->currentPage() != 1 )
                <li><a href="{{ $paginator->previousPageUrl() }}">&laquo;</a></li>
            @endif
            @php
                $a = $perPage;
                $b = 1;
            @endphp
            {{--<li class="{{ $paginator->currentPage() == 1 ? 'active' : '' }}" ><a href="{{  $paginator->url(1) }}">1</a></li>--}}
            @foreach($paginator as $i =>  $item)

                @if($a == $b++)
                    @php  $page++;  @endphp
                    <li class="{{ $paginator->currentPage() == $page ? 'active' : '' }}"><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                    @php
                       $b = 1;
                    @endphp
                @endif
            @endforeach
            @if($paginator->currentPage() != $paginator->lastPage())
                <li><a href="{{ $paginator->nextPageUrl() }}">&raquo;</a></li>
            @endif
        </ul>
    </div>
@endif