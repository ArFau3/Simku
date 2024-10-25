@extends('auth.akuntansi.layout')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if ($user)
        <p class="text-3xl font-bold mb-4 text-center">Pilih Nomor</p>
        <form method="POST" action="/otp/generate" id="otp">
            @csrf
            <input type="hidden" name="no_hp" data-type='nomor_otp' value="">
            <div class="flex items-center justify-center">
                <button class="bg-yellow-500 py-2 px-5 text-zinc-800 hover:bg-lime-700 rounded-sm font-bold" type="button"
                    onclick='DoSubmit("otp", {!! json_encode($user->no_hp, JSON_HEX_APOS) !!} )'>{{ $user->no_hp }}</button>
            </div>
            @if ($user->no_hp2)
                <div class="flex items-center justify-center">
                    <button class="bg-yellow-500 py-2 px-5 text-zinc-800 hover:bg-lime-700 rounded-sm font-bold"
                        type="button" onclick='DoSubmit("otp", {!! json_encode($user->no_hp2, JSON_HEX_APOS) !!} )'>{{ $user->no_hp2 }}</button>
                </div>
            @endif
        </form>
    @else
        <div class="w-full lg:w-2/6 p-5">
            <p class="text-3xl font-bold mb-4 text-center">Masukkan Nomor</p>
            <form method="POST" action="/otp/generate">
                @csrf
                <!-- no. hp -->
                {{-- FIXME: harusnya hanya no hp --}}
                <div>
                    <x-text-input id="no_hp" class="block p-2 mt-1 w-full rounded-none text-zinc-800 font-medium"
                        placeholder="Masukkan Nomor Telepon" type="text" name="no_hp" :value="old('no_hp')" required
                        autofocus autocomplete="no_hp" />
                    <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                </div>
                <div class="my-7"></div>
                {{-- Button --}}
                <div class="flex items-center justify-center">
                    <button class="bg-yellow-500 py-2 px-5 text-zinc-800 hover:bg-lime-700 rounded-sm font-bold"
                        type="submit">Verifikasi</button>
                </div>
        </div>
        {{-- END Button --}}
        </form>
        </div>
    @endif
@endsection
