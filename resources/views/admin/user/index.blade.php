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
                        <th>Alamat Email</th>
                        <th>Terdaftar Sejak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $isCurrentSuperAdmin = auth()->user() && (auth()->user()->username === 'adm_mnk_9472_x9' || auth()->user()->id === 1);
                    @endphp
                    @foreach($users as $item)
                    @php
                        $isTargetSuperAdmin = ($item->username === 'adm_mnk_9472_x9' || $item->id === 1);
                    @endphp
                    <tr>
                        <td>
                            <b>{{ $item->name }}</b>
                            @if($isTargetSuperAdmin)
                                <span style="background: #FEF3C7; color: #B45309; border: 1px solid #FDE68A; font-size: 10.5px; padding: 2px 8px; border-radius: 10px; font-weight: 800; margin-left: 4px;">👑 Super Admin</span>
                            @else
                                <span style="background: #E0E7FF; color: #3730A3; font-size: 10.5px; padding: 2px 6px; border-radius: 10px; font-weight: 700; margin-left: 4px;">Pengelola</span>
                            @endif

                            @if($item->id === auth()->id())
                                <span style="background: #E0F2FE; color: #0369A1; font-size: 10.5px; padding: 2px 6px; border-radius: 10px; font-weight: bold; margin-left: 2px;">(Anda)</span>
                            @endif
                        </td>
                        <td><code>{{ $item->username }}</code></td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            @if(!$isTargetSuperAdmin || $isCurrentSuperAdmin)
                                <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-warning" style="padding: 6px 12px; font-size: 12.5px;">Edit</a>
                            @else
                                <button class="btn btn-secondary" style="padding: 6px 12px; font-size: 12.5px; opacity: 0.5; cursor: not-allowed;" title="Akun Super Admin Terkunci">Edit</button>
                            @endif
                            
                            @if($isTargetSuperAdmin)
                                <button class="btn btn-secondary" style="padding: 6px 12px; font-size: 12.5px; opacity: 0.5; cursor: not-allowed;" title="Akun Super Admin dilindungi dan tidak dapat dihapus">🔒 Terkunci</button>
                            @elseif($item->id === auth()->id())
                                <button class="btn btn-secondary" style="padding: 6px 12px; font-size: 12.5px; opacity: 0.5; cursor: not-allowed;" title="Anda tidak bisa menghapus akun Anda sendiri yang sedang aktif">Hapus</button>
                            @elseif($isCurrentSuperAdmin)
                                <form action="/admin/user/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user pengelola ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12.5px;">Hapus</button>
                                </form>
                            @else
                                <button class="btn btn-secondary" style="padding: 6px 12px; font-size: 12.5px; opacity: 0.5; cursor: not-allowed;" title="Hanya Super Admin yang berhak menghapus user">Hapus</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
