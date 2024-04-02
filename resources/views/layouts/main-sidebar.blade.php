<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
                <a class="desktop-logo logo-light active" href="{{ url('/' . $page='dashboard') }}">
                    <i class="fas fa-album side-menu__icon" aria-hidden="true"></i>
                </a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='dashboard') }}"><img src="{{asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='dashboard') }}"><img src="{{asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='dashboard') }}"><img src="{{asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="https://cdn-icons-png.flaticon.com/512/9131/9131529.png"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
							<span class="mb-0 text-muted">{{auth()->user()->eamil}}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">


					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ route('albums.index') }}">
                            <i class="fa fa-image side-menu__icon" aria-hidden="true"></i>
                            <span class="side-menu__label">Albums</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('albums.index') }}">All Albums</a></li>

						</ul>
					</li>




				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
