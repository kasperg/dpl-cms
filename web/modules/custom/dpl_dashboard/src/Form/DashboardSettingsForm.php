<?php

namespace Drupal\dpl_dashboard\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Dashboard list setting form.
 */
class DashboardSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'dashboard.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'dashboard_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('dashboard.settings');

    $form['settings'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Basic settings', [], ['context' => 'Dashboard (settings)']),
      '#tree' => FALSE,
    ];

    $form['settings']['intermediate_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Fees url', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('intermediate_url') ?? '',
    ];

    $form['settings']['pay_owed_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Pay owed url', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('pay_owed_url') ?? '',
    ];

    $form['settings']['physical_loans_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Physical loans url', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('physical_loans_url') ?? '',
    ];

    $form['settings']['loans_overdue_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Loans overdue url', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('loans_overdue_url') ?? '',
    ];

    $form['settings']['loans_soon_overdue_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Loans soon overdue url', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('loans_soon_overdue_url') ?? '',
    ];

    $form['settings']['loans_not_overdue_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Loans not overdue url', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('loans_not_overdue_url') ?? '',
    ];

    $form['settings']['reservations_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Reservations url', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('reservations_url') ?? '',
    ];

    $form['settings']['page_size_mobile'] = [
      '#type' => 'number',
      '#title' => $this->t('Page size mobile', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('page_size_mobile') ?? 25,
      '#min' => 0,
      '#step' => 1,
    ];

    $form['settings']['page_size_desktop'] = [
      '#type' => 'number',
      '#title' => $this->t('Page size desktop', [], ['context' => 'Dashboard (settings)']),
      '#default_value' => $config->get('page_size_desktop') ?? 25,
      '#min' => 0,
      '#step' => 1,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    parent::submitForm($form, $form_state);
    $this->config('dashboard.settings')
      ->set('intermediate_url', $form_state->getValue('intermediate_url'))
      ->set('pay_owed_url', $form_state->getValue('pay_owed_url'))
      ->set('physical_loans_url', $form_state->getValue('physical_loans_url'))
      ->set('loans_overdue_url', $form_state->getValue('loans_overdue_url'))
      ->set('loans_soon_overdue_url', $form_state->getValue('loans_soon_overdue_url'))
      ->set('loans_not_overdue_url', $form_state->getValue('loans_not_overdue_url'))
      ->set('reservations_url', $form_state->getValue('reservations_url'))
      ->set('page_size_desktop', $form_state->getValue('page_size_desktop'))
      ->set('page_size_mobile', $form_state->getValue('page_size_mobile'))
      ->save();
  }

}
