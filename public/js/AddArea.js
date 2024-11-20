document.getElementById('showMore').addEventListener('click', function () {
    // Kota tambahan yang akan ditambahkan
    const additionalCities = [
        'Maesan', 'Curahdami', 'Sempol', 'Pakem',  'Maesan', 'Curahdami', 'Sempol', 'Pakem',  'Maesan', 'Curahdami', 'Sempol', 'Pakem'
    ];

    // Kontainer tempat tombol ditambahkan
    const cityContainer = document.getElementById('cityContainer');

    // Tambahkan kota tambahan sebagai tombol baru
    additionalCities.forEach(city => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-outline-primary mr-3 d-inline-block';
        button.textContent = city;
        cityContainer.appendChild(button);
    });

    // Hapus tombol "10+" setelah kota tambahan ditambahkan
    this.parentNode.removeChild(this);
});