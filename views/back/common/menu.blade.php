<div class="sidebar">
	<ul class="nav sidebar-menu">
		{{-- <li class=""><a href="{{ route('home') }}" class=""><i class="fa fa-circle-o"></i> Home</a></li> --}}
		<li class="">
			<a href="{{ route(config('laravelbackend.path')) }}" class=""><i class="fa fa-circle-o"></i> Dachboard</a>
		</li>
		<li class="">
			<a href="{{ route('database') }}" class=""><i class="fa fa-circle-o"></i> Database</a>
		</li>
		<li class="">
			<a href="{{ route('table') }}" class=""><i class="fa fa-circle-o"></i> Tables</a>
		</li>
		<li class="">
			<a href="{{ route('menu_index') }}" class=""><i class="fa fa-circle-o"></i> Menu</a>
		</li>
	    @if(Auth::check())
            <li class=""><a href="{{ route('logout') }}" class=""><i class="fa fa-circle-o"></i> Deconnexion back end</a></li>
	    @endif
	</ul>
</div>