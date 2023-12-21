<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the ZIP codes from the POST request
    $zipCode1 = isset($_GET['pincode']) ? $_GET['pincode'] : '';

    $zipCode2 = 686501;

    // Get coordinates for ZIP code 1
    $coordinates1 = getGeocode($zipCode1);

    // Get coordinates for ZIP code 2
    $coordinates2 = getGeocode($zipCode2);

    if ($coordinates1 && $coordinates2) {
        // Calculate the distance in miles using Haversine formula
        $distanceInMiles = haversineDistance($coordinates1, $coordinates2);

        // Convert the distance to kilometers
        $distanceInKilometers = milesToKilometers($distanceInMiles);
        
        echo "{$distanceInKilometers} km";
    } else {
        echo "Error getting geocode information for one or both ZIP codes.";
    }
}

// Function to calculate the distance between two points using Haversine formula
function haversineDistance($coordinates1, $coordinates2)
{
    $earthRadius = 3959; // Radius of the Earth in miles

    $lat1 = deg2rad($coordinates1['lat']);
    $lon1 = deg2rad($coordinates1['lon']);
    $lat2 = deg2rad($coordinates2['lat']);
    $lon2 = deg2rad($coordinates2['lon']);

    $deltaLat = $lat2 - $lat1;
    $deltaLon = $lon2 - $lon1;

    $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
         cos($lat1) * cos($lat2) * sin($deltaLon / 2) * sin($deltaLon / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c;

    return round($distance, 2); // Round to 2 decimal places
}

// Function to convert miles to kilometers
function milesToKilometers($miles)
{
    return $miles * 1.60934;
}

// Enhanced error handling in the geocoding function
function getGeocode($zipCode)
{
    $address = urlencode($zipCode);
    $url = "https://nominatim.openstreetmap.org/search?format=json&q={$address}";

    $options = [
        'http' => [
            'header' => 'User-Agent: MyApplication/1.0'
        ]
    ];
    $context = stream_context_create($options);

    $response = file_get_contents($url, false, $context);

    if ($response === false) {
        // Log or display the error
        error_log("Error fetching data from Nominatim for ZIP code {$zipCode}");
        return null;
    }

    $data = json_decode($response, true);

    if ($data && isset($data[0]['lat']) && isset($data[0]['lon'])) {
        $coordinates = [
            'lat' => $data[0]['lat'],
            'lon' => $data[0]['lon']
        ];
        return $coordinates;
    } else {
        // Log or display the error
        error_log("Error getting coordinates from Nominatim for ZIP code {$zipCode}");
        return null;
    }
}
?>