<!-- Sidebar -->
<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <a href="{{ url('/beranda') }}" class="cursor-pointer">
                <span class="mx-2 text-3xl font-bold text-black font-inter">SIMAMPU</span>
            </a>
        </div>
    </div>

    <br>

    <nav class="mt-2 font-inter">
        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('beranda') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/beranda') }}">
            <i class='bx bxs-home'></i>
            <span class="mx-3">Beranda</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('petani') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/petani') }}">
            <i class='bx bxs-group'></i>
            <span class="mx-3">Petani</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('panen') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/panen') }}">
            <i class='bx bx-line-chart'></i>
            <span class="mx-3">Hasil Panen</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('sawit') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/sawit') }}">
            <i class='bx bx-dollar'></i>
            <span class="mx-3">Harga Sawit</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('angkutan') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/angkutan') }}">
            <i class='bx bxs-truck'></i>
            <span class="mx-3">Angkutan</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('varietas') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/varietas') }}">
            <i class='bx bxs-leaf'></i>
            <span class="mx-3">Jenis Varietas</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('pupuk') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/pupuk') }}">
            <i class='bx bxs-leaf'></i>
            <span class="mx-3">Jenis Pupuk</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('transaksi') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/transaksi') }}">
            <i class='bx bxs-cart'></i>
            <span class="mx-3">Transaksi</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('suratjalan') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/suratjalan') }}">
            <i class='bx bxs-envelope'></i>
            <span class="mx-3">Surat Jalan</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('suratkonfirmasi') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/suratkonfirmasi') }}">
            <i class='bx bxs-envelope'></i>
            <span class="mx-3">Surat Konfirmasi Perusahaan</span>
        </a>

        <!-- <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white {{ Request::is('') ? 'bg-green-400 text-white' : '' }}" href="{{ url('/') }}">
            <i class='bx bxs-log-in-circle'></i>
            <span class="mx-3">Keluar</span>
        </a> -->

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="flex items-center px-6 py-2 mt-2 text-gray-500 hover:bg-green-400 hover:text-white" href="" onclick="event.preventDefault();
                    this.closest('form').submit();">
                <i class='bx bxs-log-in-circle'></i>
                <span class="mx-3">Keluar</span>
            </a>
        </form>
    </nav>
</div>
<!-- End Sidebar -->