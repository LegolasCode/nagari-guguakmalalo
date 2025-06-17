<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::all();
        return view('pages.resident.index', [
            'residents' => $residents
        ]);
    }

    public function create()
    {
        return view('pages.resident.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'name' => ['required', 'max:100'],
            'gender' => ['required', Rule::in(['Pria', 'Wanita'])],
            'birth_date' => ['required', 'string'],
            'birth_place' => ['required', 'max:100'],
            'address' => ['required', 'max:700'],
            'religion' => ['nullable','max:50'],
            'marital_status' => ['required', Rule::in(['Belum Menikah', 'Menikah', 'Cerai', 'Janda/Duda'])],
            'occupation' => ['nullable', 'max:100'],
            'phone' => ['nullable', 'max:15'],
            'status' => ['required', Rule::in(['Aktif', 'Pindah', 'Meninggal'])],        
        ]);

        Resident::create($validatedData);
        return redirect('/resident')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        return view('pages.resident.edit', [
            'resident' => $resident
        ]);
    }   

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'name' => ['required', 'max:100'],
            'gender' => ['required', Rule::in(['Pria', 'Wanita'])],
            'birth_date' => ['required', 'string'],
            'birth_place' => ['required', 'max:100'],
            'address' => ['required', 'max:700'],
            'religion' => ['nullable','max:50'],
            'marital_status' => ['required', Rule::in(['Belum Menikah', 'Menikah', 'Cerai', 'Janda/Duda'])],
            'occupation' => ['nullable', 'max:100'],
            'phone' => ['nullable', 'max:15'],
            'status' => ['required', Rule::in(['Aktif', 'Pindah', 'Meninggal'])],        
        ]);

        Resident::findOrFail($id)->update($validatedData);
        return redirect('/resident')->with('success', 'Berhasil Mengubah Data');
    }

    public function destroy($id)
    {
        $residents = Resident::findOrFail($id);
        $residents->delete();
        return redirect('/resident')->with('success', 'Berhasil Menghapus Data');
    }
}
