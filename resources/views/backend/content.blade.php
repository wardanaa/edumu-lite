@extends('backend.layouts.app')

{{--@section('title', app_name() . ' | ' . __('Content'))--}}
@section('title', __('Edumu-Lite') . ' | ' . __('Content'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Data Content
                    </h4>
                </div><!--col-->

                {{--<div class="col-sm-7 pull-right">--}}
                {{--@include('backend.auth.role.includes.header-buttons')--}}
                {{--</div><!--col-->--}}
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        <div class="col-md-3">
                            {{ html()->text('search')
                                ->class('form-control')
                                ->placeholder(__('Search'))
                                ->id('search')
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="table-responsive">
                        <table class="table" id="data-table">
                            <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Desc</th>
                                <th>Author</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contents as $cont)
                                <tr>
                                    <td>{{ ucwords($cont->name) }}</td>
                                    <td>{{$cont->short_description}}</td>
                                    <td>{{$cont->customer->name}}</td>
                                    <td>{{$cont->created_at}}</td>
                                    <td>@include('backend.includes.content.actions')</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $contents->total() !!} {{ trans_choice('content total', $contents->total()) }}
                    </div>
                </div><!--col-->
            </div><!--row-->

        </div>
    </div><!--card-->
@endsection

@push('after-scripts')
    <script>

        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{route('admin.contentjson')}}',
                data:{'search':$value},
                success:function(data){
                    // $('#data-table').html(data);
                    $('#data-table tbody').empty();

                    for (i=0;i<data.data.length;i++){
                        $('#data-table tbody').append(
                            '<tr>' +
                            '<td>'+data.data[i].name_content+'</td>'+
                            '<td>'+data.data[i].short_description+'</td>'+
                            '<td>'+data.data[i].nama+'</td>'+
                            '<td>'+data.data[i].created_at+'</td>'+
                            '<td>' +
                            '<div class="btn-group btn-group-sm" role="group" aria-label="@lang("labels.backend.access.users.user_actions")">\n' +
                            '\n' +
                            '    <a href="<?php echo URL::to('admin/show') ?>/'+data.data[i].id+'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="show">\n' +
                            '        <i class="fas fa-eye"></i>\n' +
                            '    </a>\n' +
                            '\n' +
                            '    <a href="<?php echo URL::to('admin/delete') ?>/'+data.data[i].id+'"\n' +
                            '       data-method="get"\n' +
                            '       data-trans-button-cancel="@lang("buttons.general.cancel")"\n' +
                            '       data-trans-button-confirm="@lang("buttons.general.crud.delete")"\n' +
                            '       data-trans-title="@lang("strings.backend.general.are_you_sure")"\n' +
                            '       class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">\n' +
                            '        <i class="fas fa-trash"></i>\n' +
                            '    </a>\n' +
                            '</div>' +
                            '</td>'+
                            '</tr>'
                        )
                    }
                }
            });
        })

    </script>
@endpush
