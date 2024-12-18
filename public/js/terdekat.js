document.getElementById('dropdownHarga').addEventListener('change', function () {
    const selectedValue = this.value;
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('harga', selectedValue);
    window.location.href = currentUrl;
});

document.getElementById('dropdownUrutkan').addEventListener('change', function () {
    const selectedValue = this.value;
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('urutkan', selectedValue);
    window.location.href = currentUrl;
});

document.getElementById('dropdownLokasi').addEventListener('change', function () {
    const selectedValue = this.value;
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('lokasi', selectedValue);
    window.location.href = currentUrl;
});

window.addEventListener('DOMContentLoaded', function () {
    const currentUrl = new URL(window.location.href);

    const hargaParam = currentUrl.searchParams.get('harga');
    if (hargaParam) {
        const hargaDropdown = document.getElementById('dropdownHarga');
        hargaDropdown.value = hargaParam;
    }

    const urutkanParam = currentUrl.searchParams.get('urutkan');
    if (urutkanParam) {
        const urutkanDropdown = document.getElementById('dropdownUrutkan');
        urutkanDropdown.value = urutkanParam;
    }

    const lokasiParam = currentUrl.searchParams.get('lokasi');
    if (lokasiParam) {
        const lokasiDropdown = document.getElementById('dropdownLokasi');
        lokasiDropdown.value = lokasiParam;
    }
});