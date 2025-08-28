{{-- resources/views/layouts/app-sidebar.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? 'Enterprise Risk Management' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
    <script defer src="//unpkg.com/alpinejs"></script>
</head>
<body class="bg-slate-50 text-slate-900" x-data="{ open: false }">

    {{-- Shell --}}
    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside class="hidden lg:block w-64 shrink-0 bg-white border-r border-slate-200">
            <div class="h-16 px-4 flex items-center gap-2 border-b border-slate-200">
                <svg class="w-7 h-7 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12 3l7.5 3v6c0 4.418-3.134 8.363-7.5 9-4.366-.637-7.5-4.582-7.5-9V6L12 3z"/>
                </svg>
                <div class="font-semibold">Enterprise Risk Management</div>
            </div>

            <nav class="p-3 space-y-1">
                <x-sidebar-link :href="url('/')" :active="request()->is('/')" icon="home">Homepage</x-sidebar-link>
                <x-sidebar-link :href="url('/dashboard')" :active="request()->is('dashboard*')" icon="layout-dashboard">Dashboard</x-sidebar-link>

                <div class="px-3 pt-4 pb-2 text-xs font-semibold text-slate-500">ERM</div>
                <x-sidebar-link :href="route('rr.form.wizard')" :active="request()->routeIs('rr.form.*')" icon="file-text">Risk Register</x-sidebar-link>
                <x-sidebar-link :href="url('/erm/risk-register/unit')" :active="request()->is('erm/risk-register/unit')" icon="users">Risk Register Unit</x-sidebar-link>
                <x-sidebar-link :href="url('/monitoring')" :active="request()->is('monitoring*')" icon="activity">Monitoring</x-sidebar-link>

                <div class="px-3 pt-4 pb-2 text-xs font-semibold text-slate-500">RMU</div>
                <x-sidebar-link :href="route('rmu.settings')" :active="request()->routeIs('rmu.settings') || request()->routeIs('erm.settings')" icon="settings">RMU Settings</x-sidebar-link>
            </nav>

            <div class="absolute bottom-0 w-64 p-3 border-t border-slate-200">
                <div class="text-xs text-slate-500">© {{ date('Y') }} All rights reserved.</div>
            </div>
        </aside>

        {{-- MOBILE TOPBAR --}}
        <div class="lg:hidden fixed inset-x-0 top-0 z-40 bg-white border-b border-slate-200">
            <div class="h-14 px-3 flex items-center justify-between">
                <button @click="open = !open" class="p-2 rounded-md hover:bg-slate-100">
                    <svg class="w-6 h-6 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="font-semibold">ERM</div>
                <div class="w-6"></div>
            </div>

            {{-- Drawer --}}
            <div x-show="open" x-transition @click.outside="open=false" class="bg-white border-t border-slate-200">
                <nav class="p-2 space-y-1">
                    <a href="{{ route('rr.form.wizard') }}" class="block px-3 py-2 rounded hover:bg-slate-50">Risk Register</a>
                    <a href="{{ route('rmu.settings') }}" class="block px-3 py-2 rounded hover:bg-slate-50">RMU Settings</a>
                </nav>
            </div>
        </div>

        {{-- MAIN --}}
        <main class="flex-1 min-w-0 w-full">
            {{-- spacing untuk mobile topbar --}}
            <div class="lg:hidden h-14"></div>

            <header class="px-4 lg:px-8 pt-6">
                <h1 class="text-xl font-semibold">{{ $header ?? ($title ?? '') }}</h1>
                @isset($subheader)
                    <p class="text-xs text-slate-500 mt-1">{{ $subheader }}</p>
                @endisset
            </header>

            <div class="px-4 lg:px-8 py-6">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
