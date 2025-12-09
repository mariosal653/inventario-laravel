@extends('layouts.app')

@section('title','Productos')

@section('content')

<style>
  .centered {
      text-align: center;
      vertical-align: middle;
  }
</style>

<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold">Productos</h1>
  <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">
    Nuevo producto
  </a>
</div>

<table class="min-w-full bg-white shadow rounded">
  <thead>
    <tr class="border-b bg-gray-100">
      <th class="p-2 centered">ID</th>
      <th class="p-2 centered">Nombre</th>
      <th class="p-2 centered">Stock</th>
      <th class="p-2 centered">Precio</th>
      <th class="p-2 centered">Acciones</th>
    </tr>
  </thead>

  <tbody>
    @foreach($products as $p)
      <tr class="border-t hover:bg-gray-50">
        
        <td class="p-2 centered">{{ $p->id }}</td>

        <td class="p-2 centered">
          <div class="flex items-center justify-center gap-3">
            @if($p->image)
              <img 
                src="{{ asset('storage/'.$p->image) }}" 
                class="h-10 w-10 object-cover rounded"
              />
            @endif
            {{ $p->name }}
          </div>
        </td>

        <td class="p-2 centered">{{ $p->stock }}</td>

        <td class="p-2 centered">
          ${{ number_format($p->price,2) }}
        </td>

        <td class="p-2 centered">
          <a href="{{ route('products.show', $p) }}" class="px-2 text-blue-600">Ver</a>
          <a href="{{ route('products.edit', $p) }}" class="px-2 text-green-600">Editar</a>

          <form 
            action="{{ route('products.destroy',$p) }}" 
            method="POST" 
            class="inline"
            onsubmit="return confirm('¿Deseas eliminar este producto?');"
          >
            @csrf 
            @method('DELETE')
            <button class="text-red-600 px-2">
              Eliminar
            </button>
          </form>
        </td>

      </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-4 text-center">
  {{ $products->links() }}
</div>

@endsection
