<button {{ $attributes->merge(['type' => 'submit', 'class' => 'hd-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
