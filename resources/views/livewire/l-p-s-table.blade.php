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
        <div class="overflow-x-auto shadow-md sm:rounded-lg max-w-full mx-auto">
            <table class="min-w-full divide-y divide-gray-200 sm:table-fixed">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Nama Rate</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Rate</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($lpss as $lps)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $lps->nama_rate }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $lps->rate }}%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                <button wire:click="openEditModal('{{ $lps->id }}')" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="absolute bottom-0 right-0 w-8 h-8 bg-gradient-to-l from-white pointer-events-none"></div>
        <!-- Edit Modal -->
        <div x-show="$wire.isEditModalOpen" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Edit LPS
                        <div class="mt-2">
                            <label for="nama_rate" class="block text-sm font-medium text-gray-700 mb-1">Nama Rate</label>
                            <input name="nama_rate" wire:model="editingLps.nama_rate" class="block w-full pl-3 pr-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" type="text" placeholder="Nama Rate">
                            @error('editingLps.nama_rate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <label for="rate" class="block text-sm font-medium text-gray-700 mb-1 mt-3">Rate (%)</label>
                            <input name="rate" wire:model="editingLps.rate" class="block w-full pl-3 pr-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" type="text" placeholder="Rate">
                            @error('editingLps.rate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="updateLPS" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Update
                        </button>
                        <button wire:click="closeEditModal" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>
