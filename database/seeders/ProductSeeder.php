<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products =  [
            [
                'name' => 'Burger King',
                'description' => 'Gane hasta un 28% de descuento y envío gratis con el codigo promocional',
                'discount' => '28',
                'img' => 'https://brandemia.org/contenido/subidas/2021/12/bk_rebrand_stills_vi_1_logo.jpg',
            ],
            [
                'name' => 'Hopi Hari',
                'description' => 'Codigo promocional: Gane 20% de descuento en ingreso unitario para el fin de semana!',
                'discount' => '20',
                'img' => 'https://upload.wikimedia.org/wikipedia/pt/b/b2/Hopi_Hari.png',
            ],
            [
                'name' => 'Magalu',
                'description' => 'Dia de la madre en Magalu: Obtenga hasta 60% de descuento + Flete Gratis',
                'discount' => '60',
                'img' => 'https://s3-symbol-logo.tradingview.com/magaz-luiza-on-nm--600.png',
            ],
            [
                'name' => 'Netshoes',
                'description' => 'Cupon Netshoes: Descuento EXCLUSIVO de 10% OFF en ofertas especiales',
                'discount' => '10',
                'img' => 'https://www.eleconomista.com.mx/__export/1507911460576/sites/eleconomista/img/historico/netshoes_1_0.jpg_423682103.jpg',
            ],
            [
                'name' => 'Amazon',
                'description' => 'Cupon Amazon de 20% OFF en seleccion de utensilios de cocina',
                'discount' => '20',
                'img' => 'https://brandemia.org/contenido/subidas/2022/11/tipografia-y-paleta-de-color-1024x576.png',
            ],
        ];
        DB::table('products')->insert(($products));

    }
}
