<?php

namespace Drupal\media_formats_reports\Commands;

use Drush\Commands\DrushCommands;

/**
 * Drush commandfile.
 */
class MediaFormatsReportsCommands extends DrushCommands {

  /**
   * @command media_formats_reports:list_report_types
   * @usage media_formats_reports:list_report_types
   */
   public function list_report_types() {
     $output = $this->output();
     $utilities = \Drupal::service('media_formats_reports.utilities');
     $services = $utilities->getServices(TRUE);
     foreach ($services as $service_id) {
       $output->writeln($service_id);
     }
   }

  /**
   * @param string $report_type
   *   The type of report (e.g., 'mimetype', 'puid').
   *
   * @command media_formats_reports:build_cache
   * @usage media_formats_reports:build_cache mimetype
   */
   public function build_cache($report_type) {
     $utilities = \Drupal::service('media_formats_reports.utilities');
     $services = $utilities->getServices(TRUE);

     if (!in_array($report_type, $services)) {
       $this->logger()->error(dt('Report type @report_type not found.', ['@report_type' => $report_type]));
       exit();
     }

     $data_source_service_id = 'media_formats_reports.datasource.' . $report_type;
     $data_source = \Drupal::service($data_source_service_id);
     $format_counts = $data_source->getData();
     $cid = 'media_formats_reports_format_counts_' . $report_type;
     \Drupal::cache()->set($cid, $format_counts);
     $this->logger()->notice(dt('Cache built for media formats report data @report_type.', ['@report_type' => $report_type]));
  }

  /**
   * @param string $report_type
   *   The type of report (e.g., 'mimetype', 'puid').
   *
   * @command media_formats_reports:delete_cache
   * @usage media_formats_reports:delete_cache mimetype
   */
   public function delete_cache($report_type) {
     $utilities = \Drupal::service('media_formats_reports.utilities');
     $services = $utilities->getServices(TRUE);

     if (!in_array($report_type, $services)) {
       $this->logger()->error(dt('Report type @report_type not found.', ['@report_type' => $report_type]));
       exit();
     }

     $cid = 'media_formats_reports_format_counts_' . $report_type;
     \Drupal::cache()->delete($cid);
     $this->logger()->notice(dt('Cache deleted for media formats report data @report_type.', ['@report_type' => $report_type]));
  }
}
