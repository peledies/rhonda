<?php
namespace Rhonda;

/**
 * Class to handle Autoloading .php files
 *
 * @category  Class
 * @version   0.0.1
 * @since     2016-02-09
 * @author    Deac Karns <deac@sdicg.com>
 */
class Autoload
{
  /**
   * Automatically include all files with a .php extension within a supplied directory
   *
   * @example
   * <code>
   *   \Rhonda\Autoload::path(__DIR__.'/path/to/load/');
   * </code>
   *
   * @example
   * <code>
   *   $autoload = new \Rhonda\Autoload();
   *   $autoload->path(__DIR__.'/path/to/load/');
   * </code>
   *
   * @return void
   *
   * @since   2016-02-15
   * @author  Deac Karns <peledies@gmail.com>
   **/
  public static function path($folder, $pattern=NULL)
  {
    $pattern = '/^.+\.php$/i';
    $dir = new \RecursiveDirectoryIterator($folder);
    $ite = new \RecursiveIteratorIterator($dir);
    $files = new \RegexIterator($ite, $pattern, \RegexIterator::GET_MATCH);

    foreach($files as $file) {
      if($file != "./index.php"){
        include array_shift($file);
      }
    }

  }
}