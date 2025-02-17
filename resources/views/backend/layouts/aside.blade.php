<!-- aside start -->
<style>
	.sidebar-menu li a {
		text-transform: uppercase;
		color: #373d3f;
		display: block;
		font-size: 13px;
		height: auto;
		line-height: 40px;
		min-height: 40px;
		padding: 10px 10px;
		border-radius: 0;
		border-top: 1px solid #e7e7e7;
	}

	.submenu {
		margin-bottom: 3px;
	}

	.list-unstyled {
		/* border-radius: 50%; */
		border-top-left-radius: 30px;
		border-bottom-right-radius: 30px;

	}

	.list-unstyled span {
		color: #bf222b;
	}
</style>
<div class="sidebar" id="sidebar" style="overflow-y: scroll; background: #bf222b;">
	<div class="sidebar-inner">
		<div id="sidebar-menu" class="sidebar-menu">
			<div class="header-left">
				<a href="{{ route('Admin-Dashboard') }}" style="margin-left: -8%;">
					<img src="{{ asset('frontend/img/sat_logo.png') }}" width="80" height="70" alt="" style="margin-right: 90%;" /></a>
				<span style="margin-left: -88%;font-size: 17px;" class="text-uppercase"><span style="color: #085591;font-family: 'Font Awesome 5 Free';">Sattree</span>&nbsp;<span style="color: #F24f1c;font-family: 'Font Awesome 5 Free';">Gurukul</span></span>
			</div>
			<ul class="sidebar-ul">
				<li class="{{ Route::is('Admin-Dashboard') ? 'active' : '' }}">
					<a href="{{ route('Admin-Dashboard') }}"><img src="{{ asset('backend/img/sidebar/icon-1.png') }}" alt="icon" /><span>Dashboard</span></a>
				</li>

				@role('Admin')
				<!-- Category -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span style="color: white;"> Category</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('category.index') }}" class="{{ Route::is('category.index', 'category.edit', 'category.show') ? 'active' : '' }}"><span>Category</span></a>
						</li>
						<li>
							<a href="{{ route('subcategory.index') }}" class="{{ Route::is('subcategory.index', 'subcategory.edit', 'subcategory.show') ? 'active' : '' }}"><span>Sub Category</span></a>
						</li>
					</ul>
				</li>
				<!-- Teacher -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-10.png') }}" alt="icon" />
						<span style="color: white;">Todays Enrollment</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none;">
						<li>
							<a href="{{ route('Teachers-Enrolled') }}" class="{{ Route::is('Teachers-Enrolled') ? 'active' : '' }}"><span>
									Teachers Enrolled</span></a>
						</li>
						<li>
							<a href="{{ route('Students-Enrolled') }}" class="{{ Route::is('Students-Enrolled') ? 'active' : '' }}"><span>
									Students Enrolled</span></a>
						</li>
					</ul>
				</li>
				<!-- Teacher -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-10.png') }}" alt="icon" />
						<span style="color: white;">Teacher</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none;">
						<li>
							<a href="{{ route('teachers.index') }}" class="{{ Route::is('teachers.index', 'teachers.edit', 'teachers.show') ? 'active' : '' }}"><span>All
									Teachers</span></a>
						</li>
						<li>
							<a href="{{ route('teachers.create') }}" class="{{ Route::is('teachers.create', 'teachers.edit', 'teachers.show') ? 'active' : '' }}"><span>Add
									Teacher</span></a>
						</li>
					</ul>
				</li>
				<!-- Student -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-3.png') }}" alt="icon" />
						<span style="color: white;"> Students</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('students.index') }}" class="{{ Route::is('students.index') ? 'active' : '' }}"><span>All Students</span></a>
						</li>
					</ul>
				</li>
				<!-- Book -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span style="color: white;"> Book</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('books.index') }}" class="{{ Route::is('books.index', 'books.edit', 'books.show') ? 'active' : '' }}"><span>All
									Book</span></a>
						</li>
						<li>
							<a href="{{ route('books.create') }}" class="{{ Route::is('books.create', 'books.edit', 'books.show') ? 'active' : '' }}"><span>Add
									Book</span></a>
						</li>
					</ul>
				</li>
				<!-- Quiz -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span style="color: white;"> Quiz</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('quizzes.index') }}" class="{{ Route::is('quizzes.index', 'quizzes.edit', 'quizzes.show') ? 'active' : '' }}">
								<span>All Quiz</span></a>
						</li>
						<li>
							<a href="{{ route('quizzes.create') }}" class="{{ Route::is('quizzes.create') ? 'active' : '' }}">
								<span>Add Quiz</span></a>
						</li>
						<!-- Quiz Reports -->
						<li>
							<a href="{{ route('Quiz-Reports') }}" class="{{ Route::is('Quiz-Reports') ? 'active' : '' }}">
								<span>Quiz Reports</span></a>
						</li>
					</ul>
				</li>

				<!-- Payment Module -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Payments</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{route('Book-Payments')}}" class="{{ Route::is('Book-Payments') ? 'active' : '' }}"><span>Book Payments</span></a>
						</li>
						<li>
							<a href="{{route('Course-Payments')}}" class="{{ Route::is('Course-Payments') ? 'active' : '' }}"><span>Course Payments</span></a>
						</li>
						<li>
							<a href="{{route('Quiz-Payments')}}" class="{{ Route::is('Quiz-Payments') ? 'active' : '' }}"><span>Quiz Payments</span></a>
						</li>
						<li>
							<a href="{{route('Teachers-Course-Payments')}}" class="{{ Route::is('Teachers-Course-Payments') ? 'active' : '' }}"><span>Teacher's Course Payments</span></a>
						</li>
					</ul>
				</li>
				<!-- Contacts -->
				<li class="{{ Route::is('Contacts') ? 'active' : '' }}">
					<a href="{{route('Contacts')}}"><img src="{{ asset('backend/img/sidebar/icon-4.png') }}" alt="icon" />
						<span>Contacts</span></a>
				</li>
				@endrole
				@role('Teacher')
				<!-- Courses -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Courses</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('category.index') }}" class="{{ Route::is('category.index', 'category.edit', 'category.show') ? 'active' : '' }}"><span>Category</span></a>
						</li>
						<li>
							<a href="{{ route('subcategory.index') }}" class="{{ Route::is('subcategory.index', 'subcategory.edit', 'subcategory.show') ? 'active' : '' }}"><span>Sub Category</span></a>
						</li>
						<li>
							<a href="{{ route('courses.index') }}" class="{{ Route::is('courses.index', 'courses.edit', 'courses.show') ? 'active' : '' }}"><span>All
									Courses</span></a>
						</li>
						<li>
							<a href="{{ route('courses.create') }}" class="{{ Route::is('courses.create', 'courses.edit', 'courses.show') ? 'active' : '' }}"><span>Add
									Course</span></a>
						</li>
					</ul>
				</li>
				<!-- Course Video -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Course Video</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('coursevideos.index') }}" class="{{ Route::is('coursevideos.index', 'coursevideos.edit', 'coursevideos.show') ? 'active' : '' }}"><span>All
									Video</span></a>
						</li>
						<li>
							<a href="{{ route('coursevideos.create') }}" class="{{ Route::is('coursevideos.create', 'coursevideos.edit', 'coursevideos.show') ? 'active' : '' }}"><span>Add
									Video</span></a>
						</li>
					</ul>
				</li>
				<!-- Study Material -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Study Material</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('studymaterialtypes.index') }}" class="{{ Route::is('studymaterialtypes.index') ? 'active' : '' }}"><span>
									Study Material Type</span></a>
						</li>
						<li>
							<a href="{{ route('studymaterials.index') }}" class="{{ Route::is('studymaterials.index', 'studymaterials.edit', 'studymaterials.show') ? 'active' : '' }}"><span>All
									Study Material</span></a>
						</li>
						<li>
							<a href="{{ route('studymaterials.create') }}" class="{{ Route::is('studymaterials.create', 'studymaterials.edit', 'studymaterials.show') ? 'active' : '' }}"><span>Add
									Study Material</span></a>
						</li>
					</ul>
				</li>
				<!-- Quiz -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Quiz</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('quizzes.index') }}" class="{{ Route::is('quizzes.index', 'quizzes.edit', 'quizzes.show') ? 'active' : '' }}">
								<span>All Quiz</span></a>
						</li>
						<li>
							<a href="{{ route('quizzes.create') }}" class="{{ Route::is('quizzes.create') ? 'active' : '' }}">
								<span>Add Quiz</span></a>
						</li>
						<!-- Quiz Reports -->
						<li>
							<a href="{{ route('Quiz-Reports') }}" class="{{ Route::is('Quiz-Reports') ? 'active' : '' }}">
								<span>Quiz Reports</span></a>
						</li>
					</ul>
				</li>
				<!-- Test -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Test</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('tests.index') }}" class="{{ Route::is('tests.index', 'tests.edit', 'tests.show') ? 'active' : '' }}"><span>All
									Test</span></a>
						</li>
						<li>
							<a href="{{ route('tests.create') }}" class="{{ Route::is('tests.create', 'tests.edit', 'tests.show') ? 'active' : '' }}"><span>Add
									Test</span></a>
						</li>
						<!-- Test Reports -->
						<li>
							<a href="{{ route('Test-Reports') }}" class="{{ Route::is('Test-Reports') ? 'active' : '' }}">
								<span>Test Reports</span></a>
						</li>
						<!-- Subjective Test Reports -->
						<li>
							<a href="{{ route('Subjective-Test-Reports') }}" class="{{ Route::is('Subjective-Test-Reports') ? 'active' : '' }}">
								<span>Subjective Test</span></a>
						</li>
					</ul>
				</li>
				<!-- Payment Module -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Payments</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{route('Teacher-Course-Payments')}}" class="{{ Route::is('Teacher-Course-Payments') ? 'active' : '' }}"><span>Course Payments</span></a>
						</li>
					</ul>
				</li>
				<!-- Live Class -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Live Class</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('Agora-Meetings') }}" class="{{ Route::is('Agora-Meetings', 'Agora-Edit-Meeting', 'Agora-View-Meeting','Join-Meeting') ? 'active' : '' }}"><span>All
									Live Class</span></a>
						</li>
						<li>
							<a href="{{ route('Create-Agora-Meeting') }}" class="{{ Route::is('Create-Agora-Meeting', 'Agora-Edit-Meeting', 'Agora-View-Meeting') ? 'active' : '' }}"><span>Add
									Live Class</span></a>
						</li>
					</ul>
				</li>
				@endrole
				<!-- Students Query -->
				<li class="{{ Route::is('queries.index','queries.edit') ? 'active' : '' }}">
					<a href="{{ route('queries.index') }}"><img src="{{ asset('backend/img/sidebar/icon-12.png') }}" alt="icon" />
						<span> Students Query</span></a>
				</li>
				<!-- Sold Courses -->
				<li class="{{ Route::is('soldcourses.index') ? 'active' : '' }}">
					<a href="{{ route('soldcourses.index') }}"><img src="{{ asset('backend/img/sidebar/icon-4.png') }}" alt="icon" />
						<span>Sold Courses</span></a>
				</li>
				<!-- Review & Rating -->
				<li class="submenu">
					<a href="#"><img src="{{ asset('backend/img/sidebar/icon-4.png') }}" alt="icon" />
						<span> Review & Rating</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none">
						<li>
							<a href="{{ route('courserrs.index') }}" class="{{ Route::is('courserrs.index') ? 'active' : '' }}"><span style="font-size: 13px;">Course Review Rating</span></a>
						</li>
						<li>
							<a href="{{ route('teacherrrs.index') }}" class="{{ Route::is('teacherrrs.index') ? 'active' : '' }}"><span style="font-size: 13px;">Teacher Review Rating</span></a>
						</li>
					</ul>
				</li>
				<!-- Course Completed -->
				<li class="{{ Route::is('completedcourses.index') ? 'active' : '' }}">
					<a href="{{route('completedcourses.index')}}"><img src="{{ asset('backend/img/sidebar/icon-4.png') }}" alt="icon" />
						<span>Course Completed</span></a>
				</li>
				<!-- Certificate -->
				<li class="{{ Route::is('coursecertificates.index') ? 'active' : '' }}">
					<a href="{{route('coursecertificates.index')}}"><img src="{{ asset('backend/img/sidebar/icon-4.png') }}" alt="icon" />
						<span>Certificate</span></a>
				</li>
				@role('Admin')
				<!-- Certificate -->
				<li class="{{ Route::is('adminnotifications.index') ? 'active' : '' }}">
					<a href="{{route('adminnotifications.index')}}"><img src="{{ asset('backend/img/sidebar/icon-22.png') }}" alt="icon" />
						<span>Notification</span></a>
				</li>
				@endrole
				@role('Teacher')
				<!-- Certificate -->
				<li class="{{ Route::is('teachernotifications.index') ? 'active' : '' }}">
					<a href="{{route('teachernotifications.index')}}"><img src="{{ asset('backend/img/sidebar/icon-22.png') }}" alt="icon" />
						<span>Notification</span></a>
				</li>
				@endrole
			</ul>
		</div>
	</div>
</div>
<!-- aside end -->