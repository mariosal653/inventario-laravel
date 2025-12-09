@extends('layouts.app')

@section('title','Nuevo Producto')

@section('content')

<h2 class="text-2xl font-bold mb-4">Nuevo Producto</h2>

<form 
  action="{{ route('products.store') }}" 
  method="POST" 
  enctype="multipart/form-data" 
  class="bg-white p-6 shadow rounded max-w-lg"
>
  @csrf

  <div class="mb-4">
    <label class="block font-semibold">Nombre</label>
    <input 
      name="name" 
      value="{{ old('name') }}" 
      class="w-full border p-2 rounded"
    />
    @error('name') 
      <div class="text-red-600 text-sm">{{ $message }}</div> 
    @enderror
  </div>

  <div class="mb-4">
    <label class="block font-semibold">Descripción</label>
    <textarea 
      name="description" 
      class="w-full border p-2 rounded"
    >{{ old('description') }}</textarea>
  </div>

  <div class="mb-4">
    <label class="block font-semibold">Stock</label>
    <input 
      name="stock" 
      type="number" 
      value="{{ old('stock',0) }}" 
      class="w-full border p-2 rounded"
    />
  </div>

  <div class="mb-4">
    <label class="block font-semibold">Precio</label>
    <input 
      name="price" 
      type="number" 
      step="0.01" 
      value="{{ old('price',0) }}" 
      class="w-full border p-2 rounded"
    />
  </div>

  <div class="mb-4">
    <label class="block font-semibold">Imagen</label>
    <input type="file" name="image" class="w-full"/>
  </div>

  <button class="bg-indigo-600 text-white px-4 py-2 rounded">
    Guardar
  </button>

  <a href="{{ route('products.index') }}" class="ml-2 text-gray-600">
    Cancelar
  </a>

</form>

@endsection
