		<!-- nav start -->
		<div class="header-outer">
			<div class="header">
				<a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fas fa-bars" aria-hidden="true"></i></a>
				<a id="toggle_btn" class="float-left" href="javascript:void(0);">
					<img src="{{ asset('backend/img/sidebar/icon-21.png')}}" alt="" />
				</a>

				<ul class="nav float-left">
					<li>
						<a href="index.html" class="mobile-logo d-md-block d-lg-none d-block"><img src="{{ asset('frontend/img/sat_logo.png')}}" alt="" width="30" height="30" /></a>
					</li>
				</ul>

				<ul class="nav user-menu float-right">
					<!-- <li class="nav-item dropdown d-none d-sm-block">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<img src="{{ asset('backend/img/sidebar/icon-22.png')}}" alt="" />
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span>Notifications</span>
							</div>
							<div class="drop-scroll">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="John Doe" src="{{ asset('backend/img/user-06.jpg')}}" class="img-fluid rounded-circle" />
												</span>
												<div class="media-body">
													<p class="noti-details">
														<span class="noti-title">John Doe</span> is now
														following you
													</p>
													<p class="noti-time">
														<span class="notification-time">4 mins ago</span>
													</p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">T</span>
												<div class="media-body">
													<p class="noti-details">
														<span class="noti-title">Tarah Shropshire</span>
														sent you a message.
													</p>
													<p class="noti-time">
														<span class="notification-time">6 mins ago</span>
													</p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">L</span>
												<div class="media-body">
													<p class="noti-details">
														<span class="noti-title">Misty Tison</span> like
														your photo.
													</p>
													<p class="noti-time">
														<span class="notification-time">8 mins ago</span>
													</p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">G</span>
												<div class="media-body">
													<p class="noti-details">
														<span class="noti-title">Rolland Webber</span>
														booking appoinment for meeting.
													</p>
													<p class="noti-time">
														<span class="notification-time">12 mins ago</span>
													</p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">T</span>
												<div class="media-body">
													<p class="noti-details">
														<span class="noti-title">Bernardo Galaviz</span>
														like your photo.
													</p>
													<p class="noti-time">
														<span class="notification-time">2 days ago</span>
													</p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li> -->

					<li class="nav-item dropdown has-arrow">
						<a href="#" class="nav-link user-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src="{{ asset('backend/img/user.jpg') }}" width="30" alt="Admin" />
								<span class="status online"></span></span>
							<span>{{Auth::user()->name}}</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{route('Edit-Profile')}}">Change Password</a>
							<form action="{{route('logout')}}" method="POST">
								@csrf
								<button type="submit" class="dropdown-item">Logout</button>
							</form>
						</div>
					</li>
				</ul>
				<div class="dropdown mobile-user-menu float-right">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{route('Edit-Profile')}}">Change Password</a>
						<form action="{{route('logout')}}" method="POST">
							@csrf
							<button type="submit" class="dropdown-item">Logout</button>
						</form>
						<!-- <a class="dropdown-item" href="">Logout</a> -->
					</div>
				</div>
			</div>
		</div>
		<!-- nav end -->