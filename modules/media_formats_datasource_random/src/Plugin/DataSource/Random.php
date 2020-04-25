<?php

namespace Drupal\media_formats_datasource_random\Plugin\DataSource;

use Drupal\media_formats_reports\Plugin\DataSource\MediaFormatsReportsDataSourceInterface;

/**
 * Random data source for the Media Formats Reports module.
 */
class Random implements MediaFormatsReportsDataSourceInterface{

  /**
   * Returns the data source's name.
   *
   * @return string
   *   The name of the data source.
   */
  public function getName() {
    return t('Random data (for testing, etc.)');
  }

  /**
   * Generates the random data.
   *
   * @return array
   *   An assocative array containing formatlabel => count members. 
   */
  public function getData() {
     $chars = 'abcdefghijklmnopqrstuvwxyz';
     $num_labels = rand(5, 25);
     $data = [];
     for ($x = 1; $x <= $num_labels; $x++) {
       $label = ucfirst(substr(str_shuffle($chars), 3, 12));
       $data[$label] = rand(0,1000);
     } 
     return $data;
  }

}
