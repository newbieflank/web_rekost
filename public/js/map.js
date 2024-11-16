// Inisialisasi variabel global
let map;
let marker;


// Fungsi untuk menginisialisasi peta
function initMap() {
    if (map) {
        map.remove(); // Hapus map yang sudah ada jika ada
    }

    // Membuat instance peta baru
    map = L.map('map').setView([-2.5489, 118.0149], 5);

    // Menambahkan layer peta
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Menambahkan kontrol pencarian
    const geocoder = L.Control.geocoder({
        defaultMarkGeocode: false,
        placeholder: 'Cari lokasi...',
        errorMessage: 'Lokasi tidak ditemukan',
        geocoder: L.Control.Geocoder.nominatim({
            geocodingQueryParams: {
                'accept-language': 'id',
                countrycodes: 'id'
            }
        })
    }).addTo(map);

    // Event handler untuk hasil pencarian
    geocoder.on('markgeocode', async function (e) {
        const location = e.geocode.center;
        console.log('Lokasi dari pencarian:', location);
        updateMarker(location.lat, location.lng);
    });

    // Ambil koordinat dari input tersembunyi
    const latitude = parseFloat(document.getElementById('latitude').value);
    const longitude = parseFloat(document.getElementById('longitude').value);

    console.log('Initializing map with:', latitude, longitude);

    // If coordinates are valid, update the marker and center map
    if (!isNaN(latitude) && !isNaN(longitude)) {
        updateMarker(latitude, longitude);
    } else {
        console.warn('Latitude or Longitude is not valid.');
    }

    // Invalidate size setelah map dibuat
    setTimeout(() => {
        map.invalidateSize();
    }, 100);
}



// Fungsi untuk memperbarui marker dan data lokasi
function updateMarker(latitude, longitude) {
    // Hapus marker sebelumnya jika ada
    if (marker) {
        map.removeLayer(marker);
    }

    // Tambah marker baru
    marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);

    // Set view ke lokasi
    map.setView([latitude, longitude], 16);

    // Update form koordinat
    document.getElementById('latitude').value = latitude;
    document.getElementById('longitude').value = longitude;

    // Update alamat
    updateAddress(latitude, longitude);

    // Event saat marker di-drag
    marker.on('dragend', async function (event) {
        const position = marker.getLatLng();
        document.getElementById('latitude').value = position.lat;
        document.getElementById('longitude').value = position.lng;
        updateAddress(position.lat, position.lng);
    });
}

// Fungsi untuk mengupdate alamat menggunakan reverse geocoding
let debounceTimer;
function updateAddress(lat, lng) {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(async () => {
        try {
            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&accept-language=id`
            );

            if (!response.ok) {
                throw new Error('Gagal mendapatkan alamat');
            }

            const data = await response.json();
            document.getElementById('alamat').value = data.display_name;
        } catch (error) {
            console.error('Error saat mengupdate alamat:', error);
        }
    }, 500); // Delay request by 500ms after the last input
}


// Fungsi untuk mendapatkan lokasi saat ini
function getCurrentLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            // Success callback
            function (position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                console.log('Lokasi ditemukan:', latitude, longitude);
                updateMarker(latitude, longitude);
            },
            // Error callback
            function (error) {
                console.error('Error getting location:', error);
                let errorMessage;
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = "Izin menggunakan lokasi ditolak. Mohon aktifkan akses lokasi di browser Anda.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = "Informasi lokasi tidak tersedia.";
                        break;
                    case error.TIMEOUT:
                        errorMessage = "Waktu permintaan lokasi habis.";
                        break;
                    default:
                        errorMessage = "Terjadi kesalahan yang tidak diketahui.";
                }
                alert(errorMessage);
            }
        );
    } else {
        alert("Browser Anda tidak mendukung geolokasi.");
    }


    document.addEventListener("DOMContentLoaded", function () {
        initMap();
    });
}