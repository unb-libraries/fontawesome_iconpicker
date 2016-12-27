<?php

namespace Drupal\fontawesome_iconpicker\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'fontawesome_iconpicker_formatter_type' formatter.
 *
 * @FieldFormatter(
 *   id = "fontawesome_iconpicker_formatter_type",
 *   label = @Translation("Font Awesome Icon Picker formatter"),
 *   field_types = {
 *     "fontawesome_iconpicker_field_type"
 *   }
 * )
 */
class FontawesomeIconpickerFormatterType extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
      'size' => '1x',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
      $form['size'] = [
        '#type'           => 'select',
        '#title'          => t('Icon Size'),
        '#description'    => t('Select an icon size.'),
        '#default_value'  => $this->getSetting('size'),
        '#options'        => [
          '1x'  => '1x',
          '2x'  => '2x',
          '3x'  => '3x',
          '4x'  => '4x',
          '5x'  => '5x',
        ],
      ]
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    // Implement settings summary.
    $summary = t('Size: @size', [
      '@size'     => $this->getSetting('size'),
    ]);

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $size = $this->getSetting('size');
      $safe_value = $this->viewValue($item);

      $elements[$delta] = [
        '#theme' => 'fontawesome_iconpicker_formatter',
        '#icon' => $safe_value,
        '#size' => $size,
      ];
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    // The text value has no text format assigned to it, so the user input
    // should equal the output, including newlines.
    return nl2br(Html::escape($item->value));
  }

}
