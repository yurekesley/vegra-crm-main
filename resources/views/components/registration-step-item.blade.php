@props(['step' => 1, 'name' => 'None', 'completed' => false, 'current' => false, 'final' => false, 'cancelled' => false])

<li class="relative md:flex-1 md:flex">
    @if ($completed == true)
        <p href="#" class="flex items-center w-full group" title="{{ $cancelled ? 'Cliente não possui coparticipante' : '' }}">
            <span class="flex items-center px-6 py-4 text-sm font-medium">
                <span
                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-red-600 border-2 border-red-600 rounded-full" style="{{ $cancelled ? 'background-color: rgb(229 231 235); border-color: rgb(156 163 175)' : '' }}">
                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="ml-4 text-sm font-medium text-gray-900" style="{{ $cancelled ? 'text-decoration: line-through; color: rgb(156 163 175);' : '' }}">{{ $name }}</span>
            </span>
        </p>
    @else
        @if ($current == true)
            <p href="#" class="flex items-center w-full group">
                <span class="flex items-center px-6 py-4 text-sm font-medium">
                    <span
                        class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-red-200 border-2 border-red-600 rounded-full">
                        <span class="text-red-600">{{ str_pad($step, 2, '0', STR_PAD_LEFT) }}</span>
                    </span>
                    <span class="ml-4 text-sm font-bold text-red-700">{{ $name }}</span>
                </span>
            </p>
        @else
            <p href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
                <span
                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                    <span
                        class="text-gray-500 group-hover:text-gray-900">{{ str_pad($step, 2, '0', STR_PAD_LEFT) }}</span>
                </span>
                <span
                    class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ $name }}</span>
            </p>
        @endif
    @endif
    @if ($final == false)
        <x-registration-step-separator />
    @endif
</li>
