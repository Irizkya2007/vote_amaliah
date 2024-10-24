<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['0081918758', '2250294', 'AL KENATARO RAJA AFGAN'],
            ['0078162456', '2250321', 'ANDI MARDIANSYAH'],
            ['0073256256', '2250408', 'AUDI APRIANSYAH'],
            ['0068849579', '2250303', 'DANI SETIAWAN NOVIANSYAH'],
            ['0075615582', '2250378', 'DIMAS MAULIDI ARDANA'],
            ['0079331647', '2250198', 'FAHRI PURWANA HADI'],
            ['0075347510', '2250160', 'FARHAN FATURAHMAN'],
            ['0076744783', '2250083', 'HAIKAL GEOVANE PERMANA'],
            ['0074943860', '2250390', 'IRFAN RIZKYA NUGRAHA'],
            ['0074136678', '2250230', 'M. RAIHAN IBNU SYABRI'],
            ['0065317211', '2250327', 'M. VIRGI RAMDANI'],
            ['0063794500', '2250214', 'MOCHAMAD EGI DARMAWANSYAH'],
            ['0077838809', '2250222', 'MUHAMAD ADIB JIRJIS'],
            ['0054718673', '2250194', 'MUHAMAD NURJAMIL'],
            ['0079329411', '2250387', 'MUHAMAD PERDIYANSYAH'],
            ['0063871884', '2250428', 'MUHAMAD RAFLI KRIDO WAHONO'],
            ['0062700736', '2250195', 'MUHAMAD RIVAL'],
            ['0085812930', '2250202', 'MUHAMAD YESA'],
            ['0068818666', '2250385', 'MUHAMAD YUSUF MAULANA'],
            ['0078848853', '2250047', 'MUHAMMAD FAHRIANSYAH'],
            ['0074442893', '2250172', 'MUHAMMAD FAJRI AWALUDIN'],
            ['0057713292', '2250197', 'MUHAMMAD SYAHRUL PIKRIYANA'],
            ['0073146984', '2250256', 'NADYA AYDI YUNIAR'],
            ['0062381880', '2250203', 'NOVA HILDA FACHRIZAH'],
            ['0077707567', '2250232', 'RADEN FAZRIAH SALSABILA AMMALIA'],
            ['0062919928', '2250429', 'RAIHAN NAFISA'],
            ['0072553261', '2250069', 'RIO VALDO APENDI'],
            ['0073496675', '2250127', 'RIZQI PADIL DARMAWAN'],
            ['0067854447', '2250196', 'SITI ANISA NUR FATWA'],
            ['0067659814', '2250223', 'SYAM SHEKY HAFRIZAL'],
            ['0075448382', '2250217', 'TIARA ARDITA SUPRIYO']
        ];

        foreach ($data as $item) {
            User::create([
                'name' => $item[2], // Nama pengguna
                'username' => $item[0], // NISN sebagai username
                'password' => Hash::make($item[1]), // NIS sebagai password (hashed)
                'nisn' => $item[0], // NISN
                'nis' => $item[1], // NIS
                'kelas_id' => 1, // Misalnya, kelas_id = 1
                'role_id' => 1,  // Misalnya, role_id = 1 untuk siswa
                'school_id' => 1,
            ]);
        }
    }
}

