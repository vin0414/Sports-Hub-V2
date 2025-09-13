<?=view('main/templates/header')?>
<?=view('main/templates/main-template')?>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                            <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                        </svg>
                        <?=$title?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div id="map" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
var map = L.map('map').setView([14.3134, 120.8926], 11); // Coordinates and zoom level

// Step 3: Add Tile Layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

$.ajax({
    url: '<?=site_url('shop-location')?>', // The PHP script URL
    type: 'GET',
    dataType: 'json', // Expect JSON response
    success: function(data) {
        // On success, iterate over each shop and add a marker on the map
        data.forEach(function(shop) {
            var marker = L.marker([shop.latitude, shop.longitude]).addTo(map);
            var popupContent = `
                <h4>${shop.shop_name}</h4>
                <span>${shop.address}</span><br/>
                <a href="${shop.website}" target="_blank">Visit our website</a>
            `;
            marker.bindPopup(popupContent);
        });
    },
    error: function(xhr, status, error) {
        console.error("Error fetching shop data:", error);
    }
});

var marker;

// When the map is clicked, add or move marker
map.on('click', function(e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;

    // If there's already a marker, remove it
    if (marker) {
        map.removeLayer(marker);
    }

    // Add new marker at the clicked position
    marker = L.marker([lat, lng]).addTo(map);
    // You can also store coordinates in hidden fields or variables
    document.getElementById("latitude").value = lat;
    document.getElementById("longitude").value = lng;
    $('#modal-report').modal('show');
});
</script>
<?= view('main/templates/closing')?>