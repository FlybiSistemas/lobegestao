<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
    <livewire:styles />
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>

    <div x-data="{ sidebarOpen: false }" x-cloak>
        <div class="flex min-h-screen">

            @auth
                <!-- regular sidebar -->
                <div class="sidebar hidden flex-none w-full md:block md:w-60 px-4 bg-primary dark:bg-gray-700">
                    @include('layouts.app.navigation')
                </div>

                <!--sidebar on mobile-->
                <div x-show.transition.origin.top.left="sidebarOpen"
                    class="sidebar min-w-full px-4 bg-primary dark:bg-gray-700 md:hidden">
                    @include('layouts.app.navigation')
                </div>
            @endauth

            <div id="main" class="w-full bg-gray-100 dark:bg-gray-600">

                @auth
                    <div class="flex justify-between mb-5 bg-white dark:bg-gray-700 px-2 py-1">

                        <div class="flex">
                            <button @click.stop="sidebarOpen = !sidebarOpen" class="md:hidden focus:outline-none pl-1 pr-2">
                                <svg class="w-6 transition ease-in-out duration-150 text-gray-900 dark:text-gray-200"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h8m-8 6h16" />
                                </svg>
                            </button>

                            <livewire:admin.search />
                        </div>

                        <div class="flex">
                            {{-- <livewire:admin.notifications-menu /> --}}
                            {{-- <livewire:admin.help-menu /> --}}
                            <livewire:admin.users.user-menu />
                        </div>
                    </div>
                @endauth

                <div class="px-7 py-5">
                    {{ $slot ?? '' }}
                </div>
            </div>

        </div>

        <div class="bg-white dark:bg-gray-900 dark:text-gray-300 p-5 flex justify-between text-xs">
            <div>{{ __('Copyright') }} &copy; {{ date('Y') }}</div>
        </div>

    </div>

    <livewire:scripts />
</body>

</html>
