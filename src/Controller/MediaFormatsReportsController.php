<?php

namespace Drupal\media_formats_reports\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller.
 */
class MediaFormatsReportsController extends ControllerBase {

  /**
   * Output the report.
   *
   * The chart itself is rendered via Javascript.
   *
   * @return string
   *   Markup used by the chart.
   */
  public function main() {
    if ($tempstore = \Drupal::service('user.private_tempstore')->get('media_formats_reports')) {
      $show_csv_link = $tempstore->get('media_formats_reports_generate_csv');
    }
    $form = \Drupal::formBuilder()->getForm('Drupal\media_formats_reports\Plugin\Form\MediaFormatsReportsReportSelectorForm');
    return [
      '#form' => $form,
      '#show_csv_link' => $show_csv_link,
      '#theme' => 'media_formats_reports_chart',
    ];
  }

}
