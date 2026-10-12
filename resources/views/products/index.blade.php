<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Produk Top Up Game</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h2 class="mb-4">Kelola Produk Top Up Game</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- FORM CREATE (TAMBAH DATA) -->
    <div class="card mb-4">
        <div class="card-header">Tambah Produk Baru</div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Pilih Game</label>
                        <select name="game_id" class="form-select" required>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nama Item</label>
                        <input type="text" name="name" class="form-control" placeholder="Misal: 1000 VP" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" placeholder="100000" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stock" class="form-control" value="999" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan Produk</button>
            </form>
        </div>
    </div>

    <!-- TABEL READ, UPDATE, DELETE -->
    <div class="card">
        <div class="card-header">Daftar Produk</div>
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game</th>
                        <th>Nama Item</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->game->title }}</td>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <!-- FORM DELETE -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>