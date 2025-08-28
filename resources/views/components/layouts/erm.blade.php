<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'ERM' }}</title>

  @vite(['resources/css/app.css','resources/js/app.js'])
  @livewireStyles
</head>
<body class="bg-gray-50">

  @php
    // mark menu aktif
    $active = fn ($p) => request()->is($p) ? 'border-b-2 border-blue-600 text-blue-700 font-semibold' : 'text-gray-700 hover:text-blue-700';
    $link   = 'px-3 py-3 text-sm';
  @endphp

  <header class="bg-white shadow">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="h-16 flex items-center justify-between">

      {{-- BRANDING --}}
      <div class="text-lg font-bold">
        Enterprise Risk Management
      </div>

      @php
        $active = fn ($p) => request()->is($p) ? 'border-b-2 border-blue-600 text-blue-700 font-semibold' : 'text-gray-700 hover:text-blue-700';
        $link   = 'px-3 py-3 text-sm';
      @endphp

      {{-- NAVIGATION --}}
      <nav class="flex items-center space-x-1">

        {{-- HOMEPAGE --}}
        <a href="{{ url('/') }}" class="{{ $link }} {{ $active('/') }}">🏡 Homepage</a>

        {{-- DASHBOARD --}}
        <a href="{{ url('/erm') }}" class="{{ $link }} {{ $active('erm') }}">📊 Dashboard</a>

        {{-- RISKS --}}
        <a href="{{ url('/erm/risk-register') }}" class="{{ $link }} {{ $active('erm/risk-register') }}">🛡️ Risk Register</a>
        <a href="{{ url('/erm/risk-register-unit') }}" class="{{ $link }} {{ $active('erm/risk-register-unit') }}">🗂️ Risk Register Unit</a>

        {{-- MONITORING DROPDOWN --}}
        <details class="relative">
          <summary class="{{ $link }} cursor-pointer list-none {{ $active('erm/monitoring/*') }}">📈 Monitoring ▾</summary>
          <div class="absolute right-0 mt-1 w-56 bg-white border rounded shadow p-1 z-20">
           <a href="{{ url('/erm/monitoring/mitigation') }}" class="block px-3 py-2 text-sm hover:bg-gray-50 {{ $active('erm/monitoring/mitigation') }}">✅ Update Mitigation</a>
           <a href="{{ url('/erm/monitoring/actual') }}" class="block px-3 py-2 text-sm hover:bg-gray-50 {{ $active('erm/monitoring/actual') }}">📉 Update Actual Risk</a>
          </div>
        </details>

        {{-- RMU DROPDOWN --}}
        <details class="relative">
          <summary class="{{ $link }} cursor-pointer list-none {{ $active('erm/rmu/*') }}">🧭 RMU ▾</summary>
          <div class="absolute right-0 mt-1 w-64 bg-white border rounded shadow p-1 z-20">
            <a href="{{ url('/erm/rmu/review-register') }}" class="block px-3 py-2 text-sm hover:bg-gray-50 {{ $active('erm/rmu/review-register') }}">🔎 Review Risk Register</a>
            <a href="{{ url('/erm/rmu/review-register-unit') }}" class="block px-3 py-2 text-sm hover:bg-gray-50 {{ $active('erm/rmu/review-register-unit') }}">🧩 Review Risk Register Unit</a>
          <a href="{{ url('/erm/settings') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100"> ⚙️ Settings</a>
          </div>
        </details>

      </nav>
    </div>
  </div>
</header>

  {{-- KONTEN --}}
  <main class="max-w-7xl mx-auto px-4 sm:px-6 py-6">
    {{ $slot }}
  </main>

  @livewireScripts
</body>
</html>
