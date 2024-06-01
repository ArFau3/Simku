<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Simku</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="assets/css/mains.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'> --}}
</head>

<body>
    @include('akuntansi.layouts.sidebar')
    <div class="lg:w-5/6 lg:float-right border my-1 min-h-screen">
        {{-- SECTION Header --}}
        <div class="bg-white p-3 sm:p-5 flex justify-between">
            <div class="">
                <img src="/assets/logo.png" alt="logo.png"
                    class="object-contain float-left sm:h-full max-h-20 sm:w-20 flex-shrink-0 mr-2">
                <div class="leading-4 float-left pt-3">
                    <h3 class="sm:leading-7 font-bold sm:text-xl">SISTEM INFORMASI AKUNTANSI</h3>
                    <div class="text-xs sm:text-base sm:leading-4">
                        <p>Koperasi Unit Desa (KUD) Tapang Dadap</p>
                        <p>Nomor : 0003967//BH/M.KUKM.2/IV/2017</p>
                    </div>
                </div>
            </div>
            <img src="/assets/logo-sekadau.png" alt="logo-sekadau.png"
                class="object-contain float-right h-5/6 sm:h-full w-20 mr-2">
        </div>
        {{-- END SECTION Header --}}
        {{-- SECTION Time --}}
        <div class="container min-w-full py-1 border-2 text-sm border-slate-300 bg-zinc-300 pr-3 flex justify-end">
            <p>Tapang Dadap -
                {{ \Carbon\Carbon::now()->isoFormat('dddd, ') }}
            <div class="px-1 text-sm" id="clock"></div> WIB
            </p>
        </div>
        {{-- END SECTION Time --}}
        {{-- SECTION Body --}}
        <div class="min-h-screen">
            <div class="pt-3 px-2">
                <div class="rounded-lg bg-zinc-200 px-4 py-6">
                    <h1 class="text-2xl font-bold mb-4">{{ $judul }}</h1>
                    <div class="bg-zinc-50 p-3 rounded">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        {{-- END SECTION Body --}}
        {{-- SECTION Footer --}}
        <div class="container min-w-full -mt-2 self-end py-1 border border-slate-400 bg-zinc-300">
            <p class="text-center text-sm">Copyright &copy; Koperasi Sekadau 2023</p>
        </div>
        {{-- END SECTION Footer --}}
    </div>
</body>

</html>
<script type="text/javascript">
    // Jam Digital
    // Calling showTime function at every second
    setInterval(showTime, 1000);

    // Defining showTime funcion
    function showTime() {
        // Getting current time and date
        let time = new Date();
        let hour = time.getHours();
        let min = time.getMinutes();
        let sec = time.getSeconds();
        am_pm = "AM";

        // Setting time for 12 Hrs format
        if (hour >= 12) {
            if (hour > 12) hour -= 12;
            am_pm = "PM";
        } else if (hour == 0) {
            hr = 12;
            am_pm = "AM";
        }

        hour =
            hour < 10 ? "0" + hour : hour;
        min = min < 10 ? "0" + min : min;
        sec = sec < 10 ? "0" + sec : sec;

        let currentTime =
            hour +
            ":" +
            min +
            ":" +
            sec +
            am_pm;

        // Displaying the time
        document.getElementById(
            "clock"
        ).innerHTML = currentTime;
    }

    showTime();
    // END Jam Digital
    // Atur field tanggal akhir filter tanggal
    if (document.getElementById('akhir')) {
        document.getElementById('akhir').valueAsDate = new Date();
    }
    // END Atur field tanggal akhir filter tanggal
    // DROPDOWN SIDEBAR
    let menu1 = document.getElementById("menu1");
    const showMenu1 = (flag) => {
        if (flag) {
            icon1.classList.toggle("rotate-180");
            menuHeader1.classList.toggle("text-indigo-400")
            menu1.classList.toggle("hidden");
        }
    };
    let menu2 = document.getElementById("menu2");
    const showMenu2 = (flag) => {
        if (flag) {

            icon2.classList.toggle("rotate-180");
            menuHeader2.classList.toggle("text-indigo-400")
            menu2.classList.toggle("hidden");
        }
    };
    // END DROPDOWN SIDEBAR
    //CURRENCY FORMATTER
    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") {
            return;
        }

        // original length
        var original_len = input_val.length;

        // initial caret position 
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(",") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(",");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = "Rp " + left_side + "," + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = "Rp " + input_val;

            // final formatting
            if (blur === "blur") {
                input_val += ",00";
            }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
    //END CURRENCY FORMATTER
    //NOMOR REKENING MAKER
    @if ($title == 'Rekening')
        var induks = {!! $rekening_json->toJson() !!}
        $('#rekening_induk').change(function() {
            formatRekening($(this));
        });

        function formatRekening(input) {
            // get input value from rekening_induk field
            var input_id = input.val();
            console.log("id: " + input_id);
            // don't validate empty input
            if (input_id === "") {
                return;
            }

            // Ambil data dengan awalan sesuai input 
            // ambil nomor induk berdasarkan id induk dari form rekening_induk
            var nomor_induk = 0
            induks.forEach(i => {
                if (i['rekening_id'] == input_id) {
                    nomor_induk = i['nomor']
                }
            });
            console.log("nomor induk: " + nomor_induk);
            // rangkai aturan untuk match()
            // output === string, jadi perlu diconvert lagi ke executable js code
            var filter = "/^" + nomor_induk + ".*/"
            // tempat simpan
            var anak_induk = []
            // looping untuk cek data satu persatu
            // hanya ambil dengan bagian akhir e.g. 4 == [4, 4.5, 4.16.5]
            // ==! [1.4, 1.16.4] 
            induks.forEach(i => {
                if (i['nomor'].match(eval(filter))) {
                    // potong nomor induk bagian depan
                    var anak_pertama = i['nomor'].indexOf(nomor_induk) + nomor_induk.length + 1;
                    anak_induk.push(i['nomor'].substring(anak_pertama))
                }
            });
            console.log("anak induk: " + anak_induk);
            // potong bagian belakang/cucu nya
            var anak = []
            anak_induk.forEach(j => {
                // pastikan ada nomor/(karena nomor induk = urutan petama & tetap ada, jadi perlu dihapus)
                if (j !== '') {
                    // pastikan ada anak, jika tidak langsung push
                    if (j.indexOf(".") >= 0) {
                        var anak_kedua = j.indexOf(".");
                        anak.push(parseInt(j.substring(0, anak_kedua)))
                    } else {
                        anak.push(parseInt(j))
                    }
                }
            })
            console.log("anak: " + anak);
            // sort var anak
            anak.sort(function(a, b) {
                return a - b;
            });
            console.log("anak sort: " + anak);
            // Buat unique
            anak = [...new Set(anak)];
            console.log("anak unique: " + anak);
            // ambil nilai terendah kosong pertama dari 1 - n
            var nomor_anak
            for (let n = 1; n < 100; n++) {

                if (anak[n - 1] !== n) {
                    nomor_anak = n
                    break
                }
            }
            console.log("nomor anak: " + nomor_anak);
            // Gabung nomor induk dan anak
            var nomor_rekening = nomor_induk + "." + nomor_anak
            console.log("nomor induk: " + nomor_rekening);
            // kirim ke form di kolom nomor rekening
            $("input[data-type='nomor_rekening']").val(nomor_rekening);
        }
    @endif
    //END NOMOR REKENING MAKER
</script>
