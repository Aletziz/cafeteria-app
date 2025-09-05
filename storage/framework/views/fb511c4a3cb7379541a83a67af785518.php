<?php $__env->startSection('title', 'Carrito de Compras - Cafetería El Aroma'); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('menu')); ?>">Menú</a></li>
                        <li class="breadcrumb-item active">Carrito</li>
                    </ol>
                </nav>
                <h1 class="h2 fw-bold text-primary">
                    <i class="fas fa-shopping-cart me-2"></i>Mi Carrito de Compras
                </h1>
            </div>
        </div>
    </div>
</section>

<!-- Cart Content -->
<section class="py-5 cart-section">
    <div class="container">
        <?php if(session('cart') && count(session('cart')) > 0): ?>
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8 cart-items-container">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-list me-2"></i>Productos en tu carrito
                                <span class="badge bg-primary ms-2"><?php echo e(count(session('cart'))); ?></span>
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cart-item border-bottom p-4" data-id="<?php echo e($item['product']->id); ?>">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 col-sm-3 col-4">
                                            <img src="<?php echo e($item['product']->image ?: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3'); ?>" 
                                                 class="cart-item-image img-fluid rounded" alt="<?php echo e($item['product']->name); ?>">
                                        </div>
                                        <div class="col-md-4 col-sm-9 col-8 cart-item-details">
                                            <h6 class="cart-item-title"><?php echo e($item['product']->name); ?></h6>
                                            <small class="cart-item-price">Precio unitario: $<?php echo e(number_format($item['product']->price, 2)); ?></small>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 cart-item-quantity">
                                            <div class="input-group input-group-sm quantity-controls">
                                                <button class="btn btn-outline-secondary" type="button" 
                                                        onclick="updateQuantity(<?php echo e($item['product']->id); ?>, 'decrease')">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" class="form-control text-center quantity-display" 
                                                       value="<?php echo e($item['quantity']); ?>" readonly>
                                                <button class="btn btn-outline-secondary" type="button" 
                                                        onclick="updateQuantity(<?php echo e($item['product']->id); ?>, 'increase')">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-8">
                                            <strong class="cart-item-total">$<?php echo e(number_format($item['subtotal'], 2)); ?></strong>
                                        </div>
                                        <div class="col-md-1 col-sm-2 col-4">
                                            <button class="btn btn-outline-danger btn-sm" 
                                                    onclick="removeFromCart(<?php echo e($item['product']->id); ?>)" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="card-footer">
                            <div class="cart-actions">
                                <button class="btn btn-outline-danger" onclick="clearCart()">
                                    <i class="fas fa-trash me-2"></i>Vaciar Carrito
                                </button>
                                <a href="<?php echo e(route('menu')); ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i>Seguir Comprando
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card order-summary cart-summary sticky-top" style="top: 20px;">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white">
                                <i class="fas fa-calculator me-2"></i>Resumen del Pedido
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-medium">Subtotal:</span>
                                <span class="fw-bold" id="subtotal">$<?php echo e(number_format($total, 2)); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-medium">Envío:</span>
                                <span class="text-success fw-bold">Gratis</span>
                            </div>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between mb-4">
                                <strong class="h6 mb-0">Total:</strong>
                                <strong class="text-primary h4 mb-0" id="total">$<?php echo e(number_format($total, 2)); ?></strong>
                            </div>
                            
                            <div class="d-grid gap-3">
                                <a href="<?php echo e(route('checkout')); ?>" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="fas fa-credit-card me-2"></i>Proceder al Pago
                                </a>
                                <div class="text-center">
                                    <small class="text-muted d-block mb-2">
                                        <i class="fas fa-shield-alt me-1"></i>Compra 100% segura
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-lock me-1"></i>Datos protegidos con SSL
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Delivery Info -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="fas fa-truck me-2 text-primary"></i>Información de Entrega
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-clock me-2 text-muted"></i>
                                    <small>Tiempo estimado: 30-45 min</small>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                    <small>Entrega a domicilio disponible</small>
                                </li>
                                <li>
                                    <i class="fas fa-phone me-2 text-muted"></i>
                                    <small>Contacto: (555) 123-4567</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Empty Cart -->
            <div class="row">
                <div class="col-12">
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">Tu carrito está vacío</h3>
                        <p class="text-muted mb-4">¡Agrega algunos productos deliciosos a tu carrito!</p>
                        <a href="<?php echo e(route('menu')); ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-coffee me-2"></i>Explorar Menú
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // Actualizar cantidad de producto
    function updateQuantity(productId, action) {
        const data = {
            _token: '<?php echo e(csrf_token()); ?>',
            action: action
        };
        
        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Error al actualizar el carrito');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar el carrito');
        });
    }
    
    // Eliminar producto del carrito
    function removeFromCart(productId) {
        if (confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
            fetch(`/cart/remove/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Error al eliminar el producto');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar el producto');
            });
        }
    }
    
    // Vaciar carrito completo
    function clearCart() {
        if (confirm('¿Estás seguro de que quieres vaciar todo el carrito?')) {
            fetch('/cart/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Error al vaciar el carrito');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al vaciar el carrito');
            });
        }
    }
    
    // Actualizar contador del carrito
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alexis\OneDrive\Desktop\laravel\cafeteria-app\resources\views/cart/index.blade.php ENDPATH**/ ?>