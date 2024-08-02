<div class="p-4 lg:p-6 bg-white border-b border-gray-200">
    <h1 class="text-2xl font-medium text-gray-900">
        Halo, {{ Auth::user()->name }}!
    </h1>

    @if ($role == 'admin')
        @livewire('dashboard')
    @elseif ($role == 'user')
        @livewire('loket')
    @else
        <p class="mt-6 text-gray-500 leading-relaxed">
            Akun Anda tidak valid. Hubungi Admin.
        </p>
    @endif
</div>