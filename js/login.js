// Menampilkan pop-up login saat tombol login diklik
document.getElementById("show-login").addEventListener("click", function() {
    document.getElementById("popup-login").style.display = "block"; // Menampilkan pop-up login
    document.getElementById("popup-overlay").style.display = "block"; // Menampilkan overlay
});

// Menutup pop-up login saat tombol close diklik
document.getElementById("close-popup").addEventListener("click", function() {
    document.getElementById("popup-login").style.display = "none"; // Menyembunyikan pop-up login
    document.getElementById("popup-overlay").style.display = "none"; // Menyembunyikan overlay
});

// Menampilkan pop-up register saat link "Daftar" diklik
document.getElementById("show-register").addEventListener("click", function() {
    document.getElementById("popup-login").style.display = "none"; // Menyembunyikan pop-up login
    document.getElementById("popup-register").style.display = "block"; // Menampilkan pop-up register
    document.getElementById("popup-overlay").style.display = "block"; // Menampilkan overlay
});

// Menutup pop-up register saat tombol close diklik
document.getElementById("close-register-popup").addEventListener("click", function() {
    document.getElementById("popup-register").style.display = "none"; // Menyembunyikan pop-up register
    document.getElementById("popup-overlay").style.display = "none"; // Menyembunyikan overlay
});

// Menutup pop-up jika overlay diklik
document.getElementById("popup-overlay").addEventListener("click", function() {
    document.getElementById("popup-login").style.display = "none"; // Menyembunyikan pop-up login
    document.getElementById("popup-register").style.display = "none"; // Menyembunyikan pop-up register
    document.getElementById("popup-overlay").style.display = "none"; // Menyembunyikan overlay
});

// Menampilkan notifikasi registrasi berhasil (jika ada parameter)
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("registration") === "success") {
        // Tampilkan notifikasi
        const notification = document.createElement("div");
        notification.innerHTML = `
            <div class="notification">
                <p>Registrasi berhasil! Silakan login.</p>
                <button id="show-login-popup">Login</button>
            </div>
        `;
        document.body.appendChild(notification);

        // Tambahkan event listener untuk tombol login
        document.getElementById("show-login-popup").addEventListener("click", function() {
            document.getElementById("popup-login").style.display = "block"; // Menampilkan pop-up login
            document.getElementById("popup-overlay").style.display = "block"; // Menampilkan overlay
            notification.style.display = "none"; // Sembunyikan notifikasi
        });
    }
});

