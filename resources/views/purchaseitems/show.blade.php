<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Purchase Item - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="mb-3">Detail Purchase Item</h3>
                        <hr/>

                        <div class="mb-3">
                            <strong>Product :</strong>
                            <p>{{ $purchaseItem->product->name ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Purchase :</strong>
                            <p>{{ $purchaseItem->purchase->code ?? $purchaseItem->purchase->id ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Quantity :</strong>
                            <p>{{ $purchaseItem->quantity }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Price :</strong>
                            <p>{{ 'Rp ' . number_format($purchaseItem->price, 2, ',', '.') }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Subtotal :</strong>
                            <p>{{ 'Rp ' . number_format($purchaseItem->subtotal, 2, ',', '.') }}</p>
                        </div>

                        <a href="{{ route('purchaseitems.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
