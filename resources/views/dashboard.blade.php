<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabLoan Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">

    <div class="container">
        <h1 class="mb-4 text-center fw-bold">🧪 LabLoan System</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Daftar Barang Lab</div>
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Barang</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ $item->category->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong>{{ $item->name }}</strong><br>
                                        <small class="text-muted">{{ $item->description }}</small>
                                    </td>

                                    {{-- ... sisa kode sama ... --}}
                                    <td>
                                        @if($item->stock > 0)
                                        <span class="badge bg-success">{{ $item->stock }} Tersedia</span>
                                        @else
                                        <span class="badge bg-danger">Habis</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('loan.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">

                                            @if($item->stock > 0)
                                            <button type="submit" class="btn btn-sm btn-primary">Pinjam</button>
                                            @else
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>Pinjam</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">Barang Dipinjam (User 1)</div>
                    <div class="card-body">
                        @if($myLoans->isEmpty())
                        <p class="text-center text-muted my-3">Tidak ada barang yang sedang dipinjam.</p>
                        @else
                        <ul class="list-group">
                            @foreach($myLoans as $loan)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $loan->item->name }}</strong>
                                    <br>
                                    <small class="text-muted">Tgl: {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</small>
                                </div>

                                <form action="{{ route('loan.return', $loan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Kembalikan</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>