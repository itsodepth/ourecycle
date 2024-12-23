$(document).ready(function () {
    // Fungsi untuk memulai animasi countdown
    function startCountdown(element) {
        $(element).each(function () {
            var $this = $(this);
            var countTo = $this.data("count");
            $({ countNum: 0 }).animate(
                { countNum: countTo },
                {
                    duration: 4000, // Durasi animasi dalam milidetik (lebih lambat)
                    easing: "swing", // Jenis easing
                    step: function () {
                        $this.text(Math.floor(this.countNum)); // Update teks dengan angka bulat
                    },
                    complete: function () {
                        $this.text(this.countNum); // Pastikan angka akhir ditampilkan
                    },
                }
            );
        });
    }

    // Menggunakan Intersection Observer untuk lazy load countdown
    var options = {
        root: null, // viewport
        rootMargin: "0px",
        threshold: 0.1, // 10% dari elemen harus terlihat
    };

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                startCountdown(".count"); // Mulai countdown jika elemen terlihat
                observer.unobserve(entry.target); // Hentikan pengamatan setelah animasi dimulai
            }
        });
    }, options);

    // Mengamati setiap elemen dengan kelas 'count'
    $(".count").each(function () {
        observer.observe(this);
    });
});

