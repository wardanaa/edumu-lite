@extends('backend.layouts.app')

@section('title', __('Edumu-Lite') . ' | ' . __('Detail Content'))

{{--@section('breadcrumb-links')--}}
    {{--@include('backend.auth.user.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Preview Content
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('Detail Content')</a>
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
                                            <td>{{ $content->name }}</td>
                                        </tr>

                                        <tr>
                                            <th>Short Desc</th>
                                            <td>{{ $content->short_description }}</td>
                                        </tr>

                                        <tr>
                                            <th>Desc</th>
                                            <td>{{ $content->description }}</td>
                                        </tr>

                                        <tr>
                                            <th>Contributor</th>
                                            <td>{{ $content->customer->name}}</td>
                                        </tr>

                                        <tr>
                                            <th>File</th>
                                            <td>{{ $content->file }}</td>
                                        </tr>

                                        <tr>
                                            <th>Link URL</th>
                                            <td>{{ $content->url }}</td>
                                        </tr>

                                        <tr>
                                            <th>Date Publish</th>
                                            <td>{{ $content->created_at }}</td>
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
