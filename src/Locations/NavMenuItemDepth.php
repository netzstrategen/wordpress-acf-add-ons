<?php

namespace Netzstrategen\AcfAddOns\Locations;

use acf_location;
use Netzstrategen\AcfAddOns\Plugin;

/**
 * Class for adding a custom ACF 'menu item depth' location rule.
 *
 * Set at which menu item depth the ACF group is shown.
 */
class NavMenuItemDepth extends acf_location {

  /**
   * Maximum selectable menu item depth.
   *
   * Getting a dynamic value is expensive as they are not stored in the database.
   *
   * @var int
   */
  const MAX_DEPTH = 3;

  /**
   * @inheritdoc
   */
  function initialize() {
    $this->name = 'nav_menu_item_depth';
    $this->label = __('Menu Item Depth', Plugin::L10N);
    $this->category = 'forms';
  }

  /**
   * @inheritdoc
   */
  function rule_match($result, $rule, $screen) {
    $match = $this->compare($screen['nav_menu_item_depth'], $rule);
    return $match;
  }

  /**
   * @inheritdoc
   */
  function rule_values($choices, $rule) {
    $choices = range(0, apply_filters('netzstrategen/acf_add_ons/max_menu_item_depth', self::MAX_DEPTH));
    return $choices;
  }

}
