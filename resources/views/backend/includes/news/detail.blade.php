@extends('backend.layouts.app')

@section('title', __('Edumu-Lite') . ' | ' . __('Detail News'))

{{--@section('breadcrumb-links')--}}
    {{--@include('backend.auth.user.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Preview News
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('Detail News')</a>
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
                                                @if($roles->image !== null && $roles->image !== '')
                                                    <img width="30%" height="30%" class="img-thumbnail" src="{!! $roles->image_location !!}" alt="Profile Picture">
                                                @else
                                                    <img width="30%" height="30%" class="img-thumbnail" src="{{ asset('img/default_image.jpg') }}" alt="Profile Picture">
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Judul Content</th>
                                            <td>{{ $roles->name }}</td>
                                        </tr>

                                        <tr>
                                            <th>Desc</th>
                                            <td>{{ $roles->description }}</td>
                                        </tr>

                                        <tr>
                                            <th>Date Publish</th>
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
    </div><!--card-->
@endsection
