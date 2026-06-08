<?php

namespace Database\Seeders;

use App\Models\Trip;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catTamanHiburan = Category::where('slug', 'taman-hiburan')->first()->id;
        $catMuseum = Category::where('slug', 'museum')->first()->id;
        $catAlamKebun = Category::where('slug', 'alam-dan-kebun')->first()->id;
        $catKebunBinatang = Category::where('slug', 'kebun-binatang')->first()->id;
        $catRuangPublik = Category::where('slug', 'ruang-publik')->first()->id;

        $trips = [
            [
                'title' => 'Museum Angkut',
                'category_id' => $catMuseum,
                'location' => 'Jl. Terusan Sultan Agung No.2, Ngaglik, Kec. Batu, Kota Batu, Jawa Timur 65314',
                'price' => 100000.00,
                'duration' => '12.00 – 20.00 WIB',
                'description' => 'Museum Angkut merupakan museum transportasi pertama dan terbesar di Asia Tenggara. Menghadirkan koleksi lebih dari 300 kendaraan antik, klasik, hingga modern dari berbagai penjuru dunia, yang dipamerkan dalam zona-zona tematik berlatar belakang sejarah dan budaya unik seperti Zona Hollywood, Zona Eropa, dan Zona Istana Buckingham.',
                'whatsapp_number' => '+62341595007',
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.4588722421375!2d112.5186641757827!3d-7.873210378280622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78873090623a31%3A0xc3676c8c48a7b05d!2sMuseum%20Angkut!5e0!3m2!1sid!2sid!4v1717669145628!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.87321000,
                'longitude' => 112.51866400,
            ],
            [
                'title' => 'Jawa Timur Park 2',
                'category_id' => $catKebunBinatang,
                'location' => 'Jl. Raya Oro-Oro Ombo No.9, Temas, Kec. Batu, Kota Batu, Jawa Timur 65315',
                'price' => 120000.00,
                'duration' => '08.30 – 16.30 WIB',
                'description' => 'Jawa Timur Park 2 (JTP 2) menawarkan konsep wisata edukasi bertaraf internasional yang terdiri dari Batu Secret Zoo (kebun binatang modern dengan konsep interaktif), Museum Satwa (galeri fosil dan diorama hewan purba hingga satwa liar yang diawetkan), dan Eco Green Park. Tempat yang sangat cocok untuk liburan keluarga yang mendidik.',
                'whatsapp_number' => '+623415025777',
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.3540608678225!2d112.52735747578292!3d-7.8841444784151745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78872e42845c47%3A0x8670d97034c44243!2sJatim%20Park%202!5e0!3m2!1sid!2sid!4v1717669223845!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.88414400,
                'longitude' => 112.52735700,
            ],
            [
                'title' => 'Jawa Timur Park 3',
                'category_id' => $catTamanHiburan,
                'location' => 'Jl. Ir. Soekarno No.144, Beji, Kec. Junrejo, Kota Batu, Jawa Timur 65326',
                'price' => 120000.00,
                'duration' => '11.00 – 19.00 WIB',
                'description' => 'Jawa Timur Park 3 (JTP 3) menghadirkan petualangan zaman prasejarah melalui Dino Park, wahana dengan replika dinosaurus berukuran asli yang dapat bergerak dan bersuara. Selain Dino Park, terdapat juga The Legend Star (museum lilin tokoh ternama dunia), Ffun Tech Plaza (pusat permainan interaktif berbasis teknologi tinggi), dan Millennial Glow Garden (taman cahaya multimedia).',
                'whatsapp_number' => '+623415103030',
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.2934177439564!2d112.553926875783!3d-7.890464678491871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78873f1d8ee1c3%3A0xe54fb72a39a6652!2sJatim%20Park%203!5e0!3m2!1sid!2sid!4v1717669312345!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.89046500,
                'longitude' => 112.55392700,
            ],
            [
                'title' => 'Taman Rekreasi Selecta',
                'category_id' => $catAlamKebun,
                'location' => 'Jl. Raya Selecta No.1, Tulungrejo, Kec. Bumiaji, Kota Batu, Jawa Timur 65336',
                'price' => 30000.00,
                'duration' => '07.00 – 17.00 WIB',
                'description' => 'Didirikan sejak masa kolonial Belanda, Taman Rekreasi Selecta terkenal dengan hamparan kebun bunga beraneka warna yang sangat indah, udara pegunungan yang sejuk, dan air kolam renang alami yang jernih langsung dari sumber pegunungan. Wahana tambahan seperti bianglala, sky bike, dan perahu bebek menambah keseruan wisata keluarga ini.',
                'whatsapp_number' => '+62341591025',
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.124578131333!2d112.525624775782!3d-7.8038888774706535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e787df600b3e551%3A0xb36ef8df96dd6294!2sTaman%20Rekreasi%20Selecta!5e0!3m2!1sid!2sid!4v1717669401234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.80388900,
                'longitude' => 112.52562500,
            ],
            [
                'title' => 'Batu Night Spectacular',
                'category_id' => $catTamanHiburan,
                'location' => 'Jl. Hayam Wuruk No.1, Oro-Oro Ombo, Kec. Batu, Kota Batu, Jawa Timur 65316',
                'price' => 90000.00,
                'duration' => '15.00 – 23.00 WIB',
                'description' => 'Batu Night Spectacular (BNS) adalah taman hiburan malam yang menawarkan suasana magis dengan ribuan lampion warna-warni yang indah di Lampion Garden. Selain itu, pengunjung dapat menguji adrenalin di wahana ekstrem seperti Drop Zone dan Tornado, serta menikmati pertunjukan air mancur menari yang menawan di tengah udara sejuk malam kota Batu.',
                'whatsapp_number' => '+623415025111',
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.285897854659!2d112.53229787578306!3d-7.891248078499595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78872c55555555%3A0xc3676c8c48a7b05e!2sBatu%20Night%20Spectacular%20(BNS)!5e0!3m2!1sid!2sid!4v1717669481234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.89124800,
                'longitude' => 112.53229800,
            ],
            [
                'title' => 'Jawa Timur Park 1',
                'category_id' => $catTamanHiburan,
                'location' => 'Jl. Kartika No.2, Sisir, Kec. Batu, Kota Batu, Jawa Timur 65314',
                'price' => 120000.00,
                'duration' => '08.30 – 16.30 WIB',
                'description' => 'Jawa Timur Park 1 memadukan wahana rekreasi seru dengan konsep edukasi budaya Indonesia. Di dalamnya terdapat Galeri Etnik Nusantara yang menyajikan replika pakaian, rumah adat, dan alat musik tradisional Indonesia, Science Center, serta puluhan wahana permainan menegangkan seperti Roller Coaster, Volcano Coaster, dan Waterboom.',
                'whatsapp_number' => null,
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.455437890539!2d112.52243297578278!3d-7.87356817828469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78873090623a31%3A0x6b1db94c3dc2cf4c!2sJatim%20Park%201!5e0!3m2!1sid!2sid!4v1717669551234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.87356800,
                'longitude' => 112.52243300,
            ],
            [
                'title' => 'Predator Fun Park Batu',
                'category_id' => $catTamanHiburan,
                'location' => 'Jl. Raya Tlekung No.315, Junrejo, Kec. Junrejo, Kota Batu, Jawa Timur 65322',
                'price' => 50000.00,
                'duration' => '08.00 – 16.00 WIB',
                'description' => 'Predator Fun Park adalah destinasi wisata edukatif bertema hewan predator seperti buaya, ular, piranha, dan berbagai reptil langka lainnya. Pengunjung dapat melihat secara langsung dari dekat proses pemeliharaan reptil, memberi makan buaya secara aman, serta menikmati wahana bermain air dan taman lampion keluarga yang mendidik dan seru.',
                'whatsapp_number' => '+62341531999',
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.0965251648753!2d112.54146197578326!3d-7.910972278701962!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7880df96dd6295%3A0xc3676c8c48a7b05f!2sPredator%20Fun%20Park!5e0!3m2!1sid!2sid!4v1717669621234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.91097200,
                'longitude' => 112.54146200,
            ],
            [
                'title' => 'Batu Secret Zoo',
                'category_id' => $catKebunBinatang,
                'location' => 'Jl. Raya Oro-Oro Ombo No.9, Temas, Kec. Batu, Kota Batu, Jawa Timur 65315',
                'price' => 120000.00,
                'duration' => '08.00 – 16.00 WIB',
                'description' => 'Bagian utama dari Jatim Park 2, Batu Secret Zoo merupakan kebun binatang modern dengan tata letak kelas dunia. Menampilkan aneka satwa eksotis dari berbagai benua (Afrika, Asia, Amerika Selatan), seperti Harimau Benggala, Singa Putih, jerapah, tapir, lemur, flamingo, dan akuarium raksasa air tawar maupun laut yang dikelola dengan sangat profesional.',
                'whatsapp_number' => null,
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.3540608678225!2d112.52735747578292!3d-7.8841444784151745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78872e42845c47%3A0x8670d97034c44243!2sBatu%20Secret%20Zoo!5e0!3m2!1sid!2sid!4v1717669691234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.88414400,
                'longitude' => 112.52735700,
            ],
            [
                'title' => 'Air Terjun Tumpak Sewu',
                'category_id' => $catAlamKebun,
                'location' => 'Kampung Siji, Jl. Raya Sidomulyo, Besukcukit, Sidomulyo, Pronojiwo, Lumajang',
                'price' => 10000.00,
                'duration' => '07.00 – 15.00 WIB',
                'description' => 'Air Terjun Tumpak Sewu, atau yang sering dijuluki Niagara dari Indonesia, adalah air terjun dengan formasi unik melebar menyerupai tirai dari aliran mata air Gunung Semeru. Meskipun secara administratif berada di perbatasan Malang-Lumajang, wisata ini sangat populer sebagai paket perjalanan keliling wisata alam dari Kota Batu karena pemandangannya yang spektakuler.',
                'whatsapp_number' => '+6281334061395',
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.790906233568!2d112.91572977578611!3d-8.172960679883582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78bc93aab61db5%3A0x8e8eb468fb713d71!2sAir%20Terjun%20Tumpak%20Sewu!5e0!3m2!1sid!2sid!4v1717669761234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -8.17296100,
                'longitude' => 112.91573000,
            ],
            [
                'title' => 'Eco Green Park',
                'category_id' => $catKebunBinatang,
                'location' => 'Jl. Raya Oro-Oro Ombo No.9A, Temas, Kec. Batu, Kota Batu, Jawa Timur 65315',
                'price' => 45000.00,
                'duration' => '09.00 – 17.00 WIB',
                'description' => 'Eco Green Park adalah taman rekreasi bertema lingkungan hidup, pelestarian alam, dan pemanfaatan barang bekas. Menampilkan wahana menarik seperti Plaza Candi Tikus, Rumah Terbalik, Rumah Hidroponik, Jungle Adventure (berburu pemburu liar), serta taman burung eksotis di mana pengunjung bisa berinteraksi langsung dan memberi makan burung nuri.',
                'whatsapp_number' => '+62341512525',
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.341258131557!2d112.52834577578298!3d-7.885489778428285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78872de813c9e9%3A0xc3676c8c48a7b060!2sEco%20Green%20Park!5e0!3m2!1sid!2sid!4v1717669831234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.88549000,
                'longitude' => 112.52834600,
            ],
            [
                'title' => 'Alun-Alun Kota Wisata Batu',
                'category_id' => $catRuangPublik,
                'location' => 'Alun-Alun Kota Wisata Batu, Jl. Diponegoro, Sisir, Kec. Batu, Kota Batu, Jawa Timur 65314',
                'price' => 0.00,
                'duration' => 'Buka 24 Jam',
                'description' => 'Alun-Alun Kota Wisata Batu merupakan salah satu alun-alun terpopuler di Indonesia yang memiliki wahana ikonik berupa Bianglala (Ferris Wheel) raksasa beroperasi di tengah kota. Tempat berkumpul favorit warga dan wisatawan untuk menikmati hawa dingin kota Batu sembari mencicipi aneka kuliner kaki lima legendaris seperti Ketan Bubuk dan susu sapi segar.',
                'whatsapp_number' => null,
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.520448131333!2d112.525624775782!3d-7.8638888774706535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788736e69eb74b%3A0x6b1db94c3dc2cf4d!2sAlun-Alun%20Kota%20Batu!5e0!3m2!1sid!2sid!4v1717669901234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.86388900,
                'longitude' => 112.52562500,
            ],
            [
                'title' => 'Selecta Garden',
                'category_id' => $catAlamKebun,
                'location' => 'Jl. Raya Selecta No. 1, Desa Tulungrejo, Kec. Bumiaji, Kota Batu, Jawa Timur 65336',
                'price' => 30000.00,
                'duration' => '07.00 – 17.00 WIB',
                'description' => 'Selecta Garden adalah area taman tematik modern dengan dekorasi kebun anggrek langka, bunga krisan, mawar, dan aneka tanaman hias pegunungan lainnya. Memiliki jalan pedestrian yang tertata rapi, ramah lansia dan difabel, menjadikannya spot foto yang sangat instagramable dan asri dengan latar belakang Gunung Panderman.',
                'whatsapp_number' => null,
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.124578131333!2d112.525624775782!3d-7.8038888774706535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e787df600b3e551%3A0xb36ef8df96dd6294!2sTaman%20Rekreasi%20Selecta!5e0!3m2!1sid!2sid!4v1717669401234!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'latitude' => -7.80388900,
                'longitude' => 112.52562500,
            ],
        ];

        foreach ($trips as $trip) {
            $slug = Str::slug($trip['title']);
            $originalSlug = $slug;
            $count = 1;
            while (Trip::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            Trip::create(array_merge($trip, [
                'slug' => $slug,
                'thumbnail' => null,
            ]));
        }
    }
}
