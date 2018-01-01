@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('layouts.errors')
            @include('layouts.status')
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Edit Post
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('adminposts.update', $post) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" maxlength="180" required>
                            </div>                              
                            <div class="form-group">
                                <label for="content">Content:</label>
                                <textarea id="content" name="content" class="form-control" 
                                required>{{ 
                                    old('content', $post->content)
                                }}</textarea>
                            </div>  
                            @if ($post->image_path)
                            <div class="form-group">
                                Uploaded Image:
                                <img width="50" src="{{ asset('storage/'. $post->image_path) }}" >
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="image_file">Upload New Image:</label>
                                <input type="file" id="image_file" name="image_file" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>                
                </div>
        </div>
    </div>
</div>
@endsection

