@extends('akuntansi.layouts.layout')

@section('content')
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="sm:flex sm:justify-between sm:self-start">
            {{-- Bagian Foto --}}
            <img src="https://placehold.co/200" class="rounded-lg self-start" alt="profile picture" srcset="">
            {{-- END Bagian Foto --}}
            {{-- Informasi Diri --}}
            <section class="w-2/6">
                {{-- Nama --}}
                <div class="mb-5">
                    <x-input-label for="name" :value="__('Nama: ')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->nama_lengkap)"
                        required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                {{-- END Nama --}}
                {{-- Alamat --}}
                <div class="mb-5">
                    <x-input-label for="alamat" :value="__('Alamat: ')" />
                    <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full"
                        :value="old('alamat', $user->alamat)" />
                    <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                </div>
                {{-- END Alamat --}}
                {{-- No. Hp --}}
                <div class="mb-5">
                    <x-input-label for="no_hp" :value="__('Nomor Telepon: ')" />
                    <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full"
                        :value="old('no_hp', $user->no_hp)" />
                    <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                    <a href="/">
                        <button type="button"
                            class="bg-amber-400 opacity-85 p-2 mt-2 rounded-sm font-medium text-sm lg:text-base antialiased inline-block w-11/12">Ubah
                            Nomor
                            Telepon</button>
                    </a>
                    <a href="/">
                        <button type="button"
                            class="bg-amber-400 opacity-85 p-2 mt-2 rounded-sm font-medium text-sm lg:text-base antialiased inline-block w-11/12">Tambah
                            Nomor Pemulihan</button>
                    </a>
                </div>
                {{-- END No. Hp --}}
                {{-- Password --}}
                <div class="mt-10 mb-5">
                    <div>
                        <x-input-label for="update_password_password" :value="__('Password Baru')" />
                        <x-text-input id="update_password_password" name="password" type="password"
                            class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password Baru')" />
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                            type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                {{-- END Password --}}
            </section>
            {{-- END Informasi Diri --}}
            {{-- Data Koperasi --}}
            <section class="w-2/6">
                {{-- Nama Koperasi --}}
                <div class="mb-5">
                    <x-input-label for="koperasi" :value="__('Koperasi: ')" />
                    <x-text-input id="koperasi" disabled name="koperasi" type="text" class="mt-1 block w-full"
                        value="{{ $user->koperasi }}" />{{-- ->nama --}}
                    <x-input-error class="mt-2" :messages="$errors->get('koperasi')" />
                </div>
                {{-- END Nama Koperasi --}}
                {{-- Jabatan --}}
                <div class="mb-5">
                    <x-input-label for="jabatan" :value="__('Jabatan: ')" />
                    <x-text-input id="jabatan" disabled name="jabatan" type="text" class="mt-1 block w-full"
                        value="{{ $user->jabatan }}" />{{-- ->nama --}}
                    <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
                </div>
                {{-- END Jabatan --}}
            </section>
            {{-- END Data Koperasi --}}
        </div>
        <div class="flex">
            {{-- Tombol Save --}}
            <div class="flex items-center gap-4 pr-3">
                <Button class="bg-blue-600 py-2 px-3 font-medium rounded-sm text-zinc-50" type="submit">Simpan</Button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
            {{-- END Tombol Save --}}
            {{-- Tombol Kembali --}}
            <a href="/dashboard">
                <Button type="button" class="bg-zinc-500 py-2 px-3 font-medium rounded-sm text-zinc-50">Kembali</Button>
            </a>
            {{-- END Tombol Kembali --}}
        </div>
    </form>
@endsection
