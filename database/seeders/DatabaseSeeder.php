<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Anggota;
use App\Models\User;
use App\Models\biaya;
use App\Models\lapangan;
use Database\Seeders\StokLapanganSeeder;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
    //     #data anggota
    // Anggota::create([
    //     'nama' => 'Sopian Aji',
    //     'hp' => '085123456781',
    //     ]);
    // Anggota::create([
    //     'nama' => 'Husni Faqih',
    //     'hp' => '085123456782',
    //     ]);
    // Anggota::create([
    //     'nama' => 'Rousyati',
    //     'hp' => '085123456783',
    //     ]);

        #data user
    User::create([
        'nama' => 'Owner',
        'email' => 'Owner@gmail.com',
        'role' => '1',
        'status' => 1,
        'hp' => '0812345678901',
        'password' => bcrypt('P@55word'),
        ]);
        #untuk record berikutnya silahkan, beri nilai berbeda pada nilai: nama, email, hp dengan nilai masing-masing anggota kelompok
    User::create([
        'nama' => 'Sopian Aji',
        'email' => 'sopian4ji@gmail.com',
        'role' => '0',
        'status' => 1,
        'hp' => '081234567892',
        'password' => bcrypt('P@55word'),
        ]);
    User::create([
            'nama' => 'Sufianto Ahmad Arrafi',
            'email' => 'arafisufi2303@gmail.com',
            'role' => '2',
            'status' => 1,
            'hp' => '085721164584',
            'password' => bcrypt('P@55word'),
            ]);
    User::create([
                'nama' => 'Mohammad Bagas Prasetyo',
                'email' => 'Mohamadbagas899@gmail.com',
                'role' => '1',
                'status' => 1,
                'hp' => '087749833614',
                'password' => bcrypt('P@55word'),
                ]);
    User::create([
                    'nama' => 'Celvin Akbar Pratama',
                    'email' => 'kepin@gmail.com',
                    'role' => '0',
                    'status' => 1,
                    'hp' => '085955173113',
                    'password' => bcrypt('P@55word'),
                    ]);
    User::create([
                        'nama' => 'Handito Satrio Pamungkas',
                        'email' => 'handito@gmail.com',
                        'role' => '2',
                        'status' => 1,
                        'hp' => '081291294083',
                        'password' => bcrypt('P@55word'),
                        ]);
    User::create([
                            'nama' => 'Bima Sanjaya Putra ',
                            'email' => 'bima@gmail.com',
                            'role' => '0',
                            'status' => 1,
                            'hp' => '0895321640101',
                            'password' => bcrypt('P@55word'),
                            ]);
                            
                           
        #data biaya
biaya::create([
    'kelas_lapangan' => 'F-A',
    'biaya_lapangan' => '100000',
    'stok_lapangan'  => '30',
    'stok_awal'  => '30',
    ]);
    biaya::create([
        'kelas_lapangan' => 'F-B',
        'biaya_lapangan' => '80000',
        'stok_lapangan'  => '30',
        'stok_awal'  => '30',
        ]);
        biaya::create([
            'kelas_lapangan' => 'F-C',
            'biaya_lapangan' => '60000',
            'stok_lapangan'  => '30',
            'stok_awal'  => '30',
            ]);

  #data biaya
    lapangan::create([
        'user_id' => '1',
        'status' => '1',
        'nama_lapangan' => 'lapangan futsal 1',
        'kelas_lapangan' => 'F-A',
        'detail'  => 'LAPANGAN FUTSAL',
        'foto' => '20241127150622_6746d2fea08b7.jpg',
        ]);
    lapangan::create([
            'user_id' => '1',
            'status' => '1',
            'nama_lapangan' => 'lapangan futsal 2',
            'kelas_lapangan' => 'F-B',
            'detail'  => 'LAPANGAN FUTSAL',
            'foto' => '20241127150622_6746d2fea08b7.jpg',
            ]);
    lapangan::create([
                'user_id' => '1',
                'status' => '1',
                'nama_lapangan' => 'lapangan futsal 3',
                'kelas_lapangan' => 'F-C',
                'detail'  => 'LAPANGAN FUTSAL',
                'foto' => '20241127150622_6746d2fea08b7.jpg',
                ]);
          
 
        $this->call(StokLapanganSeeder::class);
    
        
    }
}
