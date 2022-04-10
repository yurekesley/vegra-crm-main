<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="overflow-hidden shadow sm:rounded-md">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Mensagens e avisos') }}
                        </h2>
                        @foreach ($messages as $message)
                            <hr class="col-span-6 mt-2 mb-4" />
                            <div class="py-5 bg-white">
                                {!! $message?->content !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
