<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'MLA5725',
                'parent_id' => 0,
                'name' => 'Accesorios para Vehículos',
                'slug' => 'accesorios-para-vehiculos',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'MLA1403',
                'parent_id' => 0,
                'name' => 'Alimentos y Bebidas',
                'slug' => 'alimentos-y-bebidas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'MLA1071',
                'parent_id' => 0,
                'name' => 'Animales y Mascotas',
                'slug' => 'animales-y-mascotas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'MLA1367',
                'parent_id' => 0,
                'name' => 'Antigüedades',
                'slug' => 'antigueedades',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'MLA1368',
                'parent_id' => 0,
                'name' => 'Arte y Artesanías',
                'slug' => 'arte-y-artesanias',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'MLA1743',
                'parent_id' => 0,
                'name' => 'Autos, Motos y Otros',
                'slug' => 'autos-motos-y-otros',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'MLA138',
                'parent_id' => 0,
                'name' => 'Bebés',
                'slug' => 'bebes',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'MLA1246',
                'parent_id' => 0,
                'name' => 'Belleza y Cuidado Personal',
                'slug' => 'belleza-y-cuidado-personal',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'MLA1039',
                'parent_id' => 0,
                'name' => 'Cámaras y Accesorios',
                'slug' => 'camaras-y-accesorios',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'MLA1051',
                'parent_id' => 0,
                'name' => 'Celulares y Teléfonos',
                'slug' => 'celulares-y-telefonos',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'MLA1798',
                'parent_id' => 0,
                'name' => 'Coleccionables y Hobbies',
                'slug' => 'coleccionables-y-hobbies',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'MLA1648',
                'parent_id' => 0,
                'name' => 'Computación',
                'slug' => 'computacion',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'MLA1144',
                'parent_id' => 0,
                'name' => 'Consolas y Videojuegos',
                'slug' => 'consolas-y-videojuegos',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'MLA1276',
                'parent_id' => 0,
                'name' => 'Deportes y Fitness',
                'slug' => 'deportes-y-fitness',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'MLA5726',
                'parent_id' => 0,
                'name' => 'Electrodomésticos y Aires Ac.',
                'slug' => 'electrodomesticos-y-aires-ac',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'MLA1000',
                'parent_id' => 0,
                'name' => 'Electrónica, Audio y Video',
                'slug' => 'electronica-audio-y-video',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'MLA2547',
                'parent_id' => 0,
                'name' => 'Entradas para Eventos',
                'slug' => 'entradas-para-eventos',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            17 => 
            array (
                'id' => 18,
                'code' => 'MLA407134',
                'parent_id' => 0,
                'name' => 'Herramientas y Construcción',
                'slug' => 'herramientas-y-construccion',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            18 => 
            array (
                'id' => 19,
                'code' => 'MLA1574',
                'parent_id' => 0,
                'name' => 'Hogar, Muebles y Jardín',
                'slug' => 'hogar-muebles-y-jardin',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            19 => 
            array (
                'id' => 20,
                'code' => 'MLA1499',
                'parent_id' => 0,
                'name' => 'Industrias y Oficinas',
                'slug' => 'industrias-y-oficinas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            20 => 
            array (
                'id' => 21,
                'code' => 'MLA1459',
                'parent_id' => 0,
                'name' => 'Inmuebles',
                'slug' => 'inmuebles',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            21 => 
            array (
                'id' => 22,
                'code' => 'MLA1182',
                'parent_id' => 0,
                'name' => 'Instrumentos Musicales',
                'slug' => 'instrumentos-musicales',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            22 => 
            array (
                'id' => 23,
                'code' => 'MLA3937',
                'parent_id' => 0,
                'name' => 'Joyas y Relojes',
                'slug' => 'joyas-y-relojes',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            23 => 
            array (
                'id' => 24,
                'code' => 'MLA1132',
                'parent_id' => 0,
                'name' => 'Juegos y Juguetes',
                'slug' => 'juegos-y-juguetes',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            24 => 
            array (
                'id' => 25,
                'code' => 'MLA3025',
                'parent_id' => 0,
                'name' => 'Libros, Revistas y Comics',
                'slug' => 'libros-revistas-y-comics',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            25 => 
            array (
                'id' => 26,
                'code' => 'MLA1168',
                'parent_id' => 0,
                'name' => 'Música, Películas y Series',
                'slug' => 'musica-peliculas-y-series',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            26 => 
            array (
                'id' => 27,
                'code' => 'MLA1430',
                'parent_id' => 0,
                'name' => 'Ropa y Accesorios',
                'slug' => 'ropa-y-accesorios',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            27 => 
            array (
                'id' => 28,
                'code' => 'MLA409431',
                'parent_id' => 0,
                'name' => 'Salud y Equipamiento Médico',
                'slug' => 'salud-y-equipamiento-medico',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            28 => 
            array (
                'id' => 29,
                'code' => 'MLA1540',
                'parent_id' => 0,
                'name' => 'Servicios',
                'slug' => 'servicios',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            29 => 
            array (
                'id' => 30,
                'code' => 'MLA1953',
                'parent_id' => 0,
                'name' => 'Otras categorías',
                'slug' => 'otras-categorias',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 14:10:31',
                'updated_at' => '2021-03-11 14:10:31',
            ),
            30 => 
            array (
                'id' => 31,
                'code' => 'MLA5982',
                'parent_id' => 5,
                'name' => 'Librería',
                'slug' => 'libreria',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:24',
                'updated_at' => '2021-03-11 16:19:24',
            ),
            31 => 
            array (
                'id' => 32,
                'code' => 'MLA34320',
                'parent_id' => 31,
                'name' => 'Artística y Pintura',
                'slug' => 'artistica-y-pintura',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:24',
                'updated_at' => '2021-03-11 16:19:24',
            ),
            32 => 
            array (
                'id' => 33,
                'code' => 'MLA73675',
                'parent_id' => 32,
                'name' => 'Acuarelas',
                'slug' => 'acuarelas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:24',
                'updated_at' => '2021-03-11 16:19:24',
            ),
            33 => 
            array (
                'id' => 34,
                'code' => 'MLA109026',
                'parent_id' => 27,
                'name' => 'Calzado',
                'slug' => 'calzado',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:27',
                'updated_at' => '2021-03-11 16:19:27',
            ),
            34 => 
            array (
                'id' => 35,
                'code' => 'MLA415193',
                'parent_id' => 34,
                'name' => 'Otros Zapatos',
                'slug' => 'otros-zapatos',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:27',
                'updated_at' => '2021-03-11 16:19:27',
            ),
            35 => 
            array (
                'id' => 36,
                'code' => 'MLA414673',
                'parent_id' => 34,
                'name' => 'Alpargatas',
                'slug' => 'alpargatas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:30',
                'updated_at' => '2021-03-11 16:19:30',
            ),
            36 => 
            array (
                'id' => 37,
                'code' => 'MLA414674',
                'parent_id' => 34,
                'name' => 'Mocasines y Oxfords',
                'slug' => 'mocasines-y-oxfords',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:33',
                'updated_at' => '2021-03-11 16:19:33',
            ),
            37 => 
            array (
                'id' => 38,
                'code' => 'MLA69564',
                'parent_id' => 31,
                'name' => 'Abrochadoras',
                'slug' => 'abrochadoras',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:35',
                'updated_at' => '2021-03-11 16:19:35',
            ),
            38 => 
            array (
                'id' => 39,
                'code' => 'MLA415192',
                'parent_id' => 34,
                'name' => 'Chatitas',
                'slug' => 'chatitas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:38',
                'updated_at' => '2021-03-11 16:19:38',
            ),
            39 => 
            array (
                'id' => 40,
                'code' => 'MLA414251',
                'parent_id' => 34,
                'name' => 'Botas y Botinetas',
                'slug' => 'botas-y-botinetas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-11 16:19:43',
                'updated_at' => '2021-03-11 16:19:43',
            ),
            40 => 
            array (
                'id' => 41,
                'code' => 'MLA1608',
                'parent_id' => 19,
                'name' => 'Camas, Colchones y Accesorios',
                'slug' => 'camas-colchones-y-accesorios',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 12:59:01',
                'updated_at' => '2021-03-12 12:59:01',
            ),
            41 => 
            array (
                'id' => 42,
                'code' => 'MLA1612',
                'parent_id' => 41,
                'name' => 'Colchones',
                'slug' => 'colchones',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 12:59:01',
                'updated_at' => '2021-03-12 12:59:01',
            ),
            42 => 
            array (
                'id' => 43,
                'code' => 'MLA1384',
                'parent_id' => 0,
                'name' => 'Bebés',
                'slug' => 'bebes-1',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 12:59:04',
                'updated_at' => '2021-03-12 12:59:04',
            ),
            43 => 
            array (
                'id' => 44,
                'code' => 'MLA1390',
                'parent_id' => 43,
                'name' => 'Seguridad para Bebés',
                'slug' => 'seguridad-para-bebes',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 12:59:04',
                'updated_at' => '2021-03-12 12:59:04',
            ),
            44 => 
            array (
                'id' => 45,
                'code' => 'MLA74021',
                'parent_id' => 44,
                'name' => 'Pisos de Goma',
                'slug' => 'pisos-de-goma',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 12:59:04',
                'updated_at' => '2021-03-12 12:59:04',
            ),
            45 => 
            array (
                'id' => 46,
                'code' => 'MLA109027',
                'parent_id' => 34,
                'name' => 'Zapatillas',
                'slug' => 'zapatillas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 12:59:07',
                'updated_at' => '2021-03-12 12:59:07',
            ),
            46 => 
            array (
                'id' => 47,
                'code' => 'MLA416005',
                'parent_id' => 34,
                'name' => 'Sandalias y Ojotas',
                'slug' => 'sandalias-y-ojotas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 12:59:44',
                'updated_at' => '2021-03-12 12:59:44',
            ),
            47 => 
            array (
                'id' => 48,
                'code' => 'MLA415445',
                'parent_id' => 34,
                'name' => 'Zuecos y Mules',
                'slug' => 'zuecos-y-mules',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 13:52:25',
                'updated_at' => '2021-03-12 13:52:25',
            ),
            48 => 
            array (
                'id' => 49,
                'code' => 'MLA3530',
                'parent_id' => 30,
                'name' => 'Otros',
                'slug' => 'otros',
                'deleted_at' => NULL,
                'created_at' => '2021-03-12 13:54:35',
                'updated_at' => '2021-03-12 13:54:35',
            ),
            49 => 
            array (
                'id' => 50,
                'code' => 'MLA455214',
                'parent_id' => 41,
                'name' => 'Camas',
                'slug' => 'camas',
                'deleted_at' => NULL,
                'created_at' => '2021-03-20 19:27:30',
                'updated_at' => '2021-03-20 19:27:30',
            ),
        ));
        
        
    }
}