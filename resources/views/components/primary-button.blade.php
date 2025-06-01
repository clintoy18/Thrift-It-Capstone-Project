<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#B59F84] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#a08e77] active:bg-[#8b7a66] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
