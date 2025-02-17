<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .receipt {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .receipt-header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .logo-container {
            text-align: center;
        }

        .tiny-logo {
            height: 60px;
            width: 60px;
            margin-bottom: 30px;
        }

        .company-details,
        .student-details {
            display: table-cell;
            /* width: 65%; */
            vertical-align: top;
        }

        .receipt-info {
            margin: 20px 0;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .receipt-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt-items th,
        .receipt-items td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .receipt-items th {
            background-color: #f4f4f4;
        }

        .receipt-footer {
            text-align: right;
            margin-top: 20px;
        }

        .receipt-footer .total {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="receipt">
        <div class="logo-container">
            <!-- Centered Logo -->
            <img src="frontend/img/sat_logo_wtbg.png" alt="Logo" class="tiny-logo" />
        </div>
        <div class="receipt-header">
            <!-- Left side: Company details -->
            <div class="company-details">
                <h3>Sattree Gurukul</h3>
                <p>Fatehpur, P.O.+ P.S. - Ander, Dist- Siwan, <br> Pin: 841231 <br>
                    Phone: +91 9708467940 <br>
                    Email: sattreevision@gmail.com
                </p>
            </div>
            <!-- Right side: Student details -->
            <div class="student-details">
                <h3>Name: {{$student_name}}</h3>
                <p> Mobile: {{$mobile}} <br>
                    Email: {{$email}} <br>
                    {{$category}} : {{$subcategory}} <br>
                    Date: {{$purchase_date}}<br>
                </p>
            </div>
        </div>

        <div class="receipt-info">
            <div><strong>Order #:</strong>{{$receipt_number}} <strong>Payment Type : </strong>{{$payment_type == 'monthly' ? 'EMI' : 'One Time' }} <strong>Payment Status : </strong>{{$payment_status == 'success' ? 'Success' : 'Failed'}}  </div>
        </div>

        <div class="receipt-items">
            <table>
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Course Fee</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$course_uid}}</td>
                        <td>{{$course_name}}</td>
                        <td>{{$course_fee}}</td>
                        <td>{{$duration}} Hours</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="receipt-footer">
            <p class="total">Total: Rs {{$amount}}</p>
        </div>
    </div>
</body>

</html>