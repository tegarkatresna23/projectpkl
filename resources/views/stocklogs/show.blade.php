<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show StockLog - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>Stock Log Detail</h3>
                        <hr/>
                        <p><strong>Product :</strong> {{ $stocklog->product->title ?? 'Tidak ada' }}</p>
                        <p><strong>Change Type :</strong> 
                            <span class="badge bg-{{ $stocklog->change_type == 'in' ? 'success' : 'danger' }}">
                                {{ strtoupper($stocklog->change_type) }}
                            </span>
                        </p>
                        <p><strong>Quantity :</strong> {{ $stocklog->quantity }}</p>
                        <p><strong>Description :</strong></p>
                        <code>
                            <p>{!! $stocklog->description !!}</p>
                        </code>
                        <hr/>
                        <p><strong>Dibuat pada :</strong> {{ $stocklog->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
