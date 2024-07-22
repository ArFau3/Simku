{{-- SECTION SIDEBAR --}}
{{-- FIXME: add icon --}}
{{-- FIXME: toggle side in hp --}}
{{-- FIXME: rapikan viewport < --}}
<div class="lg:float-left lg:fixed overflow-y-auto lg:w-1/6 bg-zinc-800 lg:translate-x-0 lg:inset-0">
    {{-- SECTION card profile --}}
    <a href="/profile">
        <div class="items-center justify-center mt-8">
            <section class="flex w-5/6 mx-auto bg-zinc-700 rounded-2xl px-3 py-4 shadow-lg">
                <div class="flex-shrink-0 lg:w-3/6 float-left pr-3">
                    <img src="https://api.lorem.space/image/face?w=120&h=120&hash=bart89fe" class="rounded-lg "
                        alt="profile picture" srcset="">
                </div>

                <div class="pr-3 text-white -ml-1">
                    <h3 class="text-2xl pb-0.5 lg:text-base font-bold underline lg:no-underline">
                        {{ $user->getRoles() ? ucwords($user->getRoles()[0]) : 'User' }}
                    </h3>
                    <p class="text-xl lg:text-sm">{{ $user->nama_lengkap }}</p>
                </div>
            </section>
        </div>
    </a>
    {{-- END SECTION card profile --}}
    <p class="px-5 pt-6 text-zinc-200">Menu</p>
    <div class="mx-auto lg:w-5/6 mb-2 bg-zinc-200 h-[1px]"></div>
    {{-- SECTION Nav --}}
    <nav>
        {{-- LINK Beranda --}}
        <a class="flex items-center px-4 py-2 mt-4 text-gray-500 {{ $title === 'Beranda' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
            href="/dashboard">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>
            <span class="mx-3">Beranda</span>
        </a>
        {{-- END LINK Beranda --}}
        {{-- LINK Pengaturan --}}
        {{-- FIXME: buat sistem --}}
        {{-- TODO: Role mgmt --}}
        <div class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="/elements">
            <div class="w-full">
                <button id="menuHeader1" onclick="showMenu1(true)"
                    class="{{ $title === 'Koperasi' || $title === 'Akuntan' ? '!text-indigo-400' : '' }} focus:outline-none text-left flex justify-between items-center w-full ">
                    <div><svg class="w-6 h-6 float-left" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                        </svg>
                        <p class="mx-3 text-sm leading-5 float-left uppercase">Pengaturan</p>
                    </div>
                    <svg id="icon1"
                        class="{{ $title === 'Koperasi' || $title === 'Akuntan' ? '' : 'rotate-180' }} transform  float-right"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div id="menu1"
                    class="{{ $title === 'Koperasi' || $title === 'Akuntan' ? '' : 'hidden' }} flex justify-start  flex-col w-full md:w-auto items-start pb-1 ">
                    <a href="/pengaturan-koperasi"
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Koperasi' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg class="fill-stroke" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 ">Koperasi</p>
                        </button>
                    </a>
                    <a href="/pengaturan-akuntan"
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Akuntan' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4">Akuntan</p>
                        </button>
                    </a>
                    <div class="mx-auto lg:w-5/6 mt-2 bg-gray-600 h-[1px]"></div>
                </div>
            </div>
        </div>
        {{-- END LINK Pengaturan --}}
        {{-- LINK Pencatatan --}}
        <div class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="/elements">
            <div class="w-full">
                <button id="menuHeader2" onclick="showMenu2(true)"
                    class="{{ $title === 'Rekening' || $title === 'Transaksi' || $title === 'Tutup Buku' ? '!text-indigo-400' : '' }} focus:outline-none text-left flex justify-between items-center w-full ">
                    <div><svg class="w-6 h-6 float-left" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                        </svg>
                        <p class="mx-3 text-sm leading-5 float-left uppercase">Pencatatan</p>
                    </div>
                    <svg id="icon2"
                        class="{{ $title === 'Rekening' || $title === 'Transaksi' || $title === 'Tutup Buku' ? '' : 'rotate-180' }} transform  float-right"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div id="menu2"
                    class="{{ $title === 'Rekening' || $title === 'Transaksi' || $title === 'Tutup Buku' ? '' : 'hidden' }} flex justify-start  flex-col w-full md:w-auto items-start pb-1 ">
                    <a href="/rekening"
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Rekening' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg class="fill-stroke" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Rekening</p>
                        </button>
                    </a>
                    <a href="/transaksi"
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Transaksi' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Transaksi</p>
                        </button>
                    </a>
                    <a href="/tutup-buku" {{-- TODO: buat rvc --}}
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Tutup Buku' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Tutup Buku</p>
                        </button>
                    </a>
                    <div class="mx-auto lg:w-5/6 mt-2 bg-gray-600 h-[1px]"></div>
                </div>
            </div>
        </div>
        {{-- END LINK Pencatatan --}}
        {{-- LINK Inventaris --}}
        <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ $title === 'Aset Tetap' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
            href="/inventaris">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span class="mx-3">Aset Tetap</span>
        </a>
        {{-- END LINK Inventaris --}}
        {{-- LINK Laporan --}}
        <div class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="/elements">
            <div class="w-full">
                <button id="menuHeader3" onclick="showMenu3(true)"
                    class="{{ $title === 'Jurnal Umum' || $title === 'Buku Besar' || $title === 'Laba Rugi' || $title === 'Neraca' || $title === 'Arus Kas' || $title === 'Perubahan Modal' || $title === 'Penjualan TBS' ? '!text-indigo-400' : '' }} focus:outline-none text-left flex justify-between items-center w-full  ">
                    <div><svg class="w-6 h-6 float-left" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                        </svg>
                        <p class="mx-3 text-sm leading-5 float-left uppercase">Laporan</p>
                    </div>
                    <svg id="icon3"
                        class="{{ $title === 'Jurnal Umum' || $title === 'Buku Besar' || $title === 'Laba Rugi' || $title === 'Neraca' || $title === 'Arus Kas' || $title === 'Perubahan Modal' || $title === 'Penjualan TBS' ? '' : 'rotate-180' }} transform  float-right"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div id="menu3"
                    class="{{ $title === 'Jurnal Umum' || $title === 'Buku Besar' || $title === 'Laba Rugi' || $title === 'Neraca' || $title === 'Arus Kas' || $title === 'Perubahan Modal' || $title === 'Penjualan TBS' ? '' : 'hidden' }}  flex justify-start  flex-col w-full md:w-auto items-start pb-1 ">
                    <a href="/jurnal-umum"
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Jurnal Umum' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg class="fill-stroke" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Jurnal Umum</p>
                        </button>
                    </a>
                    <a href="/buku-besar"
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Buku Besar' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Buku Besar</p>
                        </button>
                    </a>
                    <a href="/laba-rugi"
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Laba Rugi' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg class="fill-stroke" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Laba Rugi</p>
                        </button>
                    </a>
                    <a href="/neraca"
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Neraca' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Neraca</p>
                        </button>
                    </a>
                    <a href="/arus-kas" {{-- TODO: buat rvc --}}
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Arus Kas' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Arus Kas</p>
                        </button>
                    </a>
                    <a href="/perubahan-modal" {{-- FIXME: perbaiki UI --}}
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Perubahan Modal' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-7 px-3 py-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Perubahan Modal</p>
                        </button>
                    </a>
                    <a href="/penjualan-tbs" {{-- TODO: buat rvc --}}
                        class="w-full hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded {{ $title === 'Penjualan TBS' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <button class="flex justify-start items-center space-x-6 px-3 py-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-base leading-4 text-left">Penjualan TBS</p>
                        </button>
                    </a>
                    <div class="mx-auto lg:w-5/6 mt-2 bg-gray-600 h-[1px]"></div>
                </div>
            </div>
        </div>
        {{-- END LINK Laporan --}}
        {{-- LINK Grafik --}}
        {{-- TODO: buat rvc --}}
        <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ $title === 'Grafik' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
            href="/grafik">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>

            <span class="mx-3">Grafik</span>
        </a>
        {{-- END LINK Grafik --}}
        {{-- LINK Aktivitas --}}
        <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ $title === 'Aktivitas' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
            href="/aktivitas">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>

            <span class="mx-3">Aktivitas</span>
        </a>
        {{-- END LINK Aktivitas --}}
        {{-- LINK Logout --}}
        <form method="POST" action="/logout">
            @csrf
            <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                href="" onclick="event.preventDefault();
                    this.closest('form').submit();">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>

                <span class="mx-3">Keluar</span>
            </a>
        </form>
        {{-- END LINK Logout --}}
    </nav>
    {{-- END SECTION Nav --}}
</div>
{{-- END SECTION SIDEBAR --}}
