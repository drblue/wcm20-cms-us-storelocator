<?php
/**
 * Geocoding functions
 */

use Geocoder\Query\GeocodeQuery;

/**
 * Geocode a location to geoposition (latitude and longitude).
 *
 * @param string $address
 * @param string $city
 * @return array
 */
function wcmsl_geocode($address, $city) {
	$google_maps_api_key = wcmsl_get_google_maps_api_key();
	if (!$google_maps_api_key) {
		return false;
	}

	$httpClient = new \Http\Adapter\Guzzle6\Client();
	$provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, $google_maps_api_key);
	$geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');

	$query = GeocodeQuery::create("{$address}, {$city}");
	$result = $geocoder->geocodeQuery($query);

	if ($result->isEmpty()) {
		return false;
	}

	$coords = $result->first()->getCoordinates();

	return [
		'lat' => $coords->getLatitude(),
		'lng' => $coords->getLongitude(),
	];
}
