<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Branch Report - {{$report->invoice_no}}</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <h2>Branch Report > Invoice no. : {{$report->invoice_no}}</h2>
    <ul>
        <li>Grand Total: {{$report->grand_total}}</li>
        @if ($report->justification != '')
        <li>Justification: {{$report->justification}}</li>
        @endif
        <li>Billing Date: {{$report->billing_date}}</li>
    </ul>
    <h3>Contributions :</h3>
    @foreach ($report->branchReportContributions as $cont)
    <ul>
        <li>Grand Total: {{$report->grand_total}}</li>
        @if ($cont->justification != '')
        <li>Justification: {{$cont->justification}}</li>
        @endif
        <li>Amount: {{$cont->amount}}</li>
    </ul>
    @endforeach
</body>
</html>