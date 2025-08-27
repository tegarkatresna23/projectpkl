<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Purchase Items - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center my-4">DATA PURCHASE ITEM</h3>
                <hr>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('purchaseitems.create') }}" class="btn btn-success mb-3">TAMBAHKAN </a>

                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center">
                                <tr>
                                    <th scope="col">PRODUCT</th>
                                    <th scope="col">PURCHASE</th>
                                    <th scope="col">QUANTITY</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col" style="width: 25%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchaseItems as $purchaseItem)
                                    <tr>
                                        <td class="text-center">{{ $purchaseItem->product->name ?? '-' }}</td>
                                        <td class="text-center">{{ $purchaseItem->purchase->id ?? '-' }}</td>


                                        <td class="text-center">{{ $purchaseItem->quantity }}</td>
                                        <td class="text-center">
                                            {{ 'Rp ' . number_format($purchaseItem->price, 2, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('purchaseitems.destroy', $purchaseItem->id) }}"
                                                method="POST">
                                                <a href="{{ route('purchaseitems.show', $purchaseItem->id) }}"
                                                    class="btn btn-sm btn-dark">LIHAT</a>
                                                <a href="{{ route('purchaseitems.edit', $purchaseItem->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">
                                            Data Purchase Items belum ada.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-end">
                            {{ $purchaseItems->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Message with SweetAlert2
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'GAGAL!',
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>

</html>
