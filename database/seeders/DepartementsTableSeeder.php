<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departements')->insert([
            [
                'name' => 'Bio Yogyakarta (Pusat)',
                'alamat' => 'Jl. Sidikan No.94, Sorosutan, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55162',
                'branch' => 'Yogyakarta',
                'latitude' => -7.824743884482511,
                'longitude' => 110.3851776668307,
                'phone' => '0274 388301',
                'email' => 'jogja.bio@gmail.com',
            ],
            [
                'name' => 'Bio Jepara',
                'alamat' => 'Jalan Raya Jepara Kudus, Ngabul, jepara, Ngabul, Tahunan, Jepara Regency, Central Java 59417',
                'branch' => 'Jepara',
                'latitude' => -6.647269842117206,
                'longitude' => 110.7121427730476,
                'phone' => '0291 598992',
                'email' => 'jepara.bio@gmail.com',
            ],
            [
                'name' => 'Bio Cirebon',
                'alamat' => 'Jl. Escot No.42, RT.014/RW.04, Tegalwangi, Kec. Weru, Kabupaten Cirebon, Jawa Barat 45154',
                'branch' => 'Cirebon',
                'latitude' => -6.706866430319171,
                'longitude' => 108.49201800221323,
                'phone' => '0231 320759',
                'email' => 'cirebon.bio@gmail.com',
            ],
            [
                'name' => 'Bio Surabaya',
                'alamat' => 'Perum Taman Anggun Sejahtera 5, Blok G2 No.3 Kelurahan Bendotretek, Kecamatan Prambon, Plintahan, Bendotretek, Krian, Sidoarjo Regency, East Java 61264',
                'branch' => 'Surabaya',
                'latitude' => -7.446368457599441,
                'longitude' => 112.56624541304522,
                'phone' => '0274 388301',
                'email' => 'surabaya.bioind@gmail.com',
            ],
            [
                'name' => 'Bio Digital Team',
                'alamat' => 'JL. BABARAN BARAT GG. VIII UH III 817, Jl. Celeban, BARU, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55167',
                'branch' => 'Yogyakarta-2',
                'latitude' => -7.810572515368331,
                'longitude' => 110.38677199880023,
                'phone' => '0822-4338-0001',
                'email' => 'info@bioindustries.co.id',
            ],

        ]);
    }
}
