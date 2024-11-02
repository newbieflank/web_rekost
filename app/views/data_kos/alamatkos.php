<!-- CSS Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- Search Control -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Cari Alamat Kos</h5>
        <div class="card-body">
            <div class="container mt-3 mb-5">
                <div id="map" style="height: 400px; width: 100%;" class="mb-3"></div>
                <button type="button" class="btn btn-primary mb-3" onclick="getCurrentLocation()">
                    <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saat Ini
                </button>
            </div>
            <form id="alamatForm" class="row m-5 custom-form" action="<?= BASEURL; ?>alamatkos/tambah" method="post" onsubmit="handleSubmitAlamat(event)">
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alamat" name="alamat" 
                            placeholder="Alamat akan terisi otomatis ketika memilih lokasi di peta"
                            rows="3" style="resize: none;" required></textarea>
                    </div>
                </div>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <div class="text-end mx-5">
                    <button type="submit" class="btn btn-lanjut">
                        Simpan & Lanjutkan <i class="fas fa-chevron-right ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Peta
var map = L.map('map').setView([-2.5489, 118.0149], 5);
var marker;

// Layer peta
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Tambahkan control pencarian
var geocoder = L.Control.geocoder({
    defaultMarkGeocode: false
}).addTo(map);

// Mendapatkan lokasi pengguna
function getCurrentLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            
            // Hapus marker sebelumnya 
            if (marker) {
                map.removeLayer(marker);
            }
            
            // Untuk Marker
            marker = L.marker([latitude, longitude], {draggable: true}).addTo(map);
            
            // Set view ke lokasi pengguna
            map.setView([latitude, longitude], 16);
            
            // Update form koordinat
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
            
            // Dapatkan alamat dari koordinat
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('alamat').value = data.display_name;
                });
                
            marker.on('dragend', updateMarkerPosition);
        }, function(error) {
            // Handle error
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Izin menggunakan lokasi ditolak. Mohon aktifkan akses lokasi di browser Anda.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Waktu permintaan lokasi habis.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan yang tidak diketahui.");
                    break;
            }
        });
    } else {
        alert("Browser Anda tidak mendukung geolokasi.");
    }
}

function updateMarkerPosition(event) {
    var position = marker.getLatLng();
    // Update koordinat
    document.getElementById('latitude').value = position.lat;
    document.getElementById('longitude').value = position.lng;
    
    // Reverse geocoding untuk mendapatkan alamat
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.lat}&lon=${position.lng}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('alamat').value = data.display_name;
        });
}

// Event handler untuk hasil pencarian
geocoder.on('markgeocode', function(e) {
    var location = e.geocode.center;
    var address = e.geocode.name;
    
    // Hapus marker sebelumnya jika ada
    if (marker) {
        map.removeLayer(marker);
    }
    
    // Tambah marker baru
    marker = L.marker(location, {draggable: true}).addTo(map);
    
    // Set view ke lokasi yang dipilih
    map.setView(location, 16);
    
    // Update form
    document.getElementById('alamat').value = address;
    document.getElementById('latitude').value = location.lat;
    document.getElementById('longitude').value = location.lng;
    
    // Event saat marker di-drag
    marker.on('dragend', updateMarkerPosition);
});

document.addEventListener('DOMContentLoaded', getCurrentLocation);

async function handleSubmitAlamat(event) {
    event.preventDefault();
    
    try {
        const form = event.target;
        const formData = new FormData(form);
        
        // Debug: cek data yang akan dikirim
        console.log('Data yang akan dikirim:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            window.location.href = '<?= BASEURL; ?>fotokos';
        } else {
            // Informasi error
            const errorText = await response.text();
            console.error('Error response:', errorText);
            throw new Error('Form submission failed: ' + errorText);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    }
}
</script>