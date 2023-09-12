<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>{{ __('messages.welcome') }}</h1>
                    <h1>@lang('messages.welcome')</h1>

                    <p>{{ __('messages.example_with_value', ['name' => 'John']) }}</p>

                    <p>{{ trans_choice('messages.plural', 0, ['a' => 1]) }}</p>
                    <p>{{ trans_choice('messages.plural', 1, ['a' => 1]) }}</p>
                    <p>{{ trans_choice('messages.plural', 2, ['a' => 1]) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
