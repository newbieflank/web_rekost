document.getElementById('dropdownHarga').addEventListener('change', function () {
    const selectedValue = this.value;
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('harga', selectedValue);
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

    const urutkanParam = currentUrl.searchParams.get('lokasi');
    if (urutkanParam) {
        const urutkanDropdown = document.getElementById('dropdownLokasi');
        urutkanDropdown.value = urutkanParam;
    }
});