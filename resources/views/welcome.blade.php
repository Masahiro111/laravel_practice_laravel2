<x-app>
    <x-slot name="title">
        Laravel Components
    </x-slot>

    <x-slot name="sidebar">
        <p>サイドバーに追加できます。</p>
    </x-slot>

    <h1 class="text-2xl">Laravel Componets</h1>
    <p class="text-sm text-gray-400">message: {{ $message }}</p>

    <x-alert
             :message="$message"
             class="font-bold"
             type="info" />
</x-app>