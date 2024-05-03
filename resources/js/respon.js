// Cek apakah ada status yang disimpan di localStorage saat halaman dimuat
document.addEventListener("DOMContentLoaded", function() {
    const registerElement = document.querySelector('#register');
    const closeButton = document.querySelector('#register button');

    // Periksa localStorage, jika ada status 'hidden', sembunyikan elemen register
    if (localStorage.getItem('registerStatus') === 'hidden') {
        registerElement.classList.add('hidden');
    }

    // Event listener untuk tombol penutup
    closeButton.addEventListener('click', function() {
        // Sembunyikan elemen register
        registerElement.classList.add('hidden');
        // Simpan status 'hidden' di localStorage
        localStorage.setItem('registerStatus', 'hidden');
    });
});

// Event listener untuk menampilkan kembali elemen register saat kembali ke halaman
window.addEventListener('pageshow', function(event) {
    const registerElement = document.querySelector('#register');

    // Periksa localStorage, jika statusnya 'hidden', maka tampilkan kembali elemen register
    if (localStorage.getItem('registerStatus') === 'hidden') {
        registerElement.classList.remove('hidden');
        // Hapus status 'hidden' dari localStorage
        localStorage.removeItem('registerStatus');
    }
});
