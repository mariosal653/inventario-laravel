@extends('layouts.app')

@section('title','Editar Producto')

@section('content')
<h2 class="text-xl mb-3">Editar Producto</h2>

<form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
  @csrf @method('PUT')

  <div class="mb-2">
    <label>Nombre</label>
    <input name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2 rounded"/>
  </div>

  <div class="mb-2">
    <label>Descripción</label>
    <textarea name="description" class="w-full border p-2 rounded">{{ old('description', $product->description) }}</textarea>
  </div>

  <div class="mb-2">
    <label>Stock</label>
    <input name="stock" type="number" value="{{ old('stock', $product->stock) }}" class="w-full border p-2 rounded"/>
  </div>

  <div class="mb-2">
    <label>Precio</label>
    <input name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" class="w-full border p-2 rounded"/>
  </div>

  <div class="mb-2">
    <label>Imagen</label>
    @if($product->image)
      <img src="{{ asset('storage/'.$product->image) }}" class="h-20 mb-2"/>
    @endif
    <input type="file" name="image" class="w-full"/>
  </div>

  <button class="bg-indigo-600 text-white px-4 py-2 rounded">Actualizar</button>
  <a href="{{ route('products.index') }}" class="ml-2 text-gray-600">Cancelar</a>
</form>
@endsection
