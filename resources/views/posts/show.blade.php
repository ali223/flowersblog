@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">
                	<h4>
                		{{ $post->title }}
                	</h4>             	
                	<strong>Created by: </strong>
                	{{ $post->user->name }} on 
                	<em>
                		{{ $post->created_at->toDayDateTimeString() }}
                	</em>
                </div>
                <div class="panel-body">
                	<p>
                		{{ $post->content }}
                	</p>
                </div>
            </div>
            <div class="panel panel-info">
            	<div class="panel-heading">
            		<h4>Comments</h4>
            	</div>
            	<div class="panel-body">
            		@foreach($post->comments as $comment)
            			<p>
	        		        <strong>
	        					{{ $comment->user->name }} 
	        					commented
	        					<em>
	        						{{ $comment->created_at->diffForHumans() }}
	        					</em>
	        				</strong>
        				</p>
            			<p>
            				{{ $comment->content }}
            			</p>
            		@endforeach            		
            	</div>

            </div>
        </div>
    </div>
</div>
@endsection

