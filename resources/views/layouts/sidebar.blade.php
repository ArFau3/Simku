{{-- SECTION SIDEBAR --}}
<div class="lg:float-left lg:fixed overflow-y-auto lg:w-1/6 bg-zinc-800 lg:translate-x-0 lg:inset-0">
    {{-- SECTION card profile --}}
    <div class="items-center justify-center mt-8">
        <section class="flex lg:justify-between w-5/6 mx-auto bg-zinc-700 rounded-2xl px-3 py-4 shadow-lg">
            <div class="flex-shrink-0 lg:w-3/6 float-left pr-3">
                <img src="https://api.lorem.space/image/face?w=120&h=120&hash=bart89fe" class="rounded-lg "
                    alt="profile picture" srcset="">
            </div>

            <div class="pr-3 text-white -ml-1">
                <h3 class="text-2xl pb-0.5 lg:text-base font-bold ">
                    <?php //($user->getRoles()) ? print ucwords($user->getRoles()[0]) : print 'User';
                    ?>
                    {{ $user->getRoles() ? ucwords($user->getRoles()[0]) : 'User' }}
                </h3>
                <p class="text-xl lg:text-sm">{{ $user->nama_lengkap }}</p>
            </div>
        </section>
    </div>
    {{-- END SECTION card profile --}}
    {{-- SECTION line divider --}}
    <p class="px-5 pt-6 text-gray-600">Menu</p>
    <div class="mx-auto lg:w-5/6 mb-2 bg-gray-600 h-[1px]"></div>
    {{-- END SECTION line divider --}}
    {{-- SECTION Nav --}}
    <nav>
        <a class="flex items-center px-4 py-2 mt-4 text-gray-500 {{ $title === 'Dashboard' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
            href="/elements">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>
            <span class="mx-3">Dashboard</span>
        </a>

        <div class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="/elements">
            <div class="w-full">
                <button id="menuHeader1" onclick="showMenu1(true)"
                    class="focus:outline-none text-left flex justify-between items-center w-full">
                    <div><svg class="w-6 h-6 float-left" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                        </svg>
                        <p class="mx-3 text-sm leading-5 float-left uppercase">Pencatatan</p>
                    </div>
                    <svg id="icon1" class="transform rotate-180 float-right" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div id="menu1" class="hidden flex justify-start  flex-col w-full md:w-auto items-start pb-1 ">
                    <button
                        class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full {{ $title === 'Rekening' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <svg class="fill-stroke" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4 ">Rekening</p>
                    </button>
                    <button
                        class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full {{ $title === 'Transaksi' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4">Transaksi</p>
                    </button>
                </div>
            </div>
        </div>

        <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ $title === 'Inventaris' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
            href="/tables">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span class="mx-3">Inventaris</span>
        </a>

        <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ $title === 'Kas' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
            href="/forms">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>

            <span class="mx-3">Kas</span>
        </a>

        <div class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="/elements">


            <div class="w-full">
                <button id="menuHeader2" onclick="showMenu2(true)"
                    class="focus:outline-none text-left flex justify-between items-center w-full  ">
                    <div><svg class="w-6 h-6 float-left" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                        </svg>
                        <p class="mx-3 text-sm leading-5 float-left uppercase">Laporan</p>
                    </div>
                    <svg id="icon2" class="transform rotate-180 float-right" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div id="menu2" class="hidden flex justify-start  flex-col w-full md:w-auto items-start pb-1 ">
                    <button
                        class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full {{ $title === 'Jurnal Umum' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <svg class="fill-stroke" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4">Jurnal Umum</p>
                    </button>
                    <button
                        class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full {{ $title === 'Buku Besar' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4  ">Buku Besar</p>
                    </button>
                    <button
                        class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full {{ $title === 'Laba Rugi' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <svg class="fill-stroke" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4  ">Laba Rugi</p>
                    </button>
                    <button
                        class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full {{ $title === 'Neraca' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4  ">Neraca</p>
                    </button>
                    <button
                        class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full {{ $title === 'Arus Kas' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <svg class="fill-stroke" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4  ">Arus Kas</p>
                    </button>
                    <button
                        class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full {{ $title === 'Penjualan TBS' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4  ">Penjualan TBS</p>
                    </button>

                </div>
            </div>


        </div>
        <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ $title === 'Grafik' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
            href="/forms">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>

            <span class="mx-3">Grafik</span>
            <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ $title === 'Aktivitas' ? '!text-gray-100 bg-gray-700 bg-opacity-75' : '' }}"
                href="/forms">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>

                <span class="mx-3">Aktivitas</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="flex items-center px-4 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href=""
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>

                    <span class="mx-3">Keluar</span>
                </a>
            </form>
        </a>
    </nav>
    {{-- SECTION Nav --}}
</div>
{{-- END SECTION SIDEBAR --}}
