<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GatewayController extends Controller
{
    public function index(Request $request){
        if($request->user()->hasRole('akuntan')){
            return redirect('/dashboard');
        }elseif($request->user()->hasRole('petugas')){
            return redirect('/beranda');
        }elseif($request->user()->hasRole('pengurus')){
            return view('gateway');
        }elseif($request->user()->hasRole('superadministrator')){
            return redirect('/laratrust');
        }else{
            return redirect('/');
        }
    }
}
