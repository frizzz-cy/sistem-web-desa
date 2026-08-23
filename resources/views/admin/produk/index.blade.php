@extends('layouts.admin', ['activePage' => 'produk'])

@section('title', 'Kelola Produk UMKM')

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">Kelola Produk UMKM</h1>
            <div>
                <a href="/" class="btn btn-secondary" target="_blank">Lihat Web</a>
                <a href="/admin/produk/create" class="btn btn-primary">+ Tambah Produk</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%; margin-top: 10px;">
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Penjual</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produks as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->foto_produk ? asset('storage/'.$item->foto_produk) : 'https://placehold.co/100' }}" width="60" style="border-radius: 6px; object-fit: cover; aspect-ratio: 1/1; display: block;">
                        </td>
                        <td><b>{{ $item->nama_produk }}</b><br><small style="color:#64748B;">{{ $item->kategori }} &bull; Status: {{ $item->status_stok }}</small></td>
                        <td>{{ $item->nama_penjual }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>
                            <a href="/admin/produk/{{ $item->id }}/edit" class="btn btn-warning" style="padding: 6px 12px; font-size: 12.5px;">Edit</a>
                            <form action="/admin/produk/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12.5px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection