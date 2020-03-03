<?php

namespace Drupal\media_formats_reports\Plugin\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Admin settings form.
 */
class MediaFormatsReportsSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'media_formats_reports_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'media_formats_reports.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('media_formats_reports.settings');
    $form['media_formats_reports_media_use_terms'] = [
      '#type' => 'textfield',
      '#maxlength' => 256,
      '#title' => $this->t('Media Use Term IDs'),
      '#default_value' => $config->get('media_formats_reports_media_use_terms'),
      '#description' => $this->t('A comma-separated list of the IDs of the terms from the Islandora Media Use vocabulary to include in the MIME Type report.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable('media_formats_reports.settings')
      ->set('media_formats_reports_media_use_terms', $form_state->getValue('media_formats_reports_media_use_terms'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
