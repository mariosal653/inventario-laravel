@extends('layouts.app')

@section('title','Perfil de Usuario')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-center">Perfil de Usuario</h1>

<div class="flex justify-center">
    <form action="{{ route('user.update') }}" method="POST" class="max-w-md w-full bg-white p-5 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block text-sm font-medium">Correo</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium">Nueva contraseña (opcional)</label>
            <input type="password" name="password" class="w-full p-2 border rounded">
        </div>

        <div class="flex gap-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>

            <!-- Botón logout (opcional aquí, pero usa form POST) -->
            <form action="{{ route('logout') }}" method="POST" class="ml-auto">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </form>
</div>
@endsection
