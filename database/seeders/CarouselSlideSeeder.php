<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarouselSlide;

class CarouselSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Café Especial del Día',
                'description' => 'Disfruta de nuestro blend exclusivo con notas de chocolate y caramelo.',
                'image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3&w=300',
                'button_text' => 'Ordenar Ahora',
                'button_url' => '/menu',
                'background_gradient' => 'linear-gradient(135deg, #8B4513 0%, #D2691E 100%)',
                'badge_text' => '¡Oferta Especial!',
                'badge_color' => '#28a745',
                'price' => '4.50',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pasteles Artesanales',
                'description' => 'Deliciosos pasteles horneados diariamente con ingredientes frescos.',
                'image_url' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&w=300',
                'button_text' => 'Ver Pasteles',
                'button_url' => '/menu',
                'background_gradient' => 'linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%)',
                'badge_text' => 'Recién Horneados',
                'badge_color' => '#17a2b8',
                'price' => '3.00',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Bebidas Refrescantes',
                'description' => 'Perfectas para el clima cálido. Frappés, smoothies y bebidas heladas.',
                'image_url' => 'https://images.unsplash.com/photo-1544145945-f90425340c7e?ixlib=rb-4.0.3&w=300',
                'button_text' => 'Refréscate',
                'button_url' => '/menu',
                'background_gradient' => 'linear-gradient(135deg, #4ECDC4 0%, #44A08D 100%)',
                'badge_text' => 'Temporada de Verano',
                'badge_color' => '#007bff',
                'price' => '3.50',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Desayunos Completos',
                'description' => 'Comienza tu día con energía. Desayunos nutritivos y deliciosos.',
                'image_url' => 'https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?ixlib=rb-4.0.3&w=300',
                'button_text' => 'Ver Desayunos',
                'button_url' => '/menu',
                'background_gradient' => 'linear-gradient(135deg, #F093FB 0%, #F5576C 100%)',
                'badge_text' => 'Hasta 11:00 AM',
                'badge_color' => '#ffc107',
                'price' => '6.00',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => '¡Promoción Especial!',
                'description' => 'Compra 2 cafés y llévate el tercero GRATIS. Válido de lunes a viernes.',
                'image_url' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&w=300',
                'button_text' => 'Aprovechar Oferta',
                'button_url' => '/menu',
                'background_gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                'badge_text' => '¡Oferta Limitada!',
                'badge_color' => '#dc3545',
                'price' => null,
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            CarouselSlide::create($slide);
        }
    }
}
