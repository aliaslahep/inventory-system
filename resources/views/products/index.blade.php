<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 Product Inventory
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container mx-auto p-4 space-y-6">

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Top Bar --}}
                <div class="flex justify-between items-center">
                    <form action="{{ route('products.create') }}" method="GET">
                        <x-primary-button>
                            + Add New Product
                        </x-primary-button>
                    </form>
                </div>

                {{-- Filter Form --}}
                <form method="GET" action="{{ route('products.index') }}"
                      class="bg-white p-4 rounded-lg shadow flex flex-wrap gap-4 items-center">

                    <input type="text" name="search" placeholder="Search by Name or SKU..."
                           value="{{ request('search') }}"
                           class="flex-grow border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                    <select name="category_id"
                            class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-black hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded shadow">
                        Filter
                    </button>

                    @if (request()->hasAny(['search', 'category_id', 'sort']))
                        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                            Clear
                        </a>
                    @endif
                </form>

                {{-- Table --}}
                <div class="bg-white shadow rounded-lg overflow-hidden">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name / SKU</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                    @include('components.sort-link', ['field' => 'price', 'label' => 'Price'])
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                    @include('components.sort-link', ['field' => 'quantity', 'label' => 'Qty'])
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Categories</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500">SKU: {{ $product->sku }}</div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        ${{ number_format($product->price, 2) }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $product->quantity }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @forelse ($product->categories as $category)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $category->name }}
                                            </span>
                                        @empty
                                            <span class="text-gray-400">N/A</span>
                                        @endforelse
                                    </td>

                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="text-indigo-600 hover:text-indigo-900 mr-4">
                                            Edit
                                        </a>

                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                              class="inline"
                                              onsubmit="return confirm('⚠️ Are you sure you want to delete the product: {{ $product->name }}? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="ms-2">
                                                Delete
                                            </x-danger-button>
                                        </form>

                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
