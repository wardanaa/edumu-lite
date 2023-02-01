@extends ('admin.layouts.app')

@if($type == \App\Models\Content\Content::TYPE_NEWS)
    @section('title', 'News | Tambah News')
@else
    @section('title', 'News | Tambah Review')
@endif

@section('content')
    {{ html()->form('POST', route('content.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    {{ html()->hidden('type')->value($type) }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @if($type == \App\Models\Content\Content::TYPE_NEWS)
                            Tambah News
                        @else
                            Tambah Review
                        @endif
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr/>

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group required row">
                        {{ html()->label('Name')
                            ->class('col-md-2 form-control-label')
                            ->for('content_name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder('Name')
                                ->attribute('maxlength', 200)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

            <div class="form-group required row mb-3">
                {{ html()->label('Kategori')
                    ->class('col-md-2 form-control-label')
                    ->for('category') }}

                <div class="col-md-4 ">
                    <select id="categories" name="category" class="form-control">
                        @foreach($categories as $category)

                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>

                        @endforeach
                    </select>
                </div><!--col-->
            </div><!--form-group-->

            <div class="row mt-3">
                <div class="col">
                    <div class="form-group required row">
                        {{ html()->label('Image')
                            ->class('col-md-2 form-control-label') }}

                        <div class="col-md-10">

                            <div class="custom-file mb-2">

                                {{ html()->file('image')->class('custom-file-input')->required()->attribute('onchange="readURL(this)"') }}
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
                    <div class="form-group row">
                        {{ html()->label('Active')->class('col-md-2 form-control-label') }}

                        <div class="col-md-9">
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('active', true, '1')->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>

                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('content.index', $type), 'Batal') }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit('Tambah') }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection

@push('after-scripts')
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#categories').select2();
        });

        var options = {
            filebrowserImageBrowseUrl: '{{url('/laravel-filemanager?type=Images')}}',
            filebrowserImageUploadUrl: '{{url('/laravel-filemanager/upload?type=Images&_token='.csrf_token())}}',
            filebrowserBrowseUrl: '{{url('/laravel-filemanager?type=Files')}}',
            filebrowserUploadUrl: '{{url('/laravel-filemanager/upload?type=Files&_token='.csrf_token())}}',
        };

        CKEDITOR.config.extraPlugins = 'justify,colorbutton';
        CKEDITOR.replace('description', options);

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