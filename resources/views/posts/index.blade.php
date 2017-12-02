@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
	        @foreach($posts as $post)
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                	<h4>
	                		<a href="{{ route('posts.show', $post) }}">
	                			{{ $post->title }}
	                		</a>
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
	        @endforeach
        </div>
    </div>
</div>
@endsection

