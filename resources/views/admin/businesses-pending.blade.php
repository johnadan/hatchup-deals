{{-- <style>
    html:has(dialog[open]) {
      overflow: hidden;
    }

    @keyframes scaleDown {
      0% {
        opacity: 1;
        transform: scale(1);
      }

      100% {
        opacity: 0;
        transform: scale(0);
      }
    }

    @keyframes slideInUp {
      0% {
        opacity: 0;
        transform: translateY(20%);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    dialog[open]::backdrop {
      backdrop-filter: blur(5px);
    }

    @media (prefers-reduced-motion: no-preference) {
      dialog {
        opacity: 0;
        transform: scale(0.9);
      }

      dialog.showing {
        animation: slideInUp 0.3s ease-out forwards;
      }

      dialog.closing {
        animation: scaleDown 0.3s ease-in forwards;
      }
    }

    .close-button {
      position: absolute;
      top: 1rem;
      right: 1rem;
      cursor: pointer;
    }
</style> --}}
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
        {{-- <div class="md:col-span-2 p-4" x-data="modalHandler"> --}}
        <div class="md:col-span-2 container mx-auto px-4 py-8" x-data="modalHandler">
        {{-- <div class="md:col-span-2 container mx-auto px-4 py-8" x-data="{ showModal: false, selectedAction: '', selectedBusiness: null }"> --}}

            @if (session()->has('success'))
            <x-success-alert></x-success-alert>
            @endif

            @if (session()->has('error'))
                <x-error-alert></x-error-alert>
            @endif

            {{-- <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100"> --}}
                            {{-- <div class="mb-4 flex justify-end"> --}}
                            {{-- <div class="mb-4 flex justify-start">
                                <h1 class="text-2xl font-bold mb-6">Pending Business Applications</h1>
                            </div>
                            <div class="overflow-x-auto">
                                <button id="openModalButton" class="px-4 py-2 text-white bg-indigo-500 rounded">
                                    Open Modal
                                </button>
                                <table class="table-auto min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                    <thead class="ltr:text-left rtl:text-right">
                                        <tr>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Business Name</th>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Full Name</th>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                                            <th class="px-4 py-2 text-left">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($businesses as $business)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $business->business->name }}</td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $business->full_name }}</td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $business->email }}</td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $business->status }}</td>
                                            <td class="whitespace-nowrap px-4 py-2">
                                                <button @click="openModal('approve', {{ $business->id }})" class="text-blue-500 hover:text-blue-700">Approve</button>
                                                <button @click="openModal('reject', {{ $business->id }})" class="text-red-500 hover:text-red-700 ml-2">Reject</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <h1 class="text-2xl font-bold mb-6">Pending Business Applications</h1>

            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Business Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($businesses as $business)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $business->business->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $business->full_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $business->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{-- <button
                                        @click="showModal = true; selectedAction = 'approve'; selectedBusiness = {{ $business->id }}"
                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 mr-2"
                                    >
                                        Approve
                                    </button> --}}
                                    <button
                                        @click="selectedAction = 'approve'; selectedBusiness = {{ $business->id }}; showModal = true"
                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 mr-2"
                                    >
                                        Approve
                                    </button>
                                    {{-- <button
                                        @click="showModal = true; selectedAction = 'reject'; selectedBusiness = {{ $business->id }}"
                                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                                    >
                                        Reject
                                    </button> --}}
                                    <button
                                        @click="selectedAction = 'reject'; selectedBusiness = {{ $business->id }}; showModal = true"
                                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                                    >
                                        Reject
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No pending business user applications
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Confirmation Modal -->
            <div
                x-show="showModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4"
                style="display: none;"
            >
                <div class="bg-white rounded-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-medium mb-4">
                        Confirm <span x-text="selectedAction.charAt(0).toUpperCase() + selectedAction.slice(1)"></span>
                    </h3>
                    <p class="mb-4">Are you sure you want to <span x-text="selectedAction"></span> this business user?</p>

                    <div class="flex justify-end space-x-4">
                        <button
                            @click="showModal = false"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800"
                        >
                            Cancel
                        </button>
                        {{-- <button
                            @click="handleAction()"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                        >
                            Confirm
                        </button> --}}
                        <button
                            @click="handleAction()"
                            :disabled="processing"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50"
                        >
                            <span x-show="!processing">Confirm</span>
                            <span x-show="processing">Processing...</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- <dialog id="modal" class="relative p-6 bg-white rounded-lg shadow-lg">
        <button id="closeModalButtonTop" class="close-button">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 hover:text-gray-900" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        <h2 class="mb-4 text-lg font-semibold">Modal Title</h2>
        <p class="mb-4 text-gray-700">
          This is a modal dialog created using the &lt;dialog&gt; element and
          Tailwind CSS.
        </p>
        <div class="flex justify-end space-x-2">
          <button id="secondaryActionButton" class="px-4 py-2 text-white bg-gray-500 rounded">
            Secondary Action
          </button>
          <button id="closeModalButtonBottom" class="px-4 py-2 text-white bg-indigo-500 rounded">
            Close
          </button>
        </div>
    </dialog> --}}

    {{-- <script>
        const modal = document.getElementById("modal");
        const openModalButton = document.getElementById("openModalButton");
        const closeModalButtonTop = document.getElementById(
          "closeModalButtonTop"
        );
        const closeModalButtonBottom = document.getElementById(
          "closeModalButtonBottom"
        );
        const secondaryActionButton = document.getElementById(
          "secondaryActionButton"
        );

        openModalButton.addEventListener("click", () => {
          modal.classList.remove("closing");
          modal.showModal();
          modal.classList.add("showing");
        });

        closeModalButtonTop.addEventListener("click", closeModal);
        closeModalButtonBottom.addEventListener("click", closeModal);
        secondaryActionButton.addEventListener("click", () => {
          console.log("Secondary action executed");
        });

        function closeModal() {
          modal.classList.remove("showing");
          modal.classList.add("closing");
          modal.addEventListener(
            "animationend",
            () => {
              modal.close();
              modal.classList.remove("closing");
            },
            { once: true }
          );
        }
    </script> --}}

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('modalHandler', () => ({
                showModal: false,
                selectedAction: '',
                selectedBusiness: null,
                processing: false,

                async handleAction() {
                    this.processing = true;
                    // Construct the route URL with actual business ID
                    const route = this.selectedAction === 'approve'
                        ? '{{ route("admin.businesses.approve", ":business") }}'
                        : '{{ route("admin.businesses.reject", ":business") }}';

                    const url = route.replace(':business', this.selectedBusiness);

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        });

                        if (response.ok) {
                            window.location.reload(); // Refresh the page after success
                        } else {
                            const errorData = await response.json();
                            alert(errorData.message || 'Action failed');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Request failed - check console for details');
                    }
                    this.processing = false;
                    this.showModal = false;
                }
            }));
        });
    </script>

    {{-- <style>
        [x-cloak] { display: none !important; }
    </style> --}}
</x-app-layout>
