<ol class="breadcrumb">
	@foreach(Request::segments() as $segment => $path)
		<li class="breadcrumb-item">
			@if(count(Request::segments()) == ($segment + 1))
				{{ $path }}
			@else
				<a href="{{ route($path) }}">{{ $path }}</a>
			@endif
		</li>
	@endforeach
</ol>