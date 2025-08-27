<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Purchase Item - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('purchaseitems.store') }}" method="POST">
                            @csrf

                            <!-- Purchase -->
                            <div class="mb-3">
                                <label for="purchase_id" class="form-label fw-bold">Purchase</label>
                                <select name="purchase_id" id="purchase_id"
                                    class="form-select @error('purchase_id') is-invalid @enderror">
                                    <option value="">-- Pilih Purchase --</option>
                                    @foreach ($purchases as $purchase)
                                        <option value="{{ $purchase->id }}"
                                            {{ old('purchase_id') == $purchase->id ? 'selected' : '' }}>
                                            {{ $purchase->id }} - {{ $purchase->supplier?->name ?? 'No Supplier' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('purchase_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product -->
                            <div class="mb-3">
                                <label for="product_id" class="form-label fw-bold">Product</label>
                                <select name="product_id" id="product_id"
                                    class="form-select @error('product_id') is-invalid @enderror">
                                    <option value="">-- Pilih Product --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div class="mb-3">
                                <label for="quantity" class="form-label fw-bold">Quantity</label>
                                <input type="number" id="quantity" name="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    value="{{ old('quantity') }}" placeholder="Masukkan Jumlah" min="1">
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label fw-bold">Price</label>
                                <input type="number" step="0.01" id="price" name="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" placeholder="Masukkan Harga" min="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Subtotal -->
                            <div class="mb-3">
                                <label for="subtotal" class="form-label fw-bold">Subtotal</label>
                                <input type="number" step="0.01" id="subtotal" name="subtotal"
                                    class="form-control @error('subtotal') is-invalid @enderror"
                                    value="{{ old('subtotal') }}" placeholder="Masukkan Subtotal" min="0" readonly>
                                @error('subtotal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">SAVE</button>
                            <button type="reset" class="btn btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JS to auto-calculate subtotal -->
    <script>
        const quantityInput = document.getElementById('quantity');
        const priceInput = document.getElementById('price');
        const subtotalInput = document.getElementById('subtotal');

        function updateSubtotal() {
            const quantity = parseFloat(quantityInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;
            subtotalInput.value = (quantity * price).toFixed(2);
        }

        quantityInput.addEventListener('input', updateSubtotal);
        priceInput.addEventListener('input', updateSubtotal);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
