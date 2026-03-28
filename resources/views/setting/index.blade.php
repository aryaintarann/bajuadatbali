@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col">

        {{-- TAB NAVIGATION --}}
        <ul class="nav nav-tabs mb-0" id="settingTabs" role="tablist" style="border-bottom: none;">
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link {{ (session('tab') == 'password') ? '' : 'active' }}"
                    id="info-tab"
                    data-toggle="tab"
                    data-target="#info-panel"
                    type="button"
                    role="tab"
                >
                    <i class="fas fa-cog mr-1"></i> Informasi Umum
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link {{ (session('tab') == 'password') ? 'active' : '' }}"
                    id="password-tab"
                    data-toggle="tab"
                    data-target="#password-panel"
                    type="button"
                    role="tab"
                >
                    <i class="fas fa-key mr-1"></i> Ubah Password
                </button>
            </li>
        </ul>

        <div class="tab-content" id="settingTabContent">

            {{-- ======= TAB: INFORMASI UMUM ======= --}}
            <div
                class="tab-pane fade {{ (session('tab') == 'password') ? '' : 'show active' }}"
                id="info-panel"
                role="tabpanel"
            >
                <div class="card" style="border-top-left-radius: 0;">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-cog mr-2"></i>{{ $title }}</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any() && !$errors->has('current_password') && !$errors->has('new_password'))
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form class="row g-3" method="POST" action="{{ route('setting.update', $setting->id_setting) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Aplikasi</label>
                                <input type="text" name="instansi_setting" class="form-control" value="{{ $setting->instansi_setting }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pemilik</label>
                                <input type="text" name="pimpinan_setting" class="form-control" value="{{ $setting->pimpinan_setting }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Keyword</label>
                                <input type="text" name="keyword_setting" class="form-control" value="{{ $setting->keyword_setting }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat_setting" class="form-control" value="{{ $setting->alamat_setting }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label>Tentang Aplikasi</label>
                                <textarea name="tentang_setting" class="form-control" id="editor" cols="30" rows="5">{{ $setting->tentang_setting }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Youtube</label>
                                <input type="text" class="form-control" name="youtube_setting" placeholder="Masukkan Channel Youtube disini" value="{{ $setting->youtube_setting }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Instagram</label>
                                <input type="text" name="instagram_setting" class="form-control" placeholder="Masukkan akun instagram disini..." value="{{ $setting->instagram_setting }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email_setting" placeholder="Masukkan email disini" value="{{ $setting->email_setting }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>No. HP</label>
                                <input type="text" name="no_hp_setting" class="form-control" placeholder="Masukkan No HP disini..." value="{{ $setting->no_hp_setting }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Logo Aplikasi</label>
                                <input type="file" class="form-control" name="logo_setting" accept="image/*" id="preview_gambar" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Preview Foto</label>
                                <img src="{{ asset('logo/'.$setting->logo_setting) }}" alt="" style="width: 200px; display:block;" id="gambar_nodin">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Logo Halaman Login &amp; Daftar <span class="text-muted">(Optional)</span></label>
                                <input type="file" class="form-control" name="logo_login_setting" accept="image/*" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Preview Foto Login</label><br>
                                @if($setting->logo_login_setting)
                                    <img src="{{ asset('logo/'.$setting->logo_login_setting) }}" alt="Logo Login" style="width: 200px; background: #333; padding:10px; border-radius:8px;">
                                @else
                                    <span class="text-muted">Belum ada logo login khusus</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Favicon</label>
                                <input type="file" class="form-control" name="favicon_setting" accept="image/*" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Preview Favicon</label>
                                <img src="{{ asset('favicon/'.$setting->favicon_setting) }}" alt="" style="width: 200px; display:block;">
                            </div>
                            <div class="col-12 mb-3">
                                <label>Link Maps</label>
                                <textarea name="maps_setting" class="form-control" rows="3">{{ $setting->maps_setting }}</textarea>
                            </div>
                            <iframe class="w-100 rounded" src="{{ $setting->maps_setting }}" frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark" style="float: right">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                        </form>
                    </div>{{-- end .card --}}
                </div>{{-- end info tab-pane --}}


            {{-- ======= TAB: UBAH PASSWORD ======= --}}
            <div
                class="tab-pane fade {{ (session('tab') == 'password') ? 'show active' : '' }}"
                id="password-panel"
                role="tabpanel"
            >
                <div class="card" style="border-top-left-radius: 0; border-top-right-radius: 0;">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-key mr-2"></i>Ubah Password</h3>
                    </div>
                    <div class="card-body">

                        {{-- Error password --}}
                        @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                        <div class="alert alert-danger">
                            <strong><i class="fas fa-exclamation-circle mr-1"></i>Error:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row justify-content-center">
                            <div class="col-md-6">

                                {{-- Tips keamanan --}}
                                <div class="alert alert-info" style="border-radius: 10px; font-size: 13.5px;">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    <strong>Tips Keamanan:</strong> Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol untuk password yang kuat.
                                </div>

                                <form method="POST" action="{{ route('setting.change-password') }}" id="changePasswordForm">
                                    @csrf

                                    {{-- Password Saat Ini --}}
                                    <div class="form-group">
                                        <label for="current_password">
                                            <i class="fas fa-lock mr-1 text-muted"></i>
                                            Password Saat Ini <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input
                                                type="password"
                                                id="current_password"
                                                name="current_password"
                                                class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan password saat ini"
                                                required
                                            >
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('current_password', this)" tabindex="-1">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Password Baru --}}
                                    <div class="form-group">
                                        <label for="new_password">
                                            <i class="fas fa-key mr-1 text-muted"></i>
                                            Password Baru <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input
                                                type="password"
                                                id="new_password"
                                                name="new_password"
                                                class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                                                placeholder="Min. 8 karakter"
                                                required
                                                oninput="checkPasswordStrength(this.value)"
                                            >
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('new_password', this)" tabindex="-1">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Strength bar --}}
                                        <div class="mt-2" id="strengthContainer" style="display:none;">
                                            <div style="height:6px; background:#eee; border-radius:3px; overflow:hidden;">
                                                <div id="strengthBar" style="height:100%; width:0; border-radius:3px; transition: all 0.3s;"></div>
                                            </div>
                                            <small id="strengthText" class="text-muted" style="font-size:11.5px;"></small>
                                        </div>
                                    </div>

                                    {{-- Konfirmasi Password Baru --}}
                                    <div class="form-group">
                                        <label for="new_password_confirmation">
                                            <i class="fas fa-check-circle mr-1 text-muted"></i>
                                            Konfirmasi Password Baru <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input
                                                type="password"
                                                id="new_password_confirmation"
                                                name="new_password_confirmation"
                                                class="form-control"
                                                placeholder="Ulangi password baru"
                                                required
                                                oninput="checkMatch()"
                                            >
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('new_password_confirmation', this)" tabindex="-1">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small id="matchText" style="font-size:11.5px; display:none;"></small>
                                    </div>

                                    <button type="submit" class="btn btn-dark btn-block mt-3" id="submitBtn">
                                        <i class="fas fa-save mr-1"></i> Simpan Password Baru
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>{{-- end card-body --}}
                </div>{{-- end .card --}}
            </div>{{-- end password tab-pane --}}

        </div>{{-- end tab-content --}}

    </div>
</div>
@endsection

@section('script')
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: { uploadUrl: '' }
        })
        .catch(error => { console.error(error); });
