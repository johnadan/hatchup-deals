<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-orange-700 dark:bg-orange-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-orange-700 uppercase tracking-widest hover:bg-orange-600 dark:hover:bg-white focus:bg-orange-600 dark:focus:bg-white active:bg-orange-600 dark:active:bg-orange-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-orange-700 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
