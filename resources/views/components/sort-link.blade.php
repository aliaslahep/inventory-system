@props(['field', 'label'])

@php
    $currentSort = request('sort');
    $currentDirection = request('direction', 'asc');
    
    // Determine the next direction
    $newDirection = $currentSort === $field && $currentDirection === 'asc' ? 'desc' : 'asc';
    
    // Build the query string, preserving search/filter parameters
    $queryString = request()->except(['sort', 'direction']);
    $queryString['sort'] = $field;
    $queryString['direction'] = $newDirection;
    $url = route('products.index', $queryString);
@endphp

<a href="{{ $url }}" class="flex items-center space-x-1 hover:text-gray-700">
    <span>{{ $label }}</span>
    @if ($currentSort === $field)
        @if ($currentDirection === 'asc')
            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
        @else
            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        @endif
    @else
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
    @endif
</a>