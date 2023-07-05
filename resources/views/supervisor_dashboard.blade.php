<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supervisor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-60 bg-dark">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-2 text-gray-900 mt-2" style="text-align: center;">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <a href="{{ route('Lec_view_submissions') }}"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-2 text-gray-900 mt-2" style="text-align: center;">
                    {{ __("View Student Reports") }}
                </div>

            </div></a>
        </div>
    </div>
</x-app-layout>
