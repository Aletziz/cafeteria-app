<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CafeteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar tablas existentes
        Product::truncate();
        Category::truncate();

        // Crear categorías
        $categories = [
            [
                'name' => 'Cafés Calientes',
                'description' => 'Deliciosos cafés recién preparados para disfrutar en cualquier momento',
                'image' => 'images/categories/cafe-caliente.jpg',
                'active' => true
            ],
            [
                'name' => 'Cafés Fríos',
                'description' => 'Refrescantes bebidas de café perfectas para días calurosos',
                'image' => 'images/categories/cafe-frio.jpg',
                'active' => true
            ],
            [
                'name' => 'Postres',
                'description' => 'Exquisitos postres artesanales para acompañar tu café',
                'image' => 'images/categories/postres.jpg',
                'active' => true
            ],
            [
                'name' => 'Panadería',
                'description' => 'Pan fresco y productos horneados diariamente',
                'image' => 'images/categories/panaderia.jpg',
                'active' => true
            ],
            [
                'name' => 'Desayunos',
                'description' => 'Opciones nutritivas y deliciosas para comenzar el día',
                'image' => 'images/categories/desayunos.jpg',
                'active' => true
            ],
            [
                'name' => 'Bebidas Especiales',
                'description' => 'Bebidas únicas y creativas de la casa',
                'image' => 'images/categories/bebidas-especiales.jpg',
                'active' => true
            ]
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);
            $this->createProductsForCategory($category);
        }
    }

    private function createProductsForCategory(Category $category)
    {
        $products = [];

        switch ($category->name) {
            case 'Cafés Calientes':
                $products = [
                    [
                        'name' => 'Espresso Tradicional',
                        'description' => 'Café espresso puro, intenso y aromático. La base perfecta para cualquier bebida de café.',
                        'price' => 3500,
                        'image' => 'images/products/espresso.jpg',
                        'stock' => 100,
                        'available' => true
                    ],
                    [
                        'name' => 'Americano',
                        'description' => 'Espresso suavizado con agua caliente. Ideal para quienes prefieren un café menos intenso.',
                        'price' => 4000,
                        'image' => 'images/products/americano.jpg',
                        'stock' => 100,
                        'available' => true
                    ],
                    [
                        'name' => 'Cappuccino',
                        'description' => 'Espresso con leche vaporizada y espuma cremosa. Decorado con arte latte.',
                        'price' => 5500,
                        'image' => 'images/products/cappuccino.jpg',
                        'stock' => 80,
                        'available' => true
                    ],
                    [
                        'name' => 'Latte',
                        'description' => 'Espresso con abundante leche vaporizada y una fina capa de espuma.',
                        'price' => 6000,
                        'image' => 'images/products/latte.jpg',
                        'stock' => 75,
                        'available' => true
                    ],
                    [
                        'name' => 'Mocha',
                        'description' => 'Deliciosa combinación de espresso, chocolate y leche vaporizada, coronado con crema batida.',
                        'price' => 7000,
                        'image' => 'images/products/mocha.jpg',
                        'stock' => 60,
                        'available' => true
                    ],
                    [
                        'name' => 'Macchiato',
                        'description' => 'Espresso "manchado" con una pequeña cantidad de leche vaporizada.',
                        'price' => 5000,
                        'image' => 'images/products/macchiato.jpg',
                        'stock' => 50,
                        'available' => true
                    ]
                ];
                break;

            case 'Cafés Fríos':
                $products = [
                    [
                        'name' => 'Iced Coffee',
                        'description' => 'Café americano servido sobre hielo, refrescante y energizante.',
                        'price' => 4500,
                        'image' => 'images/products/iced-coffee.jpg',
                        'stock' => 90,
                        'available' => true
                    ],
                    [
                        'name' => 'Frappé de Vainilla',
                        'description' => 'Bebida helada con café, leche, hielo y sirope de vainilla, coronado con crema batida.',
                        'price' => 8000,
                        'image' => 'images/products/frappe-vainilla.jpg',
                        'stock' => 70,
                        'available' => true
                    ],
                    [
                        'name' => 'Cold Brew',
                        'description' => 'Café extraído en frío durante 12 horas, suave y menos ácido.',
                        'price' => 6500,
                        'image' => 'images/products/cold-brew.jpg',
                        'stock' => 40,
                        'available' => true
                    ],
                    [
                        'name' => 'Iced Latte',
                        'description' => 'Espresso con leche fría servido sobre hielo, cremoso y refrescante.',
                        'price' => 6500,
                        'image' => 'images/products/iced-latte.jpg',
                        'stock' => 65,
                        'available' => true
                    ],
                    [
                        'name' => 'Frappé de Caramelo',
                        'description' => 'Deliciosa mezcla helada con café, caramelo y crema batida.',
                        'price' => 8500,
                        'image' => 'images/products/frappe-caramelo.jpg',
                        'stock' => 55,
                        'available' => true
                    ]
                ];
                break;

            case 'Postres':
                $products = [
                    [
                        'name' => 'Tiramisú',
                        'description' => 'Clásico postre italiano con café, mascarpone y cacao en polvo.',
                        'price' => 9000,
                        'image' => 'images/products/tiramisu.jpg',
                        'stock' => 25,
                        'available' => true
                    ],
                    [
                        'name' => 'Cheesecake de Frutos Rojos',
                        'description' => 'Cremoso cheesecake con salsa de frutos rojos frescos.',
                        'price' => 8500,
                        'image' => 'images/products/cheesecake.jpg',
                        'stock' => 30,
                        'available' => true
                    ],
                    [
                        'name' => 'Brownie con Helado',
                        'description' => 'Brownie de chocolate caliente acompañado de helado de vainilla.',
                        'price' => 7500,
                        'image' => 'images/products/brownie.jpg',
                        'stock' => 40,
                        'available' => true
                    ],
                    [
                        'name' => 'Tarta de Chocolate',
                        'description' => 'Rica tarta de chocolate con ganache y decoración artesanal.',
                        'price' => 8000,
                        'image' => 'images/products/tarta-chocolate.jpg',
                        'stock' => 20,
                        'available' => true
                    ],
                    [
                        'name' => 'Pannacotta de Café',
                        'description' => 'Suave pannacotta con sabor a café y salsa de caramelo.',
                        'price' => 7000,
                        'image' => 'images/products/pannacotta.jpg',
                        'stock' => 35,
                        'available' => true
                    ]
                ];
                break;

            case 'Panadería':
                $products = [
                    [
                        'name' => 'Croissant de Mantequilla',
                        'description' => 'Croissant francés tradicional, hojaldrado y dorado.',
                        'price' => 3000,
                        'image' => 'images/products/croissant.jpg',
                        'stock' => 50,
                        'available' => true
                    ],
                    [
                        'name' => 'Muffin de Arándanos',
                        'description' => 'Esponjoso muffin con arándanos frescos y azúcar glass.',
                        'price' => 4000,
                        'image' => 'images/products/muffin-arandanos.jpg',
                        'stock' => 45,
                        'available' => true
                    ],
                    [
                        'name' => 'Pan Integral',
                        'description' => 'Pan artesanal integral con semillas, horneado diariamente.',
                        'price' => 5000,
                        'image' => 'images/products/pan-integral.jpg',
                        'stock' => 30,
                        'available' => true
                    ],
                    [
                        'name' => 'Bagel con Queso Crema',
                        'description' => 'Bagel tostado con queso crema y hierbas finas.',
                        'price' => 6000,
                        'image' => 'images/products/bagel.jpg',
                        'stock' => 35,
                        'available' => true
                    ],
                    [
                        'name' => 'Scone de Limón',
                        'description' => 'Scone inglés con ralladura de limón y glaseado.',
                        'price' => 4500,
                        'image' => 'images/products/scone.jpg',
                        'stock' => 25,
                        'available' => true
                    ]
                ];
                break;

            case 'Desayunos':
                $products = [
                    [
                        'name' => 'Desayuno Completo',
                        'description' => 'Huevos revueltos, tocino, pan tostado, mermelada y café americano.',
                        'price' => 12000,
                        'image' => 'images/products/desayuno-completo.jpg',
                        'stock' => 20,
                        'available' => true
                    ],
                    [
                        'name' => 'Tostadas Francesas',
                        'description' => 'Pan brioche en tostadas francesas con miel de maple y frutas.',
                        'price' => 9000,
                        'image' => 'images/products/tostadas-francesas.jpg',
                        'stock' => 25,
                        'available' => true
                    ],
                    [
                        'name' => 'Bowl de Açaí',
                        'description' => 'Bowl de açaí con granola, frutas frescas y miel.',
                        'price' => 10000,
                        'image' => 'images/products/bowl-acai.jpg',
                        'stock' => 30,
                        'available' => true
                    ],
                    [
                        'name' => 'Avocado Toast',
                        'description' => 'Pan integral con aguacate, tomate cherry y huevo pochado.',
                        'price' => 8500,
                        'image' => 'images/products/avocado-toast.jpg',
                        'stock' => 35,
                        'available' => true
                    ],
                    [
                        'name' => 'Pancakes',
                        'description' => 'Stack de pancakes esponjosos con sirope de maple y mantequilla.',
                        'price' => 8000,
                        'image' => 'images/products/pancakes.jpg',
                        'stock' => 40,
                        'available' => true
                    ]
                ];
                break;

            case 'Bebidas Especiales':
                $products = [
                    [
                        'name' => 'Chai Latte',
                        'description' => 'Té chai especiado con leche vaporizada y canela.',
                        'price' => 6500,
                        'image' => 'images/products/chai-latte.jpg',
                        'stock' => 60,
                        'available' => true
                    ],
                    [
                        'name' => 'Matcha Latte',
                        'description' => 'Té verde matcha japonés con leche y un toque de dulzura.',
                        'price' => 7000,
                        'image' => 'images/products/matcha-latte.jpg',
                        'stock' => 45,
                        'available' => true
                    ],
                    [
                        'name' => 'Golden Milk',
                        'description' => 'Leche dorada con cúrcuma, jengibre y especias ayurvédicas.',
                        'price' => 6000,
                        'image' => 'images/products/golden-milk.jpg',
                        'stock' => 40,
                        'available' => true
                    ],
                    [
                        'name' => 'Chocolate Caliente Especial',
                        'description' => 'Chocolate belga con leche, crema batida y marshmallows.',
                        'price' => 7500,
                        'image' => 'images/products/chocolate-especial.jpg',
                        'stock' => 50,
                        'available' => true
                    ],
                    [
                        'name' => 'Smoothie Verde',
                        'description' => 'Batido verde con espinaca, manzana, plátano y jengibre.',
                        'price' => 8000,
                        'image' => 'images/products/smoothie-verde.jpg',
                        'stock' => 35,
                        'available' => true
                    ]
                ];
                break;
        }

        foreach ($products as $productData) {
            $productData['category_id'] = $category->id;
            Product::create($productData);
        }
    }
}