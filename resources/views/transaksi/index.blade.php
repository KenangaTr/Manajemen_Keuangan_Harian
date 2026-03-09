<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Keuangan</title>
</head>
<body>
    <h1>Pengelolaan Keuangan Harian</h1>
    <h3>Kenanga (247006111007)</h3>
    <a href="/transaksi/create"><button>Tambah Transaksi</button></a>
    <br><br>
    
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $t)
            <tr>
                <td>{{ $t->tanggal }}</td>
                <td>{{ $t->jenis }}</td>
                <td>Rp {{ number_format($t->nominal, 0, ',', '.') }}</td>
                <td>{{ $t->keterangan }}</td>
                <td>
                    <form action="/transaksi/{{ $t->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>