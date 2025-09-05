// ===== CAFETERÍA EL AROMA - JAVASCRIPT PERSONALIZADO =====

// Variables globales
let cartCount = 0;
let cartItems = [];

// Inicialización cuando el DOM está listo
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

// Función principal de inicialización
function initializeApp() {
    updateCartCount();
    initializeQuantityControls();
    initializeFormValidation();
    initializeTooltips();
    initializeSmoothScrolling();
    initializeImageLazyLoading();
}

// ===== FUNCIONES DEL CARRITO =====

// Actualizar contador del carrito
function updateCartCount() {
    fetch('/cart/count')
        .then(response => response.json())
        .then(data => {
            const cartBadge = document.getElementById('cart-count');
            if (cartBadge) {
                cartBadge.textContent = data.count;
                cartBadge.style.display = data.count > 0 ? 'inline-block' : 'none';
            }
        })
        .catch(error => console.error('Error updating cart count:', error));
}

// Agregar producto al carrito
function addToCart(productId, quantity = 1) {
    const button = document.querySelector(`[onclick="addToCart(${productId})"]`);
    const originalText = button ? button.innerHTML : '';
    
    // Mostrar loading
    if (button) {
        button.innerHTML = '<span class="loading-spinner"></span> Agregando...';
        button.disabled = true;
    }
    
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Producto agregado al carrito', 'success');
            updateCartCount();
            
            // Animación de éxito
            if (button) {
                button.innerHTML = '<i class="fas fa-check"></i> ¡Agregado!';
                button.classList.add('btn-success');
                button.classList.remove('btn-primary');
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-primary');
                    button.disabled = false;
                }, 2000);
            }
        } else {
            showAlert(data.message || 'Error al agregar producto', 'error');
            if (button) {
                button.innerHTML = originalText;
                button.disabled = false;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error al agregar producto al carrito', 'error');
        if (button) {
            button.innerHTML = originalText;
            button.disabled = false;
        }
    });
}

// Actualizar cantidad en el carrito
function updateCartItem(itemId, quantity) {
    if (quantity < 1) {
        removeFromCart(itemId);
        return;
    }
    
    const formData = new FormData();
    formData.append('quantity', quantity);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('_method', 'PATCH');
    
    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Recargar para actualizar totales
        } else {
            showAlert(data.message || 'Error al actualizar cantidad', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error al actualizar el carrito', 'error');
    });
}

