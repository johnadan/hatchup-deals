<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session()->has('success'))
        <x-success-alert></x-success-alert>
        {{-- session()->forget('success') --}}
    @endif

    @if (session()->has('error'))
        <x-error-alert></x-error-alert>
        {{-- session()->forget('error') --}}
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 h-screen">
        {{-- <div class="row-span-2 bg-black lg:w-20rem"> --}}
        <div class="row-span-2 bg-black">
            <x-sidebar></x-sidebar>
        </div>
        {{-- <div class="md:col-span-2 p-4 min-h-screen"> --}}
        <div class="md:col-span-2 p-4">
            <div id="qr-reader" style="width: 500px"></div>
            <div id="qr-reader-results"></div>
        </div>
    </div>
    <script>
        function onScanSuccess(decodedText) {
            // Send the scanned code to your backend for validation
            fetch('/api/validate-deal', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ deal_code: decodedText }),
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('qr-reader-results').innerText = data.message;
            });
        }

        const html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</x-app-layout>
