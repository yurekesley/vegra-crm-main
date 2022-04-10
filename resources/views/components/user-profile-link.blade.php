@php
$user = auth()->user();
$profilePictureUrl = $user->picture_url ?? asset('images/blank-profile-picture.png');
$name = $user->name;
@endphp

<a href="{{ route('user_profile.index') }}" class="flex-shrink-0 block w-full group">
    <div class="flex items-center">
        <div>
            <img class="inline-block object-cover rounded-full h-9 w-9" src="{{ $profilePictureUrl }}"
                alt="{{ $name }} picture">
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-white">{{ $name }}</p>
            <p class="text-xs font-medium text-red-300 group-hover:text-red-200">{{ __('Ver perfil') }}</p>
        </div>
    </div>
</a>
