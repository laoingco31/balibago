<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Background Gradient */
        body {
            background: linear-gradient(to right,rgb(90, 184, 231),rgb(15, 91, 167),rgb(4, 21, 71));
        }

        /* Glassmorphism Card */
       .glass-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 0.5px solid rgba(255, 255, 255, 0.2); 
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    padding: 1.5rem;
    border-radius: 12px; 
}


        /* Smooth Fade-in Animation */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-in-out;
        }
    </style>
</head>

<body class="font-sans text-gray-900 dark:text-gray-100 antialiased 
             min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-lg p-10 rounded-3xl glass-card 
                animate-fade-in text-center">

        <!-- App Logo -->
       

        
        <!-- Slot for Dynamic Content -->
        <div class="mt-6 text-white">
            {{ $slot }}
        </div>

       
    </div>

</body>

</html>
