@extends('admin.layout')

@section('content')
    <form method = "post" action="{{route('post.save')}}">
        @csrf
        <div id="content">
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> Posts </h1>
                    </div>
                </div>
                <hr />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add New Post
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="form-text">Title:</label>
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" id="title" value="{{old('title')}}" placeholder="Title..." class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-text">Slug:</label>
                        </div>
                        <div class="form-group">
                            <input type="text" name="slug" value="{{old('slug')}}" id="slug" placeholder="Slug..." class="form-control @error('slug') is-invalid @enderror">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button-big">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT STRIP  SECTION -->
        <div id="right">
            <div class="well well-small">
                <ul class="list-unstyled">
                    <li>Publish &nbsp; : <span><input type="radio" name="status" checked value="1"></span></li>
                    <li>Save as draft &nbsp; : <span><input type="radio" name="status" value="2"></span></li>
{{--                    <li>Registrations &nbsp; : <span>3,000</span></li>--}}
                </ul>
            </div>
            <div class="well well-small">
{{--                <span>Profit</span><span class="pull-right"><small>20%</small></span>--}}

{{--                <div class="progress mini">--}}
{{--                    <div class="progress-bar progress-bar-info" style="width: 20%"></div>--}}
{{--                </div>--}}
{{--                <span>Sales</span><span class="pull-right"><small>40%</small></span>--}}

{{--                <div class="progress mini">--}}
{{--                    <div class="progress-bar progress-bar-success" style="width: 40%"></div>--}}
{{--                </div>--}}
{{--                <span>Pending</span><span class="pull-right"><small>60%</small></span>--}}

{{--                <div class="progress mini">--}}
{{--                    <div class="progress-bar progress-bar-warning" style="width: 60%"></div>--}}
{{--                </div>--}}
{{--                <span>Summary</span><span class="pull-right"><small>80%</small></span>--}}

{{--                <div class="progress mini">--}}
{{--                    <div class="progress-bar progress-bar-danger" style="width: 80%"></div>--}}
{{--                </div>--}}
<!--Accordion wrapper-->
    <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

        <!-- Accordion card -->
        <div class="card">

            <!-- Card header -->
            <div class="card-header" role="tab" id="headingThree3">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                   aria-expanded="false" aria-controls="collapseThree3">
                    <h5 class="mb-0">
                        Category &nbsp;<i class="icon-chevron-down"></i>
                    </h5>
                </a>
            </div>

            <!-- Card body -->
            <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionEx">
                <div class="card-body">
{{--                    <div class="form-group">--}}
{{--                        <input type="checkbox" id="category{{$cate->id}}" name="category[]" value="{{$cate->id}}"><label for="category{{$cate->id}}">{{$cate->category}}</label>--}}
{{--                    </div>--}}
                    {!! $category !!}
                </div>
            </div>

        </div>
        <!-- Accordion card -->

    </div>
    <!-- Accordion wrapper -->
            </div>
        </div>
        <!-- END RIGHT STRIP  SECTION -->
    </form>
@endsection
@section('script')
    <script>
        {{--CKEDITOR.replace( 'description', {--}}
        {{--    filebrowserUploadUrl: "{{route('post.upload.image', ['_token' => csrf_token() ])}}",--}}
        {{--    filebrowserUploadMethod: 'form'--}}
        {{--});--}}
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
        CKEDITOR.replace('description', options);
    </script>
@endsection
