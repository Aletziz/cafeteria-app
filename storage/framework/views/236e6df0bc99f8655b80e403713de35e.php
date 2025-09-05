<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Cafetería El Aroma'); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <?php echo $__env->yieldContent('styles'); ?>
    
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
    
    <style>
        /* Mobile-first responsive improvements */
        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .mobile-menu-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--coffee-brown) 100%);
            z-index: 1050;
            transition: right 0.3s ease;
            overflow-y: auto;
        }
        
        .mobile-menu.show {
            right: 0;
        }
        
        .mobile-menu-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .mobile-menu-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            float: right;
            cursor: pointer;
        }
        
        .mobile-menu-nav {
            padding: 1rem 0;
        }
        
        .mobile-menu-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .mobile-menu-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white !important;
            padding-left: 2rem;
        }
        
        .mobile-menu-nav .nav-link i {
            margin-right: 0.75rem;
            width: 20px;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .hamburger {
            display: flex;
            flex-direction: column;
            width: 24px;
            height: 18px;
            justify-content: space-between;
            cursor: pointer;
        }
        
        .hamburger span {
            display: block;
            height: 2px;
            width: 100%;
            background-color: white;
            border-radius: 1px;
            transition: all 0.3s ease;
        }
        
        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        /* Responsive improvements */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                display: none !important;
            }
            
            .mobile-menu-toggle {
                display: block !important;
            }
        }
        
        @media (min-width: 992px) {
            .mobile-menu-toggle {
                display: none !important;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
    
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <i class="fas fa-coffee me-2"></i>Cafetería El Aroma
            </a>
            
            <!-- Desktop Navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('menu')); ?>">Menú</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('about')); ?>">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('contact')); ?>">Contacto</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="<?php echo e(route('cart.index')); ?>">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge" id="cart-count">0</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Mobile Navigation Toggle -->
            <div class="d-flex align-items-center">
                <!-- Mobile Cart Icon -->
                <a class="nav-link position-relative me-3 d-lg-none" href="<?php echo e(route('cart.index')); ?>">
                    <i class="fas fa-shopping-cart text-white"></i>
                    <span class="cart-badge" id="cart-count-mobile">0</span>
                </a>
                
                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggler mobile-menu-toggle" type="button" id="mobileMenuToggle">
                    <div class="hamburger" id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <h5 class="text-white mb-0">
                <i class="fas fa-coffee me-2"></i>Cafetería El Aroma
            </h5>
            <button class="mobile-menu-close" id="mobileMenuClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <nav class="mobile-menu-nav">
            <a class="nav-link" href="<?php echo e(route('home')); ?>">
                <i class="fas fa-home"></i>
                Inicio
            </a>
            <a class="nav-link" href="<?php echo e(route('menu')); ?>">
                <i class="fas fa-utensils"></i>
                Menú
            </a>
            <a class="nav-link" href="<?php echo e(route('about')); ?>">
                <i class="fas fa-info-circle"></i>
                Nosotros
            </a>
            <a class="nav-link" href="<?php echo e(route('contact')); ?>">
                <i class="fas fa-envelope"></i>
                Contacto
            </a>
            <a class="nav-link" href="<?php echo e(route('cart.index')); ?>">
                <i class="fas fa-shopping-cart"></i>
                Carrito de Compras
                <span class="cart-badge ms-auto" id="cart-count-menu">0</span>
            </a>
        </nav>
    </div>

    <!-- Alerts -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo e(session('warning')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-coffee me-2"></i>Cafetería El Aroma</h5>
                    <p>El mejor café de la ciudad, preparado con amor y dedicación.</p>
                </div>
                <div class="col-md-3">
                    <h6>Enlaces</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('home')); ?>" class="text-light">Inicio</a></li>
                        <li><a href="<?php echo e(route('menu')); ?>" class="text-light">Menú</a></li>
                        <li><a href="<?php echo e(route('about')); ?>" class="text-light">Nosotros</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" class="text-light">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Contacto</h6>
                    <p><i class="fas fa-phone me-2"></i>(555) 123-4567</p>
                    <p><i class="fas fa-envelope me-2"></i>info@cafeteriaelaroma.com</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Calle Principal 123</p>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center">
                <p>&copy; <?php echo e(date('Y')); ?> Cafetería El Aroma. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    
    <script>
        // Update cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            initMobileMenu();
        });
        
        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const count = data.count;
                    document.getElementById('cart-count').textContent = count;
                    const mobileCount = document.getElementById('cart-count-mobile');
                    const menuCount = document.getElementById('cart-count-menu');
                    if (mobileCount) mobileCount.textContent = count;
                    if (menuCount) menuCount.textContent = count;
                })
                .catch(error => console.error('Error:', error));
        }
        
        function initMobileMenu() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenuClose = document.getElementById('mobileMenuClose');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const hamburger = document.getElementById('hamburger');
            
            if (!mobileMenuToggle || !mobileMenu) return;
            
            // Open mobile menu
             mobileMenuToggle.addEventListener('click', function() {
                 mobileMenu.classList.add('active');
                 mobileMenuOverlay.classList.add('active');
                 hamburger.classList.add('active');
                 document.body.style.overflow = 'hidden';
             });
             
             // Close mobile menu
             function closeMobileMenu() {
                 mobileMenu.classList.remove('active');
                 mobileMenuOverlay.classList.remove('active');
                 hamburger.classList.remove('active');
                 document.body.style.overflow = '';
             }
            
            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', closeMobileMenu);
            }
            
            if (mobileMenuOverlay) {
                mobileMenuOverlay.addEventListener('click', closeMobileMenu);
            }
            
            // Close menu when clicking on a link
            const mobileMenuLinks = document.querySelectorAll('.mobile-menu-nav .nav-link');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
            
            // Close menu on escape key
             document.addEventListener('keydown', function(e) {
                 if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                     closeMobileMenu();
                 }
             });
        }
    </script>
    
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\Alexis\OneDrive\Desktop\laravel\cafeteria-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>