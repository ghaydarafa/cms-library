@if ($message)
    <div id="alert-{{ $type }}" class="{{ $type === 'success' ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600' }} border text-white px-2 py-3 rounded relative mb-4" role="alert">
        {{ $message }}
        <button onclick="document.getElementById('alert-{{ $type }}').style.display='none'" class="absolute top-0 right-0 p-1 text-white hover:text-gray-200">
            <svg class="w-[17px] h-[17px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
        </button>
    </div>
    <script>
        setTimeout(function() {
            var alertElement = document.getElementById('alert-{{ $type }}');
            if (alertElement) {
                alertElement.style.display = 'none';
            }
        }, 5000);
    </script>
@endif
