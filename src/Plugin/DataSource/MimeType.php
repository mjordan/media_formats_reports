<?php

namespace Drupal\media_formats_reports\Plugin\DataSource;

use Drupal\media_formats_reports\Plugin\DataSource\MediaFormatsReportsDataSourceInterface;

/**
 * Data source that gets media counts by MIME type.
 */
class MimeType implements MediaFormatsReportsDataSourceInterface {

  /**
   * Returns the data source's name.
   *
   * @return string
   *   The name of the data source.
   */
  public function getName() {
    return t('MIME Type');
  }

  /**
   * Gets the data.
   *
   * @return array
   *   An assocative array containing formatlabel => count members. 
   */
  public function getData() {
    $config = \Drupal::config('media_formats_reports.settings');
    $media_use_term_ids = explode(',', $config->get('media_formats_reports_media_use_terms'));
    $entity_type_manager = \Drupal::service('entity_type.manager');
    $media_storage = $entity_type_manager->getStorage('media');
    $result = $media_storage->getAggregateQuery()
      ->groupBy('field_mime_type')
      ->aggregate('field_mime_type', 'COUNT')
      ->condition('field_media_use', $media_use_term_ids, 'IN')
      ->execute();
    $format_counts = [];
    foreach ($result as $format) {
      $format_counts[$format['field_mime_type']] = $format['field_mime_type_count'];
    }
    return $format_counts;
  }

}
