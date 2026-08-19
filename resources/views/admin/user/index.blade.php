@extends('layouts.admin', ['activePage' => 'user'])

@section('title', 'Kelola User')

@section('content')
    <div class="admin-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
            <h1 style="margin: 0; font-size: 24px; color: var(--biru-tua); font-weight: 800;">Kelola User Pengelola</h1>
            <div>
                <a href="/" class="btn btn-secondary" target="_blank">Lihat Web</a>
                <a href="/admin/user/create" class="btn btn-primary">+ Tambah User</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-danger">{{ session('error') }}</div>
        @endif

        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%; margin-top: 10px;">
            <table>
                <thead>
                    <tr>
                        <th>Nama Pengelola</th>
                        <th>Username</th>
                        <th>Peran (Role)</th>
                        <th>Alamat Email</th>
                        <th>Terdaftar Sejak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $item)
                    <tr>
                        <td><b>{{ $item->name }}</b> @if($item->id === auth()->id()) <span style="background: #E0F2FE; color: #0369A1; font-size: 11px; padding: 2px 6px; border-radius: 10px; font-weight: bold; margin-left: 4px;">Akun Anda</span> @endif</td>
                        <td><code>{{ $item->username }}</code></td>
                        <td>
                            @if($item->isAdmin())
                                <span style="background: #FEF3C7; color: #92400E; padding: 4px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                    👑 Administrator
                                </span>
                            @else
                                <span style="background: #E0F2FE; color: #075985; padding: 4px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                    ✍️ Kontributor
                                </span>
                            @endif
                        </td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-warning" style="padding: 6px 12px; font-size: 12.5px;">Edit</a>
                            
                            @if($item->id !== auth()->id())
                            <form action="/admin/user/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user pengelola ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12.5px;">Hapus</button>
                            </form>
                            @else
                            <button class="btn btn-secondary" style="padding: 6px 12px; font-size: 12.5px; opacity: 0.5; cursor: not-allowed;" title="Anda tidak bisa menghapus akun Anda sendiri yang sedang aktif">Hapus</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
