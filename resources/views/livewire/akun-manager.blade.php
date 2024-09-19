<div class="card pb-4">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Manajemen Akun</h5>
        <a href="#tambahAkunModal" data-bs-toggle="modal" class="btn btn-primary m-1">
            Tambah Akun
        </a>
    </div>
    <div>
        {{-- <section class="mt-10"> --}}
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
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
                                <th scope="col" class="px-4 py-3 text-center">Nama</th>
                                <th scope="col" class="px-4 py-3 text-center">Nomor HP</th>
                                <th scope="col" class="px-4 py-3 text-center">Jabatan</th>
                                <th scope="col" class="px-4 py-3 text-center">Dibuat</th>
                                <th scope="col" class="px-4 py-3 text-center">Terakhir Update</th>
                                <th scope="col" class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($this->getUsers->pluck('nama_role')) --}}

                            @foreach ($users as $user)
                                {{-- @dd($user) --}}
                                {{-- @dd($user->id_user) --}}
                                <tr wire:key="{{ $user->id_user }}" class="border-b dark:border-gray-300">
                                    <td
                                        class="px-4 py-3 text-center text-black {{ auth()->user()->username === $user->username ? 'text-red-500' : '' }}">
                                        {{ ucfirst($user->username) }}
                                        {{ auth()->user()->username === $user->username ? '(Anda)' : '' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-black">{{ $user->no_hp }}</td>
                                    <td class="px-4 py-3 text-black text-center">{{ $user->roles->nama_role }}</td>
                                    <td class="px-4 py-3 text-center text-black">{{ $user->created_at }}</td>
                                    <td class="px-4 py-3 text-center text-black">{{ $user->updated_at }}</td>
                                    <td class="px-4 py-3  text-center text-black">
                                        <a href="#editAkunModal{{ $user->id_user }}" data-bs-toggle="modal"
                                            class="btn btn-primary m-1">
                                            <i class="ti ti-pencil" aria-hidden="true"></i>
                                        </a>
                                        <button
                                            onclick="confirm('Kamu akan menghapus akun {{ $user->username }} secara permanen, apakah yakin?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $user->id_user }})" class="btn btn-danger m-1">
                                            <i class="ti ti-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <script>
                                function confirmDelete(id_user) {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You won't be able to revert this!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Yes, delete it!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Emit event ke Livewire untuk menghapus data
                                            Livewire.emit('deleteUser', id_user);
                                            // Tampilkan pesan sukses setelah penghapusan (opsional, jika diperlukan)
                                            Swal.fire({
                                                title: "Deleted!",
                                                text: "The user has been deleted.",
                                                icon: "success"
                                            });
                                        }
                                    });
                                }
                            </script> --}}
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
                    {{ $users->links() }}
                </div>
            </div>
            {{-- </section> --}}
        </div>
    </div>

    {{-- MODAL TAMBAH AKUN START --}}
    <div class="modal fade" id="tambahAkunModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAkun">
                        <strong>Pendaftaran Akun</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="daftarin" key="{{ now() }}">
                        <div class="mb-3">
                            <label for="exampleInputNamaPengguna1" class="form-label">Nama Pengguna</label>
                            <input wire:model="username" type="text" class="form-control" id="username"
                                aria-describedby="NamaPenggunaHelp">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputNoTelp" class="form-label">Nomor Telepon</label>
                            <input wire:model="no_hp" type="number" class="form-control" id="no_hp"
                                aria-describedby="NoTelpHelp">
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input wire:model="password" type="password" class="form-control" id="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Jabatan</label>
                            <select wire:model="role" class="form-select" id="role"
                                aria-label="Default select example">
                                <option value="" selected>Jabatan</option>
                                @foreach ($this->getRoles as $roles)
                                    <option value="{{ $roles->id_role }}">{{ $roles->nama_role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div> --}}
            </div>
        </div>
    </div>
    {{-- MODAL TAMBAH AKUN END --}}


    {{-- MODAL EDIT AKUN START --}}
    @foreach ($users as $user)
        <div class="modal fade" id="editAkunModal{{ $user->id_user }}" tabindex="-1" aria-hidden="true"
            wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAkun{{ $user->id_user }}">
                            <strong>Edit Akun</strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="daftarin" key="{{ now() }}">
                            <fieldset disabled>
                                <div class="mb-3">
                                    <label for="exampleInputNamaPengguna1" class="form-label">Nama Pengguna</label>
                                    <input type="text" class="form-control" id="disabledTextInput"
                                        aria-describedby="NamaPenggunaHelp" value="{{ $user->username }}">
                                    </input>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputNoTelp" class="form-label">Nomor Telepon</label>
                                    <input type="number" class="form-control" id="no_hp"
                                        aria-describedby="NoTelpHelp" value="{{ $user->no_hp }}">
                                </div>
                            </fieldset>

                            <div class="mb-3">
                                <label for="role" class="form-label">Jabatan</label>
                                <select wire:model="role" class="form-select" id="role"
                                    aria-label="Default select example">
                                    <option value="">Pilih Jabatan</option>
                                    {{-- @dd($roles) --}}
                                    @foreach ($this->getRoles as $roles)
                                        <option value="{{ $roles->id_role }}"
                                            {{ $user->id_role == $roles->id_role ? 'selected' : '' }}>
                                            {{ $roles->nama_role }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <h2 class="text-center">EDIT UNDERMAINTENANCE</h2>
                            {{-- <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div> --}}
                        </form>
                    </div>
                    {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div> --}}
                </div>
            </div>
        </div>
    @endforeach
    {{-- MODAL EDIT AKUN END --}}
</div>
