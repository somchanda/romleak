@extends('admin.layout')

@section('content')
    <form method="post" action="{{route('post.update')}}">
        @csrf
        <div id="content">
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> Posts </h1>
                    </div>
                </div>
                <hr/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Post
                    </div>
                    <div class="panel-body">
                        @error('featurePath')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="form-group">
                            <label class="form-text">Title:</label>
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" id="title" value="{{$post->title}}" placeholder="Title..."
                                   class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description">{{$post->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button-big">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT STRIP  SECTION -->
        <div id="right">
            <div class="well well-small">
                <ul class="list-unstyled">
                    <li>Publish &nbsp; : <span><input type="radio" @if($post->status == 1) checked @endif name="status"
                                                      value="1"></span></li>
                    <li>Save as draft &nbsp; : <span><input type="radio" @if($post->status == 2) checked
                                                            @endif name="status" value="2"></span></li>
                </ul>
            </div>
            <div class="well well-small">
                <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                    <!-- Accordion card -->
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingThree3">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx"
                               href="#collapseThree3"
                               aria-expanded="false" aria-controls="collapseThree3">
                                <h5 class="mb-0">
                                    Category &nbsp;<i class="icon-chevron-down"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                             data-parent="#accordionEx">
                            <div class="card-body">
                                {!! $category !!}
                            </div>
                        </div>

                    </div>
                    <!-- Accordion card -->
                    <!-- Accordion card -->
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingThree3">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#feature"
                               aria-expanded="false" aria-controls="feature">
                                <h5 class="mb-0">
                                    Feature &nbsp;<i class="icon-chevron-down"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="feature" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                             data-parent="#accordionEx">
                            <div class="card-body">
                                <div class="input-group">
                        <span class="input-group-btn">
                            <a id="feature-file-manager" data-input="feature-thumbnail" data-preview="feature-view"
                               class="btn btn-block">
                                Choose
                            </a>
                        </span>
                                    <input id="feature-thumbnail" class="form-control" value="@if(old('featurePath')) {{old('featurePath')}} @else {{$post->featurePath}}@endif"
                                           type="hidden" name="featurePath">
                                </div>
                                <div id="feature-view" style="margin: 1px 2px; max-height:200px;">
                                    @if(old('featurePath') and !\Illuminate\Support\Str::contains(old('featurePath'), ','))
                                        <img style="height: 5rem;" src="{{old('featurePath')}}">
                                    @else
                                        <img style="height: 5rem;" src="{{$post->featurePath}}">
                                    @endif

                                </div>
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
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
        CKEDITOR.replace('description', options);
        $('#feature-file-manager').filemanager('image');
    </script>
@endsection
