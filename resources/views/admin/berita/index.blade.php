@extends('layouts.admin', ['activePage' => 'berita'])

@section('title', 'Kelola Berita Desa')

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">Kelola Berita Desa</h1>
            <div>
                <a href="/" class="btn btn-secondary" target="_blank">Lihat Web</a>
                <a href="/admin/berita/create" class="btn btn-primary">+ Tambah Berita</a>
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
                        <th>Judul Berita</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Dilihat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/100?text=Berita' }}" width="60" style="border-radius: 6px; object-fit: cover; aspect-ratio: 1/1; display: block;">
                        </td>
                        <td><b>{{ $item->judul }}</b></td>
                        <td><span style="background: #E8F5E9; color: #2E7D32; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;">{{ $item->kategori }}</span></td>
                        <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                        <td>{{ $item->views }}x</td>
                        <td>
                            <a href="/admin/berita/{{ $item->id }}/edit" class="btn btn-warning" style="padding: 6px 12px; font-size: 12.5px;">Edit</a>
                            <form action="/admin/berita/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12.5px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #64748B; padding: 30px;">Belum ada berita yang ditulis.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
