<div>
    <div class="overflow-hidden shadow-md sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Mata Uang</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Beli</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Jual</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($valas as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="fi fi-{{ strtolower($item->kode_iso_valas) }} mr-2"></span>
                                    <span class="text-sm font-medium">{{ $item->kode_valas }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                Rp{{ number_format($item->beli, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                Rp{{ number_format($item->jual, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button wire:click="openEditModal({{ $item->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3 transition-colors duration-200">
                                    Edit
                                </button>
                                <button wire:click="openDeleteModal({{ $item->id }})" class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Kontrol Paginasi -->
    <div class="mt-4">
        {{ $valas->links() }}
    </div>

    <div class="absolute bottom-0 right-0 w-8 h-8 bg-gradient-to-l from-white pointer-events-none"></div>
    <!-- Edit Modal -->
    <div x-show="$wire.isEditModalOpen" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Edit Valas</h3>
                    <div class="mt-2">
                        <label for="buy" class="block text-sm font-medium text-gray-700 mb-1">Kode ISO Valas</label>
                        <input wire:model.live="editingValas.kode_iso_valas" class="block w-full pl-3 pr-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" type="text" placeholder="Kode ISO Valas">
                        @error('editingValas.kode_iso_valas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label for="buy" class="block text-sm font-medium text-gray-700 mb-1">Kode Valas</label>
                            <input wire:model.live="editingValas.kode_valas" class="block w-full pl-3 pr-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" type="text" placeholder="Kode Valas">
                            @error('editingValas.kode_valas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label for="buy" class="block text-sm font-medium text-gray-700 mb-1 mt-3">Beli</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center ">
                                Rp
                            </span>
                            <input wire:model.live="editingValas.beli" class="block w-full pl-10 pr-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" type="text" placeholder="Beli">
                            @error('editingValas.beli') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <label for="sell" class="block text-sm font-medium text-gray-700 mb-1 mt-3">Jual</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center ">
                                Rp
                            </span>
                            <input wire:model.live="editingValas.jual" class="block w-full pl-10 pr-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" type="text" placeholder="Jual">
                            @error('editingValas.jual') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="updateValas" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Update
                    </button>
                    <button wire:click="closeEditModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="$wire.isDeleteModalOpen" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Konfirmasi Hapus</h3>
                    <div class="mt-2">
                        <p class="text-sm ">Apakah Anda yakin ingin menghapus data ini?</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="deleteValas" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Hapus
                    </button>
                    <button wire:click="closeDeleteModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>