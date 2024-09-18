<div class="d-flex align-items-center justify-content-center w-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
                <div class="card-body">
                    <a class="text-nowrap logo-img text-center d-block py-3 w-100">
                        <img src="images/logos/dark-logo.svg" width="180" alt="">
                    </a>
                    <p class="text-center">Your Social Campaigns</p>
                    <form wire:submit="register">
                        {{-- @csrf --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input wire:model='username' type="text" class="form-control" id="nama"
                                aria-describedby="textHelp">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input wire:model='no_hp' type="number" class="form-control" id="no_hp"
                                aria-describedby="emailHelp">
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input wire:model='password' type="password" class="form-control" id="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Register</button>


                        <div class="d-flex align-items-center justify-content-center">
                            <p class="fs-4 mb-0 fw-bold">Sudah punya Akun?</p>
                            <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign
                                In</a>
                        </div>
                        @if (session('message'))
                            <div class="card-body p-4">
                                <div class="alert alert-danger" role="alert">
                                    {{ session('message') }}
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
