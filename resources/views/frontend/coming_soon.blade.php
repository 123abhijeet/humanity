@extends('frontend.layouts.master')
@section('title','Book Demo | Sattree Gurukul')
@section('body')
<!-- Header Start -->
<!-- <div class="container-fluid bg-primary py-5 mb-5 page-header">
	<div class="container py-5">
		<div class="row justify-content-center">
			<div class="col-lg-10 text-center">
				<h1 class="display-3 text-white animated slideInDown">Coming Soon</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
						<li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
						<li class="breadcrumb-item text-white active" aria-current="page">Coming Soon</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div> -->
<!-- Header End -->
<!-- <div class="container-xxl py-5">
	<div class="container">
	<h2 style="text-align: center;">Coming Soon</h2>
	</div>
</div> -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Demo Booking Page</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/purecss@2.0.6/build/pure-min.css"
      integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5"
      crossorigin="anonymous"
    />
    <style>
      .container {
        background-color: #06bbcc !important;
        color: white;
        padding: 50px;
        border-radius: 10px;
        margin-top: 30px;
      }

      .image-container {
        text-align: center;
      }

      .image-container img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
      }

      .form-container {
        background-color: white;
        color: black;
        padding: 20px;
        border-radius: 10px;
      }

      .form-container h3 {
        margin-bottom: 20px;
      }

      /*styles for button*/
      .button_go {
        background-color: #f1c40f;
        color: #ffffff;
        border-radius: 40px;
        border: none;
        padding: 12px;
        margin-left: 35%;
      }
      .button_go:hover {
        background-color: #d4ac0d;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6 image-container">
          <img
            src="{{asset('frontend/img/child_with_tablet.png')}}"
            alt="Child with tablet"
            style="height: 80%"
          />
        </div>
        <div class="col-md-6 form-container" style="height: 80%">
          <h3 style="text-align: center">
            Fill out this form to book a <br /><strong>Free demo</strong>
          </h3>
          <form>
            <div class="form-group">
              <label for="studentName">Student's Name</label>
              <input
                type="text"
                class="form-control"
                id="studentName"
                placeholder="Enter student's name"
              />
            </div>
            <div class="form-group">
              <label for="studentClass">Student's Class</label>
              <select class="form-control" id="studentClass">
                <option>Select class</option>
                <option>Class 1</option>
                <option>Class 2</option>
                <option>Class 3</option>
                <option>Class 4</option>
                <option>Class 5</option>
                <option>Class 6</option>
                <option>Class 7</option>
                <option>Class 8</option>
              </select>
            </div>
            <div class="form-group">
              <label for="phoneNumber">Phone Number</label>
              <input
                type="text"
                class="form-control"
                id="phoneNumber"
                placeholder="Enter phone number"
              />
            </div>
            <div class="form-group">
              <label for="emailId">Email id</label>
              <input
                type="email"
                class="form-control"
                id="emailId"
                placeholder="Enter email id"
              />
            </div>
            <div class="form-group">
              <label for="state">State</label>
              <input
                type="text"
                class="form-control"
                id="state"
                placeholder="Enter state"
              />
            </div>
            <button type="submit" class="button_go pure_button">
              Book a Free Demo
            </button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>

@endsection