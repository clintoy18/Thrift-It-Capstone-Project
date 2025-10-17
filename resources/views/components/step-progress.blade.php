@props(['currentStep' => 1])

@php
    $steps = ['Product Details', 'Optional QR', 'Finalize'];
@endphp

<div class="flex items-center mb-8">
    @foreach($steps as $index => $step)
        @php
            $stepNumber = $index + 1;
            $completed = $stepNumber < $currentStep;
            $active = $stepNumber === $currentStep;
            $isLast = $loop->last;
        @endphp

        <div class="flex items-center flex-1">
            <!-- Step Circle -->
            <div class="w-8 h-8 flex items-center justify-center rounded-full
                        {{ $completed ? 'bg-[#E1D5B6] text-white' : ($active ? 'bg-[#E1D5B6] text-white' : 'bg-gray-300 text-gray-700') }}">
                {{ $stepNumber }}
            </div>

            <!-- Step Name -->
            <span class="ml-2 text-sm {{ $active ? 'font-semibold text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}">
                {{ $step }}
            </span>

            <!-- Connector -->
            @if(!$isLast)
                <div class="flex-1 h-1 mx-2 rounded
                            {{ $stepNumber < $currentStep ? 'bg-[#E1D5B6]' : 'bg-gray-300' }}">
                </div>
            @endif
        </div>
    @endforeach
</div>
