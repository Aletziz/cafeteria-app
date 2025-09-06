@extends('layouts.app')

@section('title', 'Inicio - Cafetería El Aroma')

@section('content')
<!-- Hero Section -->
<section class="hero-section py-5" style="background: linear-gradient(rgba(139, 69, 19, 0.8), rgba(139, 69, 19, 0.8)), url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?ixlib=rb-4.0.3') center/cover; color: white;">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Bienvenido a Cafetería El Aroma</h1>
                <p class="lead mb-4">Disfruta del mejor café artesanal de la ciudad. Granos seleccionados, preparación perfecta y un ambiente acogedor te esperan.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('menu') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-coffee me-2"></i>Ver Menú
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Conoce Más
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3" 
                     alt="Café" class="img-fluid rounded-circle" style="max-width: 400px; border: 5px solid white;">
            </div>
        </div>
    </div>
</section>

<!-- Product Carousel Section -->
@if($carouselSlides->count() > 0)
<section class="py-0 bg-light">
    <div class="container-fluid px-0">
        <div id="productCarousel" class="continuous-carousel overflow-hidden" style="height: 280px; position: relative;">
            <div class="carousel-track" style="display: flex; width: {{ ($carouselSlides->count() * 2) * 100 }}%; animation: scroll {{ $carouselSlides->count() * 10 }}s linear infinite;">
                @foreach($carouselSlides as $slide)
                <div class="carousel-slide" style="min-width: {{ 60 / ($carouselSlides->count() * 2) }}%; flex-shrink: 0; background: {{ $slide->background_gradient }}; height: 280px; display: flex; align-items: center; padding: 0 1rem;">
                    <div class="d-flex flex-column align-items-center text-center w-100 h-100 justify-content-center">
                        @if($slide->image_url)
                            <img src="{{ $slide->image_url }}" 
                                 alt="{{ $slide->title }}" class="img-fluid rounded-circle shadow-lg mb-3" style="max-width: 80px; border: 3px solid white;">
                        @endif
                        <div class="text-white">
                            <h4 class="fw-bold mb-2" style="font-size: 1.1rem;">{{ $slide->title }}</h4>
                            <p class="mb-2" style="font-size: 0.85rem; line-height: 1.3;">{{ Str::limit($slide->description, 60) }}</p>
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                @if($slide->price)
                                    <span class="h6 text-warning me-2" style="font-size: 0.9rem;">${{ $slide->price }}</span>
                                @endif
                                @if($slide->badge_text)
                                    <span class="badge" style="background-color: {{ $slide->badge_color ?? '#28a745' }}; font-size: 0.7rem;">{{ $slide->badge_text }}</span>
                                @endif
                            </div>
                            @if($slide->button_text && $slide->button_url)
                                <a href="{{ $slide->button_url }}" class="btn btn-light btn-sm" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                    <i class="fas fa-shopping-cart me-1"></i>{{ Str::limit($slide->button_text, 15) }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Duplicar slides para efecto continuo -->
                @foreach($carouselSlides as $slide)
                <div class="carousel-slide" style="min-width: {{ 60 / ($carouselSlides->count() * 2) }}%; flex-shrink: 0; background: {{ $slide->background_gradient }}; height: 280px; display: flex; align-items: center; padding: 0 1rem;">
                    <div class="d-flex flex-column align-items-center text-center w-100 h-100 justify-content-center">
                        @if($slide->image_url)
                            <img src="{{ $slide->image_url }}" 
                                 alt="{{ $slide->title }}" class="img-fluid rounded-circle shadow-lg mb-3" style="max-width: 80px; border: 3px solid white;">
                        @endif
                        <div class="text-white">
                            <h4 class="fw-bold mb-2" style="font-size: 1.1rem;">{{ $slide->title }}</h4>
                            <p class="mb-2" style="font-size: 0.85rem; line-height: 1.3;">{{ Str::limit($slide->description, 60) }}</p>
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                @if($slide->price)
                                    <span class="h6 text-warning me-2" style="font-size: 0.9rem;">${{ $slide->price }}</span>
                                @endif
                                @if($slide->badge_text)
                                    <span class="badge" style="background-color: {{ $slide->badge_color ?? '#28a745' }}; font-size: 0.7rem;">{{ $slide->badge_text }}</span>
                                @endif
                            </div>
                            @if($slide->button_text && $slide->button_url)
                                <a href="{{ $slide->button_url }}" class="btn btn-light btn-sm" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                    <i class="fas fa-shopping-cart me-1"></i>{{ Str::limit($slide->button_text, 15) }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary">Productos Destacados</h2>
            <p class="lead text-muted">Descubre nuestras especialidades más populares</p>
        </div>
        
        <div class="row g-4">
            @forelse($featuredProducts as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3' }}" 
                             class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary mb-0">{{ $product->formatted_price }}</span>
                                @if($product->available && $product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-cart-plus me-1"></i>Agregar
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-secondary">No disponible</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No hay productos destacados disponibles.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-eye me-2"></i>Ver Todo el Menú
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary">Nuestras Categorías</h2>
            <p class="lead text-muted">Explora nuestra variedad de productos</p>
        </div>
        
        <div class="row g-4">
            @forelse($categories as $category)
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-coffee fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($category->description, 80) }}</p>
                            <span class="badge bg-primary">{{ $category->products->count() }} productos</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No hay categorías disponibles.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?ixlib=rb-4.0.3" 
                     alt="Nuestra cafetería" class="img-fluid rounded">
            </div>
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold text-primary mb-4">¿Por qué elegirnos?</h2>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-seedling fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>Granos Premium</h5>
                                <p class="text-muted">Seleccionamos los mejores granos de café de origen sostenible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-heart fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>Preparación Artesanal</h5>
                                <p class="text-muted">Cada taza es preparada con cuidado y dedicación por nuestros baristas expertos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>Servicio Rápido</h5>
                                <p class="text-muted">Entrega rápida sin comprometer la calidad de nuestros productos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    /* Estilos personalizados para el carrusel continuo */
    .continuous-carousel {
            overflow: hidden;
            width: 100%;
            height: 280px;
            position: relative;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
    
    .carousel-track {
        display: flex;
        width: 1000%;
        animation: scroll 50s linear infinite;
    }
    
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    
    .continuous-carousel:hover .carousel-track {
        animation-play-state: paused;
    }
    
    .carousel-slide {
        transition: transform 0.3s ease;
        padding: 30px 40px;
        color: white;
        position: relative;
    }
    
    .carousel-slide:hover {
        transform: scale(1.02);
    }
    
    .slide-image {
        max-width: 150px;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
    }
    
    #productCarousel .carousel-item {
        transition: transform 0.8s ease-in-out;
    }
    
    #productCarousel .carousel-indicators button {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        margin: 0 8px;
        border: 2px solid white;
        background-color: rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }
    
    #productCarousel .carousel-indicators button.active {
        background-color: white;
        transform: scale(1.2);
    }
    
    #productCarousel .carousel-control-prev,
    #productCarousel .carousel-control-next {
        width: 60px;
        height: 60px;
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s ease;
    }
    
    #productCarousel .carousel-control-prev:hover,
    #productCarousel .carousel-control-next:hover {
        background-color: rgba(0, 0, 0, 0.6);
        transform: translateY(-50%) scale(1.1);
    }
    
    #productCarousel .carousel-control-prev {
        left: -30px;
    }
    
    #productCarousel .carousel-control-next {
        right: -30px;
    }
    
    /* Animaciones para los elementos del carrusel */
    .carousel-item.active .display-6 {
        animation: fadeInUp 1s ease-out;
    }
    
    .carousel-item.active .lead {
        animation: fadeInUp 1s ease-out 0.2s both;
    }
    
    .carousel-item.active .btn {
        animation: fadeInUp 1s ease-out 0.4s both;
    }
    
    .carousel-item.active img {
        animation: zoomIn 1s ease-out 0.3s both;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    /* Efecto hover en las imágenes del carrusel */
    #productCarousel img {
        transition: transform 0.3s ease;
    }
    
    #productCarousel img:hover {
        transform: scale(1.05);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        #productCarousel .carousel-control-prev,
        #productCarousel .carousel-control-next {
            width: 40px;
            height: 40px;
        }
        
        #productCarousel .carousel-control-prev {
            left: 10px;
        }
        
        #productCarousel .carousel-control-next {
            right: 10px;
        }
        
        #productCarousel .row {
            min-height: 300px !important;
        }
        
        #productCarousel img {
            max-width: 200px !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Actualizar contador del carrito después de agregar productos
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form[action*="cart/add"]');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                setTimeout(updateCartCount, 500);
            });
        });
        
        // Mejorar la experiencia del carrusel
        const carousel = document.getElementById('productCarousel');
        if (carousel) {
            // Inicializar el carrusel si no existe una instancia
            let carouselInstance = bootstrap.Carousel.getInstance(carousel) || new bootstrap.Carousel(carousel, {
                interval: 3000,
                ride: 'carousel'
            });
            let isPaused = false;
            
            // Pausar el carrusel cuando se hace clic en cualquier parte del carrusel
            carousel.addEventListener('click', function(e) {
                if (!isPaused) {
                    carouselInstance.pause();
                    isPaused = true;
                    
                    // Mostrar indicador visual de pausa
                    const pauseIndicator = document.createElement('div');
                    pauseIndicator.id = 'pause-indicator';
                    pauseIndicator.innerHTML = '<i class="fas fa-pause"></i> Carrusel pausado - Haz clic para reanudar';
                    pauseIndicator.style.cssText = `
                        position: absolute;
                        top: 10px;
                        right: 10px;
                        background: rgba(0,0,0,0.7);
                        color: white;
                        padding: 8px 12px;
                        border-radius: 20px;
                        font-size: 12px;
                        z-index: 1000;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    `;
                    carousel.style.position = 'relative';
                    carousel.appendChild(pauseIndicator);
                    
                    // Reanudar al hacer clic en el indicador
                    pauseIndicator.addEventListener('click', function(e) {
                        e.stopPropagation();
                        carouselInstance.cycle();
                        isPaused = false;
                        pauseIndicator.remove();
                    });
                } else {
                    // Si ya está pausado, reanudarlo
                    carouselInstance.cycle();
                    isPaused = false;
                    const pauseIndicator = document.getElementById('pause-indicator');
                    if (pauseIndicator) {
                        pauseIndicator.remove();
                    }
                }
            });
            
            // Evitar que los controles de navegación pausen el carrusel
            const prevBtn = carousel.querySelector('.carousel-control-prev');
            const nextBtn = carousel.querySelector('.carousel-control-next');
            const indicators = carousel.querySelectorAll('.carousel-indicators button');
            
            [prevBtn, nextBtn, ...indicators].forEach(control => {
                if (control) {
                    control.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                }
            });
            
            // Agregar efecto de transición suave
            carousel.addEventListener('slide.bs.carousel', function(e) {
                const activeItem = carousel.querySelector('.carousel-item.active');
                if (activeItem) {
                    activeItem.style.opacity = '0.7';
                }
            });
            
            carousel.addEventListener('slid.bs.carousel', function(e) {
                const activeItem = carousel.querySelector('.carousel-item.active');
                if (activeItem) {
                    activeItem.style.opacity = '1';
                }
            });
            
            // Asegurar que el carrusel se inicie automáticamente
            carouselInstance.cycle();
        }
    });
</script>
@endsection