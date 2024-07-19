@extends('akuntansi.layouts.layout')

@section('content')
    {{-- HACK: pakai? --}}
    {{-- TODO: buat UI --}}
    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}
    <div class="py-2">
        <div class="m-3"><img class="rounded" src="https://placehold.co/300x200" alt=""></div>
        <form method="post" action="" class="mt-6 space-y-6">
            @csrf
            <div class="sm:flex sm:justify-between sm:self-start">
                {{-- Password --}}
                <div class="mx-2 w-full md:w-3/12">
                    <div>
                        <x-input-label for="no_hp" :value="__('Nomor Telepon Baru: ')" />
                        <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 w-full" :value="old('no_hp')"
                            placeholder="Masukkan nomor telepon baru" />
                        <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                    </div>
                </div>
                {{-- END Password --}}
            </div>
            {{-- Keterangan --}}
            <div class="mx-2 mb-5">
                <div class="block mt-4">
                    <p class="text-sm font-semibold">Pastikan nomor telepon baru yang Anda masukkan aktif.</p>
                </div>
            </div>
            {{-- END Keterangan --}}
            <div class="flex text-zinc-50 md:px-0 px-2">
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
    </div>
@endsection
