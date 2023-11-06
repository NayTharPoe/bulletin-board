<!DOCTYPE html>
<html lang="en" data-theme="{{ old('theme', 'light')}}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bulletin Board</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="font-poppins">
  <main class="flex flex-col min-h-screen bg-base-200">
    <x-navigation />

    {{-- body content --}}
    <section class="py-10 px-2 md:px-10 lg:px-12 mt-[74px]">
      {{$slot}}
    </section>

    <x-flash-message />
    <x-error-message />
    <x-footer />
  </main>

</body>

</html>