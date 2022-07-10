<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        if ($user->hak_akses == 'kesiswaan') {
            return redirect()->route('manage.siswa');
        } else if ($user->hak_akses == 'walikelas') {
            return redirect()->route('manage.detail_nilai');
        } else if ($user->hak_akses == 'kepalasekolah') {
            return redirect()->route('manage.laporan');
        }

        return redirect()->route('manage.detail_nilai');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
