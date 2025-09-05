@extends('layouts.app')

@section('title', 'Menú - Cafetería El Aroma')

@section('content')
<!-- Hero Section -->
<section class="hero-section py-5" style="background: linear-gradient(rgba(139, 69, 19, 0.9), rgba(139, 69, 19, 0.9)), url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?ixlib=rb-4.0.3') center/cover; color: white;">
    <div class="container">
        <div class="row align-items-center min-vh-40">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-3 fw-bold mb-4">Nuestro Menú</h1>
                <p class="lead mb-4">Descubre toda nuestra variedad de cafés y productos artesanales preparados con los mejores ingredientes</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#productos" class="btn btn-light btn-lg">
                        <i class="fas fa-coffee me-2"></i>Ver Productos
                    </a>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i>Mi Carrito
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Menu Content -->
<section class="py-5" id="productos">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary">Nuestros Productos</h2>
            <p class="lead text-muted">Filtra por categoría para encontrar exactamente lo que buscas</p>
        </div>
        
        <!-- Category Filter -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <button class="btn btn-outline-primary category-filter active" data-category="all">
                        <i class="fas fa-th me-2"></i>Todos los Productos
                    </button>
                    @foreach($categories as $category)
                        <button class="btn btn-outline-primary category-filter" data-category="{{ $category->id }}">
                            <i class="fas fa-coffee me-2"></i>{{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Products by Category -->
        @foreach($categories as $category)
            <div class="category-section mb-5" data-category-id="{{ $category->id }}">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="text-primary fw-bold">
                            <i class="fas fa-coffee me-2"></i>{{ $category->name }}
                        </h2>
                        <p class="text-muted">{{ $category->description }}</p>
                        <hr>
                    </div>
                </div>
                
                <div class="row g-4">
                    @forelse($category->products->where('available', true) as $product)
                        <div class="col-md-6 col-lg-4 product-card" data-category="{{ $category->id }}">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3' }}" 
                                         class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                                    @if($product->stock <= 5 && $product->stock > 0)
                                        <span class="position-absolute top-0 end-0 badge bg-warning m-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Pocas unidades
                                        </span>
                                    @elseif($product->stock == 0)
                                        <span class="position-absolute top-0 end-0 badge bg-danger m-2">
                                            <i class="fas fa-times me-1"></i>Agotado
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text text-muted flex-grow-1">{{ $product->description }}</p>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="h4 text-primary mb-0">{{ $product->formatted_price }}</span>
                                            <small class="text-muted">
                                                <i class="fas fa-box me-1"></i>Stock: {{ $product->stock }}
                                            </small>
                                        </div>
                                        
                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity(this)">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" class="form-control text-center quantity-input" 
                                                           name="quantity" value="1" min="1" max="{{ $product->stock }}">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity(this)">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fas fa-cart-plus me-2"></i>Agregar al Carrito
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary w-100" disabled>
                                                <i class="fas fa-times me-2"></i>No Disponible
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-4">
                                <i class="fas fa-coffee fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No hay productos disponibles en esta categoría.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
        
        @if($categories->isEmpty())
            <div class="row">
                <div class="col-12 text-center py-5">
                    <i class="fas fa-coffee fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">Menú en construcción</h3>
                    <p class="text-muted">Pronto tendremos productos disponibles para ti.</p>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="fw-bold mb-3">¿Listo para hacer tu pedido?</h3>
                <p class="text-muted mb-4">Revisa tu carrito y procede con tu compra</p>
                <a href="{{ route('cart.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-cart me-2"></i>Ver Carrito
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .min-vh-40 {
        min-height: 40vh;
    }
    
    .category-filter {
        transition: all 0.3s ease;
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 500;
    }
    
    .category-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }
    
    .category-filter.active {
        background-color: #8B4513;
        border-color: #8B4513;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.4);
    }
    
    .product-card {
        transition: all 0.3s ease;
    }
    
    .product-card:hover .card {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .product-card.hidden {
        display: none;
    }
    
    .category-section {
        transition: all 0.3s ease;
    }
    
    .category-section.hidden {
        display: none;
    }
    
    .category-section h2 {
        position: relative;
        padding-bottom: 15px;
    }
    
    .category-section h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background-color: #8B4513;
        border-radius: 2px;
    }
    
    .card-img-top {
        transition: transform 0.3s ease;
    }
    
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .btn-primary {
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.4);
    }
</style>
@endsection

@section('scripts')
<script>
    // Funciones para manejar cantidad
    function increaseQuantity(button) {
        const input = button.parentElement.querySelector('.quantity-input');
        const max = parseInt(input.getAttribute('max'));
        const current = parseInt(input.value);
        if (current < max) {
            input.value = current + 1;
        }
    }
    
    function decreaseQuantity(button) {
        const input = button.parentElement.querySelector('.quantity-input');
        const current = parseInt(input.value);
        if (current > 1) {
            input.value = current - 1;
        }
    }
    
    // Filtro de categorías
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.category-filter');
        const categorySections = document.querySelectorAll('.category-section');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Actualizar botones activos
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Mostrar/ocultar secciones
                if (category === 'all') {
                    categorySections.forEach(section => {
                        section.classList.remove('hidden');
                    });
                } else {
                    categorySections.forEach(section => {
                        const sectionCategory = section.getAttribute('data-category-id');
                        if (sectionCategory === category) {
                            section.classList.remove('hidden');
                        } else {
                            section.classList.add('hidden');
                        }
                    });
                }
            });
        });
        
        // Manejar envío de formularios
        const forms = document.querySelectorAll('.add-to-cart-form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;
                
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Agregando...';
                button.disabled = true;
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    updateCartCount();
                }, 1000);
            });
        });
    });
</script>
@endsection