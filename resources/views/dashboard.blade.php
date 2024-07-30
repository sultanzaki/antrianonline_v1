<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome :role="$role" />
            </div>
        </div>
    </div>
    <style>
        .uk-section {
                box-sizing: border-box;
                display: flow-root;
                padding-bottom: 40px;
                padding-top: 40px;
            }

            .is-footerbar {
                display: grid;
                grid-template-columns: 1fr .5fr .5fr;
            }

            .is-footerbar-area {
                height: 6px;
                width: 100%;
            }

            .is-footerbar-start {
                background-color: #0b79ca;
            }

            .is-footerbar-middle {
                background-color: #0078ff;
            }

            .is-footerbar-end {
                background-color: #edc817;
            }
    </style>
</x-app-layout>
