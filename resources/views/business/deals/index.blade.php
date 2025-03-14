<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div x-data="dealManager">
        <div class="grid grid-cols-1 md:grid-cols-3 h-screen">
            <div class="row-span-2 bg-black">
                <x-sidebar></x-sidebar>
            </div>
            <div class="md:col-span-2 p-4">
                <div class="container">
                    @if (session()->has('success'))
                        <x-success-alert></x-success-alert>
                    @endif

                    @if (session()->has('error'))
                        <x-error-alert></x-error-alert>
                    @endif
                    {{-- <h1>Deals</h1>
                    <a href="{{ route('business.deals.create') }}" class="btn btn-primary mb-3">Create New Deal</a>
                    <div class="row">
                        @if(!($deals->isEmpty()))
                        @foreach ($deals as $deal)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if ($deal->image)
                                <img src="{{ asset('storage/' . $deal->image) }}" class="card-img-top" alt="{{ $deal->title }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $deal->title }}</h5>
                                    <p class="card-text">{{ $deal->description }}</p>
                                    <p class="card-text"><strong>Category:</strong> {{ $deal->category->name }}</p>
                                    <p class="card-text"><strong>Original Price:</strong> ${{ $deal->original_price }}</p>
                                    <p class="card-text"><strong>Discounted Price:</strong> ${{ $deal->discounted_price }}</p>
                                    <p class="card-text"><strong>Valid Until:</strong> {{ $deal->end_date }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>No deals found.</p>
                        @endif
                    </div> --}}
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div class="mb-4 flex justify-between items-center">
                                        <h3 class="text-lg font-semibold">Your Deals</h3>
                                        <a href="{{ route('business.deals.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Create New Deal
                                        </a>
                                    </div>

                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Used</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Limit</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @forelse ($deals as $deal)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <img src="{{ asset('storage/' . $deal->image) }}" alt="{{ $deal->title }}" class="h-12 w-12 object-cover rounded">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $deal->title }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $deal->type === 'paid' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                            {{ ucfirst($deal->type) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $deal->start_date->format('M d, Y') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $deal->end_date->format('M d, Y') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $deal->current_usage_count }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $deal->max_usage_limit }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $deal->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ $deal->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $deal->is_featured ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                                            {{ $deal->is_featured ? 'Featured' : 'Regular' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                                        <a href="{{ route('business.deals.edit', $deal) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                        <button @click="openDeleteModal({{ $deal->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="10" class="px-6 py-4 text-center">No deals found</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-4">
                                        {{ $deals->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-cloak x-show="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
                <p class="mb-4">Are you sure you want to delete this deal? This action cannot be undone.</p>

                <div class="flex justify-end space-x-4">
                    <button @click="showDeleteModal = false" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <form :action="deleteRoute" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dealManager', () => ({
                showDeleteModal: false,
                deleteRoute: '',

                openDeleteModal(dealId) {
                    this.deleteRoute = `/business/deals/${dealId}`;
                    this.showDeleteModal = true;
                }
            }));
        });
    </script>
</x-app-layout>
