@props(['year'])
<form action="" id="bandingkan" class="md:flex ml-1 md:mb-0 mb-5">
    <select name="periode" class="h-10 mt-1 md:mx-1 form-select block w-full focus:bg-white" id="my-select"
        onchange='DoSubmit("bandingkan");'>
        @if (!request('periode'))
            <option value="" disabled selected hidden>Bandingkan</option>
        @endif
        @for ($i = 1; $i < 5; $i++)
            <option value="{{ $year - $i }}" {{ request('periode') == $year - $i ? 'selected' : '' }}>
                {{ $i . ' Periode' }}
            </option>
        @endfor
    </select>

</form>
