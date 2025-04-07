@php
    // dd($id);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit Data Keluarga</h2>
        <form action="{{ route('family.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $member->name) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jenis Kelamin</label>
                <select name="gender" class="w-full border rounded px-3 py-2">
                    <option value="male" {{ $member->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ $member->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="DOB" value="{{ old('DOB', $member->DOB) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full border rounded px-3 py-2">{{ old('description', $member->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Foto (opsional)</label>
                <input type="file" name="photo" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('family.show') }}" class="text-gray-600 hover:underline">← Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
