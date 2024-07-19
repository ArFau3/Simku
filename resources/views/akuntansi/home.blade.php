@extends('akuntansi.layouts.layout')

@section('content')
    <div class="mb-3">
        <p class="italic text-zinc-600 text-lg">Selamat datang di Sistem Informasi Akuntansi Koperasi Perkebunan Tapang Dadap
        </p>
    </div>

    {{-- <br> --}}
    <hr class="border-b border-zinc-700">
    <div class="mx-5 my-1">
        <p class="font-bold text-zinc-600 text-lg">Total Kas</p>
        <p class="font-semibold text-zinc-800 text-5xl my-1">{{ Number::currency($kas->sum('nominal'), 'IDR', 'id') }}</p>
        <p class="font-bold text-zinc-700 text-xs my-3" id="akhir">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    </div>
    <hr class="border-b border-zinc-700">
    <div>
        <h1 class="font-bold text-3xl text-red-600">Ini Punya Ridwan :</h1>
        <p class="text-xl">This is my Arib body content.</p>
    </div>
    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit vitae aliquid consequatur cupiditate nihil earum optio
    eveniet harum minus nostrum omnis ut eum, suscipit doloribus modi commodi numquam dicta similique. Minima doloremque nam
    accusamus repellat. Architecto, ea expedita laudantium quod ratione minus vel nisi perspiciatis tempore impedit dolore
    omnis tempora deserunt repudiandae rerum a error, consequatur nihil laboriosam! Sequi fugit beatae, voluptas obcaecati
    ad recusandae earum eos id! Repellendus molestiae quas eius saepe, quaerat itaque amet eveniet ipsam ut laborum odit?
    Quos voluptatibus enim earum eaque placeat animi debitis eveniet sunt maiores aut consequuntur, officiis quod possimus
    culpa tempora temporibus amet ipsa ducimus odio esse quo sit ut nihil. Eius quis repellat ducimus odio accusantium, est
    ipsum sunt assumenda quam id, repellendus impedit, facilis sequi iusto? Temporibus eaque eos sapiente molestiae
    recusandae exercitationem doloremque voluptates esse consequatur, error, inventore vitae quibusdam eius a quod explicabo
    nobis illo quia culpa? Suscipit esse eveniet consectetur itaque officia non quia necessitatibus explicabo distinctio
    perferendis, dolore animi nisi voluptatibus facere magni quis possimus dolorem architecto quibusdam earum soluta
    aspernatur iusto qui nesciunt? Nihil consequatur animi impedit consequuntur atque eligendi totam quos tempore neque, ut
    exercitationem id iure reiciendis aut similique distinctio laborum numquam ad dolor debitis eum quibusdam. Sit sequi,
    molestias voluptates facilis assumenda nemo nulla cumque optio veritatis perspiciatis, architecto consequatur ex
    consequuntur dolorum numquam alias ipsum ipsam pariatur, voluptas laborum nostrum hic corrupti! Nemo eligendi quos
    cumque numquam magni ratione adipisci ex, labore nam consequuntur hic odit est error ipsam, illum at praesentium
    corporis libero dolor cupiditate laboriosam doloremque? Expedita ipsam eum amet autem ratione eligendi accusantium. Et
    aliquid, a officiis odit exercitationem, placeat voluptatum fuga quam esse commodi dolorem architecto sequi quas dolorum
    eveniet quaerat dolores blanditiis pariatur? Sint magnam dolorum dolorem, culpa enim unde quaerat quibusdam quas rerum
    earum corporis aspernatur ratione sapiente, facilis quidem dolore nihil aliquam repellat voluptatibus, laboriosam
    commodi libero hic! Numquam harum tempore modi placeat nulla id, sequi vero nesciunt nobis ratione rem commodi minima
    deleniti distinctio fugiat accusamus impedit. Eos est cumque quibusdam adipisci esse! Reiciendis doloremque
    necessitatibus, ipsum consequatur quis delectus non debitis earum voluptatibus consequuntur provident sint consectetur
    totam sequi sed. Ut excepturi corrupti obcaecati aut quam beatae et atque dolore neque numquam, laborum ipsam reiciendis
    maxime! Nisi eius error corporis, vel at minima? Unde suscipit ducimus, eos inventore dolor ea magnam quidem ipsum,
    corporis quia similique dicta maxime harum odit officia rerum temporibus nulla eius quas nemo distinctio magni
    necessitatibus facilis sapiente. Quas deserunt nisi incidunt. Voluptatem quibusdam excepturi possimus non culpa officia
    illum quo atque iste est! Harum accusamus perspiciatis nihil? Sunt, laboriosam repellat tempora officiis deleniti
    laborum a perferendis ex distinctio suscipit modi quos! Alias, sapiente nemo. Vel quisquam inventore laudantium soluta,
    possimus velit quidem omnis, iusto recusandae deserunt unde! Dolor earum esse culpa ratione incidunt, minus ipsa
    possimus enim ab quia nam porro aliquam adipisci ducimus rerum doloribus a pariatur asperiores iusto quas et natus
    dolorem? Qui modi eum sequi dolore. Asperiores quos praesentium commodi temporibus quo architecto perferendis.
@endsection
