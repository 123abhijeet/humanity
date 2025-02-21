<!-- aside start -->
<div class="sidebar" id="sidebar" style="overflow-y: scroll; background: #bf222b;">
	<div class="sidebar-inner">
		<div id="sidebar-menu" class="sidebar-menu">
			<div class="header-left">
				<a href="{{ route('Admin-Dashboard') }}" style="margin-left: -8%;">
					<img src="{{ asset('frontend/img/backend-logo.png') }}" width="80" height="70" alt="" style="margin-right: 90%;" /></a>
				<span style="margin-left: -88%;font-size: 17px;" class="text-uppercase"><span style="color: #F24f1c;font-family: 'Font Awesome 5 Free';">HUMANITY</span></span>
			</div>
			<ul class="sidebar-ul">
				<li class="{{ Route::is('Admin-Dashboard') ? 'active' : '' }}">
					<a href="{{ route('Admin-Dashboard') }}"><img src="{{ asset('backend/img/sidebar/icon-1.png') }}" alt="icon" /><span>Dashboard</span></a>
				</li>

				@role('Admin')
				<li class="{{ Route::is('All-Members') ? 'active' : '' }}">
					<a href="{{ route('All-Members') }}"><img src="{{ asset('backend/img/sidebar/icon-3.png') }}" alt="icon" /><span style="color: white;">Members</span></a>
				</li>
				<li class="{{ Route::is('All-Donors') ? 'active' : '' }}">
					<a href="{{ route('All-Donors') }}"><img src="{{ asset('backend/img/sidebar/icon-4.png') }}" alt="icon" /><span style="color: white;">Donors</span></a>
				</li>
				<li class="{{ Route::is('All-Blood-Requests') ? 'active' : '' }}">
					<a href="{{ route('All-Blood-Requests') }}"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" /><span style="color: white;">Blood Requests</span></a>
				</li>
				@endrole
			</ul>
		</div>
	</div>
</div>
<!-- aside end -->