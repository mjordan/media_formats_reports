<?php

namespace Drupal\media_formats_reports\Plugin\DataSource;

/**
 * Gets data for rendering in a media formats report.
 */
interface MediaFormatsReportsDataSourceInterface {

  /**
   * Returns the data source's name.
   *
   * @return string
   *   The name of the data source as it appears in the reports form.
   */
  public function getName();

  /**
   * Gets the data.
   *
   * @return array
   *   An assocative array containing formatlabel => count members. 
   */
  public function getData();

}
