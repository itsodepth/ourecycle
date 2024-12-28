const cabangData = {
    surakarta: ["Cabang OuRecycle Kecamatan 1", "Cabang OuRecycle Kecamatan 2", "Cabang OuRecycle Kecamatan 3"],
    jakarta: ["Cabang OuRecycle Kecamatan A", "Cabang OuRecycle Kecamatan B", "Cabang OuRecycle Kecamatan C"],
    bandung: ["Cabang OuRecycle Kecamatan X", "Cabang OuRecycle Kecamatan Y", "Cabang OuRecycle Kecamatan Z"],
    // Tambahkan cabang untuk kota lainnya sesuai kebutuhan
};

function updateCabang() {
    const kotaSelect = document.getElementById("kota");
    const cabangSelect = document.getElementById("cabang");
    const selectedKota = kotaSelect.value;

    // Clear previous options
    cabangSelect.innerHTML = '<option value="">Pilih Cabang</option>';

    if (selectedKota && cabangData[selectedKota]) {
        cabangData[selectedKota].forEach((cabang) => {
            const option = document.createElement("option");
            option.value = cabang;
            option.textContent = cabang;
            cabangSelect.appendChild(option);
        });
    }
}
