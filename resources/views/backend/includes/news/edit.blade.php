@extends('backend.layouts.app')

@section('title', __('Edumu-Lite') . ' | ' . __('Edit News'))

{{--@section('breadcrumb-links')--}}
    {{--@include('backend.auth.user.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
    {{ html()->modelForm($content, 'PATCH', route('admin.news.editpost', $content->id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
{{--    {{ html()->form('POST', route('admin.ebook.create_post'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}--}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('News')
                        <small class="text-muted">@lang('Edit News')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('Judul Ebook'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('Judul'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group required row">
                                {{ html()->label('Description')
                                    ->class('col-md-2 form-control-label')
                                    ->for('description') }}

                                <div class="col-md-10">
                                    {{ html()->textarea('description')
                                        ->class('form-control')
                                        ->placeholder('Content Static Description')
                                        ->autofocus() }}
                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group required row">
                                {{ html()->label('Image')
                                    ->class('col-md-2 form-control-label') }}

                                <div class="col-md-10">

                                    <div class="custom-file mb-2">

                                        {{ html()->file('image')->class('custom-file-input')->attribute('onchange="readURL(this)"') }}
                                        {{ html()->label('Choose file')
                                        ->class('custom-file-label')
                                        ->for('image')
                                         ->id('label-image')}}

                                    </div>
                                    <div class="row">
                                        <div class="col-10 col-sm-6 col-lg-4">
                                            @if($content->image !== null && $content->image !== '')
                                                <img id="img-preview" width="50%" height="30%" class="img-fluid" src="{{ url($content->image_location) }}">
                                            @else
                                                <img id="img-preview" width="50%" height="30%" class="img-thumbnail" src="{{ asset('img/default_image.jpg') }}" alt="Profile Picture">
                                            @endif
                                        </div>
                                    </div>

                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.news'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit('Save') }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->form()->close() }}
@endsection
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
@push('after-scripts')
    <script>
        CKEDITOR.replace( 'description' );
        var data = CKEDITOR.instances.description.getData();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-preview').attr('src', e.target.result);
                    $('#label-image').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
