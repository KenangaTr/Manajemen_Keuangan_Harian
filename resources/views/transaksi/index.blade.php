<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pengelolaan Keuangan Harian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Nunito', sans-serif; background-color: #FE9EC7; }
    body::before {
      content: ''; position: fixed; inset: 0;
      background-image:
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.18) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(249,246,196,0.22) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(255,182,213,0.15) 0%, transparent 60%);
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
    .sparkle:nth-child(5) { top: 40%; right: 2%; animation-delay: 0.9s; }
    .main-card { background: rgba(255,255,255,0.65); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px); border: 1.5px solid rgba(255,255,255,0.8); }
    .gradient-title { background: linear-gradient(135deg,#d6336c 0%,#e8597a 40%,#c2185b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .table-header-cell { background: linear-gradient(135deg,#FE9EC7 0%,#f77db8 100%); }
    .table-row:hover td { background-color: rgba(249,246,196,0.6) !important; transition: background-color 0.2s ease; }
    .btn-tambah { background: linear-gradient(135deg,#f06292 0%,#e91e8c 50%,#d81b87 100%); box-shadow: 0 4px 15px rgba(232,89,122,0.4); transition: all 0.3s ease; }
    .btn-tambah:hover { background: linear-gradient(135deg,#e91e8c 0%,#d81b87 50%,#c2185b 100%); box-shadow: 0 6px 24px rgba(232,89,122,0.6); transform: translateY(-2px) scale(1.03); }
    .btn-tambah:active { transform: translateY(0px) scale(0.98); }
    .empty-icon { animation: pulse-soft 3s ease-in-out infinite; }
    @keyframes pulse-soft { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.08); } }
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: rgba(254,158,199,0.3); border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: rgba(214,51,108,0.4); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(214,51,108,0.6); }
  </style>
</head>
<body class="min-h-screen flex items-start justify-center py-10 px-4 relative overflow-x-hidden">

  <span class="sparkle">🌸</span>
  <span class="sparkle">✨</span>
  <span class="sparkle">💛</span>
  <span class="sparkle">🌼</span>
  <span class="sparkle">💖</span>

  <div class="relative z-10 w-full max-w-5xl">

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
    <div class="mb-4 flex items-center gap-3 bg-white/80 border border-green-200 text-green-700 font-semibold text-sm rounded-2xl px-5 py-3 shadow-sm">
      <span>✅</span> {{ session('success') }}
    </div>
    @endif

    {{-- HEADER CARD --}}
    <div class="main-card rounded-3xl shadow-2xl px-8 py-8 mb-6 text-center">
      <div class="flex justify-center gap-3 mb-3 text-2xl">
        <span>🌸</span><span>💰</span><span>🌸</span>
      </div>
      <h1 class="gradient-title text-4xl sm:text-5xl font-black tracking-tight leading-tight">
        Pengelolaan Keuangan Harian
      </h1>
      <div class="flex items-center justify-center gap-3 my-4">
        <span class="block h-0.5 w-16 rounded-full bg-gradient-to-r from-transparent to-pink-300"></span>
        <span class="text-pink-400 text-xl">✦</span>
        <span class="block h-0.5 w-16 rounded-full bg-gradient-to-l from-transparent to-pink-300"></span>
      </div>
      <div class="inline-flex items-center gap-2 bg-[#F9F6C4] text-gray-600 rounded-full px-5 py-2 shadow-sm border border-yellow-200">
        <span class="text-base">👩‍🎓</span>
        <p class="text-sm font-semibold tracking-wide">Kenanga &nbsp;·&nbsp; 247006111007</p>
      </div>
    </div>

    {{-- CONTENT CARD --}}
    <div class="main-card rounded-3xl shadow-2xl px-6 sm:px-8 py-8">

      {{-- Toolbar --}}
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
          <h2 class="text-xl font-black text-gray-700 flex items-center gap-2">
            <span>📋</span> Daftar Transaksi
          </h2>
          <p class="text-xs text-gray-400 mt-0.5 ml-7">Catat setiap pemasukan & pengeluaranmu</p>
        </div>
        <a href="/transaksi/create"
           class="btn-tambah inline-flex items-center gap-2 text-white font-bold text-sm rounded-2xl px-5 py-3 cursor-pointer select-none no-underline">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
          </svg>
          Tambah Transaksi
        </a>
      </div>

      {{-- TABLE --}}
      <div class="overflow-x-auto rounded-2xl shadow-md">
        <table class="w-full text-sm border-separate border-spacing-0">
          <thead>
            <tr>
              <th class="table-header-cell text-white font-bold px-5 py-3.5 text-left rounded-tl-2xl tracking-wide text-xs uppercase">📅 Tanggal</th>
              <th class="table-header-cell text-white font-bold px-5 py-3.5 text-left tracking-wide text-xs uppercase">🏷️ Jenis</th>
              <th class="table-header-cell text-white font-bold px-5 py-3.5 text-left tracking-wide text-xs uppercase">💵 Nominal</th>
              <th class="table-header-cell text-white font-bold px-5 py-3.5 text-left tracking-wide text-xs uppercase">📝 Keterangan</th>
              <th class="table-header-cell text-white font-bold px-5 py-3.5 text-center rounded-tr-2xl tracking-wide text-xs uppercase">⚙️ Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($transaksi as $item)
            <tr class="table-row">
              <td class="px-5 py-3.5 bg-white border-b border-pink-50 text-gray-700 font-medium">
                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
              </td>
              <td class="px-5 py-3.5 bg-white border-b border-pink-50">
                @if($item->jenis === 'Pemasukan')
                  <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                    ⬆️ Pemasukan
                  </span>
                @else
                  <span class="inline-flex items-center gap-1 bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-full">
                    ⬇️ Pengeluaran
                  </span>
                @endif
              </td>
              <td class="px-5 py-3.5 bg-white border-b border-pink-50 text-gray-700 font-semibold">
                Rp {{ number_format($item->nominal, 0, ',', '.') }}
              </td>
              <td class="px-5 py-3.5 bg-white border-b border-pink-50 text-gray-500">
                {{ $item->keterangan }}
              </td>
              <td class="px-5 py-3.5 bg-white border-b border-pink-50 text-center">
                <div class="flex items-center justify-center gap-2">
                  {{-- Edit --}}
                  <a href="/transaksi/{{ $item->id }}/edit"
                     class="inline-flex items-center gap-1 bg-[#F9F6C4] hover:bg-yellow-200 text-yellow-700 text-xs font-bold px-3 py-1.5 rounded-xl transition-all duration-200 hover:shadow-sm">
                    ✏️ Edit
                  </a>
                  {{-- Delete --}}
                  <form action="/transaksi/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin hapus transaksi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-500 text-xs font-bold px-3 py-1.5 rounded-xl transition-all duration-200 hover:shadow-sm cursor-pointer">
                      🗑️ Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="bg-[#F9F6C4] rounded-b-2xl">
                <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
                  <div class="empty-icon text-6xl mb-4">🗒️</div>
                  <p class="text-gray-600 font-bold text-base mb-1">Belum ada data transaksi.</p>
                  <p class="text-gray-400 text-xs max-w-xs leading-relaxed">
                    Yuk mulai catat pemasukan & pengeluaranmu hari ini! Klik tombol&nbsp;
                    <span class="text-pink-500 font-semibold">"Tambah Transaksi"</span>
                    &nbsp;di atas untuk memulai.
                  </p>
                  <div class="flex gap-1.5 mt-5">
                    <span class="block w-2 h-2 rounded-full bg-pink-300 opacity-70"></span>
                    <span class="block w-2 h-2 rounded-full bg-yellow-300 opacity-70"></span>
                    <span class="block w-2 h-2 rounded-full bg-pink-300 opacity-70"></span>
                  </div>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Footer --}}
      <div class="flex flex-col sm:flex-row items-center justify-between mt-5 gap-2">
        <p class="text-xs text-gray-400 flex items-center gap-1.5">
          <span class="w-2 h-2 rounded-full bg-pink-400 inline-block"></span>
          Total {{ $transaksi->count() }} transaksi tercatat
        </p>
        <p class="text-xs text-gray-400">© 2024 · Kenanga · Keuangan Harian 🌸</p>
      </div>

    </div>{{-- /CONTENT CARD --}}

  </div>
</body>
</html>
