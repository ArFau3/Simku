<dialog id="modalTambah" class="h-auto w-11/12 md:w-1/2 p-5  bg-white rounded-md font-inter">
    <div class="flex flex-col w-full h-auto ">
        <!-- Header -->
        <div class="flex w-full h-auto justify-start items-center">
            <div class="flex w-5/6 h-auto py-3 text-xl font-semibold">
                Tambah Data Surat Jalan
            </div>
        </div>

        <!-- Modal Content-->
        <form>
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-black" for="username">Nomor Surat Jalan</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="username">Berat Kotor</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="username">Tanggal Surat Jalan</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="username">Berat Bersih</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="username">Nama Supir</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="passwordConfirmation">Jenis Varietas</label>
                    <select class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                        <option>Varietas A</option>
                        <option>Varietas B</option>
                        <option>Varietas C</option>
                    </select>
                </div>

                <div>
                    <label class="text-black" for="username">Nama Pengirim</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="username">Tahun Tanam</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="emailAddress">Alamat Pengirim</label>
                    <textarea id="emailAddress" type="email" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring"></textarea>
                </div>

                <div>
                    <label class="text-black" for="username">Biaya Angkut</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="emailAddress">Nama Penerima</label>
                    <input id="emailAddress" type="email" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-black" for="emailAddress">Alamat Penerima</label>
                    <textarea id="emailAddress" type="email" class="block w-full px-4 py-2 mt-2 text-black bg-white border border-gray-400 rounded-md focus:border-blue-500 focus:outline-none focus:ring"></textarea>
                </div>

            </div>

            <div class="flex mt-6 justify-end">
                <div class="">
                    <button onclick="document.getElementById('modalTambah').close();" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-500 rounded-md hover:bg-red-800 focus:outline-none focus:bg-gray-600">Batal</button>
                </div>

                <div class="ml-4">
                    <button class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-green-800 focus:outline-none focus:bg-gray-600">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</dialog>