<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger" onclick="logout(event)">
            {{ __('Log Out') }}
        </button>
    </form>
    

    
</section>
