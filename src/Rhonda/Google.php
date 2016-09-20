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
class Google
{
  /**
  * Load address info based on basic address data
  *
  * @example
  * <code>
  * \Rhonda\Google:: geo_code(API_KEY, $params);
  * </code>
  *
  * @param String - Google API Key
  * @param Array  - of Parameters such as Address, city, zip
  *
  * @uses For error codes: https://developers.google.com/maps/documentation/geocoding/intro#StatusCodes
  * @uses For API Key: https://developers.google.com/maps/documentation/geocoding/get-api-key#get-an-api-key
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
  public static function geo_code($key=NULL, $params=NULL){
    // Make a valid query string so Google will accept this
    $query_string = self::prepare_query_string($params);

    // Check if key is set
    $key = ($key)? $key : \Rhonda\Config:: get('system')->google_api_key;

    // Load the basic url
    $request_url = 'https://maps.googleapis.com/maps/api/geocode/json';

    // Load the paramaters + key
    $request_options = '?address='.$query_string.'&key='.$key;

    $result = json_decode(file_get_contents($request_url."".$request_options));
    if($result->status != "OK"){
      throw new \Exception("Google API Error: ".$result->status.", ".$result->error_message);
    }

    return $result;
  }

  /**
  * Prepare the query string so google will accept it
  *
  * @param Array of Parameters such as Address, city, zip
  *
  * @example
  * <code>
  * \Rhonda\Google:: prepare_query_string($params);
  * </code>
  *
  * @return query string
  *
  * @since   2016-07-18
  * @author  Wesley Dekkers <wesley@sdicg.com> 
  **/
  public static function prepare_query_string($params){
    // Check if parameters are set
    if(!$params){throw new \Exception("Error no valid parameters set");}

    $query_string = '';
    foreach ($params as $param) {
      $query_string .= ($query_string)? ",+".$param : $param;
    }
    return str_replace(" ","+",$query_string);
  }
}
?>