<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Mostrar el carrito
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $product->price * $details['quantity']
                ];
                $total += $product->price * $details['quantity'];
            }
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Agregar producto al carrito
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if (!$product->available || $product->stock <= 0) {
            return redirect()->back()->with('error', 'Producto no disponible');
        }

        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity
            ];
        }

        // Verificar stock
        if ($cart[$id]['quantity'] > $product->stock) {
            $cart[$id]['quantity'] = $product->stock;
            Session::put('cart', $cart);
            return redirect()->back()->with('warning', 'Cantidad ajustada al stock disponible');
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Actualizar cantidad en el carrito
     */
    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);
        $product = Product::findOrFail($id);

        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Cantidad excede el stock disponible');
        }

        if ($quantity <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity'] = $quantity;
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Carrito actualizado');
    }

    /**
     * Eliminar producto del carrito
     */
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Limpiar carrito
     */
    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Carrito vaciado');
    }

    /**
     * Obtener cantidad de items en el carrito
     */
    public function count()
    {
        $cart = Session::get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        
        return response()->json(['count' => $count]);
    }
}