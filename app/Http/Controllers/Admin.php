<?php

namespace App\Http\Controllers;

use App\Models\M_Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{
    //
    public function index(){
        $admin = M_Admin::lates()->paginate(5);
        return view ('admin.index', compact('admin'))->with('i',(request()->input('page',1) -1) * 5);
    }

    public function create(){
        return view('admin.create');
    }

    public function store (Request $request){
        $request->validate([
            'id_admin' => 'required',
            'nama_admin' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        M_Admin::create($request->all());
        return redirect()->route('admin.index')->with('success','Data berhasil di input');
    }

    public function show(){
        return view('adnmin.show', compact('admin'));
    }

    public function edit(){
        return view('adnmin.edit', compact('admin'));
    }

    public function update(Request $request, M_Admin $model_admin){
        $request->validate([
            'id_admin' => 'required',
            'nama_admin' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        M_Admin::update($request->all());
        return redirect()->route('admin.index')->with('success','Data berhasil di input');
    }

    public function destroy(M_Admin $model_admin){
        $model_admin->delete();
        return redirect()->route('admin.index')->with('success','Data berhasil di hapus');
    }
}