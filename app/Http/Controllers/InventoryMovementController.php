<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryMovementController extends Controller
{
    // lista movimientos
    public function index()
    {
        $movements = InventoryMovement::with('product')->latest()->paginate(15);
        $products = Product::orderBy('name')->get();
        return view('inventory.index', compact('movements','products'));
    }

    // formulario (opcional si usas modal en index)
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('inventory.create', compact('products'));
    }

    // registrar movimiento
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entrada,salida',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($data['type'] === 'salida' && $product->stock < $data['quantity']) {
            return back()->with('error','No hay suficiente stock para realizar la salida.')->withInput();
        }

        // crear movimiento
        InventoryMovement::create($data);

        // actualizar stock
        if ($data['type'] === 'entrada') {
            $product->stock += $data['quantity'];
        } else {
            $product->stock -= $data['quantity'];
        }
        $product->save();

        return redirect()->route('inventory.index')->with('success','Movimiento registrado.');
    }

    // mostrar, editar, actualizar, eliminar (opcional)...
}
