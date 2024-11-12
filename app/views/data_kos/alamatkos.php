
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alamat" name="alamat"
                            placeholder="Alamat akan terisi otomatis ketika memilih lokasi di peta" rows="3"
                            style="resize: none;" required></textarea>
                    </div>
                </div>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <div class="text-end mx-5">
                </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL; ?>public/js/map.js"></script>