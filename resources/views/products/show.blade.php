<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Product - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $product->name }}</h3>
                        <hr/>
                        <p><strong>Kode Produk:</strong> {{ $product->code }}</p>
                        <p><strong>Kategori:</strong> {{ $product->category?->name ?? '-' }}</p>
                        <p><strong>Harga Beli:</strong> {{ 'Rp ' . number_format($product->purchase_price, 2, ',', '.') }}</p>
                        <p><strong>Harga Jual:</strong> {{ 'Rp ' . number_format($product->selling_price, 2, ',', '.') }}</p>
                        <p><strong>Stok:</strong> {{ $product->stock }}</p>
                        <hr/>
                        <p><strong>Deskripsi:</strong></p>
                        <code>
                            <p>{!! $product->description !!}</p>
                        </code>
                        <hr/>
                        <p><small>Dibuat: {{ $product->created_at->format('d M Y H:i') }}</small></p>
                        <p><small>Diubah: {{ $product->updated_at->format('d M Y H:i') }}</small></p>
                         <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
