<div id="detailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full p-6 relative">
        <button onclick="hideModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl"><i class="fa-solid fa-x"></i></button>

        <!-- Foto -->
        <div class="flex justify-center mb-4">
            <img id="modal-photo" class="h-96 w-96 rounded-full object-cover border-2 border-gray-300" alt="Foto">
        </div>

        <!-- Nama -->
        <h2 id="modal-name" class="text-center text-lg font-bold text-gray-800 mb-4">Nama Anggota</h2>

        <!-- Detail -->
        <div class="space-y-2 text-sm text-gray-700">
            <p><strong>Jenis Kelamin:</strong> <span id="modal-gender"></span></p>
            <p><strong>Tanggal Lahir:</strong> <span id="modal-dob"></span></p>
            <p><strong>Deskripsi:</strong> <span id="modal-description"></span></p>
            <p><strong>Asal:</strong> <span id="modal-from"></span></p>
            <p><strong>Pasangan:</strong> <span id="modal-partner"></span></p>
            <p><strong>Orang Tua:</strong> <span id="modal-parent"></span></p>
        </div>
    </div>
</div>
