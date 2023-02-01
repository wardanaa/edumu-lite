@extends('backend.layouts.app')

@section('title', __('Edumu-Lite') . ' | ' . __('Detail Users'))

{{--@section('breadcrumb-links')--}}
    {{--@include('backend.auth.user.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Preview Users
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> Detail data user</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">

                            {{--data--}}
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover">

                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $roles->name}}</td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $roles->email }}</td>
                                        </tr>

                                        <tr>
                                            <th>Position</th>
                                            <td>{{ $roles->position }}</td>
                                        </tr>

                                        <tr>
                                            <th>User name</th>
                                            <td>{{ $roles->username}}</td>
                                        </tr>

                                        <tr>
                                            <th>Instansi</th>
                                            <td>{{ $roles->company }}</td>
                                        </tr>

                                        <tr>
                                            <th>Device name</th>
                                            <td>{{ $roles->device_name }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div><!--table-responsive-->

                            {{--/data--}}

                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
