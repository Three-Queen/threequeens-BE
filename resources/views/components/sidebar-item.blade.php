@props(['route', 'icon', 'label'])

@php
    $isActive = request()->routeIs($route) || request()->routeIs($route . '.*');
@endphp

<a href="{{ route($route) }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
          {{ $isActive ? 'menu-active text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
    <div class="flex-shrink-0 w-5 flex items-center justify-center">
        <i data-lucide="{{ $icon }}" class="w-4 h-4"></i>
    </div>
    <span :class="(sidebarOpen || isMobile) ? 'opacity-100' : 'opacity-0 w-0'"
          class="text-sm font-medium whitespace-nowrap overflow-hidden transition-all duration-200">
        {{ $label }}
    </span>
</a>
