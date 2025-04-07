<?php

namespace App\Http\Controllers;

use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        // Anak cucu dari kakek nenek
        $family = FamilyMember::where('from', 'int')->get()->toArray();

        // Pasangan dari keluarga lain
        $eksternal = FamilyMember::where('from', 'eks')->get()->toArray();

        return view('family.index-graph', [
            'family' => $family,
            'eksternal' => $eksternal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $family = FamilyMember::get()->toArray();
        return view('family.index-table', [
            'family' => $family,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $member = FamilyMember::findOrFail($id);
        return view('family.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = FamilyMember::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'DOB' => 'nullable|date',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Kalau ada foto baru di-upload
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                Storage::disk('public')->delete($member->photo);
            }

            // Simpan foto baru dengan nama dan folder
            $path = $request->file('photo')->store('photos', 'public'); // otomatis menyimpan ke public/photos/namaacak.jpg
            $validated['photo'] = $path; // ini akan berisi "photos/namaacak.jpg"
        }


        $member->update($validated);

        return redirect()->route('family.index')->with('success', 'Data anggota keluarga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
