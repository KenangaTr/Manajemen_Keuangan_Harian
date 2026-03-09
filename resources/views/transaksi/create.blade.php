<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Transaksi</title>
</head>
<body>
    <h1>Tambah Transaksi Baru</h1>
    
    <form action="/transaksi" method="POST">
        @csrf
        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" required><br><br>
        
        <label>Jenis:</label><br>
        <select name="jenis" required>
            <option value="Pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
        </select><br><br>
        
        <label>Nominal (Tanpa titik/koma):</label><br>
        <input type="number" name="nominal" required><br><br>
        
        <label>Keterangan:</label><br>
        <input type="text" name="keterangan" required><br><br>
        
        <button type="submit">Simpan Transaksi</button>
        <a href="/transaksi">Batal</a>
    </form>
</body>
</html>