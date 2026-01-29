<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">

    <!-- Header -->
    <div class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-800">Manajemen Produk</h1>
                </div>
                <a href="{{ route('produk.create') }}" 
                   class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Produk
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Filter & Success Message -->
        <div class="mb-6 space-y-4">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Filter Tabs -->
            <div class="flex items-center gap-2">
                <a href="{{ route('produk.index') }}" 
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                   {{ request('filter') != 'semua' ? 'bg-white text-slate-800 shadow-sm border border-slate-200' : 'text-slate-600 hover:text-slate-800 hover:bg-white/50' }}">
                   Bisa Dijual
                </a>
                <a href="{{ route('produk.index', ['filter' => 'semua']) }}" 
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                   {{ request('filter') == 'semua' ? 'bg-white text-slate-800 shadow-sm border border-slate-200' : 'text-slate-600 hover:text-slate-800 hover:bg-white/50' }}">
                   Semua Produk
                </a>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Produk</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($data as $key => $item)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">
                                {{ $data->firstItem() + $loop->index }}
                            </td>
                            
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">
                                {{ $item->nama_produk }}
                            </td>
                            
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </td>
                            
                            <td class="px-6 py-4 text-sm text-slate-900 font-semibold">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $statusName = strtolower($item->status->nama_status ?? '');
                                    $isBisaDijual = $statusName == 'bisa dijual';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-full
                                    {{ $isBisaDijual ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $isBisaDijual ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ $item->status->nama_status ?? 'Unknown' }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('produk.edit', $item->id_produk) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-700 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors duration-150">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('produk.destroy', $item->id_produk) }}" method="POST" class="inline-block" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-rose-700 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors duration-150">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-slate-500 text-sm">Tidak ada data produk</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination & Total -->
            @if($data->hasPages() || $data->total() > 0)
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600">
                        Total <span class="font-semibold text-slate-800">{{ $data->total() }}</span> produk
                    </div>
                    <div>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>

</body>
</html>