<?php

namespace Drupal\media_formats_reports;

/**
 * Utilities for the Media Formats Reports module.
 */
class Utils {

  /**
   * Gets a list of data source services that can be used in the report selector form.
   *
   * @param bool $ids_only
   *    Whether to return an array of service IDs instead of an associative array of ids/names.
   *
   * @return array
   *   Associative array of services.
   */
  public function getServices($ids_only = FALSE) {
    $container = \Drupal::getContainer();
    $services = $container->getServiceIds();
    $services = preg_grep("/media_formats_reports\.datasource\./", $services);

    // If the Islandora FITS module is not enabled, don't show the PUID report option.
    $module_handler = \Drupal::service('module_handler');
    if (!$module_handler->moduleExists('islandora_fits')) {
      unset($services['puid']);
    }

    if ($ids_only) {
      $service_ids_to_return = [];
      foreach ($services as $service_id) {
        $service_id = preg_replace('/^.*datasource\./', '', $service_id);
        $service_ids_to_return[] = $service_id;
      }
      return $service_ids_to_return;
    }

    $options = [];
    foreach ($services as $service_id) {
      $service = \Drupal::service($service_id);
      $service_id = preg_replace('/^.*datasource\./', '', $service_id);
      $options[$service_id] = $service->getName();
    }
    return $options;
  }

}
