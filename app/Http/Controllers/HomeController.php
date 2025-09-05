<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Contact;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Página principal
     */
    public function index()
    {
        $categories = Category::active()->with('products')->get();
        $featuredProducts = Product::available()->take(6)->get();
        $carouselSlides = CarouselSlide::active()->ordered()->get();
        
        return view('home', compact('categories', 'featuredProducts', 'carouselSlides'));
    }

    /**
     * Página del menú
     */
    public function menu()
    {
        $categories = Category::active()->with(['products' => function($query) {
            $query->available();
        }])->get();
        
        return view('menu', compact('categories'));
    }

    /**
     * Página de contacto
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Página acerca de nosotros
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Procesar formulario de contacto
     */
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000'
        ]);

        Contact::create($validated);

        return redirect()->route('contact')->with('success', '¡Gracias por contactarnos! Hemos recibido tu mensaje y te responderemos pronto.');
    }
}