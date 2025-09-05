@extends('layouts.app')

@section('title', 'Contacto - Cafetería El Aroma')

@section('content')
<!-- Mensaje de éxito -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
    <div class="container">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif

<!-- Hero Section -->
<section class="hero-section py-5" style="background: linear-gradient(rgba(139, 69, 19, 0.8), rgba(139, 69, 19, 0.8)), url('https://images.unsplash.com/photo-1521017432531-fbd92d768814?ixlib=rb-4.0.3') center/cover; color: white;">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-3 fw-bold mb-4">Contacto</h1>
                <p class="lead mb-4">Estamos aquí para atenderte. Contáctanos o ven a visitarnos</p>
            </div>
        </div>
    </div>
</section>

<!-- Información de Contacto -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Información de Contacto -->
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold text-primary mb-4">Información de Contacto</h2>
                <p class="lead text-muted mb-5">
                    Nos encanta escuchar de nuestros clientes. No dudes en contactarnos para cualquier consulta, sugerencia o simplemente para saludarnos.
                </p>
                
                <div class="row g-4">
                    <div class="col-12">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold mb-1">Dirección</h5>
                                <p class="text-muted mb-0">Calle Principal 123, Centro Histórico<br>Ciudad de México, CDMX 06000</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold mb-1">Teléfono</h5>
                                <p class="text-muted mb-0">
                                    <a href="tel:+525551234567" class="text-decoration-none text-muted">(55) 5123-4567</a><br>
                                    <a href="tel:+525559876543" class="text-decoration-none text-muted">(55) 5987-6543</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold mb-1">Email</h5>
                                <p class="text-muted mb-0">
                                    <a href="mailto:info@cafeteriaelaroma.com" class="text-decoration-none text-muted">info@cafeteriaelaroma.com</a><br>
                                    <a href="mailto:pedidos@cafeteriaelaroma.com" class="text-decoration-none text-muted">pedidos@cafeteriaelaroma.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold mb-1">Horarios</h5>
                                <p class="text-muted mb-0">
                                    <strong>Lunes a Viernes:</strong> 7:00 AM - 9:00 PM<br>
                                    <strong>Sábados:</strong> 8:00 AM - 10:00 PM<br>
                                    <strong>Domingos:</strong> 8:00 AM - 8:00 PM
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de Contacto -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-primary mb-4">Envíanos un Mensaje</h3>
                        
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">Nombre *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="col-12">
                                    <label for="phone" class="form-label fw-semibold">Teléfono</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                
                                <div class="col-12">
                                    <label for="subject" class="form-label fw-semibold">Asunto *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Selecciona un asunto</option>
                                        <option value="consulta">Consulta General</option>
                                        <option value="pedido">Información sobre Pedidos</option>
                                        <option value="evento">Eventos y Reservaciones</option>
                                        <option value="sugerencia">Sugerencias</option>
                                        <option value="queja">Quejas</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                                
                                <div class="col-12">
                                    <label for="message" class="form-label fw-semibold">Mensaje *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Escribe tu mensaje aquí..."></textarea>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Enviar Mensaje
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mapa y Redes Sociales -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-5">
            <!-- Mapa -->
            <div class="col-lg-8">
                <h3 class="fw-bold text-primary mb-4">Cómo Llegar</h3>
                <div class="ratio ratio-16x9 rounded overflow-hidden shadow">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.6157267825!2d-99.13320668507394!3d19.432608086886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f92f6c8b5c5b%3A0x8b8b8b8b8b8b8b8b!2sCentro%20Hist%C3%B3rico%2C%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses!2smx!4v1635789012345!5m2!1ses!2smx" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="mt-3">
                    <p class="text-muted mb-2">
                        <i class="fas fa-subway me-2 text-primary"></i>
                        <strong>Metro:</strong> Estación Zócalo (Línea 2) - 3 minutos caminando
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-bus me-2 text-primary"></i>
                        <strong>Autobús:</strong> Líneas 1, 2, 3 - Parada Centro Histórico
                    </p>
                    <p class="text-muted">
                        <i class="fas fa-car me-2 text-primary"></i>
                        <strong>Estacionamiento:</strong> Disponible en calles aledañas (con parquímetro)
                    </p>
                </div>
            </div>
            
            <!-- Redes Sociales -->
            <div class="col-lg-4">
                <h3 class="fw-bold text-primary mb-4">Síguenos</h3>
                <p class="text-muted mb-4">
                    Mantente al día con nuestras novedades, promociones especiales y eventos siguiéndonos en nuestras redes sociales.
                </p>
                
                <div class="d-grid gap-3">
                    <a href="#" class="btn btn-outline-primary btn-lg d-flex align-items-center">
                        <i class="fab fa-facebook-f me-3"></i>
                        <div class="text-start">
                            <div class="fw-bold">Facebook</div>
                            <small class="text-muted">@CafeteriaElAroma</small>
                        </div>
                    </a>
                    
                    <a href="#" class="btn btn-outline-primary btn-lg d-flex align-items-center">
                        <i class="fab fa-instagram me-3"></i>
                        <div class="text-start">
                            <div class="fw-bold">Instagram</div>
                            <small class="text-muted">@cafeteria_el_aroma</small>
                        </div>
                    </a>
                    
                    <a href="#" class="btn btn-outline-primary btn-lg d-flex align-items-center">
                        <i class="fab fa-twitter me-3"></i>
                        <div class="text-start">
                            <div class="fw-bold">Twitter</div>
                            <small class="text-muted">@ElAromaCafe</small>
                        </div>
                    </a>
                    
                    <a href="#" class="btn btn-outline-primary btn-lg d-flex align-items-center">
                        <i class="fab fa-whatsapp me-3"></i>
                        <div class="text-start">
                            <div class="fw-bold">WhatsApp</div>
                            <small class="text-muted">(55) 5123-4567</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="fw-bold mb-3">¿Listo para disfrutar del mejor café?</h3>
                <p class="lead mb-4">Ven a visitarnos o haz tu pedido en línea</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('menu') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-coffee me-2"></i>Ver Menú
                    </a>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i>Hacer Pedido
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .min-vh-50 {
        min-height: 50vh;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
    }
    
    .btn-lg {
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .btn-outline-primary:hover {
        background-color: #8B4513;
        border-color: #8B4513;
    }
</style>
@endsection