@php
    // Helper to check if a category is currently assigned (for editing)
    $assignedCategories = $product->categories->pluck('id')->toArray();
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="sku" class="block text-sm font-medium text-gray-700">SKU (Unique) *</label>
        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('sku') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="price" class="block text-sm font-medium text-gray-700">Price * (Min: $0.01)</label>
        <input type="number" id="price" name="price" step="0.01" min="0.01" value="{{ old('price', $product->price) }}" required
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity * (Min: 0)</label>
        <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', $product->quantity) }}" required
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('quantity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
        <select id="status" name="status" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @foreach(['active', 'inactive'] as $status)
                <option value="{{ $status }}" 
                        {{ old('status', $product->status) == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    
    <div>
        <label for="category_ids" class="block text-sm font-medium text-gray-700">Assign Categories</label>
        <select id="category_ids" name="category_ids[]" multiple
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm h-32">
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

<div class="mt-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
    <textarea id="description" name="description" rows="3"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>