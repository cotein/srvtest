<?php

use App\Src\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories =  [
            [
                'code'  => "MLA5725",
                'parent_id' => 0,
                'name'  => "Accesorios para Vehículos"
            ],
            [
                'code'  => "MLA1403",
                'parent_id' => 0,
                'name'  => "Alimentos y Bebidas"
            ],
            [
                'code'  => "MLA1071",
                'parent_id' => 0,
                'name'  => "Animales y Mascotas"
            ],
            [
                'code'  => "MLA1367",
                'parent_id' => 0,
                'name'  => "Antigüedades"
            ],
            [
                'code'  => "MLA1368",
                'parent_id' => 0,
                'name'  => "Arte y Artesanías"
            ],
            [
                'code'  => "MLA1743",
                'parent_id' => 0,
                'name'  => "Autos, Motos y Otros"
            ],
            [
                'code'  => "MLA138",
                'parent_id' => 0,
                'name'  => "Bebés"
            ],
            [
                'code'  => "MLA1246",
                'parent_id' => 0,
                'name'  => "Belleza y Cuidado Personal"
            ],
            [
                'code'  => "MLA1039",
                'parent_id' => 0,
                'name'  => "Cámaras y Accesorios"
            ],
            [
                'code'  => "MLA1051",
                'parent_id' => 0,
                'name'  => "Celulares y Teléfonos"
            ],
            [
                'code'  => "MLA1798",
                'parent_id' => 0,
                'name'  => "Coleccionables y Hobbies"
            ],
            [
                'code'  => "MLA1648",
                'parent_id' => 0,
                'name'  => "Computación"
            ],
            [
                'code'  => "MLA1144",
                'parent_id' => 0,
                'name'  => "Consolas y Videojuegos"
            ],
            [
                'code'  => "MLA1276",
                'parent_id' => 0,
                'name'  => "Deportes y Fitness"
            ],
            [
                'code'  => "MLA5726",
                'parent_id' => 0,
                'name'  => "Electrodomésticos y Aires Ac."
            ],
            [
                'code'  => "MLA1000",
                'parent_id' => 0,
                'name'  => "Electrónica, Audio y Video"
            ],
            [
                'code'  => "MLA2547",
                'parent_id' => 0,
                'name'  => "Entradas para Eventos"
            ],
            [
                'code'  =>   "MLA407134",
                'parent_id' => 0,
                'name'  => "Herramientas y Construcción"
            ],
            [
                'code'  => "MLA1574",
                'parent_id' => 0,
                'name'  => "Hogar, Muebles y Jardín"
            ],
            [
                'code'  => "MLA1499",
                'parent_id' => 0,
                'name'  => "Industrias y Oficinas"
            ],
            [
                'code'  => "MLA1459",
                'parent_id' => 0,
                'name'  => "Inmuebles"
            ],
            [
                'code'  => "MLA1182",
                'parent_id' => 0,
                'name'  => "Instrumentos Musicales"
            ],
            [
                'code'  => "MLA3937",
                'parent_id' => 0,
                'name'  => "Joyas y Relojes"
            ],
            [
                'code'  => "MLA1132",
                'parent_id' => 0,
                'name'  => "Juegos y Juguetes"
            ],
            [
                'code'  => "MLA3025",
                'parent_id' => 0,
                'name'  => "Libros, Revistas y Comics"
            ],
            [
                'code'  => "MLA1168",
                'parent_id' => 0,
                'name'  => "Música, Películas y Series"
            ],
            [
                'code'  => "MLA1430",
                'parent_id' => 0,
                'name'  => "Ropa y Accesorios"
            ],
            [
                'code'  => "MLA409431",
                'parent_id' => 0,
                'name'  => "Salud y Equipamiento Médico"
            ],
            [
                'code'  => "MLA1540",
                'parent_id' => 0,
                'name'  => "Servicios"
            ],
            [
                'code'  => "MLA1953",
                'parent_id' => 0,
                'name'  => "Otras categorías"
            ]
        ];

        $categories = collect($categories);

        $categories->each(function($c){
        	Category::create([
                'code' => $c['code'],
                'parent_id' => $c['parent_id'],
                'name' => $c['name'],
        	]);
        });
    }
}
