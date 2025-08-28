@props([
    'href' => '#',
    'active' => false,
    'icon' => null, // nama ikon (opsional)
])
@php
$cls = $active
    ? 'bg-sky-50 text-sky-700 border border-sky-200'
    : 'text-slate-700 hover:bg-slate-50 border border-transparent';
@endphp

<a href="{{ $href }}"
   class="group flex items-center gap-3 rounded-lg px-3 py-2 transition {{ $cls }}">
    @if($icon)
        {{-- ikon sederhana (SVG line). Ganti sesuai kebutuhan --}}
        <svg class="w-5 h-5 {{ $active ? 'text-sky-600' : 'text-slate-400 group-hover:text-slate-600' }}"
             viewBox="0 0 24 24" fill="none" stroke="currentColor">
            @switch($icon)
                @case('home')            <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M3 11l9-8 9 8v9a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4H9v4a2 2 0 01-2 2H3z"/> @break
                @case('layout-dashboard')<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="10" width="7" height="11" rx="1.5"/><rect x="3" y="12" width="7" height="9" rx="1.5"/> @break
                @case('file-text')      <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M14 3H6a2 2 0 00-2 2v14a2 2 0 002 2h12a2 2 0 002-2V9z"/><path stroke-width="1.5" d="M14 3v6h6"/> <path stroke-width="1.5" d="M8 13h8M8 17h5"/> @break
                @case('users')          <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4" stroke-width="1.5"/> @break
                @case('activity')       <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> @break
                @case('settings')       <circle cx="12" cy="12" r="3" stroke-width="1.5"/><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V22a2 2 0 01-4 0v-.08a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 003.6 15a1.65 1.65 0 00-1.51-1H2a2 2 0 010-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06A2 2 0 115.04 2.2l.06.06A1.65 1.65 0 007 2.59 1.65 1.65 0 008 1.08V1a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82c.2.58.78 1 1.4 1H22a2 2 0 010 4h-.08a1.65 1.65 0 00-1.51 1z"/> @break
            @endswitch
        </svg>
    @endif
    <span class="text-sm">{{ $slot }}</span>
</a>
