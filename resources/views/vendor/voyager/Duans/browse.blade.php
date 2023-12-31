@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
        </h1>
        @can('add', app($dataType->model_name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
            </a>
        @endcan
        @can('delete', app($dataType->model_name))
            @include('voyager::partials.bulk-delete')
        @endcan
        @can('edit', app($dataType->model_name))
            @if(!empty($dataType->order_column) && !empty($dataType->order_display_column))
                <a href="{{ route('voyager.'.$dataType->slug.'.order') }}" class="btn btn-primary btn-add-new">
                    <i class="voyager-list"></i> <span>{{ __('voyager::bread.order') }}</span>
                </a>
            @endif
        @endcan
        @can('delete', app($dataType->model_name))
            @if($usesSoftDeletes)
                <input type="checkbox" @if ($showSoftDeleted) checked @endif id="show_soft_deletes" data-toggle="toggle" data-on="{{ __('voyager::bread.soft_deletes_off') }}" data-off="{{ __('voyager::bread.soft_deletes_on') }}">
            @endif
        @endcan
        @foreach($actions as $action)
            @if (method_exists($action, 'massAction'))
                @include('voyager::bread.partials.actions', ['action' => $action, 'data' => null])
            @endif
        @endforeach
        
        <!-- Thêm html của nút dọn thùng rác -->
        <a href="javascript:void(0)" class="btn btn-sm btn-warning delete_trash_btn"><i class="voyager-trash"></i> Dọn thùng rác</a>

        <a href="{{ setting('admin.github-dainguyen') }}" target="_blank" class="btn btn-link pull-right">Link github README.mb</a>

        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        @if ($isServerSide)
                            <form method="get" class="form-search">
                                <div id="search-input">
                                    <div class="col-2">
                                        <select id="search_key" name="key">
                                            @foreach($searchNames as $key => $name)
                                                <option value="{{ $key }}" @if($search->key == $key || (empty($search->key) && $key == $defaultSearchKey)) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select id="filter" name="filter">
                                            <option value="contains" @if($search->filter == "contains") selected @endif>{{ __('voyager::generic.contains') }}</option>
                                            <option value="equals" @if($search->filter == "equals") selected @endif>=</option>
                                        </select>
                                    </div>
                                    <div class="input-group col-md-12">
                                        <input type="text" class="form-control" placeholder="{{ __('voyager::generic.search') }}" name="s" value="{{ $search->value }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-lg" type="submit">
                                                <i class="voyager-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                @if (Request::has('sort_order') && Request::has('order_by'))
                                    <input type="hidden" name="sort_order" value="{{ Request::get('sort_order') }}">
                                    <input type="hidden" name="order_by" value="{{ Request::get('order_by') }}">
                                @endif
                            </form>
                        @endif
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        @if($showCheckboxColumn)
                                            <th class="dt-not-orderable">
                                                <input type="checkbox" class="select_all">
                                            </th>
                                        @endif
                                        <!-- Bắt đầu hiển thị các cột với tùy chỉnh dữ liệu -->
                                        @php 
                                            $mangcottren = array('da_tenduan', 'da_thulaoduan', 'Khách hàng', 'da_tienchida');
                                            $mangcotduoi = array('da_ngaygiaoviec','da_tiendothanhtoan','da_deadline','Ngân hàng');
                                        @endphp
                                        @foreach($dataType->browseRows as $row)
                                            @if( (in_array($row->field, $mangcottren)) || (in_array($row->getTranslatedAttribute('display_name'), $mangcottren)) ) 
                                                @php
                                                    $stt = array_search($row->field, $mangcottren);
                                                @endphp
                                            <th>
                                                    <p>{{ $row->getTranslatedAttribute('display_name') }}</p> 
                                                    
                                                    @foreach($dataType->browseRows as $row2)
                                                        @if( $row2->field == $mangcotduoi[$stt] || $row2->getTranslatedAttribute('display_name') == $mangcotduoi[$stt])
                                                            <p>{{ $row2->getTranslatedAttribute('display_name') }}</p>
                                                        @endif
                                                    @endforeach
                                                    
                                                @if ($isServerSide)
                                                    @if ($row->isCurrentSortField($orderBy))
                                                        @if ($sortOrder == 'asc')
                                                            <i class="voyager-angle-up pull-right"></i>
                                                        @else
                                                            <i class="voyager-angle-down pull-right"></i>
                                                        @endif
                                                    @endif
                                                    </a>
                                                @endif
                                                
                                            </th>
                                            @endif
                                        @endforeach
                                        <!-- kết thúc hiển thị các cột với tùy chỉnh dữ liệu -->
                                        <th class="actions text-right dt-not-orderable">{{ __('voyager::generic.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataTypeContent as $data)
                                    <tr>
                                        @if($showCheckboxColumn)
                                            <td>
                                                <input type="checkbox" name="row_id" id="checkbox_{{ $data->getKey() }}" value="{{ $data->getKey() }}">
                                            </td>
                                        @endif
                                        @foreach($dataType->browseRows as $row)
                                            @php
                                            if ($data->{$row->field.'_browse'}) {
                                                $data->{$row->field} = $data->{$row->field.'_browse'};
                                            }
                                            @endphp
                                            
                                                @if (isset($row->details->view_browse))
                                                    @include($row->details->view_browse, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $data->{$row->field}, 'view' => 'browse', 'options' => $row->details])
                                                @elseif (isset($row->details->view))
                                                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $data->{$row->field}, 'action' => 'browse', 'view' => 'browse', 'options' => $row->details])
                                               

                                                <!--- Bắt đầu hiển thị dữ liệu với tùy chỉnh dữ liệu-->
                                                @elseif( (in_array($row->field, $mangcottren)) || (in_array($row->getTranslatedAttribute('display_name'), $mangcottren)) )  
                                                    @php
                                                        $stt = array_search($row->field, $mangcottren);
                                                    @endphp
                                                <td>
                                                    <p style = "color:red;">{{ ($data->{$row->field}); }}</p>
                                                    @foreach($dataType->browseRows as $row2)
                                                        @if( $row2->field == $mangcotduoi[$stt] || $row2->getTranslatedAttribute('display_name') == $mangcotduoi[$stt])
                                                            @if($row2->type == 'image')
                                                                <img src="@if( !filter_var($data->{$row2->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $data->{$row2->field} ) }}@else{{ $data->{$row2->field} }}@endif" style="width:100px">
                                                            @elseif($row2->type == 'relationship')
                                                                @include('voyager::formfields.relationship', ['view' => 'browse','options' => $row2->details])
                                                            @elseif($row2->type == 'select_multiple')
                                                                @if(property_exists($row2->details, 'relationship'))

                                                                    @foreach($data->{$row2->field} as $item)
                                                                        {{ $item->{$row2->field} }}
                                                                    @endforeach

                                                                @elseif(property_exists($row2->details, 'options'))
                                                                    @if (!empty(json_decode($data->{$row2->field})))
                                                                        @foreach(json_decode($data->{$row2->field}) as $item)
                                                                            @if (@$row2->details->options->{$item})
                                                                                {{ $row2->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        {{ __('voyager::generic.none') }}
                                                                    @endif
                                                                @endif

                                                                @elseif($row2->type == 'multiple_checkbox' && property_exists($row2->details, 'options'))
                                                                    @if (@count(json_decode($data->{$row2->field}, true)) > 0)
                                                                        @foreach(json_decode($data->{$row2->field}) as $item)
                                                                            @if (@$row2->details->options->{$item})
                                                                                {{ $row2->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        {{ __('voyager::generic.none') }}
                                                                    @endif

                                                            @elseif(($row2->type == 'select_dropdown' || $row2->type == 'radio_btn') && property_exists($row2->details, 'options'))
                                                                @if($data->{$row2->field} == 1)
                                                                        <span class="label label-info"> {!! $row2->details->options->{$data->{$row2->field}} ?? '' !!} </span>
                                                                    @else 
                                                                        <span class="label label-danger"> {!! $row2->details->options->{$data->{$row2->field}} ?? '' !!} </span>
                                                                    @endif
                                                            @elseif($row2->type == 'date' || $row2->type == 'timestamp')
                                                                @if ( property_exists($row2->details, 'format') && !is_null($data->{$row2->field}) )
                                                                    {{ \Carbon\Carbon::parse($data->{$row2->field})->formatLocalized($row2->details->format) }}
                                                                @else
                                                                    {{ $data->{$row2->field} }}
                                                                @endif
                                                            @elseif($row2->type == 'checkbox')
                                                                @if(property_exists($row2->details, 'on') && property_exists($row2->details, 'off'))
                                                                    @if($data->{$row2->field})
                                                                        <span class="label label-primary">{{ $row2->details->on }}</span>
                                                                    @else
                                                                        <span class="label label-danger">{{ $row2->details->off }}</span>
                                                                    @endif
                                                                @else
                                                                {{ $data->{$row2->field} }}
                                                                @endif
                                                            @elseif($row2->type == 'color')
                                                                <span class="badge badge-lg" style="background-color: {{ $data->{$row2->field} }}">{{ $data->{$row2->field} }}</span>
                                                            @elseif($row2->type == 'text')
                                                                @include('voyager::multilingual.input-hidden-bread-browse')
                                                                <div>{{ mb_strlen( $data->{$row2->field} ) > 200 ? mb_substr($data->{$row2->field}, 0, 200) . ' ...' : $data->{$row2->field} }}</div>
                                                            @elseif($row2->type == 'text_area')
                                                                @include('voyager::multilingual.input-hidden-bread-browse')
                                                                <div>{{ mb_strlen( $data->{$row2->field} ) > 200 ? mb_substr($data->{$row2->field}, 0, 200) . ' ...' : $data->{$row2->field} }}</div>
                                                            @elseif($row2->type == 'file' && !empty($data->{$row2->field}) )
                                                                @include('voyager::multilingual.input-hidden-bread-browse')
                                                                @if(json_decode($data->{$row2->field}) !== null)
                                                                    @foreach(json_decode($data->{$row2->field}) as $file)
                                                                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}" target="_blank">
                                                                            {{ $file->original_name ?: '' }}
                                                                        </a>
                                                                        <br/>
                                                                    @endforeach
                                                                @else
                                                                    <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($data->{$row2->field}) }}" target="_blank">
                                                                        {{ __('voyager::generic.download') }}
                                                                    </a>
                                                                @endif
                                                            @elseif($row2->type == 'rich_text_box')
                                                                @include('voyager::multilingual.input-hidden-bread-browse')
                                                                <div>{{ mb_strlen( strip_tags($data->{$row2->field}, '<b><i><u>') ) > 200 ? mb_substr(strip_tags($data->{$row2->field}, '<b><i><u>'), 0, 200) . ' ...' : strip_tags($data->{$row2->field}, '<b><i><u>') }}</div>
                                                            @elseif($row2->type == 'coordinates')
                                                                @include('voyager::partials.coordinates-static-image')
                                                            @elseif($row2->type == 'multiple_images')
                                                                @php $images = json_decode($data->{$row2->field}); @endphp
                                                                @if($images)
                                                                    @php $images = array_slice($images, 0, 3); @endphp
                                                                    @foreach($images as $image)
                                                                        <img src="@if( !filter_var($image, FILTER_VALIDATE_URL)){{ Voyager::image( $image ) }}@else{{ $image }}@endif" style="width:50px">
                                                                    @endforeach
                                                                @endif
                                                            @elseif($row2->type == 'media_picker')
                                                                @php
                                                                    if (is_array($data->{$row2->field})) {
                                                                        $files = $data->{$row2->field};
                                                                    } else {
                                                                        $files = json_decode($data->{$row2->field});
                                                                    }
                                                                @endphp
                                                                @if ($files)
                                                                    @if (property_exists($row2->details, 'show_as_images') && $row2->details->show_as_images)
                                                                        @foreach (array_slice($files, 0, 3) as $file)
                                                                        <img src="@if( !filter_var($file, FILTER_VALIDATE_URL)){{ Voyager::image( $file ) }}@else{{ $file }}@endif" style="width:50px">
                                                                        @endforeach
                                                                    @else
                                                                        <ul>
                                                                        @foreach (array_slice($files, 0, 3) as $file)
                                                                            <li>{{ $file }}</li>
                                                                        @endforeach
                                                                        </ul>
                                                                    @endif
                                                                    @if (count($files) > 3)
                                                                        {{ __('voyager::media.files_more', ['count' => (count($files) - 3)]) }}
                                                                    @endif
                                                                @elseif (is_array($files) && count($files) == 0)
                                                                    {{ trans_choice('voyager::media.files', 0) }}
                                                                @elseif ($data->{$row2->field} != '')
                                                                    @if (property_exists($row2->details, 'show_as_images') && $row2->details->show_as_images)
                                                                        <img src="@if( !filter_var($data->{$row2->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $data->{$row2->field} ) }}@else{{ $data->{$row2->field} }}@endif" style="width:50px">
                                                                    @else
                                                                        {{ $data->{$row2->field} }}
                                                                    @endif
                                                                @else
                                                                    {{ trans_choice('voyager::media.files', 0) }}
                                                                @endif
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-browse')
                                                                <span>{{ $data->{$row2->field} }}</span>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                @endif   
                                                <!-- Kết thúc tùy chỉnh hiển thị dữ liệu -->
                                        @endforeach
                                        <td class="no-sort no-click bread-actions">
                                            @foreach($actions as $action)
                                                @if (!method_exists($action, 'massAction'))
                                                    @include('voyager::bread.partials.actions', ['action' => $action])
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($isServerSide)
                            <div class="pull-left">
                                <div role="status" class="show-res" aria-live="polite">{{ trans_choice(
                                    'voyager::generic.showing_entries', $dataTypeContent->total(), [
                                        'from' => $dataTypeContent->firstItem(),
                                        'to' => $dataTypeContent->lastItem(),
                                        'all' => $dataTypeContent->total()
                                    ]) }}</div>
                            </div>
                            <div class="pull-right">
                                {{ $dataTypeContent->appends([
                                    's' => $search->value,
                                    'filter' => $search->filter,
                                    'key' => $search->key,
                                    'order_by' => $orderBy,
                                    'sort_order' => $sortOrder,
                                    'showSoftDeleted' => $showSoftDeleted,
                                ])->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->    

    <!-- modal của delete trash --> 
    <div class="modal modal-danger fade" tabindex="-1" id="delete_trash_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Thông báo dọn sạch thùng rác</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_trash_form" method="GET">
                        
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  

@stop

@section('css')
@if(!$dataType->server_side && config('dashboard.data_tables.responsive'))
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
@endif
@stop

@section('javascript')
    <!-- DataTables -->
    @if(!$dataType->server_side && config('dashboard.data_tables.responsive'))
        <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    @endif
    <script>
        $(document).ready(function () {
            @if (!$dataType->server_side)
                var table = $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => $orderColumn,
                        "language" => __('voyager::datatable'),
                        "columnDefs" => [
                            ['targets' => 'dt-not-orderable', 'searchable' =>  false, 'orderable' => false],
                        ],
                    ],
                    config('voyager.dashboard.data_tables', []))
                , true) !!});
            @else
                $('#search-input select').select2({
                    minimumResultsForSearch: Infinity
                });
            @endif

            @if ($isModelTranslatable)
                $('.side-body').multilingual();
                //Reinitialise the multilingual features when they change tab
                $('#dataTable').on('draw.dt', function(){
                    $('.side-body').data('multilingual').init();
                })
            @endif
            $('.select_all').on('click', function(e) {
                $('input[name="row_id"]').prop('checked', $(this).prop('checked')).trigger('change');
            });
        });


        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = '{{ route('voyager.'.$dataType->slug.'.destroy', '__id') }}'.replace('__id', $(this).data('id'));
            $('#delete_modal').modal('show');
        });

        // script delete trash
        $('.delete_trash_btn').on('click', function () {
            $('#delete_trash_form')[0].action = '{{ route('deletetrash', ['table' => $dataType->slug, 'check' => True]) }}';
           $('#delete_trash_modal').modal('show');
        });

        @if($usesSoftDeletes)
            @php
                $params = [
                    's' => $search->value,
                    'filter' => $search->filter,
                    'key' => $search->key,
                    'order_by' => $orderBy,
                    'sort_order' => $sortOrder,
                ];
            @endphp
            $(function() {
                $('#show_soft_deletes').change(function() {
                    if ($(this).prop('checked')) {
                        $('#dataTable').before('<a id="redir" href="{{ (route('voyager.'.$dataType->slug.'.index', array_merge($params, ['showSoftDeleted' => 1]), true)) }}"></a>');
                    }else{
                        $('#dataTable').before('<a id="redir" href="{{ (route('voyager.'.$dataType->slug.'.index', array_merge($params, ['showSoftDeleted' => 0]), true)) }}"></a>');
                    }

                    $('#redir')[0].click();
                })
            })
        @endif
        $('input[name="row_id"]').on('change', function () {
            var ids = [];
            $('input[name="row_id"]').each(function() {
                if ($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            $('.selected_ids').val(ids);
        });
    </script>
@stop
