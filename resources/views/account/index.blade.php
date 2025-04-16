@php
    // dd($family);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Anggota Keluarga</h2>

                {{-- Tombol Tambah --}}
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('account.create') }}">
                        <button type="button"
                                class="bg-green-700 hover:bg-green-900 text-white px-5 mb-4 py-2 rounded-lg shadow-md text-sm font-semibold transition">
                            Tambahkan
                        </button>
                    </a>
                </div>
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

            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">username</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">nomor hp</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">nama lengkap</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">From</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($family as $item)
                            <tr>
                                <td class="px-6 py-4">{{ $item['name'] }}</td>
                                <td class="px-6 py-4">{{ $item['phone'] }}</td>
                                <td class="px-6 py-4">{{ $item['user']['name'] ?? '-' }}</td>
                                <td class="px-6 py-4">{{ ucfirst($item['user']['gender'] == 'male' ? 'Laki laki' : 'Perempuan') }}</td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item['user']['DOB'])->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4">{{ $item['user']['from'] == 'int' ? 'Keluarga Asli' : 'Dari Keluarga Lain' }}</td>

                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('account.edit', $item['id']) }}">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow text-xs font-semibold">
                                                Edit
                                            </button>
                                        </a>
                                        <form action="{{ route('account.destroy', $item['id']) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-xs font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
