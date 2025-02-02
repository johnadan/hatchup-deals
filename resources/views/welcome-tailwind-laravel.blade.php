<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel and Tailwind CSS Example</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="bg-blue-500 text-white p-4 text-center">
        Welcome to Laravel and Tailwind CSS!
    </header>
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Let's Build Something Awesome</h1>
        <p class="text-gray-700">This is a simple example of using Laravel and Tailwind CSS together.</p>
    </main>
    <!-- Button Component -->
   <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
       {{ $slot }}
   </button>
   <div class="bg-gray-100 p-4">
       <h1 class="text-2xl font-bold">Welcome to My Laravel App</h1>
   </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
