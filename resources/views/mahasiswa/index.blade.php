<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        input[name="search"] {
            max-width: 300px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">

        <!-- Header + Tombol -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-primary">📋 Daftar Mahasiswa</h1>
            <div>
                <a href="{{ route('mahasiswa.export') }}" class="btn btn-success me-2">
                    📊 Export Excel
                </a>
                <a href="{{ route('mahasiswa.cetak-pdf') }}" class="btn btn-danger me-2" target="_blank">
                    🖨️ Cetak PDF
                </a>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                    ➕ Tambah Mahasiswa
                </a>
            </div>
        </div>

        <!-- 🔍 Form Pencarian -->
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-4 d-flex">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="form-control me-2" placeholder="Cari nama, NIM, atau email...">
            <button type="submit" class="btn btn-outline-primary me-2">Cari</button>

            <!-- Tombol reset pencarian (opsional) -->
            @if(request('search'))
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>

        <!-- Tabel -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $m)
                            <tr>
                                <td>{{ $m->nama }}</td>
                                <td>{{ $m->nim }}</td>
                                <td>{{ $m->email }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('mahasiswa.edit',$m->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <form action="{{ route('mahasiswa.destroy',$m->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data mahasiswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
