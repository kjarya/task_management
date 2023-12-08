<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>

    </head>
    <body class="antialiased">

        <div class="relative sm:flex sm:justify-center  min-h-screen  bg-center bg-gray-200 selection:bg-red-500 selection:text-white">

            <div class="mx-auto p-6 lg:p-8 py-2 border bg-white w-1/2">

                @livewire('create-project')

                <h2 class='text-3xl text-center'>Task Management</h2>

                @livewire('create-task')
                @livewire('list-task')

            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
</html>
