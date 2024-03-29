<?php
/**
 * Parent Term Query Part.
 *
 * @package a-z-listing
 */

declare(strict_types=1);

namespace A_Z_Listing\Shortcode\QueryParts;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \A_Z_Listing\Shortcode\Extension;

/**
 * Parent Term Common implementation.
 */
abstract class ParentTermCommon extends Extension {
	/**
	 * The types of listing this shortcode extension may be used with.
	 *
	 * @since 4.0.0
	 * @var array<string|int>
	 */
	public $display_types = array( 'terms' );

	/**
	 * Update the query with this extension's additional configuration.
	 *
	 * @param \A_Z_Listing\Query $query      The query.
	 * @param int                $parent_id  The shortcode attribute value.
	 * @param array              $attributes The complete set of shortcode attributes.
	 * @return mixed The updated query.
	 */
	public function shortcode_query_with_parent_id( $query, int $parent_id, array $attributes ) {
		if ( isset( $attributes['get-all-children'] ) && a_z_listing_is_truthy( $attributes['get-all-children'] ) ) {
			$parent_selector = 'child_of';
		} else {
			$parent_selector = 'parent';
		}

		if ( -1 < $parent_id ) {
			$query = wp_parse_args(
				$query,
				array( $parent_selector => $parent_id )
			);
		}

		return $query;
	}
}



