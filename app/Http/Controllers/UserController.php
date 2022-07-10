<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->cari) && !empty($request->cari)) {
            $users = User::where('name', 'like', $request->cari . '%')->orderBy('id', 'ASC')->paginate(10)->appends(['cari' => $request->cari]);
        } else {
            $users = User::orderBy('id', 'ASC')->paginate(10)->appends(['cari' => $request->cari]);
        }

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'email'         => 'required',
            'name'          => 'required',
            'password'      => 'required',
            'hak_akses'     => 'required',
        ];

        $message = [
            'email.required'     => 'Email tidak boleh kosong',
            'name.required'      => 'Nama tidak boleh kosong',
            'hak_akses.required' => 'Hak Akses tidak boleh kosong',
            'password.required'  => 'Password tidak boleh kosong',
        ];

        request()->validate($rules, $message);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'hak_akses' => $request->hak_akses
        ]);

        $responseAlert = [
            'status_alert'    => 'success',
            'message_alert'   => 'Berhasil Menambah Data Pengguna'
        ];

        return redirect()->route('manage.user')->with($responseAlert);
    }
}
