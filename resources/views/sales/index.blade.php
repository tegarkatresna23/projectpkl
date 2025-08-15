<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Sales - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">DATA SALES</h3>
              
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('sales.create') }}" class="btn btn-md btn-success mb-3">TAMBAHKAN</a>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">PENGGUNA</th>
                                    <th scope="col">TANGGAL PENJUALAN</th>
                                    <th scope="col">JUMLAH TOTAL</th>
                                    <th scope="col">METODE PEMBAYARAN</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->user->name ?? 'Unknown' }}</td>
                                        <td>{{ $sale->sale_date }}</td>
                                        <td>{{ "Rp " . number_format($sale->total_amount, 2, ',', '.') }}</td>
                                        <td>{{ ucfirst($sale->payment_method) }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                                <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Sales belum ada.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>
</html>
