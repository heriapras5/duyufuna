import $ from 'jquery';

// Pastikan jQuery global aktif SEBELUM plugin Summernote dimuat,
// karena Summernote (UMD) menempel ke window.jQuery pada saat evaluasinya.
window.$ = window.jQuery = $;

const summernoteReady = Promise.all([
    import('summernote/dist/summernote-lite.min.js'),
    import('summernote/dist/lang/summernote-id-ID.min.js'),
]).then(() => {
    // Plugin sudah menempel ke jQuery — tandai agar polling cepat selesai.
    window.__summernoteLoaded = true;
}).catch((e) => {
    console.error('summernote chunk load failed:', e);
});

function snHeight($this) {
    var h = $this.data('height');
    if (h) return parseInt(h, 10);
    return $this.hasClass('sm-short') ? 140 : 260;
}

function snCreateSummernote($this) {
    $this.summernote({
        height: snHeight($this),
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview']],
        ],
        lang: 'id-ID',
        callbacks: {
            onKeydown: function(e) {
                // Jangan ganggu Enter di dalam daftar (membuat item baru / keluar list)
                if ($(e.target).closest('li').length) return;
                // Enter → '<br>' (line break langsung terlihat), Shift+Enter → paragraf baru
                if (e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault();
                    document.execCommand('insertLineBreak');
                }
            }
        },
    });
    $this.data('summernote-init', true);
}

function snTryInit($this, wait) {
    if ($this.data('summernote-init')) {
        if (wait) {
            var $editor = $this.next('.note-editor');
            if ($editor.length && $editor.is(':visible')) {
                $this.summernote('reposition');
            }
        }
        return true;
    }
    if (typeof $this.summernote !== 'function') return false;
    if (!$this.is(':visible')) return false;
    try {
        snCreateSummernote($this);
        return true;
    } catch (e) {
        console.error('summernote init failed:', e);
        return false;
    }
}

function snInitWhenReady($this, wait, attempts) {
    attempts = attempts || 0;
    if (!document.contains($this[0])) return;
    if (snTryInit($this, wait)) return;
    if (attempts >= 40) return;
    // Tunggu plugin siap dan elemen tampak, lalu coba lagi.
    setTimeout(function () { snInitWhenReady($this, wait, attempts + 1); }, 80);
}

window.initSummernote = function (scope, wait) {
    var $scope = scope ? $(scope) : $(document);
    $scope.find('.summernote').each(function () {
        snInitWhenReady($(this), !!wait, 0);
    });
};

// Pastikan global tersedia meski chunk plugin masih dimuat, lalu scan DOM.
summernoteReady.then(() => {
    $(function () {
        window.initSummernote(document);
    });
});

// Tab/pane memakai x-show (display:none) — summernote tidak bisa diinisialisasi
// saat tersembunyi. Tangani saat tab diklik/pane ditampilkan (settings mengirim
// event 'resize' pada tiap perpindahan tab) dan saat elemen baru muncul di DOM.
if (window.MutationObserver) {
    new MutationObserver(function () {
        window.initSummernote(document, true);
    }).observe(document.body, {
        childList: true,
        subtree: true,
        attributes: true,
        attributeFilter: ['style'],
    });
} else {
    window.addEventListener('resize', function () {
        window.initSummernote(document, true);
    });
}

// meta content adalah URL biasa (bukan JSON) — baca langsung sebagai string.
var STATUS_TOGGLE_URL = document.querySelector('meta[name="status-toggle-url"]')?.content || '';
var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content || '';

$(document).on('change', '.status-toggle', function () {
    var $t = $(this);
    var revert = function () {
        $t.prop('checked', !$t.prop('checked'));
        Swal.fire({
            title: 'Gagal',
            text: 'Status tidak dapat diperbarui. Coba lagi.',
            icon: 'error',
            confirmButtonText: 'Tutup',
            buttonsStyling: false,
            customClass: { popup: 'rounded-2xl shadow-lg border border-gray-100', confirmButton: 'btn btn-primary' }
        });
    };
    $.ajax({
        url: STATUS_TOGGLE_URL,
        method: 'POST',
        data: {
            _token: CSRF_TOKEN,
            resource: $t.data('resource'),
            id: $t.data('id'),
            status: $t.prop('checked') ? 1 : 0
        },
        dataType: 'json',
        success: function (res) {
            if (!res.success) revert();
        },
        error: revert
    });
});
