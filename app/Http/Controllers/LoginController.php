<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\UnitUsaha;
use App\Models\AccessMenu;
use App\Models\rolePengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function pageLogin(Request $request)
    {
        return view("dashboard.pages.login.login");
    }

    public function register(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        return view("dashboard.pages.login.register", compact("unitUsaha"));
    }

    public function pusher(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        return view("dashboard.pages.login.notif", compact("unitUsaha"));
    }

    public function resetPass(Request $request)
    {
        return view("dashboard.pages.login.forgotPassword");
    }

    public function successRegister(Request $request)
    {
        return view("dashboard.pages.login.successRegister");
    }

    public function successPage(Request $request)
    {
        return view("dashboard.pages.login.success");
    }

    public function login(Request $request)
    {
        // Validate the login form

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        //$credentials = $request->only('email', 'password');
        $credentials = [
            'email' => strtolower($request->email),
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $auth = User::where("id", Auth::user()->id)->first();
            $idpos =  $auth->role_id;
            if ($auth->id_positions == "0") {
                $idpos =  Auth::user()->role_id;
            }
            $access1 = AccessMenu::join("menus", "menus.id", "access_menus.id_menu")->where("menus.section", 1)->where("access_menus.id_jabatan", $idpos)->orderBy("menus.status", "asc")->get();
            $access2 = AccessMenu::join("menus", "menus.id", "access_menus.id_menu")->where("menus.section", 2)->where("access_menus.id_jabatan", $idpos)->orderBy("menus.status", "asc")->get();
            $accessAll1 = Menu::where("section", 1)->orderBy("menus.status", "asc")->get();
            $accessAll2 = Menu::where("section", 2)->orderBy("menus.status", "asc")->get();

            $request->session()->regenerate();
            Session::put('userLog', $auth);
            Session::put('access1', $access1);
            Session::put('access2', $access2);
            Session::put('positions', $auth->id_positions);
            Session::put('roleId', $idpos);
            Session::put('accessAll1', $accessAll1);
            Session::put('accessAll2', $accessAll2);
            return redirect()->route('dashboard');
        }

        // Login failed
        return back()->withErrors([
            'email' => 'Username atau Password salah , silakan coba kembali',
        ]);
    }
}
