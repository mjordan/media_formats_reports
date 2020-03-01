<?php

namespace Drupal\media_formats_reports\Commands;

use Drush\Commands\DrushCommands;

/**
 * Drush commandfile.
 */
class MediaFormatsReportsCommands extends DrushCommands {

  // public function __construct() {
    // $this->module_config = \Drupal::config('persistent_identifiers.settings');
  // }

  /**
   * @param string $name
   *   Name.
   *
   * @command media_formats_reports:query
   * @usage media_formats_reports:query Mark
   */
   public function query($name) {
      // select field_mime_type_value, count(field_mime_type_value) from media__field_mime_type group by field_mime_type_value
      $database = \Drupal::database();
      $query = $database->query("SELECT field_mime_type_value AS mt, count(field_mime_type_value) AS c FROM {media__field_mime_type} GROUP BY field_mime_type_value");
      $result = $query->fetchAll();
      var_dump($result);

      $this->logger()->notice(
          dt(
              'Hello @name!',
              ['@name' => $name]
            )
      );
  }

}
