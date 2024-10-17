@extends('akuntansi.layouts.layout')

@section('content')
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    {{-- TODO: ganti slug untuk route action --}}
    {{-- SEMENTARA --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- SEMENTARA --}}


    <form method="POST" action="koperasi/update/{{ $user->koperasi->id }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        <div class="sm:flex sm:self-start">
            {{-- Bagian Foto --}}
            <input type="hidden" id="foto_lama" name="foto_lama" value="{{ $user->koperasi->logo }}">
            <div>
                {{-- TODO: prefiew foto & delete changed foto --}}
                <label for="foto" class="hover:cursor-pointer">
                    <img src="{{ $user->koperasi->logo ? asset('storage/' . $user->koperasi->logo) : '' }}" alt="logo.png"
                        class="rounded-lg self-start mx-5 w-44 h-52 object-scale-down img-foto img-preview" srcset="">
                </label>
                <input class="hidden" type="file" id="foto" name="foto" onchange="previewImg()">
            </div>
            {{-- END Bagian Foto --}}
            {{-- Informasi Diri --}}
            <section class="w-2/6">
                {{-- Nama Koperasi --}}
                <div class="mb-5">
                    <x-input-label for="nama" :value="__('Nama Koperasi: ')" />
                    <x-text-input id="nama" name="name" type="text" class="mt-1 block w-full" :value="old('nama', $user->koperasi->nama)"
                        required />
                    <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                </div>
                {{-- END Nama --}}
                {{-- Tahun Berdiri --}}
                <div class="mb-5">
                    <x-input-label for="berdiri" :value="__('Tahun Berdiri: ')" />
                    <x-text-input id="berdiri" name="berdiri" type="date" class="mt-1 block w-full" :value="old('berdiri', $user->koperasi->berdiri)"
                        required />
                    <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                </div>
                {{-- END Tahun Berdiri --}}
                {{-- Alamat --}}
                {{-- TODO: ubah logo --}}
                <div class="mb-5">
                    <x-input-label for="alamat" :value="__('Alamat Koperasi: ')" />
                    <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full"
                        :value="old('alamat', $user->koperasi->alamat)" />
                    <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                </div>
                {{-- END Alamat --}}
                {{-- No. Hp --}}
                <div class="mb-5">
                    <x-input-label for="hukum" :value="__('Nomor Badan Hukum: ')" />
                    <x-text-input id="hukum" name="hukum" type="text" class="mt-1 block w-full"
                        :value="old('hukum', $user->koperasi->hukum)" />
                    <x-input-error class="mt-2" :messages="$errors->get('hukum')" />
                </div>
                {{-- END No. Hp --}}

        </div>
        <div class="flex text-zinc-50">
            {{-- Tombol Save --}}
            <div class="flex items-center gap-4 pr-3">
                <Button class="bg-blue-600 py-2 px-3 font-medium rounded-sm" type="submit">Simpan</Button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
            {{-- END Tombol Save --}}
            {{-- Tombol Kembali --}}
            <a href="/dashboard">
                <Button type="button" class="bg-zinc-500 py-2 px-3 font-medium rounded-sm">Kembali</Button>
            </a>
            {{-- END Tombol Kembali --}}
        </div>
    </form>
@endsection
