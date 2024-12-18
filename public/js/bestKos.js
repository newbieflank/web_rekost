const urlParams = new URLSearchParams(window.location.search);
const lokasi = urlParams.get("location") ?? null;


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

if (lokasi) {
    const currentUrl = new URL(window.location.href);
    if (currentUrl.searchParams.has('harga') || currentUrl.searchParams.has('urutkan')) {

        window.location.href = `best?${currentUrl.searchParams.toString()}`;
    } else {
        window.location.href = `best?lokasi=${lokasi}`;
    }
}


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
});


