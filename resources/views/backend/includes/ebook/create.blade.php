@extends('backend.layouts.app')

@section('title', __('Create Ebook'))

{{--@section('breadcrumb-links')--}}
    {{--@include('backend.auth.user.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
{{--    {{ html()->form('POST', route('admin.ebook.create_post_ebook'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}--}}
    {{ html()->modelForm($content, 'POST', route('admin.ebook.create_post_ebook'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('Ebook')
                        <small class="text-muted">@lang('Create Ebook')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('Author'))->class('col-md-2 form-control-label')->for('author') }}

                        <div class="col-md-10">
                            {{ html()->text('author')
                                ->class('form-control')
                                ->placeholder(__('Autor'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

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

                    <div class="form-group row">
                        {{ html()->label(__('Category'))->class('col-md-2 form-control-label')->for('content_category_id') }}
                        <div class="col-md-10">
                            <select class="form-control custom-select"  name="content_category_id">
                                <option selected>Select Category</option>
                                @foreach($content as $con)
                                <option value="{{ $con->id }}">{{ $con->name}}</option>
                                @endforeach
                            </select>
                            </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('Short Desc'))->class('col-md-2 form-control-label')->for('short_description') }}

                        <div class="col-md-10">
                            {{ html()->text('short_description')
                                ->class('form-control')
                                ->placeholder(__('Short Desc'))
                                ->attribute('maxlength', 191)
                                ->required() }}
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


                    <div class="form-group row">
                        {{ html()->label(__('Link Url'))->class('col-md-2 form-control-label')->for('url') }}

                        <div class="col-md-10">
                            {{ html()->text('url')
                                ->class('form-control')
                                ->placeholder(__('Link Url'))
                                ->attribute('maxlength', 500)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

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
                                            <img id="img-preview" style="width: 100%;" class="img-fluid">
                                        </div>
                                    </div>

                                </div><!--col-->
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="form-group row">
                        {{ html()->label(__('File'))->class('col-md-2 form-control-label')->for('file') }}

                        <div class="col-md-10">
                            {{ html()->file('file')
                                ->class('form-control')
                                ->attribute('maxlength', 500)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.ebook'), __('buttons.general.cancel')) }}
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
