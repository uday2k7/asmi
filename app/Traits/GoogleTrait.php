<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait GoogleTrait {
    public function getGeoLocations($address ): array
    {
        $address = str_replace(" ", "+", $address);
        $key=env('GOOGLE_MAP_API_KEY');

        $json = @file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=$key");
        $json = json_decode($json);
        $location=[];
        $location['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $location['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        return $location;
    }

}
