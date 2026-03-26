<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <br>
                    @if (isset($role))
                        <strong>Rol:</strong> {{ $role }}
                    @else
                        <strong>Rol:</strong> {{ Auth::user()->role ?? 'No definido' }}
                    @endif
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Reseñas del servicio</h3>

                    <article class="mb-4 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-bold">María González</p>
                            <p class="text-yellow-500">★★★★★</p>
                        </div>
                        <p class="text-gray-700">"Excelente atención, entrega puntual y producto tal como se describe. Repetiré compra sin duda."</p>
                    </article>

                    <article class="mb-4 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-bold">Carlos Ramírez</p>
                            <p class="text-yellow-500">★★★★☆</p>
                        </div>
                        <p class="text-gray-700">"Muy buen servicio al cliente y soporte rápido. Mejoraría la opción de seguimiento de pedido en la app."</p>
                    </article>

                    <article class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-bold">Ingrid Salas</p>
                            <p class="text-yellow-500">★★★★☆</p>
                        </div>
                        <p class="text-gray-700">"Buena experiencia general, solo tuve una demora menor con el envío, pero el producto llegó en perfectas condiciones."</p>
                    </article>
                </div>
            </div>        </div>
    </div>
</x-app-layout>