// Remover producto del carrito
function removeFromCart(itemId) {
    if (!confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('_method', 'DELETE');
    
    fetch(`/cart/remove/${itemId}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Producto eliminado del carrito', 'success');
            location.reload();
        } else {
            showAlert(data.message || 'Error al eliminar producto', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error al eliminar producto del carrito', 'error');
    });
}

// Limpiar carrito completo
function clearCart() {
    if (!confirm('¿Estás seguro de que quieres vaciar todo el carrito?')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('_method', 'DELETE');
    
    fetch('/cart/clear', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Carrito vaciado', 'success');
            location.reload();
        } else {
            showAlert(data.message || 'Error al vaciar carrito', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error al vaciar el carrito', 'error');
    });
}

// ===== CONTROLES DE CANTIDAD =====

function initializeQuantityControls() {
    // Controles de cantidad en productos
    document.querySelectorAll('.quantity-controls').forEach(control => {
        const minusBtn = control.querySelector('.quantity-minus');
        const plusBtn = control.querySelector('.quantity-plus');
        const input = control.querySelector('.quantity-input');
        
        if (minusBtn && plusBtn && input) {
            minusBtn.addEventListener('click', () => {
                let value = parseInt(input.value) || 1;
                if (value > 1) {
                    input.value = value - 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
            
            plusBtn.addEventListener('click', () => {
                let value = parseInt(input.value) || 1;
                const max = parseInt(input.getAttribute('max')) || 99;
                if (value < max) {
                    input.value = value + 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
            
            input.addEventListener('change', () => {
                let value = parseInt(input.value) || 1;
                const min = parseInt(input.getAttribute('min')) || 1;
                const max = parseInt(input.getAttribute('max')) || 99;
                
                if (value < min) input.value = min;
                if (value > max) input.value = max;
                
                // Si estamos en la página del carrito, actualizar automáticamente
                if (window.location.pathname.includes('/cart')) {
                    const itemId = input.getAttribute('data-item-id');
                    if (itemId) {
                        clearTimeout(input.updateTimeout);
                        input.updateTimeout = setTimeout(() => {
                            updateCartItem(itemId, input.value);
                        }, 1000);
                    }
                }
            });
        }
    });
}

// ===== FILTROS DE CATEGORÍAS =====

function filterByCategory(categoryId) {
    const categoryButtons = document.querySelectorAll('.category-btn');
    const productSections = document.querySelectorAll('.category-section');
    
    // Actualizar botones activos
    categoryButtons.forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('data-category') == categoryId || 
            (categoryId === 'all' && btn.getAttribute('data-category') === 'all')) {
            btn.classList.add('active');
        }
    });
    
    // Mostrar/ocultar secciones
    productSections.forEach(section => {
        if (categoryId === 'all' || section.getAttribute('data-category') == categoryId) {
            section.style.display = 'block';
            section.classList.add('fade-in');
        } else {
            section.style.display = 'none';
        }
    });
    
    // Scroll suave a la sección de productos
    const productsSection = document.getElementById('products-section');
    if (productsSection) {
        productsSection.scrollIntoView({ behavior: 'smooth' });
    }
}

// ===== VALIDACIÓN DE FORMULARIOS =====

function initializeFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                showAlert('Por favor, completa todos los campos requeridos', 'error');
            }
        });
    });
}

function validateForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    // Validación de email
    const emailFields = form.querySelectorAll('input[type="email"]');
    emailFields.forEach(field => {
        if (field.value && !isValidEmail(field.value)) {
            field.classList.add('is-invalid');
            isValid = false;
        }
    });
    
    // Validación de teléfono
    const phoneFields = form.querySelectorAll('input[type="tel"]');
    phoneFields.forEach(field => {
        if (field.value && !isValidPhone(field.value)) {
            field.classList.add('is-invalid');
            isValid = false;
        }
    });
    
    return isValid;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^[\d\s\-\+\(\)]{8,}$/;
    return phoneRegex.test(phone);
}

// ===== SISTEMA DE ALERTAS =====

function showAlert(message, type = 'info', duration = 5000) {
    const alertContainer = document.getElementById('alert-container') || createAlertContainer();
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${getBootstrapAlertClass(type)} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        <i class="fas fa-${getAlertIcon(type)} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    alertContainer.appendChild(alertDiv);
    
    // Auto-dismiss
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.classList.remove('show');
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 150);
        }
    }, duration);
}

function createAlertContainer() {
    const container = document.createElement('div');
    container.id = 'alert-container';
    container.style.position = 'fixed';
    container.style.top = '20px';
    container.style.right = '20px';
    container.style.zIndex = '9999';
    container.style.maxWidth = '400px';
    document.body.appendChild(container);
    return container;
}

function getBootstrapAlertClass(type) {
    const classes = {
        'success': 'success',
        'error': 'danger',
        'warning': 'warning',
        'info': 'info'
    };
    return classes[type] || 'info';
}

function getAlertIcon(type) {
    const icons = {
        'success': 'check-circle',
        'error': 'exclamation-triangle',
        'warning': 'exclamation-circle',
        'info': 'info-circle'
    };
    return icons[type] || 'info-circle';
}

// ===== TOOLTIPS =====

function initializeTooltips() {
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
}

// ===== SCROLL SUAVE =====

function initializeSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// ===== LAZY LOADING DE IMÁGENES =====

function initializeImageLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}

// ===== FORMATEO DE NÚMEROS =====

function formatCurrency(amount) {
    return new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
    }).format(amount);
}

function formatNumber(number) {
    return new Intl.NumberFormat('es-CO').format(number);
}

// ===== UTILIDADES =====

// Debounce function
function debounce(func, wait, immediate) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ===== MANEJO DE ERRORES GLOBALES =====

window.addEventListener('error', function(e) {
    console.error('Error global:', e.error);
});

window.addEventListener('unhandledrejection', function(e) {
    console.error('Promise rechazada:', e.reason);
});

// ===== EXPORTAR FUNCIONES GLOBALES =====

window.addToCart = addToCart;
window.updateCartItem = updateCartItem;
window.removeFromCart = removeFromCart;
window.clearCart = clearCart;
window.filterByCategory = filterByCategory;
window.showAlert = showAlert;
window.formatCurrency = formatCurrency;
window.formatNumber = formatNumber;