<div class="card pb-4">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Manajemen Menu</h5>
        <a href="#tambahMenuModal" data-bs-toggle="modal" class="btn btn-primary m-1">
            Tambah Menu
        </a>
    </div>

    {{-- @dd($this->getKategoriMenus) --}}
    <div>
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <input wire:model.live.debounce.300ms="search" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="">
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">Tipe User :</label>
                            <select wire:model.live="searchRole"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">Semua</option>
                                <option value="1">Pengelola</option>
                                <option value="2">Kasir</option>
                                <option value="3">Chef</option>
                                <option value="4">Pelanggan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-center">Nama Menu</th>
                                <th scope="col" class="px-4 py-3 text-center">Diskripsi</th>
                                <th scope="col" class="px-4 py-3 text-center">Gambar</th>
                                <th scope="col" class="px-4 py-3 text-center">Status</th>
                                <th scope="col" class="px-4 py-3 text-center">Kategori</th>
                                <th scope="col" class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($menus as $menu)
                                {{-- @dd($menu->kategoriMenu->nama_kategori_menu) --}}
                                <tr wire:key="{{ $menu->id_menu }}" class="border-b dark:border-gray-300">
                                    <td class="px-4 py-3 text-center text-black">{{ $menu->nama_menu }}</td>
                                    <td class="px-4 py-3 text-center text-black">{{ $menu->deskripsi }}</td>
                                    <td class="px-4 py-3 text-black text-center">
                                        <a href="#gambarMenuModal{{ $menu->id_menu }}" data-bs-toggle="modal"
                                            class="btn btn-primary m-1">
                                            {{-- <i class="ti ti-pencil" aria-hidden="true"></i> --}}
                                            <i class="ti ti-layout-collage" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-center text-black">{{ $menu->status }}</td>
                                    <td class="px-4 py-3 text-center text-black">
                                        {{ $menu->kategoriMenu->nama_kategori_menu }}</td>
                                    <td class="px-4 py-3  text-center text-black">
                                        <button type="button" wire:click="menuEdit({{ $menu->id_menu }})"
                                            data-bs-toggle="modal" data-bs-target="#editMenuModal"
                                            class="btn btn-warning m-1">
                                            <i class="ti ti-pencil" aria-hidden="true"></i>
                                        </button>
                                        {{-- <button
                                            onclick="confirm('Kamu akan menghapus Menu {{ $user->username }} secara permanen, apakah yakin?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $user->id_user }})" class="btn btn-danger m-1">
                                            <i class="ti ti-trash" aria-hidden="true"></i>
                                        </button> --}}
                                    </td>
                                </tr>
                                @include('livewire.tambah-menu-modal')
                                @include('livewire.edit-menu-modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live="perPage"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $menus->links() }}
                </div>
            </div>
        </div>
    </div>




    @foreach ($menus as $menu)
        {{-- MODAL GAMBAR MENU START --}}
        <div class="modal fade" id="gambarMenuModal{{ $menu->id_menu }}" tabindex="-1" aria-hidden="true"
            wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahMenu">
                            <strong>Gambar {{ $menu->nama_menu }}</strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/gambar/menu/' . $menu->gambar) }}" alt="Gambar Menu"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL GAMBAR MENU END --}}

        {{-- @dd($menu) --}}
    @endforeach





</div>
