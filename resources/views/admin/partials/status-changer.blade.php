@props([
    'customer' => null,
    'filterStatus' => '',
    'removeOnMismatch' => false,
    'onAfterSave' => '',
])
@php
    $statusList = \App\Models\Customer::STATUSES;
    $statusColor = \App\Models\Customer::STATUS_COLORS;
    $statusDot = [
        'baru' => 'bg-amber-400',
        'pelanggan' => 'bg-emerald-400',
        'dihubungi' => 'bg-sky-400',
        'konversi' => 'bg-emerald-600',
        'batal' => 'bg-red-400',
    ];
@endphp
<div class="relative"
     x-data="openStatus({{ Js::from([
        'status' => $customer->status,
        'statusList' => $statusList,
        'statusColor' => $statusColor,
        'filterStatus' => $filterStatus,
        'removeOnMismatch' => (bool) $removeOnMismatch,
        'onAfterSave' => $onAfterSave,
     ]) }})"
     @click.outside="closePanel()">
    <button type="button" @click="toggle()" data-status-btn
            :class="statusColor[selected] || 'text-gray-600 bg-gray-100 border-gray-200'"
            class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold cursor-pointer transition">
        <span x-text="statusList[selected] || ''"></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
    </button>
    <div x-show="open" x-cloak x-transition
         :style="panelStyle"
         class="status-panel z-50 rounded-xl border border-gray-100 bg-white shadow-lg py-1.5">
        <p class="px-3 py-1.5 text-[11px] font-semibold uppercase tracking-wide text-gray-400">Ubah Status</p>
        <div class="mx-2 mb-1 border-t border-gray-100"></div>
        <div class="max-h-44 overflow-y-auto">
            @foreach($statusList as $value => $text)
            <button type="button"
                    data-note=""
                    @click="choose('{{ $value }}')"
                    :class="pending === '{{ $value }}' || selected === '{{ $value }}' ? 'bg-emerald-50' : ''"
                    class="flex w-full items-center justify-between gap-3 px-3 py-1.5 text-left text-sm transition hover:bg-gray-50">
                <span class="inline-flex items-center gap-2.5">
                    <span class="h-2 w-2 rounded-full shrink-0 {{ $statusDot[$value] ?? 'bg-gray-300' }}"></span>
                    <span>{{ $text }}</span>
                </span>
                <svg x-show="pending === '{{ $value }}' || selected === '{{ $value }}'" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-dark-green shrink-0"><polyline points="20 6 9 17 4 12"/></svg>
            </button>
            @endforeach
        </div>
        <div x-show="editing" x-cloak x-transition>
            <div class="mx-2 my-1 border-t border-gray-100"></div>
            <div class="px-3 pb-2">
                <textarea x-model="note" rows="2"
                          placeholder="Catatan (opsional)"
                          class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-xs text-gray-700 placeholder:text-gray-400 focus:border-dark-green focus:outline-none resize-none"></textarea>
                <div class="mt-2 flex items-center justify-end gap-2">
                    <button type="button" @click="cancel()" class="btn btn-ghost btn-sm">Batal</button>
                    <button type="button" @click="save('{{ route('admin.customers.status', $customer) }}')" :disabled="saving"
                            class="btn btn-primary btn-sm disabled:opacity-60">
                        <svg x-show="!saving" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        <svg x-show="saving" x-cloak xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="animate-spin"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                        <span x-text="saving ? 'Menyimpan…' : 'Simpan'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
