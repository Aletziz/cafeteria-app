<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Mostrar formulario de checkout
     */
    public function checkout()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

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

        return view('checkout', compact('cartItems', 'total'));
    }

    /**
     * Procesar el pedido
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        DB::beginTransaction();
        
        try {
            $total = 0;
            $orderItems = [];

            // Verificar stock y calcular total
            foreach ($cart as $id => $details) {
                $product = Product::findOrFail($id);
                
                if (!$product->available || $product->stock < $details['quantity']) {
                    throw new \Exception("Producto {$product->name} no tiene stock suficiente");
                }

                $subtotal = $product->price * $details['quantity'];
                $total += $subtotal;
                
                $orderItems[] = [
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'unit_price' => $product->price,
                    'total_price' => $subtotal
                ];
            }

            // Crear el pedido
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'notes' => $request->notes
            ]);

            // Crear los items del pedido y actualizar stock
            foreach ($orderItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['total_price']
                ]);

                // Actualizar stock
                $product = Product::find($item['product_id']);
                $product->stock -= $item['quantity'];
                $product->save();
            }

            DB::commit();
            
            // Limpiar carrito
            Session::forget('cart');
            
            return redirect()->route('order.success', $order->id)
                ->with('success', 'Pedido realizado exitosamente');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Página de éxito del pedido
     */
    public function success($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('order.success', compact('order'));
    }

    /**
     * Ver detalles del pedido
     */
    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('order.show', compact('order'));
    }
}