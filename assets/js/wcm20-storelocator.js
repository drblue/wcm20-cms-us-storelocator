let storeLocatorMap = null;
let storeLocatorMarkers = [];

function initMap() {
	console.log("init google maps plz");

	storeLocatorMap = new google.maps.Map(document.getElementById("wcmsl-map"), {
		center: { lat: 55.8341539, lng: 13.6714464 },
		zoom: 8,
	});

	// get stores from WordPress and add them to the map
	getStores();
}

function getStores() {
	const ajax_url = wcmsl_settings.ajax_url;

	// fetch dem markers
	fetch(ajax_url + '?action=wcmsl_get_stores')
		.then(res => res.json())
		.then(res => {
			console.log("Got stores?", res);

			if (res.success) {
				// add stores to map
				addStoresToMap(res.data);
			} else {
				alert('Failed to get stores from database, sorry');
			}
		});
}

function addStoresToMap(stores) {
	stores.forEach(store => {
		let marker = new google.maps.Marker({
			position: {
				lat: store.latitude,
				lng: store.longitude
			},
			map: storeLocatorMap,
			title: store.name,
		});

		storeLocatorMarkers.push(marker);
	});
}
