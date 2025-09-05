@extends('layouts.app')

@section('title', 'Checkout - Cafetería El Aroma')

@section('content')
<!-- Page Header -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Carrito</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                </nav>
                <h1 class="h2 fw-bold text-primary">
                    <i class="fas fa-credit-card me-2"></i>Finalizar Pedido
                </h1>
            </div>
        </div>
    </div>
</section>

<!-- Checkout Content -->
<section class="py-5 checkout-section">
    <div class="container">
        @if(session('cart') && count(session('cart')) > 0)
            <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                @csrf
                <div class="row">
                    <!-- Customer Information -->
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-user me-2"></i>Información del Cliente
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_name" class="form-label">Nombre Completo *</label>
                                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                               id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                                        @error('customer_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_email" class="form-label">Correo Electrónico *</label>
                                        <input type="email" class="form-control @error('customer_email') is-invalid @enderror" 
                                               id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                                        @error('customer_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_phone" class="form-label">Teléfono *</label>
                                        <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" 
                                               id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                                        @error('customer_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_address" class="form-label">Dirección de Entrega *</label>
                                        <input type="text" class="form-control @error('customer_address') is-invalid @enderror" 
                                               id="customer_address" name="customer_address" value="{{ old('customer_address') }}" required>
                                        @error('customer_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notas Especiales (Opcional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3" 
                                              placeholder="Instrucciones especiales para tu pedido...">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-credit-card me-2"></i>Método de Pago
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" 
                                                   id="cash" value="cash" checked>
                                            <label class="form-check-label" for="cash">
                                                <i class="fas fa-money-bill-wave me-2 text-success"></i>
                                                Pago en Efectivo (Contra Entrega)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" 
                                                   id="card" value="card">
                                            <label class="form-check-label" for="card">
                                                <i class="fas fa-credit-card me-2 text-primary"></i>
                                                Tarjeta de Crédito/Débito
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card Details (Hidden by default) -->
                                <div id="card-details" class="d-none">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="card_number" class="form-label">Número de Tarjeta</label>
                                            <input type="text" class="form-control" id="card_number" 
                                                   placeholder="1234 5678 9012 3456" maxlength="19">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="card_cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="card_cvv" 
                                                   placeholder="123" maxlength="4">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="card_expiry" class="form-label">Fecha de Vencimiento</label>
                                            <input type="text" class="form-control" id="card_expiry" 
                                                   placeholder="MM/AA" maxlength="5">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="card_name" class="form-label">Nombre en la Tarjeta</label>
                                            <input type="text" class="form-control" id="card_name" 
                                                   placeholder="Como aparece en la tarjeta">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card sticky-top checkout-summary" style="top: 20px;">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-receipt me-2"></i>Resumen del Pedido
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Order Items -->
                                <div class="mb-3">
                                    @foreach($cartItems as $item)
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="flex-grow-1">
                                                <small class="fw-bold">{{ $item['product']->name }}</small>
                                                <br>
                                                <small class="text-muted">{{ $item['quantity'] }} x ${{ number_format($item['product']->price, 2) }}</small>
                                            </div>
                                            <small class="fw-bold">${{ number_format($item['subtotal'], 2) }}</small>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <hr>
                                
                                <!-- Totals -->
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Envío:</span>
                                    <span class="text-success">Gratis</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Impuestos:</span>
                                    <span>$0.00</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>Total:</strong>
                                    <strong class="text-primary h5">${{ number_format($total, 2) }}</strong>
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="d-grid gap-3">
                                    <button type="submit" class="btn btn-primary btn-lg shadow-sm" id="submit-order">
                                        <i class="fas fa-check me-2"></i>Confirmar Pedido
                                    </button>
                                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>Volver al Carrito
                                    </a>
                                </div>
                                
                                <div class="text-center mt-4">
                                    <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap security-badges">
                                        <small class="text-muted">
                                            <i class="fas fa-shield-alt me-1"></i>
                                            Datos protegidos
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-lock me-1"></i>
                                            SSL Seguro
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-credit-card me-1"></i>
                                            Pago seguro
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <!-- Empty Cart Redirect -->
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">No hay productos en tu carrito</h3>
                        <p class="text-muted mb-4">Agrega algunos productos antes de proceder al checkout.</p>
                        <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-coffee me-2"></i>Explorar Menú
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar cambio de método de pago
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const cardDetails = document.getElementById('card-details');
        
        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                if (this.value === 'card') {
                    cardDetails.classList.remove('d-none');
                } else {
                    cardDetails.classList.add('d-none');
                }
            });
        });
        
        // Formatear número de tarjeta
        const cardNumberInput = document.getElementById('card_number');
        if (cardNumberInput) {
            cardNumberInput.addEventListener('input', function() {
                let value = this.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
                let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                this.value = formattedValue;
            });
        }
        
        // Formatear fecha de vencimiento
        const cardExpiryInput = document.getElementById('card_expiry');
        if (cardExpiryInput) {
            cardExpiryInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                this.value = value;
            });
        }
        
        // Validar formulario antes del envío
        const form = document.getElementById('checkout-form');
        const submitButton = document.getElementById('submit-order');
        
        form.addEventListener('submit', function(e) {
            const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (selectedPayment === 'card') {
                const cardNumber = document.getElementById('card_number').value;
                const cardCvv = document.getElementById('card_cvv').value;
                const cardExpiry = document.getElementById('card_expiry').value;
                const cardName = document.getElementById('card_name').value;
                
                if (!cardNumber || !cardCvv || !cardExpiry || !cardName) {
                    e.preventDefault();
                    alert('Por favor, completa todos los campos de la tarjeta.');
                    return;
                }
            }
            
            // Cambiar texto del botón
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
            submitButton.disabled = true;
        });
        
        // Validación en tiempo real
        const requiredFields = document.querySelectorAll('input[required]');
        requiredFields.forEach(field => {
            field.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });
    });
</script>
@endsection