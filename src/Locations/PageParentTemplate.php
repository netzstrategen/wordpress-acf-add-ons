<?php

namespace Netzstrategen\AcfAddOns\Locations;

use acf_location;
use Netzstrategen\AcfAddOns\Plugin;

/**
 * Class for adding a custom ACF 'page parent template' location rule.
 */
class PageParentTemplate extends acf_location {

  /**
   * @inheritdoc
   */
  function initialize() {
    $this->name = 'page_parent_template';
    $this->label = __('Page Parent Template', Plugin::L10N);
    $this->category = 'page';
  }

  /**
   * @inheritdoc
   */
  function rule_match($result, $rule, $screen) {
    $post_parent_id = wp_get_post_parent_id($screen['post_id']);
    $post_parent_template = get_page_template_slug($post_parent_id);
    $match = $this->compare($post_parent_template, $rule);
    return $match;
  }

  /**
   * @inheritdoc
   */
  function rule_values($choices, $rule) {
    $choices = array_flip(get_page_templates());
    return $choices;
  }

}
