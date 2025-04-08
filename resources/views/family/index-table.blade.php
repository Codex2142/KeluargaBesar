<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silsilah Keluarga</title>
    @vite('resources/css/app.css')
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-gray-100 text-gray-800">
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Data Keluarga</h1>

    {{-- Tombol Tambah --}}
    <div class="flex justify-between items-center mt-6">
        <a href="family/tambah">
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

    {{-- Table --}}
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full table-auto text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Jenis Kelamin</th>
                <th class="px-6 py-3">Tanggal Lahir</th>
                <th class="px-6 py-3">Deskripsi</th>
                <th class="px-6 py-3">Asal</th>
                <th class="px-6 py-3">Foto</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach ($family as $index => $member)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900 flex items-center gap-4">
                        {{ $index + 1 }}
                        <button onclick="showModal(@js($member))"
                                class="text-white bg-blue-500 hover:bg-white hover:text-blue-500 p-3 rounded-full transition duration-300 ease-in-out"
                                title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                        </button>
                    </td>
                    <td class="px-6 py-4">{{ $member['name'] }}</td>
                    <td class="px-6 py-4 capitalize">{{ $member['gender'] === 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($member['DOB'])->translatedFormat('d F Y') }}</td>
                    <td class="px-6 py-4">{{ $member['description'] }}</td>
                    <td class="px-6 py-4">{{ $member['from'] === 'int' ? 'Asli Keluarga' : 'Dari Keluarga Lain' }}</td>
                    <td class="px-6 py-4">
                        @if ($member['photo'])
                            <img src="{{ asset('storage/' . $member['photo']) }}"
                                 alt="{{ $member['name'] }}"
                                 class="h-12 w-12 rounded-full object-cover border">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member['name']) }}"
                                 class="h-12 w-12 rounded-full object-cover border"
                                 alt="No Photo">
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('family.edit', $member['id']) }}">
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow text-xs font-semibold">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ route('family.destroy', $member['id']) }}" method="POST"
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

@include('component.modal')
<script>
    function showModal(member) {
        document.getElementById('modal-name').textContent = member.name;
        document.getElementById('modal-gender').textContent = member.gender === 'male' ? 'Laki-laki' : 'Perempuan';
        document.getElementById('modal-dob').textContent = new Date(member.DOB).toLocaleDateString('id-ID', {
            day: 'numeric', month: 'long', year: 'numeric'
        });
        document.getElementById('modal-description').textContent = member.description ?? '-';
        document.getElementById('modal-from').textContent = member.from === 'int' ? 'Asli Keluarga' : 'Dari Keluarga Lain';
        document.getElementById('modal-partner').textContent = member.partner?.name ?? '-';
        document.getElementById('modal-parent').textContent = member.parent?.name ?? '-';
        document.getElementById('modal-photo').src = member.photo
            ? `/storage/${member.photo}`
            : `https://ui-avatars.com/api/?name=${encodeURIComponent(member.name)}`;

        document.getElementById('detailModal').classList.remove('hidden');
    }

    function hideModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    document.getElementById('detailModal').addEventListener('click', function (e) {
        if (e.target === this) hideModal();
    });
</script>

</body>
</html>
