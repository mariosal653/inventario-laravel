@extends('layouts.app')

@section('title','Movimientos de Inventario')

@section('content')

<style>
  .centered {
      text-align: center;
      vertical-align: middle;
  }
</style>

<h1 class="text-3xl font-bold mb-5 text-gray-800">Movimientos</h1>

<!-- FORMULARIO -->
<div class="bg-white p-6 shadow-lg rounded-xl mb-6 border border-gray-200">
  <form action="{{ route('inventory.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
    @csrf

    <div>
      <label class="font-semibold text-gray-700">Producto</label>
      <select name="product_id" class="w-full border p-2 rounded-lg focus:ring focus:ring-indigo-300">
        @foreach($products as $prod)
          <option value="{{ $prod->id }}">{{ $prod->name }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="font-semibold text-gray-700">Tipo</label>
      <select name="type" class="w-full border p-2 rounded-lg focus:ring focus:ring-indigo-300">
        <option value="entrada">Entrada</option>
        <option value="salida">Salida</option>
      </select>
    </div>

    <div>
      <label class="font-semibold text-gray-700">Cantidad</label>
      <input type="number" name="quantity" min="1" class="w-full border p-2 rounded-lg focus:ring focus:ring-indigo-300"/>
    </div>

    <div class="flex items-end">
      <button class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-4 py-2 rounded-lg shadow">
        Registrar
      </button>
    </div>
  </form>
</div>

<!-- TABLA -->
<div class="overflow-x-auto">
  <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
    <thead>
      <tr class="bg-gray-100 border-b">
        <th class="p-3 centered font-semibold text-gray-700">ID</th>
        <th class="p-3 centered font-semibold text-gray-700">Producto</th>
        <th class="p-3 centered font-semibold text-gray-700">Tipo</th>
        <th class="p-3 centered font-semibold text-gray-700">Cantidad</th>
        <th class="p-3 centered font-semibold text-gray-700">Fecha</th>
      </tr>
    </thead>

    <tbody>
      @foreach($movements as $m)
        <tr class="border-b hover:bg-gray-50 transition">
          <td class="p-3 centered">{{ $m->id }}</td>

          <td class="p-3 centered text-gray-800">
            {{ $m->product ? $m->product->name : 'N/A' }}
          </td>

          <td class="p-3 centered">
            @if($m->type === 'entrada')
              <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">
                Entrada
              </span>
            @else
              <span class="px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-full">
                Salida
              </span>
            @endif
          </td>

          <td class="p-3 centered font-bold text-gray-700">
            {{ $m->quantity }}
          </td>

          <td class="p-3 centered text-gray-600">
            {{ $m->created_at->format('d/m/Y H:i') }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="mt-6">
  {{ $movements->links() }}
</div>

@endsection
