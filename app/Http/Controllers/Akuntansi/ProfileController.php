<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $data = [
            'user' => $request->user(),
            'title' => 'Profil',
            'judul' => 'Profil Akuntan'
        ];
        return view('profile.akuntansi.edit', $data);
    }

    public function updateHp(Request $request, User $id): View
    {
        // TODO: buat middleware konfirm pass dulu
        $data = [
            'user' => $request->user(),
            'title' => 'Ubah No Telepon',
            'judul' => 'Ubah No Telepon',
        ];
        return view('profile.akuntansi.editHp', $data);
        // TODO: setelah selesai buat konfirm kode OTP
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
// dd($request["name"]);
        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }
        $request->user()->nama_lengkap = $request["name"];
        $request->user()->alamat = $request["alamat"];
        $request->user()->save();

        // return Redirect::route('profil.edit')->with('status', 'profile-updated');
        return Redirect::route('profil.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/dashboard');
    }

    public function kodeOtp(Request $request,){
        // TODO: tambahkan logic untuk krim kode otp
        $data = [
            'user' => $request->user(),
            'title' => 'Kofirmasi OTP',
            'judul' => 'Masukkan OTP',
        ];
        return view('profile.akuntansi.kodeOTP', $data);
    }

    public function confirmOtp(){
        // TODO: tambahkan logic konfirm kode otp
    }
}
