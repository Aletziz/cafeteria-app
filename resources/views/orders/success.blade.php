@extends('layouts.app')

@section('title', 'Pedido Confirmado - Cafetería El Aroma')

@section('content')
<!-- Success Header -->
<section class="py-5 bg-success text-white order-success-header">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="mb-4">
                    <i class="fas fa-check-circle fa-5x mb-3"></i>
                    <h1 class="display-4 fw-bold mb-3">¡Pedido Confirmado!</h1>
                    <p class="lead mb-0">Tu pedido ha sido recibido y está siendo procesado</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Order Details -->
<section class="py-5 order-success-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Order Information -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>Detalles del Pedido
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-primary">Número de Pedido:</h6>
                                <p class="mb-3">#{{ $order->id }}</p>
                                
                                <h6 class="fw-bold text-primary">Fecha del Pedido:</h6>
                                <p class="mb-3">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                
                                <h6 class="fw-bold text-primary">Estado:</h6>
                                <span class="badge bg-warning text-dark mb-3">{{ ucfirst($order->status) }}</span>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-primary">Total del Pedido:</h6>
                                <p class="h4 text-success mb-3">${{ $order->formatted_total }}</p>
                                
                                <h6 class="fw-bold text-primary">Estado del Pago:</h6>
                                <span class="badge bg-info mb-3">{{ ucfirst($order->payment_status) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Customer Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-user me-2"></i>Información del Cliente
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Nombre:</h6>
                                <p class="mb-2">{{ $order->customer_name }}</p>
                                
                                <h6 class="fw-bold">Email:</h6>
                                <p class="mb-2">{{ $order->customer_email }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Teléfono:</h6>
                                <p class="mb-2">{{ $order->customer_phone }}</p>
                                
                                <h6 class="fw-bold">Dirección de Entrega:</h6>
                                <p class="mb-2">{{ $order->customer_address }}</p>
                            </div>
                        </div>
                        
                        @if($order->notes)
                            <div class="mt-3">
                                <h6 class="fw-bold">Notas Especiales:</h6>
                                <p class="text-muted">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Order Items -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-coffee me-2"></i>Productos Pedidos
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover order-items-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Precio Unit.</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                             alt="{{ $item->product->name }}" 
                                                             class="rounded me-3" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                                             style="width: 50px; height: 50px;">
                                                            <i class="fas fa-coffee text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->product ? $item->product->name : 'Producto no disponible' }}</h6>
                                                        @if($item->special_instructions)
                                                            <small class="text-muted">{{ $item->special_instructions }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge bg-secondary">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-end align-middle">
                                                ${{ $item->formatted_unit_price }}
                                            </td>
                                            <td class="text-end align-middle fw-bold">
                                                ${{ $item->formatted_total_price }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th colspan="3" class="text-end">Total del Pedido:</th>
                                        <th class="text-end text-success h5">${{ $order->formatted_total }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Next Steps -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>¿Qué sigue?
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center next-steps-item">
                                <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                                <h6 class="fw-bold">Preparación</h6>
                                <p class="small text-muted">Comenzaremos a preparar tu pedido inmediatamente</p>
                            </div>
                            <div class="col-md-4 text-center next-steps-item">
                                <i class="fas fa-phone fa-2x text-success mb-2"></i>
                                <h6 class="fw-bold">Confirmación</h6>
                                <p class="small text-muted">Te llamaremos para confirmar los detalles de entrega</p>
                            </div>
                            <div class="col-md-4 text-center next-steps-item">
                                <i class="fas fa-truck fa-2x text-warning mb-2"></i>
                                <h6 class="fw-bold">Entrega</h6>
                                <p class="small text-muted">Tiempo estimado: 30-45 minutos</p>
                            </div>
                        </div>
                        
                        <div class="alert alert-light border-start border-primary border-4 mt-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-1">Confirmación por Email</h6>
                                    <p class="mb-0 small">Hemos enviado una confirmación a <strong>{{ $order->customer_email }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="text-center order-action-buttons">
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-md-2">
                            <i class="fas fa-home me-2"></i>Volver al Inicio
                        </a>
                        <a href="{{ route('menu') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-coffee me-2"></i>Seguir Comprando
                        </a>
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-muted">
                            <i class="fas fa-question-circle me-1"></i>
                            ¿Tienes alguna pregunta? 
                            <a href="tel:+1234567890" class="text-decoration-none">Llámanos al (123) 456-7890</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Thank You Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h4 class="text-primary mb-3">¡Gracias por tu preferencia!</h4>
                <p class="text-muted mb-0">
                    En Cafetería El Aroma nos esforzamos por brindarte la mejor experiencia. 
                    Tu satisfacción es nuestra prioridad.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar animación de éxito
        const successIcon = document.querySelector('.fa-check-circle');
        if (successIcon) {
            successIcon.style.transform = 'scale(0)';
            successIcon.style.transition = 'transform 0.5s ease-in-out';
            
            setTimeout(() => {
                successIcon.style.transform = 'scale(1)';
            }, 200);
        }
        
        // Auto-scroll suave al contenido principal
        setTimeout(() => {
            document.querySelector('.container').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 1000);
    });
</script>
@endsection