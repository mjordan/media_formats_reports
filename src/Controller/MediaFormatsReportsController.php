<?php

namespace Drupal\media_formats_reports\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller.
 */
class MediaFormatsReportsController extends ControllerBase {

  /**
   * Output the markup that Chart.js needs.
   *
   * The chart itself is rendered via Javascript.
   *
   * @return string
   *   Themed markup used by the chart.
   */
  public function main() {
    return [
      '#theme' => 'media_formats_reports_chart',
    ];
  }
}
