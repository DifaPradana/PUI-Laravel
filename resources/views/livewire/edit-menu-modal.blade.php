<div>
    <div class="modal fade" id="editMenuModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModal">
                        <strong>Edit Menu</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="menuUpdate" key="{{ now() }}">
                        <div class="mb-3">
                            <label for="exampleInputNamaPengguna1" class="form-label">Nama Menu</label>
                            <input wire:model="nama_menu" type="text" class="form-control" id="nama_menu"
                                aria-describedby="NamaPenggunaHelp">
                            @error('nama_menu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputDeskripsiMenu" class="form-label">Deskripsi Menu</label>
                            <input wire:model="deskripsi" type="text" class="form-control" id="deskripsi"
                                aria-describedby="deskripsiMenuHelp">
                            @error('deskripsi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputGambar" class="form-label">Gambar</label>
                            <input wire:model="gambar" type="file" accept="image/jpg, image/png, image/jpeg"
                                class="form-control" id="gambar">
                            @error('gambar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div wire:loading wire:target="gambar" class="mt-2">
                                <div class="spinner-grow text-primary me-2"></div>
                            </div>
                            @if ($gambar && is_object($gambar))
                                <div class="mt-3">
                                    <h5>
                                        <strong>Preview Gambar:</strong>>
                                    </h5>
                                    <img src="{{ $gambar->temporaryUrl() }}" alt="Preview Gambar" class="img-fluid"
                                        width="200">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputGambar" class="form-label">Gambar yang sudah pernah diupload
                                :</label>
                            @if ($gambarLama)
                                <img src="{{ asset('storage/gambar/menu/' . $gambarLama) }}" alt="Gambar Menu"
                                    class="img-fluid">
                            @else
                                <p>Tidak ada gambar tersedia.</p>
                            @endif
                        </div>



                        {{-- @dd($gambar) --}}



                        <div class="mb-3">
                            <label for="exampleInputHargaMenu" class="form-label">Harga Menu</label>
                            <input wire:model="harga" type="number" class="form-control" id="harga"
                                aria-describedby="hargaMenuHelp">
                            @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori_menu" class="form-label">Kategori Menu</label>
                            <select wire:model="kategori_menu" class="form-select" id="kategori_menu"
                                aria-label="Default select example">
                                <option value="" selected>Kategori</option>
                                @foreach ($this->getKategoriMenus as $item)
                                    <option value="{{ $item->id_kategori_menu }}">{{ $item->nama_kategori_menu }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_menu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select wire:model="status" class="form-select" id="status"
                                aria-label="Default select example">
                                <option value="" selected>Status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="habis">Habis</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                wire:click="closeModal">Close</button> --}}
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
