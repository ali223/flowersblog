@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('layouts.errors')
            @include('layouts.status')
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
            				{{ $comment->text }}
            			</p>
            		@endforeach            		
            	</div>
            </div>
            @can('create', [App\Comment::class, $post])
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Add Comment
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('comments.store', $post) }}">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <textarea 
                                    id="text" 
                                    name="text" 
                                    class="form-control">{{ old('text') }}                          
                                </textarea>
                            </div>  
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>                
                </div>
            @endcan
        </div>
    </div>
</div>
@endsection

