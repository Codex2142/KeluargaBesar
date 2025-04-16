<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class accountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $family = User::with(['user'])->get()->toArray();
        return view('account.index',[
            'family' => $family
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $family = FamilyMember::whereNull('user_id')->get()->toArray();
        return view('account.add', [
            'family' => $family,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            // dd($request->identitas);
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|regex:/^[0-9]{10,15}$/|unique:users',
                'identitas' => 'required|exists:family_members,id',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // table Users
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            $member = FamilyMember::findOrFail($request->identitas);
            $member->update(['user_id' => $user->id]);

            return redirect()->route('account.index')->with('success', 'Anggota berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $family = FamilyMember::whereNull('user_id')->get()->toArray();
        $user = User::findOrFail($id);
        return view('account.edit', [
            'user' => $user,
            'family' => $family,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|regex:/^[0-9]{10,15}$/|unique:users,phone,' . $id,
                'identitas' => 'nullable|exists:family_members,id',
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->phone = $request->phone;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            // Update identitas keluarga jika ada perubahan
            if ($request->filled('identitas')) {
                $member = FamilyMember::findOrFail($request->identitas);
                $member->update(['user_id' => $user->id]);
            }

            return redirect()->route('account.index')->with('success', 'Data pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            // Unbind user_id di FamilyMember jika ada
            $family = FamilyMember::where('user_id', $id)->first();
            if ($family) {
                $family->update(['user_id' => null]);
            }

            $user->delete();

            return redirect()->route('account.index')->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
