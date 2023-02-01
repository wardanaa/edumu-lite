@extends('backend.layouts.app')

@section('title', __('Edumu-Lite') . ' | ' . __('Detail Ebook'))

{{--@section('breadcrumb-links')--}}
    {{--@include('backend.auth.user.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Preview Ebook
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> Detail data</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">

                            {{--data--}}
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover">

                                        <tr>
                                            <th>Cover</th>
                                            <td>
                                                @if($roles[0]->image !== null && $roles[0]->image !== '')
                                                    <img width="30%" height="30%" class="img-thumbnail" src="{!! $roles->image_location !!}" alt="Profile Picture">
                                                @else
                                                    <img width="30%" height="30%" class="img-thumbnail" src="{{ asset('img/default_image.jpg') }}" alt="Profile Picture">
                                                @endif
                                            </td>
                                            {{--<td></td>--}}
                                            {{--<td><img width="30%" height="30%" class="img-thumbnail" src="{!! $roles->image_location !!}" alt="Profile Picture"></td>--}}
                                        </tr>


                                        <tr>
                                            <th>Author</th>
                                            <td>{{ $roles[0]->author}}</td>
                                        </tr>

                                        <tr>
                                            <th>Judul Content</th>
                                            <td>{{ $roles[0]->name_content }}</td>
                                        </tr>

                                        <tr>
                                            <th>Short Desc</th>
                                            <td>{{ $roles[0]->short_description }}</td>
                                        </tr>

                                        <tr>
                                            <th>Desc</th>
                                            <td>{{ $roles[0]->description }}</td>
                                        </tr>

                                        <tr>
                                            <th>Category</th>
                                            <td>{{ $roles[0]->nama }}</td>
                                        </tr>

                                        <tr>
                                            <th>File</th>
                                            <td><a href="{{$roles[0]->file_location}}">{{$roles[0]->name_content}}</a></td>
                                        </tr>

                                        <tr>
                                            <th>Link URL</th>
                                            <td><a href="{{$roles[0]->url}}">{{$roles[0]->name_content}}</a></td>
                                        </tr>

                                        <tr>
                                            <th>Date Publish</th>
                                            <td>{{ $roles[0]->created_at }}</td>
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
