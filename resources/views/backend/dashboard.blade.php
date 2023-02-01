@extends('backend.layouts.app')

@section('title','Edumu-Lite'.' | ' . __('strings.backend.dashboard.title'))

@section('content')


    <!-- /.row-->
    <div class="row">

        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="nav-icon far fa-newspaper bg-primary p-4 px-5 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">{{$content}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Content</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="nav-icon far fa-newspaper bg-info p-4 px-5 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-info">{{$ebook}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">E-Book</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-bell bg-danger p-4 px-5 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-danger">{{$news}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">News</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="nav-icon fas fa-users bg-warning p-4 px-5 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-warning">{{$customer}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">E-Book</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row-->

    {{--<div class="card">--}}
    {{--<div class="card-body">--}}
    {{--<div class="row">--}}
    {{--<div class="col-sm-5">--}}
    {{--<h4 class="card-title mb-0">--}}
    {{--Data Content--}}
    {{--</h4>--}}
    {{--</div><!--col-->--}}

    {{--<div class="col-sm-7 pull-right">--}}
    {{--@include('backend.auth.role.includes.header-buttons')--}}
    {{--</div><!--col-->--}}
    {{--</div><!--row-->--}}

    {{--<div class="row mt-4">--}}
    {{--<div class="col">--}}
    {{--<div class="table-responsive">--}}
    {{--<table class="table">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th>Judul</th>--}}
    {{--<th>Desc</th>--}}
    {{--<th>Pembuat</th>--}}
    {{--<th>Create Date</th>--}}
    {{--<th>Action</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($roles as $role)--}}
    {{--<tr>--}}
    {{--<td>{{ ucwords($role->name) }}</td>--}}
    {{--<td>{{$role->short_description}}</td>--}}
    {{--<td>{{$role->customer_id}}</td>--}}
    {{--<td>{{$role->created_at}}</td>--}}
    {{--<td>@include('backend.includes.dashboard.actions')</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}

    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
    {{--<div class="col-7">--}}
    {{--<div class="float-left">--}}
    {{--{!! $roles->total() !!} {{ trans_choice('content total', $roles->total()) }}--}}
    {{--</div>--}}
    {{--</div><!--col-->--}}
    {{--</div><!--row-->--}}

    {{--</div>--}}
    {{--</div><!--card-->--}}
@endsection
