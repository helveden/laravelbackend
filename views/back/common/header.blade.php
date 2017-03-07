<header class="main-header">
	<!-- Logo -->
	<!-- Logo -->
	<a href="../index2.html" class="logo">
	<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini">LBE</span>
	<!-- logo for regular state and mobile devices -->
		<span class="logo-lg">Laravel Back end</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li><a href="http://almsaeedstudio.com">{{ Auth::user()['firstname'] }} {{ Auth::user()['lastname'] }}</a></li>
			</ul>
		</div>
	</nav>
</header>