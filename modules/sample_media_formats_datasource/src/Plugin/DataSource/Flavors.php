<?php

namespace Drupal\sample_media_formats_datasource\Plugin\DataSource;

use Drupal\media_formats_reports\Plugin\DataSource\MediaFormatsReportsDataSourceInterface;

/**
 * Sample data source for the Media Formats Reports module.
 */
class Flavors implements MediaFormatsReportsDataSourceInterface{

  /**
   * Returns the data source's name.
   *
   * @return string
   *   The name of the data source.
   */
  public function getName() {
    return t('Flavors (sample)');
  }

  /**
   * Gets the data.
   *
   * @return array
   *   An assocative array containing formatlabel => count members. 
   *
   *   The data returned by this sample method is hard-coded, but the
   *   data in a custom plugin could come from a specific field on
   *   Media (see the MIME Type, and PRONOM PUID plugins for examples
   *   of how to do that), from a Solr query, or from some other data source.
   */
  public function getData() {
    return [
      'Spicy' => 100,  
      'Sweet' => 20,  
      'Salty' => 56,  
      'Bitter' => 82,  
      'Sour' => 5,  
    ];
  }

}
