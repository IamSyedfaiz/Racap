<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="d-flex">
        @if (auth()->user()->getRoleNames()->first() === 'Super Admin')
            @include('layouts.sidebar')
        @elseif(auth()->user()->getRoleNames()->first() === 'Sub Admin')
            @include('layouts.sidebar')
        @elseif(auth()->user()->getRoleNames()->first() === 'Client')
            @include('layouts.client_sidebar')
        @elseif(auth()->user()->getRoleNames()->first() === 'Consultant')
            @include('layouts.consultant_sidebar')
        @endif
        <div class="py-5 container">

            <div class="d-flex justify-content-center align-self-center flex-column">
                <div class="">
                    <div class=" ">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="">
                    <div class="">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
            </div>
        </div>
    </div>


</x-app-layout>
