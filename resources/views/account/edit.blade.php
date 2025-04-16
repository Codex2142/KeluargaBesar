<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-green-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-4xl px-4 py-6">
        {{-- Header Card --}}
        <div class="bg-green-700 text-white rounded-t-lg p-4 shadow-md">
            <h2 class="text-2xl font-bold text-center">Edit Pengguna</h2>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="bg-green-200 border border-green-600 text-green-800 p-4 rounded-b-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-200 border border-red-600 text-red-800 p-4 rounded-b-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form --}}
        <form id="addForm" action="{{ route('account.update', $user->id) }}" method="POST" class="bg-green-100 rounded-b-lg p-6 shadow-lg space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Username --}}
                <div>
                    <label class="block text-sm font-semibold text-green-800 mb-1">Username</label>
                    <input type="text" name="name" class="w-full rounded-md border border-green-300 focus:ring-2 focus:ring-green-400 shadow-sm py-2 px-3"
                        value="{{ old('name', $user->name) }}" placeholder="Masukkan Username" autocomplete="off" required>
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-sm font-semibold text-green-800 mb-1">No HP</label>
                    <input type="text" name="phone" class="w-full rounded-md border border-green-300 focus:ring-2 focus:ring-green-400 shadow-sm py-2 px-3"
                        value="{{ old('phone', $user->phone) }}" placeholder="Masukkan Nomor HP" autocomplete="off" required>
                </div>

                {{-- Identitas --}}
                <div>
                    <label class="block text-sm font-semibold text-green-800 mb-1">Identitas Keluarga</label>
                    <select name="identitas" class="w-full rounded-md border border-green-300 focus:ring-2 focus:ring-green-400 shadow-sm py-2 px-3">
                        <option value="">Pilih Anggota Keluarga</option>
                        @foreach ($family as $member)
                            <option value="{{ $member['id'] }}"
                                {{ old('identitas', $user->identitas) == $member['id'] ? 'selected' : '' }}>
                                {{ $member['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Password --}}
                <div>
                    <label class="block text-sm font-semibold text-green-800 mb-1">Password</label>
                    <input type="password" name="password" class="w-full rounded-md border border-green-300 focus:ring-2 focus:ring-green-400 shadow-sm py-2 px-3"
                        placeholder="Masukkan Password (Kosongkan jika tidak diubah)">
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-sm font-semibold text-green-800 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full rounded-md border border-green-300 focus:ring-2 focus:ring-green-400 shadow-sm py-2 px-3"
                        placeholder="Konfirmasi Password">
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('account.index') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 shadow">Kembali</a>
                <button type="submit" form="addForm" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 shadow">Simpan</button>
            </div>
        </form>
    </div>

</body>
</html>
