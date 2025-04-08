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
        // untuk form parent_id dan partner_id
        $family = FamilyMember::get()->toArray();
        return view('family.add',[
            'family' => $family
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'DOB' => 'nullable|date',
                'parent_id' => 'nullable',
                'partner_id' => 'nullable|unique:family_members,partner_id',
                'description' => 'nullable|string',
                'from' => 'required|in:int,eks',
                'photo' => 'nullable',
            ]);

            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('foto-keluarga', 'public');
            }

            FamilyMember::create($validated);

            return redirect()->route('family.show')->with('success', 'Data keluarga berhasil ditambahkan.');

        }catch (\Exception $e) {
            // Tangkap error lainnya (misal: database, filesystem, dll.)
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $family = FamilyMember::
            with(['partner', 'parent'])
            ->get()
            ->toArray();
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
        $family = FamilyMember::get()->toArray();
        return view('family.edit',[
            'family' => $family,
            'member' => $member
        ]);
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
            'parent_id' => 'nullable',
            'partner_id' => 'nullable|unique:family_members,partner_id,' . $id,
            'description' => 'nullable|string',
            'photo' => 'nullable',
        ]);

        try {
            // Handle photo upload
            if ($request->hasFile('photo')) {
                // replace foto lama
                if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                    Storage::disk('public')->delete($member->photo);
                }

                // upload foto baru
                $path = $request->file('photo')->store('photos', 'public');
                $validated['photo'] = $path;
            } else {
                // simpan foto lama
                $validated['photo'] = $member->photo;
            }

            $member->update($validated);

            return redirect()->route('family.show')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $member = FamilyMember::findOrFail($id);
            $member->delete();
            return redirect()->route('family.show')->with('success', 'Data berhasil dihapus');
        }catch(\Exception $e){
            return redirect()->route('family.show')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
