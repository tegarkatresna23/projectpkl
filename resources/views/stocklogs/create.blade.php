<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock Log - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    
                    <form action="{{ route('stocklogs.store') }}" method="POST">
                        @csrf

                        <!-- Product -->
                        <div class="form-group mb-3">
                            <label class="fw-bold">PRODUCT</label>
                            <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Change Type -->
                        <div class="form-group mb-3">
                            <label class="fw-bold">CHANGE TYPE</label>
                            <select name="change_type" class="form-control @error('change_type') is-invalid @enderror">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="in" {{ old('change_type') == 'in' ? 'selected' : '' }}>IN (Masuk)</option>
                                <option value="out" {{ old('change_type') == 'out' ? 'selected' : '' }}>OUT (Keluar)</option>
                            </select>
                            @error('change_type')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="form-group mb-3">
                            <label class="fw-bold">QUANTITY</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}" 
                                   class="form-control @error('quantity') is-invalid @enderror" 
                                   placeholder="Masukkan Jumlah">
                            @error('quantity')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label class="fw-bold">DESCRIPTION</label>
                            <textarea name="description" rows="4" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Masukkan Keterangan">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary me-2">SAVE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