function openStatus({ status, statusList, statusColor, filterStatus, removeOnMismatch, onAfterSave }) {
    return {
        open: false,
        editing: false,
        saving: false,
        selected: status,
        pending: null,
        note: '',
        statusList,
        statusColor,
        filterStatus: filterStatus || '',
        removeOnMismatch: !!removeOnMismatch,
        onAfterSave: onAfterSave || '',
        panelStyle: {},
        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.bindScrollClose();
                this.$nextTick(() => this.positionPanel());
            } else {
                this.unbindScrollClose();
                this.resetEditor();
            }
        },
        positionPanel() {
            const btn = this.$root.querySelector('[data-status-btn]');
            if (!btn) return;
            const rect = btn.getBoundingClientRect();
            const panel = this.$root.querySelector('.status-panel');
            const h = (panel && panel.offsetHeight) || 230;
            const gap = 0;
            const width = 288;
            const spaceBelow = window.innerHeight - rect.bottom;
            const spaceAbove = rect.top;
            const openUp = spaceBelow < h && spaceAbove > spaceBelow;
            const left = Math.max(gap, Math.min(rect.right - width, window.innerWidth - width - gap));
            this.panelStyle = {
                position: 'fixed',
                top: openUp ? 'auto' : (rect.bottom + gap) + 'px',
                bottom: openUp ? (window.innerHeight - rect.top + gap) + 'px' : 'auto',
                left: left + 'px',
                width: width + 'px',
            };
        },
        bindScrollClose() {
            this._scrollClose = () => { if (this.open) this.closePanel(); };
            document.addEventListener('scroll', this._scrollClose, true);
        },
        unbindScrollClose() {
            if (this._scrollClose) {
                document.removeEventListener('scroll', this._scrollClose, true);
                this._scrollClose = null;
            }
        },
        closePanel() {
            this.open = false;
            this.unbindScrollClose();
            this.resetEditor();
        },
        resetEditor() {
            this.editing = false;
            this.pending = null;
            this.note = '';
        },
        choose(value, note) {
            this.pending = value;
            this.editing = true;
            this.note = note || '';
            this.$nextTick(() => this.positionPanel());
        },
        cancel() {
            this.resetEditor();
            this.$nextTick(() => this.positionPanel());
        },
        save(url) {
            if (this.saving || !this.pending) return;
            const newStatus = this.pending;
            this.saving = true;
            updateStatus(url, newStatus, this.note, () => {
                this.selected = newStatus;
                this.open = false;
                this.unbindScrollClose();
                this.resetEditor();
                this.saving = false;
                if (this.onAfterSave && window[this.onAfterSave]) {
                    window[this.onAfterSave](newStatus, this.note);
                }
                if (this.removeOnMismatch && this.filterStatus && this.filterStatus !== newStatus) {
                    removeLeadRow(this.$root);
                }
            }, () => {
                this.saving = false;
            });
        },
    };
}

function removeLeadRow(root) {
    const row = root.closest('tr');
    if (!row) return;
    row.style.transition = 'opacity .25s ease, transform .25s ease';
    row.style.opacity = '0';
    row.style.transform = 'translateX(10px)';
    setTimeout(function () {
        row.remove();
        updatePaginationInfo();
        if (document.querySelectorAll('#leadsTable tbody tr').length === 0) {
            window.location.reload();
        }
    }, 250);
}

function updatePaginationInfo() {
    const el = document.getElementById('leadsPaginationInfo');
    if (!el) return;
    const m = el.textContent.match(/Menampilkan (\d+)–(\d+) dari (\d+)/);
    if (!m) return;
    const first = parseInt(m[1], 10);
    const last = Math.max(first, parseInt(m[2], 10) - 1);
    const total = Math.max(0, parseInt(m[3], 10) - 1);
    el.textContent = el.textContent.replace(/Menampilkan \d+–\d+ dari \d+/, 'Menampilkan ' + first + '–' + last + ' dari ' + total);
}

function updateStatus(url, status, catatan, onSuccess, onError) {
    fetch(url, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ status: status, catatan: catatan || null }),
    }).then(r => {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
    }).then(data => {
        if (!data.success) throw new Error('Gagal memperbarui status');
        if (onSuccess) {
            onSuccess(status);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Status diperbarui',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: false,
                width: 240,
                customClass: { popup: 'rounded-xl' }
            });
        } else {
            window.location.reload();
        }
    }).catch(() => {
        if (onError) onError();
        Swal.fire({
            title: 'Gagal',
            text: 'Status tidak dapat diperbarui. Coba lagi.',
            icon: 'error',
            confirmButtonText: 'Tutup',
            buttonsStyling: false,
            customClass: { popup: 'rounded-2xl shadow-lg border border-gray-100', confirmButton: 'btn btn-primary' }
        });
    });
}
</script>
@endpush
@endonce