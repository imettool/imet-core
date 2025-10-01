<?php
use ModularForms\Helpers\Template;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

?>

<div class="flex justify-between px-3 py-1 bg-gray-100">
    <div class="flex gap-2">

        <!-- Home -->
        <div>
            <a href="{{ route('home') }}">
                {!! Template::icon('home') !!}
            </a>
        </div>


    </div>

    <div class="italic">
        <span class="font-bold">imet-core</span> development environment
    </div>

    <div class="flex gap-2">

        <!-- PHP Info -->
        <div>
            <a href="{{ route('info') }}" target="_blank" class="btn-nav red">
                <i class="fa-solid fa-circle-info"></i> phpinfo
            </a>
        </div>

        <!-- Logs -->
        <div>
            <a href="/logs"  target="_blank" class="btn-nav red">
                <i class="fa-solid fa-list"></i> Logs
            </a>
        </div>


    </div>

</div>

