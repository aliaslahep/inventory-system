@php
    $assignedCategories = $product->categories->pluck('id')->toArray();
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Name --}}
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- SKU --}}
    <div class="mb-4">
        <label for="sku" class="block text-sm font-medium text-gray-700">SKU (Unique) *</label>
        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
        @error('sku') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Price --}}
    <div class="mb-4">
        <label for="price" class="block text-sm font-medium text-gray-700">Price * (Min: $0.01)</label>
        <input type="number" id="price" name="price" step="0.01" min="0.01" value="{{ old('price', $product->price) }}" required
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
        @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Quantity --}}
    <div class="mb-4">
        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity * (Min: 0)</label>
        <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', $product->quantity) }}" required
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
        @error('quantity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Status --}}
    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
        <select id="status" name="status" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
            @foreach(['active', 'inactive'] as $status)
                <option value="{{ $status }}" 
                        {{ old('status', $product->status) == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Categories --}}
    <div class="md:col-span-2 mb-4">
        <label for="category_ids" class="block text-sm font-medium text-gray-700">Assign Categories</label>
        <select id="category_ids" name="category_ids[]" multiple
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm h-32 p-2 focus:ring focus:ring-indigo-200 focus:border-indigo-300">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                        {{ in_array($category->id, old('category_ids', $assignedCategories)) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_ids') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

</div>

{{-- Description --}}
<div class="mt-6">
    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
    <textarea id="description" name="description" rows="4"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">{{ old('description', $product->description) }}</textarea>
    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>
