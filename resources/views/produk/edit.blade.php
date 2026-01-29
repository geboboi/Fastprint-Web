<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">

    <!-- Header -->
    <div class="bg-white border-b border-slate-200">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('produk.index') }}" 
                   class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-slate-800">Edit Produk</h1>
                    <p class="text-sm text-slate-500 mt-1">Perbarui informasi produk</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <!-- Nama Produk -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Produk <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="nama_produk" 
                           value="{{ old('nama_produk', $produk->nama_produk) }}" 
                           placeholder="Masukkan nama produk"
                           class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-transparent transition-all duration-150 @error('nama_produk') border-rose-500 focus:ring-rose-500 @enderror">
                    
                    @error('nama_produk')
                        <div class="flex items-center gap-1.5 mt-2 text-rose-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs font-medium">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Harga <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm font-medium">Rp</span>
                        <input type="number" 
                               name="harga" 
                               value="{{ old('harga', $produk->harga) }}" 
                               placeholder="0"
                               class="w-full pl-12 pr-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-transparent transition-all duration-150 @error('harga') border-rose-500 focus:ring-rose-500 @enderror">
                    </div>
                    
                    @error('harga')
                        <div class="flex items-center gap-1.5 mt-2 text-rose-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs font-medium">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kategori <span class="text-rose-500">*</span>
                    </label>
                    <select name="kategori_id" 
                            class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-transparent transition-all duration-150 @error('kategori_id') border-rose-500 focus:ring-rose-500 @enderror">
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}" {{ $produk->kategori_id == $kat->id_kategori ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    
                    @error('kategori_id')
                        <div class="flex items-center gap-1.5 mt-2 text-rose-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs font-medium">Kategori wajib dipilih</p>
                        </div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <select name="status_id" 
                            class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-transparent transition-all duration-150 @error('status_id') border-rose-500 focus:ring-rose-500 @enderror">
                        @foreach($status as $stat)
                            <option value="{{ $stat->id_status }}" {{ $produk->status_id == $stat->id_status ? 'selected' : '' }}>
                                {{ $stat->nama_status }}
                            </option>
                        @endforeach
                    </select>
                    
                    @error('status_id')
                        <div class="flex items-center gap-1.5 mt-2 text-rose-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs font-medium">Status wajib dipilih</p>
                        </div>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3 pt-6 border-t border-slate-200">
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center gap-2 bg-amber-600 hover:bg-amber-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Update Produk
                    </button>
                    <a href="{{ route('produk.index') }}" 
                       class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors duration-150">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

</body>
</html>