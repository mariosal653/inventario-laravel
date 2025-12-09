<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title','Inventario')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-gray-800 text-white px-4 py-3 shadow">
    <div class="container mx-auto grid grid-cols-3 items-center">

        <!-- IZQUIERDA - MENÚ -->
        <div class="flex items-center space-x-6">
            <a href="{{ route('products.index') }}" class="hover:text-gray-300">Productos</a>
            <a href="{{ route('inventory.index') }}" class="hover:text-gray-300">Movimientos</a>
            <a href="{{ route('user.show') }}" class="hover:text-gray-300">Perfil</a>
        </div>

        <!-- CENTRO - USUARIO -->
        <div class="text-center font-bold text-lg whitespace-nowrap">
            @auth
                {{ Auth::user()->name }}
            @else
                Invitado
            @endauth
        </div>

        <!-- DERECHA - LOGIN / LOGOUT -->
        <div class="flex justify-end">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hover:text-gray-300">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-gray-300">Iniciar sesión</a>
            @endauth
        </div>

    </div>
</nav>

<div class="p-6">
    @yield('content')
</div>

</body>
</html>
