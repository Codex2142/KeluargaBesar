@php
    // Mapping data family berdasarkan parent_id
    $treeMap = [];
    foreach ($family as $member) {
        $treeMap[$member['parent_id']][] = $member;
    }

    // Bikin helper untuk ambil partner eksternal berdasarkan id
    function getPartner($id, $eksternal) {
        foreach ($eksternal as $ex) {
            if ($ex['id'] == $id) {
                return $ex;
            }
        }
        return null;
    }

    // render rekurisf
    function renderNode($member, $treeMap, $eksternal)
    {

        $foto = $member['photo'] ? asset('storage/' . $member['photo']) : 'https://ui-avatars.com/api/?name=' . urlencode($member['name']);
        $gender = $member['gender'] == 'male' ? 'Laki laki' : 'Perempuan';
        // dd($member['photo']);
        echo '<li>';

        // Card pasangan
        echo '<div class="flex gap-2 justify-center">';

        // Card untuk anggota utama
        echo '<div class="max-w-sm rounded overflow-hidden shadow-lg border bg-white">';
        echo '<img class="w-full h-48 object-cover" src="' . $foto . '" alt="' . $member['name'] . '">';
        echo '<div class="px-6 py-4 text-center">';
        echo '<div class="font-bold text-lg uppercase truncate w-40 mx-auto">' . $member['name'] . '</div>';
        echo '<div class="flex justify-around text-gray-500 text-sm mt-2">';
        echo '<span>' . ucfirst($gender) . '</span>';
        echo '<span>' . \Carbon\Carbon::parse($member['DOB'])->locale('id')->translatedFormat('d F Y') . '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';


        // Jika ada pasangan, tampilkan juga
        if ($member['partner_id']) {
            $partner = getPartner($member['partner_id'], $eksternal);
            $partnerName = $partner ? $partner['name'] : 'Misterius';

            $gender = $member['gender'] == 'male' ? 'Laki laki' : 'Perempuan';

            $fotoPartner = $partner && $partner['photo'] ? asset('storage/' . $partner['photo']) : 'https://ui-avatars.com/api/?name=' . urlencode($partnerName);

            echo '<div class="max-w-sm rounded overflow-hidden shadow-lg border bg-gray-100">';
            echo '<img class="w-full h-48 object-cover" src="' . $fotoPartner . '" alt="' . $partnerName . '">';
            echo '<div class="px-6 py-4 text-center">';
            echo '<div class="font-bold text-lg uppercase truncate w-40 mx-auto">' . $partnerName . '</div>';
            echo '<div class="flex justify-around text-gray-500 text-sm mt-2">';
            echo '<span>' . $gender . '</span>';
            echo '<span>' . \Carbon\Carbon::parse($member['DOB'])->locale('id')->translatedFormat('d F Y') . '</span>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }

        echo '</div>'; // flex container

        // Tampilkan anak-anak
        if (isset($treeMap[$member['id']])) {
            echo '<ul>';
            foreach ($treeMap[$member['id']] as $child) {
                renderNode($child, $treeMap, $eksternal);
            }
            echo '</ul>';
        }

        echo '</li>';
    }
@endphp

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Silsilah Keluarga</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
</head>
<body>
<div class="container">
    <div class="row">
        <div class="tree overflow-x-auto whitespace-nowrap px-4">
            <ul class="inline-block">
                @foreach ($family as $member)
                    @if ($member['parent_id'] === null)
                        @php renderNode($member, $treeMap, $eksternal); @endphp
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
</body>
</html>
