<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Transaksi – Pengelolaan Keuangan Harian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Nunito', sans-serif; background-color: #FE9EC7; }
    body::before {
      content: ''; position: fixed; inset: 0;
      background-image:
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.18) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(249,246,196,0.22) 0%, transparent 50%);
      pointer-events: none; z-index: 0;
    }
    .sparkle { position: fixed; pointer-events: none; z-index: 0; font-size: 1.2rem; opacity: 0.35; animation: floatUp 6s ease-in-out infinite; }
    @keyframes floatUp {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.35; }
      50%       { transform: translateY(-18px) rotate(15deg); opacity: 0.55; }
    }
    .sparkle:nth-child(1) { top: 8%;  left: 5%;  animation-delay: 0s; }
    .sparkle:nth-child(2) { top: 15%; right: 6%; animation-delay: 1.2s; }
    .sparkle:nth-child(3) { top: 60%; left: 3%; animation-delay: 0.6s; }
    .sparkle:nth-child(4) { top: 75%; right: 4%; animation-delay: 1.8s; }
    .main-card { background: rgba(255,255,255,0.65); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px); border: 1.5px solid rgba(255,255,255,0.8); }
    .gradient-title { background: linear-gradient(135deg,#d6336c 0%,#e8597a 40%,#c2185b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .form-input { background: rgba(255,255,255,0.75); border: 1.5px solid rgba(254,158,199,0.5); transition: all 0.25s ease; }
    .form-input:focus { outline: none; border-color: #f06292; box-shadow: 0 0 0 3px rgba(240,98,146,0.18); background: #fff; }
    .btn-update { background: linear-gradient(135deg,#f9d76c 0%,#f5c518 50%,#e6b800 100%); box-shadow: 0 4px 15px rgba(245,197,24,0.35); transition: all 0.3s ease; }
    .btn-update:hover { box-shadow: 0 6px 24px rgba(245,197,24,0.55); transform: translateY(-2px) scale(1.02); }
    .btn-update:active { transform: translateY(0px) scale(0.98); }
    .btn-batal { background: rgba(255,255,255,0.7); border: 1.5px solid rgba(254,158,199,0.5); transition: all 0.25s ease; }
    .btn-batal:hover { background: #FE9EC7; border-color: #FE9EC7; }
  </style>
</head>
<body class="min-h-screen flex items-start justify-center py-10 px-4 relative overflow-x-hidden">

  <span class="sparkle">🌸</span>
  <span class="sparkle">✨</span>
  <span class="sparkle">💛</span>
  <span class="sparkle">🌼</span>

  <div class="relative z-10 w-full max-w-lg">

    {{-- Back link --}}
    <a href="/transaksi" class="inline-flex items-center gap-1.5 text-white font-semibold text-sm mb-5 hover:underline">
      ← Kembali ke Daftar Transaksi
    </a>

    <div class="main-card rounded-3xl shadow-2xl px-7 py-8">

      {{-- Header --}}
      <div class="text-center mb-7">
        <div class="text-4xl mb-2">✏️</div>
        <h1 class="gradient-title text-2xl font-black">Edit Transaksi</h1>
        <p class="text-gray-400 text-xs mt-1">Ubah detail transaksi di bawah ini</p>
      </div>

      {{-- Validation Errors --}}
      @if($errors->any())
      <div class="mb-5 bg-red-50 border border-red-200 text-red-600 text-sm rounded-2xl px-4 py-3">
        <p class="font-bold mb-1">⚠️ Ada kesalahan input:</p>
        <ul class="list-disc list-inside space-y-0.5 text-xs">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      {{-- Form --}}
      <form action="/transaksi/{{ $transaksi->id }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Tanggal --}}
        <div>
          <label class="block text-sm font-bold text-gray-600 mb-1.5">📅 Tanggal</label>
          <input type="date" name="tanggal"
                 value="{{ old('tanggal', $transaksi->tanggal) }}"
                 class="form-input w-full rounded-xl px-4 py-2.5 text-sm text-gray-700 font-medium" required />
        </div>

        {{-- Jenis --}}
        <div>
          <label class="block text-sm font-bold text-gray-600 mb-1.5">🏷️ Jenis Transaksi</label>
          <select name="jenis" class="form-input w-full rounded-xl px-4 py-2.5 text-sm text-gray-700 font-medium" required>
            <option value="Pemasukan"   {{ old('jenis', $transaksi->jenis) === 'Pemasukan'   ? 'selected' : '' }}>⬆️ Pemasukan</option>
            <option value="Pengeluaran" {{ old('jenis', $transaksi->jenis) === 'Pengeluaran' ? 'selected' : '' }}>⬇️ Pengeluaran</option>
          </select>
        </div>

        {{-- Nominal --}}
        <div>
          <label class="block text-sm font-bold text-gray-600 mb-1.5">💵 Nominal (Rp)</label>
          <input type="number" name="nominal" min="1"
                 value="{{ old('nominal', $transaksi->nominal) }}"
                 class="form-input w-full rounded-xl px-4 py-2.5 text-sm text-gray-700 font-medium" required />
        </div>

        {{-- Keterangan --}}
        <div>
          <label class="block text-sm font-bold text-gray-600 mb-1.5">📝 Keterangan</label>
          <input type="text" name="keterangan"
                 value="{{ old('keterangan', $transaksi->keterangan) }}"
                 class="form-input w-full rounded-xl px-4 py-2.5 text-sm text-gray-700 font-medium" required />
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 pt-2">
          <a href="/transaksi"
             class="btn-batal flex-1 text-center text-gray-600 font-bold text-sm rounded-2xl px-5 py-3 cursor-pointer no-underline">
            Batal
          </a>
          <button type="submit"
                  class="btn-update flex-1 text-gray-800 font-bold text-sm rounded-2xl px-5 py-3 cursor-pointer">
            💾 Update Transaksi
          </button>
        </div>
      </form>

    </div>
  </div>
</body>
</html>
