<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Sales - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>Detail Penjualan</h3>
                        <hr/>
                        <p><strong>User:</strong> {{ $sale->user->name ?? 'Unknown' }}</p>
                        <p><strong>Tanggal Penjualan:</strong> {{ $sale->sale_date }}</p>
                        <p><strong>Total Amount:</strong> {{ "Rp " . number_format($sale->total_amount, 2, ',', '.') }}</p>
                        <p><strong>Payment Method:</strong> {{ ucfirst($sale->payment_method) }}</p>
                        <p><strong>Dibuat pada:</strong> {{ $sale->created_at }}</p>
                        <p><strong>Diperbarui pada:</strong> {{ $sale->updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
