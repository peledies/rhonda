<?php
namespace Rhonda;

/**
* Class to handle UUID related tasks
*
* @category  Class
* @version   0.0.1
* @since     2015-11-06
* @author    Deac Karns <deac@sdicg.com>
*/
class UUID
{
    /**
    * Create a UUID4 string
    *
    * @example
    * <code>
    *   \Rhonda\UUID::create();
    * </code>
    *
    * @example
    * <code>
    *   $uuid = new \Rhonda\UUID();
    *   $uuid->create();
    * </code>
    *
    * @return String - UUID4 string
    *
    * @since   2015-11-06
    * @author  Deac Karns <deac@sdicg.com> 
    **/
    public static function create()
    {
      return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
      );
    }
}