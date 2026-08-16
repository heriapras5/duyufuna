<div id="imageLightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 p-4" role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
    <button type="button" id="imageLightboxClose" class="absolute top-4 right-4 text-white/80 hover:text-white text-3xl leading-none cursor-pointer transition" aria-label="Tutup">&times;</button>
    <img id="imageLightboxImg" src="" alt="Pratinjau gambar" class="max-h-[85vh] max-w-full object-contain rounded-lg shadow-2xl">
</div>
<script>
(function () {
    var box = document.getElementById('imageLightbox');
    var img = document.getElementById('imageLightboxImg');
    var closeBtn = document.getElementById('imageLightboxClose');
    if (!box || !img || !closeBtn) return;

    function open(src) {
        img.src = src;
        box.classList.remove('hidden');
        box.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        box.classList.add('hidden');
        box.classList.remove('flex');
        document.body.style.overflow = '';
        img.removeAttribute('src');
    }

    document.addEventListener('click', function (e) {
        var el = e.target.closest('[data-popup-image]');
        if (el) {
            e.preventDefault();
            open(el.dataset.popupImage);
        }
    });

    box.addEventListener('click', function (e) {
        if (e.target === box) close();
    });

    closeBtn.addEventListener('click', close);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') close();
    });
})();
</script>