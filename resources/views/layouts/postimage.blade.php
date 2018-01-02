@public
	@if ($post->image_path && Storage::exists($post->image_path))
		<img width="{{ $width }}" src="{{ asset('storage/' . $post->image_path) }}">
	@endif
@endpublic

@dropbox
	@if ($post->image_path && Storage::exists($post->image_path))
		<img width="{{ $width }}" src="{{ Storage::getAdapter()->getTemporaryLink($post->image_path) }}">
	@endif
@enddropbox
