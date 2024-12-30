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

function closeNavbar() {
    // Menutup navbar jika dalam mode toggler
    var navbarCollapse = document.getElementById("navbarNav");
    if (navbarCollapse.classList.contains("show")) {
        navbarCollapse.classList.remove("show");
    }
}

function loadSubjenis(jenis) {
    const subjenisContainer = document.getElementById("subjenisCheckboxes");
    subjenisContainer.innerHTML = "<p>Memuat...</p>";

    fetch(`get_subjenis.php?jenis=${jenis}`)
        .then((response) => response.json())
        .then((data) => {
            subjenisContainer.innerHTML = ""; // Kosongkan konten sebelumnya
            data.forEach((item) => {
                const checkbox = document.createElement("div");
                checkbox.classList.add("form-check");
                checkbox.innerHTML = `
                    <input class="form-check-input" type="checkbox" name="subjenisSampah[]" value="${item.id_subjenis}" id="subjenis${item.id_subjenis}">
                    <label class="form-check-label" for="subjenis${item.id_subjenis}">
                        ${item.subjenis_sampah}
                    </label>
                `;
                subjenisContainer.appendChild(checkbox);
            });
        })
        .catch((error) => {
            console.error("Error:", error);
            subjenisContainer.innerHTML = "<p>Error memuat subjenis.</p>";
        });
}

document.getElementById("beratSampah").addEventListener("change", function () {
    var berat = parseFloat(this.value);
    if (berat < 5) {
        var myModal = new bootstrap.Modal(document.getElementById("weightModal"));
        myModal.show();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    var map = L.map("map").setView([-7.5582, 110.8261], 12); // Default to Solo
    var marker = L.marker([-7.5582, 110.8261], { draggable: true }).addTo(map);
    var searchResults = document.getElementById("searchResults");
    var searchTimeout;

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "© OpenStreetMap contributors",
    }).addTo(map);

    // Function to get address from coordinates (reverse geocoding)
    async function getAddress(lat, lng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`);
            const data = await response.json();

            document.getElementById("alamat").value = data.display_name;
            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;
        } catch (error) {
            console.error("Error fetching address:", error);
            document.getElementById("alamat").value = "Error getting address";
        }
    }

    // Function to search address (forward geocoding)
    async function searchAddress(query) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5`);
            const data = await response.json();

            searchResults.innerHTML = "";

            if (data.length > 0) {
                data.forEach((result) => {
                    const div = document.createElement("div");
                    div.textContent = result.display_name;
                    div.onclick = function () {
                        const lat = parseFloat(result.lat);
                        const lon = parseFloat(result.lon);

                        // Update map and marker
                        map.setView([lat, lon], 16);
                        marker.setLatLng([lat, lon]);

                        // Update form
                        document.getElementById("alamat").value = result.display_name;
                        document.getElementById("latitude").value = lat;
                        document.getElementById("longitude").value = lon;

                        // Hide results
                        searchResults.style.display = "none";
                    };
                    searchResults.appendChild(div);
                });
                searchResults.style.display = "block";
            } else {
                searchResults.style.display = "none";
            }
        } catch (error) {
            console.error("Error searching address:", error);
        }
    }

    // Input event listener for address search
    document.getElementById("alamat").addEventListener("input", function (e) {
        clearTimeout(searchTimeout);
        const query = e.target.value.trim();

        if (query.length > 2) {
            // Start searching after 3 characters
            searchTimeout = setTimeout(() => {
                searchAddress(query);
            }, 500); // Add delay to prevent too many requests
        } else {
            searchResults.style.display = "none";
        }
    });

    // Click outside search results to close them
    document.addEventListener("click", function (e) {
        if (!searchResults.contains(e.target) && e.target.id !== "alamat") {
            searchResults.style.display = "none";
        }
    });

    // Update address when marker is dragged
    marker.on("dragend", function (e) {
        var position = marker.getLatLng();
        getAddress(position.lat, position.lng);
    });

    // Add click event to map
    map.on("click", function (e) {
        marker.setLatLng(e.latlng);
        getAddress(e.latlng.lat, e.latlng.lng);
    });

    // Get initial address
    getAddress(-7.5582, 110.8261);
});
