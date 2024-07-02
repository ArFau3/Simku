@extends('akuntansi.layouts.layout')

@section('content')
    {{-- HACK: pakai? --}}
    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}
    <div class="m-3"><img class="rounded" src="https://placehold.co/300x200" alt=""></div>
    <form method="post" action="" class="mt-6 space-y-6">
        @csrf
        <div class="sm:flex sm:justify-between sm:self-start">
            {{-- Password --}}
            <div class="mx-2">
                <div>
                    <x-input-label for="update_password_password" :value="__('Password')" />
                    <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>
            </div>
            {{-- END Password --}}
        </div>
        {{-- Keterangan --}}
        <div class="mx-2 mb-5">
            <div class="block mt-4">
                <p class="text-sm">Untuk memastikan Anda adalah pengguna akun, silahkan masukkan password</p>
                @if (Route::has('password.request'))
                    <div class="flex">
                        <p class="text-sm rounded-md mr-1">Lupa Password? </p>
                        <a class="underline text-sm text-sky-500 hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Klik di sini') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
        {{-- END Keterangan --}}
        <div class="flex text-zinc-50">
            {{-- Tombol Save --}}
            <div class="flex items-center gap-4 pr-3">
                <Button class="bg-blue-600 py-2 px-3 font-medium rounded-sm" type="submit">Verifikasi</Button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
            {{-- END Tombol Save --}}
            {{-- Tombol Kembali --}}
            <a href="/profile">
                <Button type="button" class="bg-zinc-500 py-2 px-3 font-medium rounded-sm">Batal</Button>
            </a>
            {{-- END Tombol Kembali --}}
        </div>
    </form>
@endsection
