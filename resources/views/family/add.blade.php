@php
    // dd($family);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Keluarga</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Tambah Anggota Keluarga</h2>

        {{-- Success / Error --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 rounded text-green-700">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-300 rounded text-red-700">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('family.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- KIRI ATAS --}}
                <div>
                    {{-- Nama --}}
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            required>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-1">Jenis Kelamin</label>
                        <select name="gender"
                            class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>


                </div>

                {{-- KANAN ATAS --}}
                <div>
                    {{-- Deskripsi --}}
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                        <textarea name="description" rows="6"
                            class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('description') }}</textarea>
                    </div>

                </div>

                {{-- KIRI TENGAH --}}
                <div>
                    {{-- Tanggal Lahir --}}
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-1">Tanggal Lahir</label>
                        <input type="date" name="DOB" value="{{ old('DOB') }}"
                            class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>
                </div>

                {{-- KANAN TENGAH --}}
                <div>
                    {{-- Foto --}}
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-1">Foto (Opsional)</label>
                        <input type="file" name="photo"
                            class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                    </div>
                </div>

                {{-- KIRI BAWAH --}}
                <div>
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-1">Orang Tua (Parent)</label>
                        <select name="parent_id"
                            class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <option value="">-- Pilih Orang Tua --</option>
                            @foreach ($family as $member)
                                <option value="{{ $member['id'] }}" {{ old('parent_id') == $member['id'] ? 'selected' : '' }}>
                                    {{ $member['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- KANAN BAWAH --}}
                <div>
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-1">Pasangan (Partner)</label>
                        <select name="partner_id"
                            class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <option value="">-- Pilih Pasangan --</option>
                            @foreach ($family as $member)
                                <option value="{{ $member['id'] }}" {{ old('partner_id') == $member['id'] ? 'selected' : '' }}>
                                    {{ $member['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- asal keluarga --}}
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-1">Asal Keluarga</label>
                <select name="from" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="int">Keluarga Asli</option>
                    <option value="eks">Dari Keluarga Lain</option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('family.show') }}"
                   class="inline-flex items-center text-sm text-gray-600 hover:text-gray-800 hover:underline">
                    ← Kembali
                </a>

                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg shadow-md text-sm font-semibold transition">
                    Simpan Data
                </button>
            </div>
        </form>

    </div>
</body>
</html>
