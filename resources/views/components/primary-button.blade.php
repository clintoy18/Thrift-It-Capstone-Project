<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#B59F84] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#a08e77] hover:scale-105 focus:bg-[#a08e77] active:bg-[#8c7a65] focus:outline-none focus:ring-2 focus:ring-[#B59F84] focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>
