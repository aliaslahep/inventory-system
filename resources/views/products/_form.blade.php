<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✍️ Edit Product: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @php
                    // Helper to get the IDs of categories currently assigned to the product
                    $assignedCategories = $product->categories->pluck('id')->toArray();
                @endphp

                <form method="POST" action="{{ route('products.update', $product) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        {{-- Input Grid (Name, SKU, Price, Quantity, Status, Categories) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- 1. Name --}}
                            <div>
                                <x-input-label for="name" :value="__('Name *')" />
                                <x-text-input id="name" name="name" type="text" 
                                              :value="old('name', $product->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            {{-- 2. SKU --}}
                            <div>
                                <x-input-label for="sku" :value="__('SKU (Unique) *')" />
                                <x-text-input id="sku" name="sku" type="text" 
                                              :value="old('sku', $product->sku)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('sku')" />
                            </div>

                            {{-- 3. Price --}}
                            <div>
                                <x-input-label for="price" :value="__('Price * (Min: $0.01)')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" min="0.01"
                                              :value="old('price', $product->price)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            {{-- 4. Quantity --}}
                            <div>
                                <x-input-label for="quantity" :value="__('Quantity * (Min: 0)')" />
                                <x-text-input id="quantity" name="quantity" type="number" min="0"
                                              :value="old('quantity', $product->quantity)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                            </div>

                            {{-- 5. Status Select (Dropdown) --}}
                            <div>
                                <x-input-label for="status" :value="__('Status *')" />
                                <select id="status" name="status" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach(['active', 'inactive'] as $status)
                                        <option value="{{ $status }}" 
                                                {{ old('status', $product->status) == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            {{-- 6. Categories Select (Multi-select) --}}
                            <div>
                                <x-input-label for="category_ids" :value="__('Assign Categories')" />
                                <select id="category_ids" name="category_ids[]" multiple
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 h-32">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ in_array($category->id, old('category_ids', $assignedCategories)) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_ids')" />
                            </div>
                        </div>

                        {{-- 7. Description (Textarea) --}}
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center justify-end mt-6">
                        <x-secondary-button href="{{ route('products.index') }}" class="mr-3">
                            Cancel
                        </x-secondary-button>

                        <x-primary-button>
                            Update Product
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>