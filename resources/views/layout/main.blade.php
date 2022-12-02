<!doctype html>
<html lang="en">
@include('layout.head')

@include('layout.header', ['page' => $page])

<main>
@yield('content')
</main>

@include('layout.footer')
</html>
