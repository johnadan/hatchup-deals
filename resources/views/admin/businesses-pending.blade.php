<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 h-screen">
        <div class="row-span-2 bg-black">
            <x-sidebar></x-sidebar>
        </div>
        <div class="md:col-span-2 p-4">
            @if (session()->has('success'))
            <x-success-alert></x-success-alert>
            @endif

            @if (session()->has('error'))
                <x-error-alert></x-error-alert>
            @endif
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="mb-4 flex justify-end">
                            </div>
                            <div class="overflow-x-auto">
                                <table class="table-auto min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                    <thead class="ltr:text-left rtl:text-right">
                                        <tr>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Business Name</th>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">User's Name</th>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                                            <!-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th> -->
                                            <!-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Salary</th> -->
                                            <th class="px-4 py-2 text-left">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($businesses as $business)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $business->business->name }}</td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $business->full_name }}</td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $business->status }}</td>
                                            <td class="whitespace-nowrap px-4 py-2">
                                                <button @click="openModal('edit', {{ $business->id }})" class="text-blue-500 hover:text-blue-700">Approve</button>
                                                <button @click="openModal('delete', {{ $business->id }})" class="text-red-500 hover:text-red-700 ml-2">Deactivate</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
