<?php

namespace SchoolsManager\Import;

class Import
{
    public function __construct()
    {
        add_filter('pmxi_saved_post', 'updateVisitingAddressField');
    }

    public function getGoogleMapsApiKey()
    {
        return function_exists('acf_get_setting') ? \acf_get_setting('google_api_key') : false;
    }

    public function geocodeAddress($address)
    {

        $api_key = getGoogleMapsApiKey();
        $address = urlencode($address);

        $response = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$api_key");

        $response = json_decode($response, true);

        if (!empty($response['results'][0]['geometry']['location'])) {
            $geo               = $response['results'][0]['geometry']['location'];
            $formatted_address = $response['results'][0]['formatted_address'];
            $location          = array('address' => $formatted_address, 'lat' => $geo['lat'], 'lng' => $geo['lng']);

            return $location;
        }

        return false;
    }


    public function updateGoogleMapsField($address)
    {
        if (function_exists('update_field')) {
            $location = $this->geocodeAddress($address);
            if ($location) {
                \update_field('visiting_address', $location, $post_id);
            }
        }
    }


    public function updateVisitingAddressField($post_id, $xml_node, $is_update)
    {
        $import_id = \wp_all_import_get_import_id();
        if ($import_id == '2') {
            $imported_visiting_address = \get_field('imported_visiting_address', $post_id, true);
            if ($imported_visiting_address) {
                $this->updateGoogleMapsField($imported_visiting_address);
            }
        }
    }
}
