@extends('user.layout.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Sejarah Nagari Guguak Malalo</h2>

            <div class="row align-items-center"> {{-- align-items-center untuk menengahkan konten secara vertikal --}}
                <div class="col-lg-4 col-md-5 mb-4 mb-md-0 d-flex justify-content-center"> {{-- Flexbox untuk memusatkan gambar di tengah kolom --}}
                    <img src="{{ asset('images/logo_nagari.png') }}" alt="Logo Nagari Guguak Malalo" class="img-fluid" style="max-width: 250px;"> {{-- max-width untuk kontrol ukuran --}}
                </div>

                <div class="col-lg-8 col-md-7">
                    <p class="mb-4">
                        Nagari Guguak Malalo adalah salah satu nagari adat yang kaya akan sejarah dan budaya di Kabupaten Tanah Datar, Sumatera Barat. Berlokasi strategis di lereng Bukit Barisan, nagari ini telah menjadi saksi bisu perjalanan waktu dan perkembangan peradaban masyarakat Minangkabau.
                        Sejak dahulu kala, Guguak Malalo dikenal sebagai daerah agraris yang subur, dengan mayoritas penduduknya berprofesi sebagai petani. Kehidupan sosial masyarakatnya sangat erat kaitannya dengan nilai-nilai adat dan agama, di mana "Adat Basandi Syarak, Syarak Basandi Kitabullah" menjadi landasan utama dalam setiap sendi kehidupan. Berbagai tradisi dan upacara adat masih terus dilestarikan hingga kini, menunjukkan kuatnya akar budaya yang diwarisi dari nenek moyang.
                    </p>
                </div>
                <div class="mt-4">
                    <p class="mb-4">
                        Penduduk asli Nagari Guguak Malalo berasal dari Nagari Pariangan, menurut sejarah yang diterima yang mana ada 13 keluarga yang membangkang atau tidak mau patuh kepada raja akan tetapi mereka terkenal dengan keberaniannya, karena ketidak patuhannya kepada raja mereka dibuang ke Luhak Agam (Kampuang tigo baleh), setelah tidak memungkinkan untuk menetap akhirnya mereka pindah ke Solok dan berkembang biak hingga membentuk sebuah perkampungan (Kampuang Kubuang tigo baleh). 
                        Semenjak ke 13 keluarga tersebut dibuang dari Nagari Pariangan, semenjak itu pula di Nagari Pariangan tadi terjadi kekacauan, dimana perampokan, pembunuhan dan kejahatan lainnya merajalela hingga keamanan dan ketentraman tidak lagi terjaga dan terpelihara. 
                    </p>
                    <p class="mb-4">
                        Akhirnya sang raja bermusyawarah dengan ninik mamak dan segenap tokoh masyarakat dengan kesepakatan untuk memanggil dan menjemput kembali ke 13 keluarga yang telah dibuang tadi, karena pada saat itu mereka lah yang menjaga keamanan dan ketentraman masyarakat Nagari Pariangan dengan keberanian mereka.
                        Ke 13 keluarga tersebut mau kembali ke Nagari Pariangan tapi mereka mengajukan beberapa persyaratan kepada sang raja. Syarat-syarat tersebut antara lain :
                        -	Mereka tidak akan membungkukan dan menundukan badan bila bertemu, berhadapan dan berbicara dengan sang raja.
                        -	Bebaskan mereka untuk mencari daerah pertanian diwilayah sekitar Danau Singkarak.
                        -	Mereka tidak akan memperhambakan diri bila berbicara dengan sang raja, bahkan mereka akan menyebut diri mereka dengan sebutan “DEN”
                    </p>
                    <p class="mb-4">
                        Dan sang raja pun akhirnya memenuhi semua persyaratan yang diajukan oleh ke tiga belas keluarga tersebut, akhirnya mereka kembali ke Nagari Pariangan dan mulai menciptakan keamanan dan ketentraman di Nagari Pariangan. Setelah Nagari Pariangan telah damai dan tentram, maka ke tiga belas keluarga tersebut mulai mencari daerah garapan pertanian seperti tuntutan mereka semula. Singkat cerita akhirnya mereka menetap di wilayah barat Danau Singkarak atau yang sekarang dikenal dengan nama Malalo.
                    </p>
                    <p class="mb-4">
                        Malalo sebelum dibagi dua Nagari adalah kelarasan yang berada di bawah kepemimpinan seorang Lareh yaitu dipimpin oleh Dt. Panjang. Sistem kelarasan di Malalo terbagi kepada tiga jurai sesuai dengan kawasan dan pola pemakaian adat istiadatnya yaitu Jurai Padang Laweh, Jurai Tanjung Sawah dan Jurai Guguak. Jurai Guguak dipimpin oleh Dt. Rajo Malano dan terbagi menjadi tiga koto yaitu koto Dimudik, koto Ditenggah dan koto Diilie. Koto Dimudik dipimpin oleh panghulu pucuk Dt. Marajo dan terbagi menjadi 
                        empat suku yaitu suku Pauh, Baringin Gadang, Simaong dan Galapuang. Koto Ditenggah dipimpin oleh panghulu pucuk Dt. Rajo Malano dan terbagi menjadi tiga suku yaitu suku Baringin Kaciak, Nyiur dan Muaro Basa. Sedangkan koto Diilie dipimpin oleh panghulu pucuk Dt. Panjang dan terbagi menjadi empat suku yaitu suku Ampek Inyiak, suku Tanggah, suku Sapuluh dan suku Koto Pisang. Guguak Malalo disebut juga Lareh Nan Panjang yang merupakan pembauran dari dua kelarasan yakni Bodi Chaniago dan Koto Piliang, 
                        pola kepemimpinan Lareh Nan Panjang dikenal dengan istilah adat “Pisang Sikalek-kalek Hutan, Pisang Tan Batu Nan Bagatah, Samo di Gulai Kaduonyo, Bodi Caniago Inyo Bukan, Koto Piliang Inyo Antah, Samo di Pakai Kaduonyo.
                    </p>
                    <p class="mb-4">
                        Pada sekitar pertenggahan abad ke Delepan Belas penjajahan Belanda berkeinginan menguasai kerajaan minang secara keseluruhan. Untuk memuluskan tujuannya Belanda mencoba membujuk para pemangku adat Malalo ketika itu, tapi usaha tersebut tidak berhasil, karena keinginannya ditolak, Belanda menggancam akan menundukan Malalo dengan cara kekerasan (perang). Karena merasa adanya tindakan pemaksaan kehendak oleh pemerintah Belanda pada saat itu, masyarakat Malalo melakukan perlawanan yang dikenal dengan perang 
                        “Batu Badoro atau Perang Panduang”  yang berlokasi si Panduang Jorong Rumbai sekarang. Perang suci masyarakat Malalo dipimpin oleh seorang ulama yang bernama Djinang yang lebih dikenal dengan gelar Tuangku Limo Puluh dibantu oleh Ninik Mamak, Alim Ulama, Cadiak Pandai serta Pemuda dari ketiga Jurai yang ada di Malalo.
                    </p>
                    <p class="mb-4">
                        Karena Belanda didukung oleh peralatan yang memadai dan personil yang terlatih, maka perang tersebut dimenangkan oleh Belanda, walaupun mengalami kekalahan dalam perang terbuka para pejuang Malalo tetap melakukan perlawanan secara bergerilya. Setelah Belanda berhasil menguasai Malalo maka untuk menghentikan perlawanan masyarakat, Belanda menyiasati perkembangan masyarakat dengan cara membagi Malalo menjadi dua Nagari yaitu Guguak Malalo dan Padang Laweh Malalo. Padang Laweh terdiri dari dua Jurai yakni Jurai Tanjung 
                        Sawah dan Jurai Padang Laweh, sedangkan Guguak terdiri dari Jurai Guguak saja.
                    </p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="profil-nagari" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div> 
    </section>
@endsection