<div class="d-flex align-items-center justify-content-center w-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
                <div class="card-body">
                    <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                        <img src="images/logos/dark-logo.svg" width="180" alt="">
                    </a>
                    <p class="text-center">Kartika Resto App</p>
                    <form wire:submit="login">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nomor HP</label>
                            <input wire:model="no_hp" type="number" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input wire:model="password" type="password" class="form-control" id="password"
                                name="password" required>
                            <i class="ti ti-eye position-absolute" id="togglePassword"
                                style="right: 15px; top: 38px; cursor: pointer; font-size: 1.2rem;"></i>

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input primary" type="checkbox" value=""
                                    id="flexCheckChecked" checked>
                                <label class="form-check-label text-dark" for="flexCheckChecked">
                                    Remeber this Device
                                </label>
                            </div>
                            <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                        </div> --}}
                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                            In</button>
                        <div class="d-flex align-items-center justify-content-center">
                            <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                            <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Create an
                                account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('ti-eye');
            this.classList.toggle('ti-eye-off');
        });
    </script>
</div>
