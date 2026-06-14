<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Masuk / Daftar — {{ env('APP_NAME') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            /* STYLE TETAP SAMA TIDAK ADA YANG BERUBAH */
            body {
                min-height: 100vh;
                display: flex;
                align-items: stretch;
                background: var(--bg);
            }

            .auth-layout {
                display: flex;
                min-height: 100vh;
                width: 100%;
            }

            .auth-left {
                width: 420px;
                flex-shrink: 0;
                background: var(--dark);
                position: relative;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                padding: 48px;
            }

            .auth-left::before {
                content: '';
                position: absolute;
                bottom: -100px;
                right: -100px;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(253, 116, 0, 0.2) 0%, transparent 70%);
            }

            .auth-left-logo {
                font-family: var(--font-display);
                font-size: 1.8rem;
                font-weight: 700;
                color: white;
                margin-bottom: 48px;
            }

            .auth-left-logo span {
                color: var(--primary);
            }

            .auth-left-tagline {
                font-family: var(--font-display);
                font-size: 2rem;
                font-weight: 700;
                color: white;
                line-height: 1.3;
                margin-bottom: 20px;
                position: relative;
            }

            .auth-left-tagline em {
                font-style: normal;
                color: var(--primary);
            }

            .auth-left p {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.92rem;
                line-height: 1.7;
                position: relative;
            }

            .auth-feature-list {
                list-style: none;
                margin-top: 40px;
                display: flex;
                flex-direction: column;
                gap: 14px;
                position: relative;
            }

            .auth-feature-item {
                display: flex;
                align-items: center;
                gap: 12px;
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.88rem;
            }

            .auth-feature-icon {
                width: 32px;
                height: 32px;
                border-radius: var(--radius-sm);
                background: rgba(253, 116, 0, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--primary);
                font-size: 0.9rem;
                flex-shrink: 0;
            }

            .auth-left-foot {
                margin-top: auto;
                padding-top: 40px;
                font-size: 0.78rem;
                color: rgba(255, 255, 255, 0.35);
                position: relative;
            }

            .auth-right {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 48px 32px;
                background: var(--bg);
            }

            .auth-box {
                width: 100%;
                max-width: 440px;
            }

            .auth-tabs {
                display: flex;
                background: var(--white);
                border: 1.5px solid var(--border);
                border-radius: var(--radius-md);
                padding: 4px;
                margin-bottom: 32px;
            }

            .auth-tab {
                flex: 1;
                padding: 10px;
                text-align: center;
                border-radius: var(--radius-sm);
                font-size: 0.88rem;
                font-weight: 600;
                cursor: pointer;
                transition: all .22s;
                color: var(--dark-light);
                border: none;
                background: transparent;
                font-family: var(--font-body);
            }

            .auth-tab.active {
                background: var(--primary);
                color: white;
                box-shadow: 0 2px 8px rgba(253, 116, 0, .3);
            }

            .auth-panel {
                display: none;
            }

            .auth-panel.active {
                display: block;
            }

            .auth-title {
                font-family: var(--font-display);
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--dark);
                margin-bottom: 6px;
            }

            .auth-subtitle {
                font-size: 0.88rem;
                color: var(--dark-light);
                margin-bottom: 28px;
            }

            .social-auth {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
                margin-bottom: 20px;
            }

            .btn-social {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 11px;
                border-radius: var(--radius-sm);
                border: 1.5px solid var(--border);
                background: var(--white);
                font-size: 0.86rem;
                font-weight: 600;
                cursor: pointer;
                color: var(--dark);
                font-family: var(--font-body);
                transition: all .2s;
            }

            .btn-social:hover {
                border-color: var(--dark);
                box-shadow: var(--shadow-sm);
            }

            .otp-panel {
                display: none;
            }

            .otp-panel.show {
                display: block;
            }

            .otp-title {
                text-align: center;
                margin-bottom: 8px;
            }

            .otp-desc {
                text-align: center;
                font-size: 0.88rem;
                color: var(--dark-mid);
                margin-bottom: 28px;
            }

            .otp-desc strong {
                color: var(--dark);
            }

            .otp-inputs {
                display: flex;
                gap: 10px;
                justify-content: center;
                margin-bottom: 24px;
            }

            .otp-input {
                width: 52px;
                height: 56px;
                border: 2px solid var(--border);
                border-radius: var(--radius-sm);
                text-align: center;
                font-size: 1.5rem;
                font-weight: 700;
                font-family: var(--font-display);
                color: var(--dark);
                outline: none;
                transition: border-color .2s, box-shadow .2s;
                background: var(--white);
            }

            .otp-input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(253, 116, 0, .12);
            }

            .otp-input.filled {
                border-color: var(--primary);
                color: var(--primary);
            }

            .otp-resend {
                text-align: center;
                font-size: 0.82rem;
                color: var(--dark-light);
                margin-top: 12px;
            }

            .otp-resend a {
                color: var(--primary);
                font-weight: 600;
                cursor: pointer;
            }

            .role-selector {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
                margin-bottom: 20px;
            }

            .role-card {
                border: 2px solid var(--border);
                border-radius: var(--radius-md);
                padding: 16px;
                text-align: center;
                cursor: pointer;
                transition: all .22s;
                background: var(--white);
            }

            .role-card.selected {
                border-color: var(--primary);
                background: var(--primary-light);
            }

            .role-card .role-icon {
                font-size: 1.8rem;
                display: block;
                margin-bottom: 6px;
            }

            .role-card .role-label {
                font-size: 0.82rem;
                font-weight: 700;
                color: var(--dark);
                font-family: var(--font-display);
            }

            .role-card .role-desc {
                font-size: 0.72rem;
                color: var(--dark-light);
                margin-top: 2px;
            }

            .role-card.selected .role-label {
                color: var(--primary);
            }

            .pwd-strength {
                margin-top: 8px;
            }

            .pwd-bars {
                display: flex;
                gap: 4px;
                margin-bottom: 4px;
            }

            .pwd-bar {
                flex: 1;
                height: 3px;
                background: var(--border);
                border-radius: 2px;
                transition: background .3s;
            }

            .pwd-bar.weak {
                background: var(--danger);
            }

            .pwd-bar.medium {
                background: var(--warning);
            }

            .pwd-bar.strong {
                background: var(--success);
            }

            .pwd-text {
                font-size: 0.72rem;
                color: var(--dark-light);
            }

            @media (max-width: 768px) {
                .auth-left {
                    display: none;
                }

                .auth-right {
                    padding: 24px 16px;
                }
            }
        </style>
    </head>

    <body>
        <div class="auth-layout">

            <div class="auth-left">
                <a href="index.html" class="auth-left-logo">Laba</a>
                <div class="auth-left-tagline">
                    Bergabunglah dengan <em>Komunitas</em> UMKM Indonesia
                </div>
                <p>Ribuan penjual dan pembeli telah mempercayakan bisnis mereka ke Laba. Saatnya giliran kamu.</p>
                <ul class="auth-feature-list">
                    <li class="auth-feature-item">
                        <div class="auth-feature-icon"><i class="fa-solid fa-shield-check"></i></div>
                        <span>Verifikasi akun berlapis untuk keamanan transaksi</span>
                    </li>
                    <li class="auth-feature-item">
                        <div class="auth-feature-icon"><i class="fa-solid fa-store"></i></div>
                        <span>Buka toko online gratis, tanpa biaya berlangganan</span>
                    </li>
                    <li class="auth-feature-item">
                        <div class="auth-feature-icon"><i class="fa-brands fa-whatsapp"></i></div>
                        <span>Terima pesanan langsung via WhatsApp Business</span>
                    </li>
                    <li class="auth-feature-item">
                        <div class="auth-feature-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <span>Dashboard analitik untuk memantau performa toko</span>
                    </li>
                </ul>
                <div class="auth-left-foot">© 2026 Laba. Semua hak dilindungi.</div>
            </div>

            <div class="auth-right">
                <div class="auth-box">
                    <div class="auth-tabs">
                        <button class="auth-tab active" id="tab-login" onclick="switchTab('login')">Masuk</button>
                        <button class="auth-tab" id="tab-register" onclick="switchTab('register')">Daftar</button>
                    </div>

                    <div class="auth-panel active" id="panel-login">
                        <h2 class="auth-title">Selamat Datang Kembali!</h2>
                        <p class="auth-subtitle">Masuk untuk melanjutkan ke Laba.</p>

                        <div class="social-auth">
                            <button class="btn-social">
                                <img src="https://www.google.com/favicon.ico" width="18" height="18" alt="Google">
                                Google
                            </button>
                            <button class="btn-social">
                                <i class="fa-brands fa-facebook" style="color:#1877f2;font-size:1.1rem;"></i>
                                Facebook
                            </button>
                        </div>

                        <div class="divider-text"><span>atau masuk dengan email</span></div>
                        <div style="height:20px;"></div>

                        <div class="form-group">
                            <label class="form-label">Alamat Email <span>*</span></label>
                            <div class="input-icon-wrap">
                                <i class="fa-regular fa-envelope input-icon"></i>
                                <input type="email" class="form-control" placeholder="email@contoh.com"
                                    id="login-email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password <span>*</span></label>
                            <div class="input-icon-wrap input-icon-right-wrap" style="position:relative;">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" class="form-control" placeholder="Password kamu" id="login-pass">
                                <i class="fa-regular fa-eye input-icon-right" onclick="togglePass('login-pass',this)"
                                    style="position:absolute;right:13px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--dark-light)"></i>
                            </div>
                        </div>
                        <div class="flex-between mt-4 mb-24">
                            <label
                                style="display:flex;align-items:center;gap:6px;font-size:0.82rem;color:var(--dark-mid);cursor:pointer;">
                                <input type="checkbox" id="login-remember" style="accent-color:var(--primary)"> Ingat
                                saya
                            </label>
                            <a href="#" style="font-size:0.82rem;color:var(--primary);font-weight:600;">Lupa
                                password?</a>
                        </div>

                        <div id="login-error"
                            style="text-align:center;color:var(--danger);font-size:0.82rem;margin-bottom:12px;display:none;">
                            <i class="fa-solid fa-circle-exclamation"></i> <span id="login-error-msg">Email atau
                                password salah.</span>
                        </div>

                        <button id="btn-login" class="btn btn-primary w-full btn-lg" onclick="doLogin()">
                            <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
                        </button>

                        <p class="text-center text-sm mt-16" style="color:var(--dark-light);">
                            Belum punya akun? <a href="#" style="color:var(--primary);font-weight:600;"
                                onclick="switchTab('register')">Daftar gratis</a>
                        </p>
                    </div>

                    <div class="auth-panel" id="panel-register">
                        <div id="register-step-1">
                            <h2 class="auth-title">Buat Akun Baru</h2>
                            <p class="auth-subtitle">Pilih tipe akun yang sesuai.</p>

                            <div class="role-selector">
                                <div class="role-card selected" id="role-user" onclick="selectRole('user')">
                                    <span class="role-icon">🛍️</span>
                                    <div class="role-label">Pembeli</div>
                                    <div class="role-desc">Saya ingin berbelanja</div>
                                </div>
                                <div class="role-card" id="role-umkm" onclick="selectRole('umkm')">
                                    <span class="role-icon">🏪</span>
                                    <div class="role-label">Pemilik UMKM</div>
                                    <div class="role-desc">Saya ingin berjualan</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nama Lengkap <span>*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-regular fa-user input-icon"></i>
                                    <input type="text" class="form-control" placeholder="Nama sesuai KTP" id="reg-name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat Email <span>*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-regular fa-envelope input-icon"></i>
                                    <input type="email" class="form-control" placeholder="email@contoh.com"
                                        id="reg-email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password <span>*</span></label>
                                <div class="input-icon-wrap input-icon-right-wrap" style="position:relative;">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" class="form-control" placeholder="Minimal 8 karakter"
                                        id="reg-pass" oninput="checkPwd(this.value)">
                                    <i class="fa-regular fa-eye input-icon-right" onclick="togglePass('reg-pass',this)"
                                        style="position:absolute;right:13px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--dark-light)"></i>
                                </div>
                                <div class="pwd-strength">
                                    <div class="pwd-bars">
                                        <div class="pwd-bar" id="pb1"></div>
                                        <div class="pwd-bar" id="pb2"></div>
                                        <div class="pwd-bar" id="pb3"></div>
                                        <div class="pwd-bar" id="pb4"></div>
                                    </div>
                                    <span class="pwd-text" id="pwd-label">Masukkan password</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nomor WhatsApp <span>*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-brands fa-whatsapp input-icon" style="color:#25D366"></i>
                                    <input type="tel" class="form-control" placeholder="08xxxxxxxxxx" id="reg-phone">
                                </div>
                                <span class="form-hint">Kode OTP akan dikirim ke nomor ini</span>
                            </div>

                            <label
                                style="display:flex;align-items:flex-start;gap:8px;font-size:0.8rem;color:var(--dark-mid);margin-bottom:20px;cursor:pointer;line-height:1.5;">
                                <input type="checkbox" style="accent-color:var(--primary);margin-top:2px;" id="reg-tos">
                                Saya setuju dengan <a href="#" style="color:var(--primary);">Syarat & Ketentuan</a>
                                serta <a href="#" style="color:var(--primary);">Kebijakan Privasi</a> Laba.
                            </label>

                            <button class="btn btn-primary w-full btn-lg" onclick="goToOtp()">
                                Lanjutkan <i class="fa-solid fa-arrow-right"></i>
                            </button>
                            <p class="text-center text-sm mt-16" style="color:var(--dark-light);">
                                Sudah punya akun? <a href="#" style="color:var(--primary);font-weight:600;"
                                    onclick="switchTab('login')">Masuk</a>
                            </p>
                        </div>

                        <div id="register-step-2" style="display:none;">
                            <div style="text-align:center;margin-bottom:32px;">
                                <div
                                    style="width:72px;height:72px;background:var(--primary-light);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 16px;">
                                    📱</div>
                                <h2 class="auth-title otp-title">Verifikasi OTP</h2>
                                <p class="otp-desc">Kode 6 digit telah dikirim ke <br><strong
                                        id="otp-target">08xxxx</strong> via WhatsApp</p>
                            </div>

                            <div class="otp-inputs" id="otp-inputs">
                                <input class="otp-input" maxlength="1" type="text" inputmode="numeric"
                                    oninput="otpMove(this,0)">
                                <input class="otp-input" maxlength="1" type="text" inputmode="numeric"
                                    oninput="otpMove(this,1)">
                                <input class="otp-input" maxlength="1" type="text" inputmode="numeric"
                                    oninput="otpMove(this,2)">
                                <input class="otp-input" maxlength="1" type="text" inputmode="numeric"
                                    oninput="otpMove(this,3)">
                                <input class="otp-input" maxlength="1" type="text" inputmode="numeric"
                                    oninput="otpMove(this,4)">
                                <input class="otp-input" maxlength="1" type="text" inputmode="numeric"
                                    oninput="otpMove(this,5)">
                            </div>

                            <div id="otp-error"
                                style="text-align:center;color:var(--danger);font-size:0.82rem;margin-bottom:12px;display:none;">
                                <i class="fa-solid fa-circle-exclamation"></i> Kode OTP salah. Silakan coba lagi.
                            </div>

                            <button id="btn-verify-otp" class="btn btn-primary w-full btn-lg" onclick="verifyOtp()">
                                <i class="fa-solid fa-shield-check"></i> Verifikasi & Buat Akun
                            </button>

                            <div class="otp-resend mt-16">
                                Tidak menerima kode? <span id="resend-countdown">Kirim ulang dalam <strong
                                        id="countdown">60</strong>s</span>
                                <a id="resend-link" style="display:none;" onclick="resendOtp()">Kirim Ulang OTP</a>
                            </div>
                            <div class="text-center mt-16">
                                <a href="#" style="color:var(--dark-mid);font-size:0.82rem;" onclick="goBackToForm()">
                                    <i class="fa-solid fa-arrow-left"></i> Ubah nomor HP
                                </a>
                            </div>
                        </div>

                        <div id="register-step-3" style="display:none;text-align:center;padding:32px 0;">
                            <div style="font-size:4rem;margin-bottom:16px;">🎉</div>
                            <h2 class="auth-title" style="text-align:center;">Akun Berhasil Dibuat!</h2>
                            <p style="color:var(--dark-mid);margin-bottom:28px;">Selamat datang di Laba! Akun kamu
                                sudah aktif dan siap digunakan.</p>
                            <a href="{{ route('profile') }}" class="btn btn-primary btn-lg w-full">
                                Pergi ke Dashboard <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <div class="mt-16">
                                <a href="index.html" class="btn btn-ghost w-full">Kembali ke Beranda</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            let userRole = 'user';

            function switchTab(tab) {
                document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.auth-panel').forEach(p => p.classList.remove('active'));
                document.getElementById('tab-' + tab).classList.add('active');
                document.getElementById('panel-' + tab).classList.add('active');
            }

            function selectRole(role) {
                document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
                document.getElementById('role-' + role).classList.add('selected');
                userRole = role; 
            }

            function togglePass(id, icon) {
                const inp = document.getElementById(id);
                const isPass = inp.type === 'password';
                inp.type = isPass ? 'text' : 'password';
                icon.className = isPass ? 'fa-regular fa-eye-slash input-icon-right' : 'fa-regular fa-eye input-icon-right';
                icon.style.cssText = 'position:absolute;right:13px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--dark-light)';
            }

            function checkPwd(val) {
                const bars = [document.getElementById('pb1'),document.getElementById('pb2'),document.getElementById('pb3'),document.getElementById('pb4')];
                const lbl = document.getElementById('pwd-label');
                bars.forEach(b => b.className = 'pwd-bar');
                if (val.length === 0) { lbl.textContent = 'Masukkan password'; return; }
                let score = 0;
                if (val.length >= 8) score++;
                if (/[A-Z]/.test(val)) score++;
                if (/[0-9]/.test(val)) score++;
                if (/[^A-Za-z0-9]/.test(val)) score++;
                const cls = score <= 1 ? 'weak' : score === 2 ? 'medium' : score === 3 ? 'medium' : 'strong';
                const labels = ['','Lemah','Cukup','Kuat','Sangat Kuat'];
                for (let i = 0; i < score; i++) bars[i].classList.add(cls);
                lbl.textContent = labels[score] || '';
                lbl.style.color = cls === 'weak' ? 'var(--danger)' : cls === 'medium' ? 'var(--warning)' : 'var(--success)';
            }

            function goToOtp() {
                const name = document.getElementById('reg-name').value;
                const email = document.getElementById('reg-email').value;
                const pass = document.getElementById('reg-pass').value;
                const phone = document.getElementById('reg-phone').value;
                const tos = document.getElementById('reg-tos').checked;
                if (!name || !email || !pass || !phone) { alert('Harap lengkapi semua kolom!'); return; }
                if (!tos) { alert('Harap setujui syarat dan ketentuan!'); return; }
                document.getElementById('otp-target').textContent = phone;
                document.getElementById('register-step-1').style.display = 'none';
                document.getElementById('register-step-2').style.display = 'block';
                startCountdown();
                document.querySelector('.otp-input').focus();
            }

            function goBackToForm() {
                document.getElementById('register-step-1').style.display = 'block';
                document.getElementById('register-step-2').style.display = 'none';
            }

            let countdownInterval;
            function startCountdown() {
                let secs = 60;
                const el = document.getElementById('countdown');
                const link = document.getElementById('resend-link');
                const cd = document.getElementById('resend-countdown');
                clearInterval(countdownInterval);
                cd.style.display = 'inline'; link.style.display = 'none';
                countdownInterval = setInterval(() => {
                secs--;
                el.textContent = secs;
                if (secs <= 0) {
                    clearInterval(countdownInterval);
                    cd.style.display = 'none';
                    link.style.display = 'inline';
                }
                }, 1000);
            }

            function resendOtp() { startCountdown(); }

            function otpMove(el, idx) {
                el.classList.toggle('filled', el.value !== '');
                const inputs = document.querySelectorAll('.otp-input');
                if (el.value && idx < 5) inputs[idx + 1].focus();
            }

            function verifyOtp() {
                const inputs = document.querySelectorAll('.otp-input');
                const code = Array.from(inputs).map(i => i.value).join('');
                if (code.length < 6) { alert('Masukkan kode OTP 6 digit!'); return; }

                const name = document.getElementById('reg-name').value;
                const email = document.getElementById('reg-email').value;
                const password = document.getElementById('reg-pass').value;
                const phone = document.getElementById('reg-phone').value;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const btn = document.getElementById('btn-verify-otp');
                const originalText = btn.innerHTML;
                
                btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Memproses...';
                btn.style.pointerEvents = 'none'; 
                document.getElementById('otp-error').style.display = 'none'; 

                fetch("{{ route('register.store') }}", { 
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        role: userRole,
                        name: name,
                        email: email,
                        password: password,
                        phone: phone,
                        otp: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    btn.innerHTML = originalText;
                    btn.style.pointerEvents = 'auto';

                    if (data.success) {
                        document.getElementById('register-step-2').style.display = 'none';
                        document.getElementById('register-step-3').style.display = 'block';
                    } else {
                        const errDiv = document.getElementById('otp-error');
                        errDiv.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> ${data.message || 'Kode OTP salah. Silakan coba lagi.'}`;
                        errDiv.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    btn.innerHTML = originalText;
                    btn.style.pointerEvents = 'auto';
                    alert('Terjadi kesalahan saat menghubungi server.');
                });
            }

            // FUNGSI INI SUDAH DIUBAH UNTUK MELAKUKAN POST LOGIN
            function doLogin() {
                const email = document.getElementById('login-email').value;
                const pass = document.getElementById('login-pass').value;
                const remember = document.getElementById('login-remember').checked;
                
                if (!email || !pass) { 
                    alert('Harap isi email dan password!'); 
                    return; 
                }

                // Ambil elemen yang dibutuhkan
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const btn = document.getElementById('btn-login');
                const errDiv = document.getElementById('login-error');
                const errMsg = document.getElementById('login-error-msg');
                
                // Set tombol menjadi loading
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Memproses...';
                btn.style.pointerEvents = 'none'; 
                errDiv.style.display = 'none'; // Sembunyikan error sebelumnya

                // Ganti route dibawah sesuai dengan Route Post Login kamu, contoh: route('login.post')
                fetch("{{ route('authenticate') }}", { 
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        email: email,
                        password: pass,
                        remember: remember
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Kembalikan tombol seperti semula
                    btn.innerHTML = originalText;
                    btn.style.pointerEvents = 'auto';

                    if (data.success) {
                        // Jika login sukses, arahkan ke halaman profil/dashboard
                        window.location.href = "{{ route('profile') }}";
                    } else {
                        // Tampilkan pesan error jika kredensial salah
                        errMsg.textContent = data.message || 'Email atau password salah.';
                        errDiv.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    btn.innerHTML = originalText;
                    btn.style.pointerEvents = 'auto';
                    alert('Terjadi kesalahan saat menghubungi server.');
                });
            }

            const params = new URLSearchParams(window.location.search);
            if (params.get('mode') === 'register') switchTab('register');
        </script>
    </body>

</html>