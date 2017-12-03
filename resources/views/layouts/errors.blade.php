@if(count($errors))
<div class="alert alert-danger" id="error-alert" role="alert">
	<ul>
		@foreach($errors->all() as $error) 
	    	<li> {{ $error }} </li>
	  	@endforeach
	</ul>
</div>
@endif
