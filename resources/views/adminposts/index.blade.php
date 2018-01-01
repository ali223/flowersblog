@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('layouts.status')
	        @forelse($posts as $post)
	            <div class="panel panel-info">
	                <div class="panel-heading">
						@if ($post->image_path)
							<img width="100" src="{{ asset('storage/' . $post->image_path) }}">
						@endif
	                	<h4>
	                		<a href="{{ route('adminposts.show', $post) }}">
	                			{{ $post->title }}	                			
	                		</a>
	                		@if ($post->isUnpublished())
	                			<span class="label label-danger">Unpublished</span>
	                		@else
	                			<span class="label label-success">Published</span>
	                		@endif
	                	</h4>             	
	                	<strong>Created by: </strong>
	                	{{ $post->user->name }} on 
	                	<em>
	                		{{ $post->created_at->toDayDateTimeString() }}
	                	</em>
	                </div>
	                <div class="panel-body">
	                	<p>
	                		{{ str_limit($post->content, 100, '...')	 }}
	                	</p>
	                </div>
	            </div>
	        @empty
	        	<p>No posts found. Please check later.</p>	
	        @endforelse
        </div>
    </div>
</div>
@endsection

