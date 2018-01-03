@extends('layouts.master')

@section('content')
@if (!$showMyPosts)
	@include('layouts.showcase')
@endif
<div class="container posts-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('layouts.status')
	        @forelse($posts as $post)
	            <div class="panel panel-info">
	                <div class="panel-heading">
	                	@include('layouts.postimage', ['width' => 100])
	                	<h4>
	                		<a href="{{ route('posts.show', $post) }}">
	                			{{ $post->title }}
	                		</a>
							@if ($showMyPosts && $post->isUnpublished())
								<span class="label label-danger">Unpublished</span>
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
				@if($showMyPosts)
	        		<p>
	        			You have not created any posts yet. 
	        			You can 
	        			<a href="{{ route('posts.create') }}">create a new post</a> 
	        			or 
	        			<a href="{{ route('posts.index') }}">view all posts.</a>
	        		</p>
	        	@else
	        		<p>No posts have been created yet. Please check later.</p>
	        	@endif
	        @endforelse
        </div>
    </div>
</div>
@endsection

