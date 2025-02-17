<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <style>
        @page {
            size: landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            background-color: #ffffff;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .certificate-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-sizing: border-box;
        }

        .design-image-right, .design-image-left-bottom {
            position: absolute;
        }

        .design-image-right {
            top: 0;
            right: 0;
            width: 100px;
            height: auto;
        }

        .design-image-left-bottom {
            bottom: 0;
            left: 0;
            width: 100px;
            height: auto;
        }

        .tiny-logo {
            height: 100px;
            width: 100px;
            margin-bottom: 30px;
        }

        .certificate-text {
            font-size: 40px;
            color: #333333;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .secondary-text {
            font-size: 18px;
            color: #666666;
            margin-bottom: 10px;
        }

        .name {
            font-size: 30px;
            color: #007bff;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .course {
            font-size: 28px;
            color: #007bff;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .issued-date, .id, .date {
            font-size: 14px;
            color: #999999;
            margin-bottom: 5px;
        }

        .signature {
            margin-top: 30px;
            width: 30%;
            height: 10%;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <img src="frontend/img/patern1.svg" alt="Design" class="design-image-right" />
        <img src="frontend/img/patern2.svg" alt="Design" class="design-image-left-bottom" />
        <img src="frontend/img/sat_logo_wtbg.png" alt="Logo" class="tiny-logo" />
        <h1 class="certificate-text">Certificate of Completion</h1> <br>
        <p class="secondary-text">This certifies that</p>
        <h2 class="name">{{ $student_name }}</h2> 
        <p class="secondary-text">has successfully completed</p>
        <h3 class="course">{{ $course_name }}</h3> <br>
        <p class="secondary-text issued-date">Issued on {{ $certificate_issued_date }}</p> <br>
        <p class="id">ID: {{ $certificate_no }}</p> <br>
        <img src="frontend/img/signature.png" alt="Signature" class="signature"/>
    </div>
</body>
</html>
