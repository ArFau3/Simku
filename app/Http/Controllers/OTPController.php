<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()){
            $user = $request->user();
        }
        else{
            $user = null;            
        }
        $data = [
            'title' => "Konfirmasi Nomor",
            'user' => $user
        ];
        return view('otp.index', $data);
    }

    // Generate OTP
    public function generate(Request $request)
    {
        # Validate Data
        $request->validate([
            'no_hp' => 'required'
        ]);

        // Cek apakah data ada di database
        $cek = User::where('no_hp', $request["no_hp"])->get();
        if($cek->isEmpty()){
            return redirect()->route('otp.login')->with('error', "tidak ada data");
        }

        # Generate An OTP
        $verificationCode = $this->generateOtp($request->no_hp);

        $message = "Your OTP To Login is - ".$verificationCode->otp;
        # Return With OTP 

        return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message); 
    }


    // Return View of OTP Login Page
    public function login()
    {
        return view('auth.otp-login');
    }

    public function generateOtp($mobile_no)
    {
        $user = User::where('no_hp', $mobile_no)->first();

        # User Does not Have Any Existing OTP
        $verificationCode = OTP::where('user_id', $user->id)->latest()->first();

        $now = Carbon::now();

        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }

        // Create a New OTP
        return OTP::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
    }

    public function verification($user_id)
    {
        return view('otp.verification')->with([
            'user_id' => $user_id,
            'title' => "masukkan OTP",
        ]);
    }

    public function loginWithOtp(Request $request)
    {
        // HACK: sepertiya tidak ada sistem hapus kode otp yg sudah expire, hanya kalau udah dipakai sekali expire diubah jadi saat itu, tapi semua koda numpuk
        #Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required'
        ]);

        #Validation Logic
        $verificationCode   = OTP::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

        $now = Carbon::now();
        if (!$verificationCode) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');
        }

        $user = User::whereId($request->user_id)->first();

        if($user){
            // Expire The OTP
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }

        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }
}
