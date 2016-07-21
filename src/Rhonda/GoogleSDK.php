<?php
namespace Rhonda;

/**
* Class to handle Google API calls
*
* @category  Class
* @version   0.0.1
* @since     2016-07-20
* @author    Wesley Dekkers <wesley@sdicg.com>
*/
class GoogleSDK
{
  /**
  * Load address info based on basic address data
  *
  * @example
  * <code>
  * \Rhonda\GoogleSDK:: get_address_data(API_KEY, $params);
  * </code>
  *
  * @param String - Google API Key
  * @param Array  - of Parameters such as Address, city, zip
  *
  * @example
  * Return body
  * <code>
  * {
  *   "results" : [
  *      {
  *         "address_components" : [
  *            {
  *               "long_name" : "1600",
  *               "short_name" : "1600",
  *               "types" : [ "street_number" ]
  *            },
  *            {
  *               "long_name" : "Amphitheatre Pkwy",
  *               "short_name" : "Amphitheatre Pkwy",
  *               "types" : [ "route" ]
  *            },
  *            {
  *               "long_name" : "Mountain View",
  *               "short_name" : "Mountain View",
  *               "types" : [ "locality", "political" ]
  *            },
  *            {
  *               "long_name" : "Santa Clara County",
  *               "short_name" : "Santa Clara County",
  *               "types" : [ "administrative_area_level_2", "political" ]
  *            },
  *            {
  *               "long_name" : "California",
  *               "short_name" : "CA",
  *               "types" : [ "administrative_area_level_1", "political" ]
  *            },
  *            {
  *               "long_name" : "United States",
  *               "short_name" : "US",
  *               "types" : [ "country", "political" ]
  *            },
  *            {
  *               "long_name" : "94043",
  *               "short_name" : "94043",
  *               "types" : [ "postal_code" ]
  *            }
  *         ],
  *         "formatted_address" : "1600 Amphitheatre Parkway, Mountain View, CA 94043, USA",
  *         "geometry" : {
  *            "location" : {
  *               "lat" : 37.4224764,
  *               "lng" : -122.0842499
  *            },
  *            "location_type" : "ROOFTOP",
  *            "viewport" : {
  *               "northeast" : {
  *                  "lat" : 37.42382538,
  *                  "lng" : -122.08290
  *               },
  *               "southwest" : {
  *                  "lat" : 37.4211274197085,
  *                  "lng" : -122.0855988802915
  *               }
  *            }
  *         },
  *         "place_id" : "ChIJ2eUgeAK6j4ARbn5u_wAGqWA",
  *         "types" : [ "street_address" ]
  *      }
  *   ],
  *   "status" : "OK"
  * }
  * </code>
  *
  * @return **Object** with specific address data
  *
  * @since   2016-07-18
  * @author  Wesley Dekkers <wesley@sdicg.com> 
  **/
  public static function get_address_data($key=NULL, $params=NULL){
    // Check if key is set
    if(!$key){throw new \Exception("No API Key is set please look at https://developers.google.com/maps/documentation/geocoding/start");}

    // Check if parameters are set
    if(!$params){throw new \Exception("Error no valid parameters set");}

    // Make a valid query string so Google will accept this
  	$query_string = self::prepare_query_string($params);

    // Load the basic url
  	$request_url = 'https://maps.googleapis.com/maps/api/geocode/json';

    // Load the paramaters + key
    $request_options = '?address='.$query_string.'&key='.$key;

  	return json_decode(file_get_contents($request_url."".$request_options));
  }

  /**
  * Prepare the query string so google will accept it
  *
  * @param Array of Parameters such as Address, city, zip
  *
  * @example
  * <code>
  * prepare_query_string:: prepare_query_string($params);
  * </code>
  *
  * @return query string
  *
  * @since   2016-07-18
  * @author  Wesley Dekkers <wesley@sdicg.com> 
  **/
  public static function prepare_query_string($params){
  	$query_string = '';
  	foreach ($params as $param) {
  		$query_string .= ($query_string)? ",+".$param : $param;
  	}
  	return str_replace(" ","+",$query_string);
  }
}
?>