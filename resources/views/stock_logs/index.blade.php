<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Stock Logs - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mb-4">
                    <h3>Tutorial Laravel 12 untuk Pemula</h3>
                    <h5><a href="https://santrikoding.com">www.santrikoding.com</a></h5>
                    <hr>
                </div>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">

                        <a href="{{ route('stock_logs.create') }}" class="btn btn-success mb-3">ADD STOCK LOG</a>

                        @if($stockLogs->count())
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">PRODUCT</th>
                                    <th scope="col">CHANGE TYPE</th>
                                    <th scope="col">QUANTITY</th>
                                    <th scope="col">DESCRIPTION</th>
                                    <th scope="col">CREATED AT</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stockLogs as $stockLog)
                                    <tr>
                                        <td>{{ $stockLog->product->title ?? '-' }}</td>
                                        <td>{{ ucfirst($stockLog->change_type) }}</td>
                                        <td>{{ $stockLog->quantity }}</td>
                                        <td>{{ $stockLog->description ?? '-' }}</td>
                                        <td>{{ $stockLog->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('stock_logs.destroy', $stockLog->id) }}" method="POST">
                                                <a href="{{ route('stock_logs.show', $stockLog->id) }}" class="btn btn-dark btn-sm">SHOW</a>
                                                <a href="{{ route('stock_logs.edit', $stockLog->id) }}" class="btn btn-primary btn-sm">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $stockLogs->links() }}
                        </div>

                        @else
                        <div class="alert alert-warning text-center">
                            Data Stock Logs belum ada.
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Message with SweetAlert
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
