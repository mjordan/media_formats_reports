<?php

namespace Drupal\media_formats_reports\Plugin\DataSource;

use Drupal\media_formats_reports\Plugin\DataSource\MediaFormatsReportsDataSourceInterface;

/**
 * Data source that gets media counts by MIME type.
 *
 */
class Puid implements MediaFormatsReportsDataSourceInterface{

  /**
   * Returns the data source's name.
   *
   * @return string
   *   The name of the data source.
   */
  public function getName() {
    return t('PRONOM PUID');
  }

  /**
   * Gets the data.
   *
   * We don't include a condition/filter, we just get all the unique values in the db table.
   *
   * @return array
   *   An assocative array containing formatlabel => count members. 
   */
  public function getData() {
    $entity_type_manager = \Drupal::service('entity_type.manager');
    $media_storage = $entity_type_manager->getStorage('media');
    $result = $media_storage->getAggregateQuery()
      ->groupBy('fits_droid_puid')
      ->aggregate('fits_droid_puid', 'COUNT')
      ->execute();
    $format_counts = [];
    foreach ($result as $format) {
      if (strlen($format['fits_droid_puid_value'])) {
        $format_counts[$format['fits_droid_puid_value']] = $format['fits_droid_puid_count'];
      }
    }
	  
    return $format_counts;
  }

}
