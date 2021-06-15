<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Material Invoice</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .items-detail-table > tbody > tr > .no-line {
            border-top: none;
        }

        .items-detail-table > thead > tr > .no-line {
            border-bottom: none;
        }

        .items-detail-table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
        .h-40 {
            height: 40px;
        }
        .w-170 {
            width: 170px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>User Info</h2>
            </div>
            <hr>
            <div class="row">
                <table class="">
                    <tr>
                        <th class="h-40 w-170">Name</th>
                        <td class="h-40 w-170">{{ $name }}</td>
                    </tr>
                    <tr>
                        <th class="h-40 w-170">Email</th>
                        <td class="h-40 w-170">{{ $email }}</td>
                    </tr>
                    <tr>
                        <th class="h-40 w-170">Brand Name</th>
                        <td class="h-40 w-170">{{ $brandName }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
