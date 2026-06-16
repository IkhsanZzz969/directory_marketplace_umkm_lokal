{{-- ═══ CUSTOM MODAL (replaces native alert / confirm) ═══ --}}
<div class="custom-modal-backdrop" id="customModalBackdrop">
    <div class="custom-modal-box">
        <div class="custom-modal-icon-area">
            <div class="custom-modal-icon-ring" id="customModalIconRing">
                <i id="customModalIcon"></i>
            </div>
        </div>
        <div class="custom-modal-content">
            <div class="custom-modal-title" id="customModalTitle"></div>
            <div class="custom-modal-message" id="customModalMessage"></div>
        </div>
        <div class="custom-modal-actions" id="customModalActions"></div>
    </div>
</div>

<script>
/**
 * PasarLokal Custom Modal System
 * Replaces native alert() and confirm() with beautiful animated modals.
 *
 * Usage:
 *   showModal({ type:'success', title:'Berhasil!', message:'Data tersimpan.' });
 *   showModal({ type:'error',   title:'Gagal!',    message:'Terjadi kesalahan.' });
 *   showModal({ type:'warning', title:'Perhatian',  message:'Apakah kamu yakin?' });
 *
 *   showConfirm({
 *     title: 'Konfirmasi',
 *     message: 'Yakin ingin melanjutkan?',
 *     type: 'confirm',              // 'confirm' | 'danger'
 *     confirmText: 'Ya, Lanjutkan',
 *     cancelText: 'Batal',
 *   }).then(confirmed => { if (confirmed) { ... } });
 */

const ModalIcons = {
    success: 'fa-solid fa-check',
    error:   'fa-solid fa-xmark',
    warning: 'fa-solid fa-triangle-exclamation',
    confirm: 'fa-solid fa-question',
    danger:  'fa-solid fa-trash-can',
};

const ModalTitles = {
    success: 'Berhasil!',
    error:   'Terjadi Kesalahan',
    warning: 'Perhatian',
    confirm: 'Konfirmasi',
    danger:  'Konfirmasi Hapus',
};

let _modalResolve = null;

function _getModalEls() {
    return {
        backdrop: document.getElementById('customModalBackdrop'),
        ring:     document.getElementById('customModalIconRing'),
        icon:     document.getElementById('customModalIcon'),
        title:    document.getElementById('customModalTitle'),
        message:  document.getElementById('customModalMessage'),
        actions:  document.getElementById('customModalActions'),
    };
}

function _closeModal() {
    const { backdrop } = _getModalEls();
    backdrop.classList.remove('active');
}

function _handleEscape(e) {
    if (e.key === 'Escape') {
        _closeModal();
        if (_modalResolve) { _modalResolve(false); _modalResolve = null; }
        document.removeEventListener('keydown', _handleEscape);
    }
}

/**
 * Show an alert-style modal (info / success / error / warning).
 * Returns a Promise that resolves when the user clicks OK.
 */
function showModal({ type = 'success', title, message, okText = 'Mengerti' } = {}) {
    return new Promise(resolve => {
        const el = _getModalEls();

        // Icon
        el.ring.className = 'custom-modal-icon-ring ' + type;
        el.icon.className = ModalIcons[type] || ModalIcons.success;

        // Content
        el.title.textContent   = title   || ModalTitles[type] || '';
        el.message.textContent = message || '';

        // Actions — single OK button
        const btnClass = type === 'error' ? 'btn-modal-danger'
                       : type === 'success' ? 'btn-modal-success'
                       : 'btn-modal-ok';

        el.actions.innerHTML = `<button class="btn ${btnClass}" id="customModalOk">${okText}</button>`;

        document.getElementById('customModalOk').addEventListener('click', () => {
            _closeModal();
            resolve(true);
        });

        // Backdrop click = close
        el.backdrop.onclick = e => {
            if (e.target === el.backdrop) { _closeModal(); resolve(true); }
        };

        // Escape key
        _modalResolve = resolve;
        document.addEventListener('keydown', _handleEscape);

        // Show
        el.backdrop.classList.add('active');
    });
}

/**
 * Show a confirm-style modal with Cancel + Confirm buttons.
 * Returns a Promise<boolean>.
 */
function showConfirm({
    type = 'confirm',
    title,
    message,
    confirmText = 'Ya, Lanjutkan',
    cancelText  = 'Batal',
} = {}) {
    return new Promise(resolve => {
        const el = _getModalEls();

        // Icon
        el.ring.className = 'custom-modal-icon-ring ' + type;
        el.icon.className = ModalIcons[type] || ModalIcons.confirm;

        // Content
        el.title.textContent   = title   || ModalTitles[type] || '';
        el.message.textContent = message || '';

        // Actions — Cancel + Confirm
        const confirmBtnClass = type === 'danger' ? 'btn-modal-danger' : 'btn-modal-ok';

        el.actions.innerHTML = `
            <button class="btn btn-modal-cancel" id="customModalCancel">${cancelText}</button>
            <button class="btn ${confirmBtnClass}" id="customModalConfirm">${confirmText}</button>
        `;

        document.getElementById('customModalCancel').addEventListener('click', () => {
            _closeModal(); resolve(false);
        });
        document.getElementById('customModalConfirm').addEventListener('click', () => {
            _closeModal(); resolve(true);
        });

        // Backdrop click = cancel
        el.backdrop.onclick = e => {
            if (e.target === el.backdrop) { _closeModal(); resolve(false); }
        };

        // Escape key
        _modalResolve = resolve;
        document.addEventListener('keydown', _handleEscape);

        // Show
        el.backdrop.classList.add('active');
    });
}
</script>
