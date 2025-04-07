@php
    // dd($family);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Silsilah Keluarga</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Data Keluarga</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Gender</th>
                        <th class="px-4 py-2 border">Tanggal Lahir</th>
                        <th class="px-4 py-2 border">Deskripsi</th>
                        <th class="px-4 py-2 border">Asal</th>
                        <th class="px-4 py-2 border">Foto</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($family as $index => $member)
                        <tr class="border-t">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $member['name'] }}</td>

                            {{-- Gender --}}
                            @if ($member['gender'] == 'male')
                                <td class="px-4 py-2 border capitalize">Laki laki</td>
                            @else
                                <td class="px-4 py-2 border capitalize">Perempuan</td>
                            @endif

                            {{-- Tanggal Lahir --}}
                            <td class="px-4 py-2 border">
                                {{ \Carbon\Carbon::parse($member['DOB'])->translatedFormat('d F Y') }}
                            </td>

                            <td class="px-4 py-2 border">{{ $member['description'] }}</td>


                            {{-- Asal Keluarga --}}
                            @if ($member['from'] == 'int')
                                <td class="px-4 py-2 border">Asli Keluarga</td>
                            @else
                                <td class="px-4 py-2 border">Dari Keluarga Lain</td>
                            @endif

                            {{-- Foto --}}
                            <td class="px-4 py-2 border">
                                @if ($member['photo'])
                                <img src="{{ asset('storage/' . $member['photo']) }}" alt="{{ $member['name'] }}" class="h-16 w-16 object-cover rounded">
                                @else
                                    <span class="text-gray-400">Tidak Ada</span>
                                @endif
                            </td>

                            {{-- Edit & Delete --}}
                            <td class="px-4 py-2 border">
                                <div class="flex gap-2">
                                    <a href="{{ route('family.edit', $member['id']) }}">
                                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                            Edit
                                        </button>
                                    </a>

                                    {{-- <form action="{{ route('family.destroy', $member['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            Hapus
                                        </button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
