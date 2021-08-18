let storeLocatorMap = null;

function initMap() {
	console.log("init google maps plz");

	storeLocatorMap = new google.maps.Map(document.getElementById("wcmsl-map"), {
		center: { lat: 55.6811309, lng: 13.6487008 },
		zoom: 8,
	});

	markerEmporia = new google.maps.Marker({
		position: { lat: 55.563615, lng: 12.974616 },
		map: storeLocatorMap,
	});

	markerVala = new google.maps.Marker({
		position: { lat: 56.091522, lng: 12.757102 },
		map: storeLocatorMap,
	});
}
