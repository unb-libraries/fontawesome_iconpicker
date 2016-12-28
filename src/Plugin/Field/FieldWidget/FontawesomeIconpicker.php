<?php

namespace Drupal\fontawesome_iconpicker\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'fontawesome_iconpicker' widget.
 *
 * @FieldWidget(
 *   id = "fontawesome_iconpicker",
 *   label = @Translation("Font Awesome Icon Picker"),
 *   field_types = {
 *     "text",
 *     "string",
 *   }
 * )
 */
class FontawesomeIconpicker extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'size' => 60,
      'icon' => '',
      'placeholder' => '',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    $elements['size'] = [
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $element['size'] = array(
      '#type'           => 'select',
      '#title'          => t('Icon Size'),
      '#description'    => t('Select an icon size.'),
      '#default_value'  => $settings['size'],
      '#options'        => array(
        '1x'  => '1x',
        '2x'  => '2x',
        '3x'  => '3x',
        '4x'  => '4x',
        '5x'  => '5x',
      ),
    );

    $elements['icon'] = [
      '#type' => 'fontawesome_iconpicker_field_type',
      '#title' => t('Pick an icon'),
      '#default_value' => $this->getSetting('icon'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    $elements['placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t('Textfield size: @size', ['@size' => $this->getSetting('size')]);
    if (!empty($this->getSetting('icon'))) {
      $summary[] = t('Icon: @icon', ['@icon' => $this->getSetting('icon')]);
    }

    if (!empty($this->getSetting('placeholder'))) {
      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $this->getSetting('placeholder')]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = $element + [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#size' => $this->getSetting('size'),
      '#icon' => $this->getSetting('icon'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    return $element;
  }

}
