<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">
        @if (session('success'))
            <div id="flash-msg" class="mb-4 rounded-lg bg-green-500 text-white px-4 py-3 shadow-md text-center font-medium">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.getElementById('flash-msg');
                    if (msg) msg.style.display = 'none';
                }, 3000);
            </script>
        @endif

        @yield('content')
    </div>
</body>
</html>