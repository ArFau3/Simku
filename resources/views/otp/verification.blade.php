@extends('auth.akuntansi.layout')

@section('content')
    <div class="card-header">{{ __('OTP Login') }}</div>

    <div class="card-body w-full lg:w-2/6 p-5">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert"> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.getlogin') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}" />
            <!-- Kode OTP -->
            {{-- FIXME: masih ada debug label kode OTP karne ablm ada sistem untuk kirim --}}
            <div class="flex justify-center">
                <input id="otp" type="text"
                    class="form-control @error('otp') is-invalid @enderror rounded-none text-zinc-800 font-medium"
                    name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus
                    placeholder="Enter OTP">

                @error('otp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- END Kode OTP -->
            <div class="my-7"></div>
            {{-- Button --}}
            <div class="flex items-center justify-center">
                <button class="bg-yellow-500 py-2 px-5 text-zinc-800 hover:bg-lime-700 rounded-sm font-bold"
                    type="submit">Masuk</button>
            </div>
            {{-- END Button --}}
        </form>
    </div>
@endsection
