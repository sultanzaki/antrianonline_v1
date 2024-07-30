<div>
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <button type="button" @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-green-500 hover:text-green-700">
                    <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </button>
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif
        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <button type="button" @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-red-500 hover:text-red-700">
                    <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </button>
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    <div class="overflow-x-auto shadow-md sm:rounded-lg max-w-full mx-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">   
        <table class="min-w-full divide-y divide-gray-200 sm:table-fixed">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4  text-left text-xs font-medium  uppercase tracking-wider hidden sm:table-cell">Tiering</th>
                    <th class="px-6 py-4  text-left text-xs font-medium  uppercase tracking-wider hidden sm:table-cell">1 Bulan</th>
                    <th class="px-6 py-4  text-left text-xs font-medium  uppercase tracking-wider hidden sm:table-cell">3 Bulan</th>
                    <th class="px-6 py-4  text-left text-xs font-medium  uppercase tracking-wider hidden sm:table-cell">6 Bulan</th>
                    <th class="px-6 py-4  text-left text-xs font-medium  uppercase tracking-wider hidden sm:table-cell">12 Bulan</th>
                    <th class="px-6 py-4  text-left text-xs font-medium  uppercase tracking-wider hidden sm:table-cell">24 Bulan</th>
                    <th class="px-6 py-4  text-left text-xs font-medium  uppercase tracking-wider hidden sm:table-cell">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($counterRates as $tiering => $rates)
                    <tr class="hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-sm  hidden sm:table-cell">{{ $tiering }}</td>
                        @foreach ([1, 3, 6, 12, 24] as $duration)
                            @php
                                $rate = $rates->firstWhere('duration', $duration);
                            @endphp
                            <td class="px-6 py-4 whitespace-nowrap text-sm  hidden sm:table-cell">{{ $rate ? $rate->rate . '%' : '-' }}</td>
                        @endforeach
                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                            <button wire:click="openEditPopup('{{ $tiering }}')" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm  hidden sm:table-cell" colspan="7">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="absolute bottom-0 right-0 w-8 h-8 bg-gradient-to-l from-white pointer-events-none"></div>
<div x-show="$wire.isEditModalOpen" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Tenor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Rate (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([1, 3, 6, 12, 24] as $duration)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ $duration }} Bulan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm ">
                                    <input type="number" step="0.01" wire:model.live="editingRates.{{ $duration }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('editingRates.' . $duration) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button wire:click="updateCounterRates" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Update
                </button>
                <button wire:click="closeEditModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>  
</div>
</div>