</script>
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "",
        filebrowserUploadMethod: 'form'
    });
</script>

{{-- Password strength checker --}}
<script>
    function togglePwd(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    function checkPasswordStrength(val) {
        const bar = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');
        const container = document.getElementById('strengthContainer');

        if (!val) {
            container.style.display = 'none';
            return;
        }
        container.style.display = 'block';

        const strong = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(val);
        const medium = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/.test(val);

        if (strong) {
            bar.style.width = '100%';
            bar.style.background = '#28a745';
            text.textContent = '✓ Kuat — password sangat aman';
            text.style.color = '#28a745';
        } else if (medium) {
            bar.style.width = '60%';
            bar.style.background = '#fd7e14';
            text.textContent = '⚠ Sedang — tambahkan huruf besar & simbol';
            text.style.color = '#fd7e14';
        } else {
            bar.style.width = '25%';
            bar.style.background = '#dc3545';
            text.textContent = '✗ Lemah — minimal 8 karakter';
            text.style.color = '#dc3545';
        }

        checkMatch();
    }

    function checkMatch() {
        const newPwd = document.getElementById('new_password').value;
        const confirm = document.getElementById('new_password_confirmation').value;
        const matchText = document.getElementById('matchText');

        if (!confirm) {
            matchText.style.display = 'none';
            return;
        }
        matchText.style.display = 'block';

        if (newPwd === confirm) {
            matchText.textContent = '✓ Password cocok';
            matchText.style.color = '#28a745';
        } else {
            matchText.textContent = '✗ Password tidak cocok';
            matchText.style.color = '#dc3545';
        }
    }
</script>
@endsection