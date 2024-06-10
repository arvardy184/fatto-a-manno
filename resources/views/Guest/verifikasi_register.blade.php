<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-center px-10 mt-60">
        @if (session('errors'))
            @include('components.view_modal')
        @endif
        <div class="w-full max-w-md">
            <h2 class="mb-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Verification has been
                sent to your email! Check your email now to verify it!</h2>
            <form class="space-y-6" action="/login" method="GET">
                <div class="flex justify-center">
                    <button type="submit"
                        class="w-48 py-2 px-4 bg-indigo-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Ok</button>
                </div>
            </form>
            <form id="resend-form">
                <p class="mt-2 text-center text-sm leading-9 tracking-tight text-gray-900">If it hasn't been sent,
                    resend the email <span id="resend-link"
                        class="text-blue-500 hover:text-blue-300 cursor-pointer">here</span>
                </p>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('resend-link').addEventListener('click', function() {
            const link = document.getElementById('resend-link');
            link.style.pointerEvents = 'none';

            setTimeout(function() {
                fetch('/api/resend-verif/{{ session('user_id') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            link.textContent = 'Email resent successfully!';
                        } else {
                            link.textContent = 'Failed to resend. Try again.';
                        }
                        resetLinkAfterDelay();
                    })
                    .catch(error => {
                        link.textContent = 'Failed to resend. Try again.';
                        resetLinkAfterDelay();
                    });
            });
        });

        function resetLinkAfterDelay() {
            setTimeout(function() {
                const link = document.getElementById('resend-link');
                link.textContent = 'here';
                link.style.pointerEvents = 'auto';
            }, 30000); // 30000 milliseconds = 30 seconds
        }
    </script>
</x-layout>
