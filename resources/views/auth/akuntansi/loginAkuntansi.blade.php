@extends('auth.akuntansi.layout')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <p class="text-3xl font-bold sm:mt-20 mb-4 text-center">Login</p>
    <div class="text-center text-base mb-6 lg:w-2/6 font-light">
        <p>"Selamat Datang di Sistem Informasi Internal Koperasi Perkebunan Sekadau. Kami Siap Mendukung Transparansi dan
            Pengelolaan Keuangan yang Lebih Baik"</p>
    </div>
    <div class="w-full lg:w-2/6 p-5">
        <form method="POST" action="/akuntansi">
            @csrf

            <!-- no. hp -->
            {{-- FIXME: harusnya hanya no hp --}}
            <div>
                <x-text-input id="no_hp" class="block p-2 mt-1 w-full rounded-none text-zinc-800 font-medium"
                    placeholder="Masukkan Nomor Telepon" type="no_hp" name="no_hp" :value="old('no_hp')" required autofocus
                    autocomplete="no_hp" />
                <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
            </div>

            <!-- Password -->
            {{-- QOL: toggle visibility --}}
            <div class="mt-4">
                <x-text-input id="password" placeholder="Masukkan Password"
                    class="block p-2 mt-1 w-full rounded-none text-zinc-800 font-medium" type="password" name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Lupa Password -->
            {{-- TODO: sistem blm ada --}}
            <div class="block mt-4">
                @if (Route::has('password.request'))
                    <div class="flex">
                        <p class="text-sm rounded-md mr-1">Lupa Password? </p>
                        <a class="underline text-sm text-sky-500 hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="/otp/pilih-nomor">
                            {{ __('Klik di sini') }}
                        </a>
                    </div>
                @endif
            </div>
            <!-- END Lupa Password -->
            <hr class="my-7">
            {{-- Button --}}
            <div class="flex items-center justify-center">
                <button class="bg-yellow-500 py-2 px-5 text-zinc-800 hover:bg-lime-700 rounded-sm font-bold"
                    type="submit">Masuk</button>
            </div>
            {{-- END Button --}}
        </form>
    </div>
    </div>
@endsection
