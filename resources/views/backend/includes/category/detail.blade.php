@extends('backend.layouts.app')

@section('title', __('Edumu-Lite') . ' | ' . __('Detail Content Category'))

{{--@section('breadcrumb-links')--}}
    {{--@include('backend.auth.user.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Preview Content Category
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('Detail Content Category')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">

                            {{--data--}}
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Judul Content</th>
                                            <td>{{ $roles->name }}</td>
                                        </tr>

                                        <tr>
                                            <th>Desc</th>
                                            <td>{{ $roles->description }}</td>
                                        </tr>

                                        <tr>
                                            <th>Type</th>
                                            <td>{{ $roles->type }}</td>
                                        </tr>

                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $roles->active}}</td>
                                        </tr>

                                        <tr>
                                            <th>Create Date</th>
                                            <td>{{ $roles->created_at }}</td>
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
                    {{--<small class="float-right text-muted">--}}
                        {{--<strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($user->created_at) }} ({{ $user->created_at->diffForHumans() }}),--}}
                        {{--<strong>@lang('labels.backend.access.users.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($user->updated_at) }} ({{ $user->updated_at->diffForHumans() }})--}}
                        {{--@if($user->trashed())--}}
                            {{--<strong>@lang('labels.backend.access.users.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($user->deleted_at) }} ({{ $user->deleted_at->diffForHumans() }})--}}
                        {{--@endif--}}
                    {{--</small>--}}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
