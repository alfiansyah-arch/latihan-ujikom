<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\hak_akses;
use Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::All();

        return view('anggota/index', compact('anggota'));
    }

    public function create(){
        $anggota = Anggota::All();
        return view('anggota/create');
    }

    public function store(Request $request)
    {  
        // dd($request);
        $request->validate([
            'kd_anggota' => 'required',
            'nm_anggota' => 'required',
            'jk' => 'required|in:pria,wanita',
            'tp_lahir' => 'required',
            'tg_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jns_anggota' => 'required|in:member,non_member',
            'status' => 'required|in:borrowed,returned',
            'jm_pinjam' => 'required',
        ]);
           
        $data = $request->all();
        // dd($data);
        $check = Anggota::create([
            'kd_anggota' => $data['kd_anggota'],
            'nm_anggota' => $data['nm_anggota'],
            'jk' => $data['jk'],
            'tp_lahir' => $data['tp_lahir'],
            'tg_lahir' => $data['tg_lahir'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'jns_anggota' => $data['jns_anggota'],
            'status' => $data['status'],
            'jm_pinjam' => $data['jm_pinjam']
        ]);
         
        return redirect()->route('anggota.index')->withSuccess('Great! You have Successfully Submit it');
    }

    public function edit(Anggota $anggota)
    {   
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nm_anggota' => 'required',
            'jk' => 'required|in:pria,wanita',
            'tp_lahir' => 'required',
            'tg_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jns_anggota' => 'required|in:member,non_member',
            'status' => 'required|in:borrowed,returned',
            'jm_pinjam' => 'required',
        ]);
        $anggota->nm_anggota = $request->nm_anggota;
        $anggota->jk = $request->jk;
        $anggota->tp_lahir = $request->tp_lahir;
        $anggota->tg_lahir = $request->tg_lahir;
        $anggota->alamat = $request->alamat;
        $anggota->no_hp = $request->no_hp;
        $anggota->jns_anggota = $request->jns_anggota;
        $anggota->status = $request->status;
        $anggota->jm_pinjam = $request->jm_pinjam;
        $anggota->save();

        return redirect()->route('anggota.index')->withSuccess('Great! You have Successfully Edit it');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success','Angggota has been deleted successfully');
    }
}
