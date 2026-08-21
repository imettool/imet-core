<?php
use Illuminate\Support\Facades\App;

?>
<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    @include('modular-forms::layouts.components.metatags')
    @translations
    @include('modular-forms::layouts.components.assets')
    @include('modular-forms::layouts.components.head')
</head>

<body class="flex flex-col">

<main>
    <section class="content">
        @yield('content')
    </section>
</main>

</body>

@stack('scripts')

</html>
