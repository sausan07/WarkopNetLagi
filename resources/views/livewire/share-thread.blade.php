<button wire:click="copy"  class="hover:text-[#F29F05] flex items-center gap-1.5 transition text-sm"> <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"   d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" /> </svg> <span>Bagikan</span> </button>

<script>

document.addEventListener('livewire:init', () => {
    Livewire.on('copyToClipboard', ({ text }) => {
    navigator.clipboard.writeText(text)
    .then(() => showNotification("✅ Link berhasil disalin!", "success"))
    .catch(() => showNotification("❌ Gagal menyalin!", "error"));

        });

});

function showNotification(message, type = "success") {
const notif = document.createElement('div');
    notif.className =
        "fixed top-20 right-6 px-6 py-3 rounded-xl shadow-lg text-white z-50" +
        (type === "success" ? " bg-green-500" : " bg-red-500");
    notif.textContent = message;
    document.body.appendChild(notif);

    setTimeout(() => {
        notif.style.opacity = "0";
        notif.style.transition = "opacity .3s";
        setTimeout(() => notif.remove(), 300);
    }, 2500);
}

</script>
