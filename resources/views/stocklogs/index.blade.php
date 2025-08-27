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
                <div>
                    <h3 class="text-center my-4">DATA STOCKLOG</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('stocklogs.create') }}" class="btn btn-md btn-success mb-3">TAMBAHKAN</a>
                        <table class="table table-bordered">
                            <thead class="table-light text-center">
                                <tr>
                                    <th scope="col">PRODUCT</th>
                                    <th scope="col">CHANGE TYPE</th>
                                    <th scope="col">QUANTITY</th>
                                    <th scope="col">DESCRIPTION</th>
                                    <th scope="col">CREATED AT</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stockLogs as $stockLog)
                                    <tr class="text-center">
                                        <td>{{ $stockLog->product->title ?? '-' }}</td>
                                        <td>
                                            @if ($stockLog->change_type === 'in')
                                                <span class="badge bg-success">IN</span>
                                            @else
                                                <span class="badge bg-danger">OUT</span>
                                            @endif
                                        </td>
                                        <td>{{ $stockLog->quantity }}</td>
                                        <td>{{ $stockLog->description }}</td>
                                        <td>{{ $stockLog->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                                  action="{{ route('stocklogs.destroy', $stockLog->id) }}" 
                                                  method="POST">
                                                <a href="{{ route('stocklogs.show', $stockLog->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('stocklogs.edit', $stockLog->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">
                                            Data Stock Logs belum ada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $stockLogs->links() }}
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
