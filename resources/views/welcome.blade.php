<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Library</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen text-white bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1470790376778-a9fbc86d70e2?q=80&w=2008&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">

    <main class="flex-grow flex items-center justify-center">
        <div class="text-center bg-white p-8 rounded-lg max-w-md w-full flex flex-col items-center">
            <div class="mb-6 flex justify-center">
                <img class="h-auto w-52" src="{{ asset('images/Logo.png') }}" alt="App Logo">
            </div>
            <div class="flex justify-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </main>

    <footer class="bg-black bg-opacity-50 text-center py-4 text-sm">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</body>
</html>
