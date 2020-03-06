<?php

namespace Drupal\media_formats_reports\Plugin\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Admin settings form.
 */
class MediaFormatsReportsReportSelectorForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'media_formats_reports_report_selector';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if ($tempstore = \Drupal::service('user.private_tempstore')->get('media_formats_reports')) {
      $report_type = $tempstore->get('media_formats_reports_report_type');
    }
    else {
      $report_type = 'mimetype';
    }

    $form['media_formats_reports_report_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Report type'),
      '#default_value' => $report_type,
      '#options' => $this->getServices(),
    ];
    $form['media_formats_reports_generate_csv'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Generate a CSV file of this data'),
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Go'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $module_handler = \Drupal::service('module_handler');
    if ($form_state->getValue('media_formats_reports_report_type') == 'puid') {
      if (!$module_handler->moduleExists('islandora_fits')) {
        $form_state->setErrorByName('media_formats_reports_report_type', $this->t('Islandora FITS must be installed to generate a PUID report.'));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $tempstore = \Drupal::service('user.private_tempstore')->get('media_formats_reports');
    $tempstore->set('media_formats_reports_report_type', $form_state->getValue('media_formats_reports_report_type'));
    $tempstore->set('media_formats_reports_generate_csv', $form_state->getValue('media_formats_reports_generate_csv'));
  }

  /**
   * Gets a list of data source services that can be used in the report selector form.
   *
   * @return array
   *   Associative array of services.
   */
  public function getServices() {

    $container = \Drupal::getContainer();
    $services = $container->getServiceIds();
    $services = preg_grep("/media_formats_reports\.datasource\./", $services);

    $module_handler = \Drupal::service('module_handler');
    if (!$module_handler->moduleExists('islandora_fits')) {
      unset($services['puid']);
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
