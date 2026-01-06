@extends('layout')

@section('content')

<div class="mb-12">
    <div class="flex justify-between items-end mb-6">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Katalog Alat</h2>
            <p class="text-slate-500 mt-1">Pilih peralatan yang tersedia untuk praktikum.</p>
        </div>
        <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-slate-200 text-sm">
            <span class="text-slate-500">Total Item:</span> 
            <span class="font-bold text-indigo-600">{{ $items->count() }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($items as $item)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition duration-300 flex flex-col h-full">
            <div class="h-2 bg-indigo-500"></div> <div class="p-6 flex-1 flex flex-col">
                <div class="flex justify-between items-start mb-4">
                    <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2 py-1 rounded uppercase tracking-wider">
                        {{ $item->category->name ?? 'UMUM' }}
                    </span>
                    <span class="text-sm font-semibold {{ $item->stock > 0 ? 'text-emerald-600' : 'text-rose-500' }}">
                        Stok: {{ $item->stock }}
                    </span>
                </div>
                
                <h3 class="font-bold text-lg text-slate-800 mb-2">{{ $item->name }}</h3>
                <p class="text-slate-500 text-sm mb-6 flex-1">{{ $item->description ?? 'Tidak ada deskripsi.' }}</p>
                
                @if($item->stock > 0)
                <form action="{{ route('borrow', $item) }}" method="POST" class="mt-auto">
                    @csrf
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition shadow-sm shadow-indigo-200">
                        Pinjam Sekarang
                    </button>
                </form>
                @else
                <button disabled class="mt-auto w-full bg-slate-100 text-slate-400 font-medium py-2.5 rounded-lg cursor-not-allowed">
                    Stok Habis
                </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
        <h3 class="font-bold text-lg text-slate-800">Status Peminjaman Saya</h3>
        <span class="text-xs text-slate-400 font-mono">HISTORY_LOG</span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Nama Barang</th>
                    <th class="px-6 py-4 font-semibold">Kategori</th>
                    <th class="px-6 py-4 font-semibold">Tanggal Pinjam</th>
                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($myLoans as $loan)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $loan->item->name }}</td>
                    <td class="px-6 py-4 text-slate-500 text-sm">{{ $loan->item->category->name }}</td>
                    <td class="px-6 py-4 text-slate-500 text-sm">{{ $loan->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($loan->status == 'borrowed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                Sedang Dipinjam
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                Dikembalikan
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($loan->status == 'borrowed')
                        <form action="{{ route('return', $loan) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold hover:underline">
                                Kembalikan
                            </button>
                        </form>
                        @else
                            <span class="text-slate-300 text-sm">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                        <p>Belum ada riwayat peminjaman.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection