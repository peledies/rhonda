<?php
namespace Rhonda;

/**
 * Class to handle JSON related tasks
 *
 * @category  Class
 * @version   0.0.1
 * @since     2016-07-18
 * @author    Matthew Ess <matthew@schooldatebooks.com>
 */
class JSON{
  /**
  * encode a json response with a numeric check, converting string numbers to
  * number literals.
  *
  * @example
  * <code>
  *   $results = $model->query();
  *   echo \Rhonda\JSON:: encode_numeric($results);
  * </code>
  *
  * @return String - string with encoded json data and numeric literals
  *
  * @since 2016-07-18
  * @author Matthew Ess <matthew@schooldatebooks.com>
  **/
  public function encode_numeric($value) {
    return json_encode($value, JSON_NUMERIC_CHECK);
  }
}