<form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">
    @if (request('cari'))
        <input type="hidden" name="cari" value="{{ request('cari') }}">
    @endif
    <input id="awal" type="date" class="h-10 md:mx-1 rounded-sm mt-1 form-input block w-full focus:bg-white"
        id="my-textfield" name="awal" value="{{ request('awal') }}">

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-12 h-7 md:h-12 mx-auto">
        <path fill-rule="evenodd"
            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
    </svg>

    <input id="akhir" type="date" class="h-10 mt-1 rounded-sm md:mx-1 form-input block w-full focus:bg-white"
        id="my-textfield" name="akhir" value="{{ request('akhir') }}">

    <div>
        <button class="bg-amber-400 opacity-85 rounded-sm p-2 mt-1 font-medium text-sm lg:text-base antialiased"
            type="submit">Oke</button>
    </div>
</form>
