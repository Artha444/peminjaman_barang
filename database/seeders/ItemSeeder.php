<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
  public function run()
  {
    $data = [
      [
        'name' => 'Laptop ASUS ROG',
        'code' => 'LAP-001',
        'stock' => 5,
        'description' => 'Laptop gaming performa tinggi',
      ],
      [
        'name' => 'Proyektor Epson',
        'code' => 'PRO-021',
        'stock' => 3,
        'description' => 'Proyektor untuk ruang meeting',
      ],
      [
        'name' => 'Kabel HDMI 5M',
        'code' => 'KBL-005',
        'stock' => 10,
        'description' => 'Kabel penghubung layar',
      ],
      [
        'name' => 'Kamera Canon EOS',
        'code' => 'CAM-009',
        'stock' => 2,
        'description' => 'Kamera DSLR untuk dokumentasi',
      ],
    ];

    foreach ($data as $item) {
      Item::create($item);
    }
  }
}
