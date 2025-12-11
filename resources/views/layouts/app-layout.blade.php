<!-- resources/views/components/app-layout.blade.php -->
<div>
    <!— optional full html wrapper if you want components to render full page —>
    <!— but keep it minimal so it can act as wrapper for slot —>

    @includeIf('layouts.navigation')

    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4">
                {{ $header }}
            </div>
        </header>
    @endif

    <main class="py-4">
        {{ $slot }}
    </main>
</div>
