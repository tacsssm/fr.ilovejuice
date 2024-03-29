<?php
/**
 * WooCommerce Points and Rewards
 *
 * @package     WC-Points-Rewards/Classes
 * @author      WooThemes
 * @copyright   Copyright (c) 2013, WooThemes
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Product Admin class
 *
 * Load / saves product admin settings
 *
 * @since 1.0
 */
class WC_Points_Rewards_Product_Admin {


	/**
	 * Add hooks / filters
	 *
	 * @since 1.0
	 */
	public function __construct() {

		/** Simple Subscription hooks */

	    // save 'Points Earned' field for subscription products
	    add_action( 'woocommerce_process_product_meta_subscription',   array( $this, 'save_simple_product_fields' ) );

	    /** Variable Subscription hooks */

	    // save the 'Points Earned' field for variable subscription products
	    add_action( 'woocommerce_save_product_subscription_variation', array( $this, 'save_variable_product_fields' ) );

		/** Simple Product hooks */

		// add 'Points Earned' field to simple product general tab
		add_action( 'woocommerce_product_options_general_product_data', array( $this, 'render_simple_product_fields' ) );

		// save 'Points Earned' field for simple products
		add_action( 'woocommerce_process_product_meta_simple',   array( $this, 'save_simple_product_fields' ) );

		/** Variable Product hooks */

		// add 'Points Earned' to variable products under the 'Variations' tab after the shipping class dropdown
		add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'render_variable_product_fields' ), 15, 2 );

		// save the 'Points Earned' field for variable products
		add_action( 'woocommerce_save_product_variation', array( $this, 'save_variable_product_fields' ) );

		// adds the product variation 'Points Earned' bulk edit action
		add_action( 'woocommerce_variable_product_bulk_edit_actions', array( $this, 'add_variable_product_bulk_edit_points_action' ) );

		/** Product list bulk edit hooks */

		// add Products list table 'Points Earned' bulk edit field
		add_action( 'woocommerce_product_bulk_edit_end', array( $this, 'add_points_field_bulk_edit' ) );

		// save Products List table 'Points Earned' bulk edit field
		add_action( 'woocommerce_product_bulk_edit_save', array( $this, 'save_points_field_bulk_edit' ) );

		/** Product category hooks */

		// add 'Points Earned' field to the add product category page
		add_action( 'product_cat_add_form_fields', array( $this, 'render_product_category_fields' ) );

		// add 'Points Earned' field to view/edit product category
		add_action( 'product_cat_edit_form_fields', array( $this, 'render_edit_product_category_fields' ) );

		// save 'Points Earned' field for product category
		add_action( 'create_product_cat', array( $this, 'save_product_category_points_field' ) );
		add_action( 'edited_product_cat', array( $this, 'save_product_category_points_field' ) );

		// add 'Points Earned' column header to the product category list table
		add_filter( 'manage_edit-product_cat_columns', array( $this, 'add_product_category_list_table_points_column_header' ) );

		// add 'Points Earned' column content to the product category list table
		add_filter( 'manage_product_cat_custom_column', array( $this, 'add_product_category_list_table_points_column' ), 10, 3 );
	}


	/** Simple Product methods ******************************************************/

	/**
	 * Render simple product points earned / maximum discount fields
	 *
	 * @since 1.0
	 */
	public function render_simple_product_fields() {

		// points earned
		woocommerce_wp_text_input( array(
				'id'            => '_wc_points_earned',
				'wrapper_class' => 'show_if_simple',
				'class'         => 'short',
				'label'         => __( 'Points Earned', 'wc_points_rewards' ),
				'description'   => __( 'This can be either a fixed number of points earned for purchasing this product, or a percentage which assigns points based on the price. For example, if you want to award points equal to double the normal rate, enter 200%.  This setting modifies the global Points Conversion Rate and overrides any category value.  Use 0 to assign no points for this product, and empty to use the global/category settings.', 'wc_points_rewards' ),
				'desc_tip'      => true,
				'type'          => 'text',
			)
		);

		// maximum discount allowed on product
		woocommerce_wp_text_input( array(
				'id'            => '_wc_points_max_discount',
				'class'         => 'short',
				'wrapper_class' => 'show_if_simple',
				'label'         => __( 'Maximum Points Discount', 'wc_points_rewards' ),
				'description'   => __( 'Enter either a fixed maximum discount amount or percentage which restricts the amount of points that can be redeemed for a discount based on the product price. For example, if you want to restrict the discount on this product to a maximum of 50%, enter 50%, or enter 5 to restrict the maximum discount to $5.  This setting overrides the global/category defaults, use 0 to disable point discounts for this product, and blank to use the global/category default.', 'wc_points_rewards' ),
				'desc_tip'      => true,
				'type'          => 'text',
			)
		);
	}


	/**
	 * Save the simple product points earned / maximum discount fields
	 *
	 * @since 1.0
	 */
	public function save_simple_product_fields( $post_id ) {

		if ( '' !== $_POST['_wc_points_earned'] )
			update_post_meta( $post_id, '_wc_points_earned', stripslashes( $_POST['_wc_points_earned'] ) );
		else
			delete_post_meta( $post_id, '_wc_points_earned' );

		if ( '' !== $_POST['_wc_points_max_discount'] )
			update_post_meta( $post_id, '_wc_points_max_discount', stripslashes( $_POST['_wc_points_max_discount'] ) );
		else
			delete_post_meta( $post_id, '_wc_points_max_discount' );
	}


	/** Variable Product methods ******************************************************/


	/**
	 * Add points earned / maximum discount to variable products under the 'Variations' tab after the shipping class dropdown
	 *
	 * @since 1.0
	 */
	public function render_variable_product_fields( $loop, $variation_data ) {
		global $woocommerce;

		$points_earned = ( isset( $variation_data['_wc_points_earned'][0] ) ) ? $variation_data['_wc_points_earned'][0] : '';
		$max_discount  = ( isset( $variation_data['_wc_points_max_discount'][0] ) ) ? $variation_data['_wc_points_max_discount'][0] : '';

		$points_earned_description = __( 'This can either be a fixed number of points earned for purchasing this variation, or a percentage which assigns points based on the price. For example, if you want to award points equal to double the the normal rate, enter 200%.  This setting modifies the global Points Conversion Rate and overrides any category value.  Use 0 to assign no points for this variation, and empty to use the global/category settings.', 'wc_points_rewards' );
		$max_discount_description  = __( 'Enter either a fixed maximum discount amount or percentage which restricts the amount of points that can be redeemed for a discount based on the product price. For example, if you want to restrict the discount on this product to a maximum of 50%, enter 50%, or enter 5 to restrict the maximum discount to $5.  This setting overrides the global/category defaults, use 0 to disable point discounts for this product, and blank to use the global/category default.', 'wc_points_rewards' );

		?>
			<tr>
				<td>
					<img style="float: right;" class="help_tip" data-tip="<?php echo esc_attr( $points_earned_description ); ?>" src="<?php echo esc_url( $woocommerce->plugin_url() . '/assets/images/help.png' ); ?>" height="16" width="16" />
					<label><?php _e( 'Points Earned', 'wc_points_rewards' ); ?></label>
					<input type="number" size="5" name="variable_points_earned[<?php echo esc_attr( $loop ); ?>]" value="<?php echo esc_attr( $points_earned ); ?>" step="any" min="0" placeholder="<?php _e( 'Variation Points Earned', 'wc_points_rewards' ); ?>" />
				</td>
				<td>
					<img style="float: right;" class="help_tip" data-tip="<?php echo esc_attr( $max_discount_description ); ?>" src="<?php echo esc_url( $woocommerce->plugin_url() . '/assets/images/help.png' ); ?>" height="16" width="16" />
					<label><?php _e( 'Maximum Points Discount', 'wc_points_rewards' ); ?></label>
					<input type="text" size="5" name="variable_max_point_discount[<?php echo esc_attr( $loop ); ?>]" value="<?php echo esc_attr( $max_discount ); ?>" placeholder="<?php _e( 'Variation Max Points Discount', 'wc_points_rewards' ); ?>" />
				</td>
			</tr>
		<?php
	}


	/**
	 * Save the variable product points earned / maximum discount fields
	 *
	 * @since 1.0
	 */
	public function save_variable_product_fields( $variation_id ) {

		// find the index for the given variation ID and save the associated points earned
		$index = array_search( $variation_id, $_POST['variable_post_id'] );

		if ( false !== $index ) {

			// points earned
			if ( '' !== $_POST['variable_points_earned'][ $index ] )
				update_post_meta( $variation_id, '_wc_points_earned', stripslashes( $_POST['variable_points_earned'][ $index ] ) );
			else
				delete_post_meta( $variation_id, '_wc_points_earned' );

			// maximum points discount
			if ( '' !== $_POST['variable_max_point_discount'][ $index ] )
				update_post_meta( $variation_id, '_wc_points_max_discount', stripslashes( $_POST['variable_max_point_discount'][ $index ] ) );
			else
				delete_post_meta( $variation_id, '_wc_points_max_discount' );
		}
	}


	/**
	 * Renders the 'Points Earned' bulk edit action on the product admin Variations tab.
	 * There is core JS code that automatically handles these bulk edits.
	 *
	 * @since 1.0
	 */
	public function add_variable_product_bulk_edit_points_action() {
		echo '<option value="variable_points_earned">' . __( 'Points Earned', 'wc_points_rewards' ) . '</option>';
	}


	/** Product Bulk Edit methods ******************************************************/


	/**
	 * Add a 'Points Earned' bulk edit field, this is displayed on the Products list page
	 * when one or more products is selected, and the Edit Bulk Action is applied
	 *
	 * @since 1.0
	 */
	public function add_points_field_bulk_edit() {
		?>
			<div class="inline-edit-group">
				<label class="alignleft">
					<span class="title"><?php _e( 'Points Earned', 'wc_points_rewards' ); ?></span>
						<span class="input-text-wrap">
							<select class="change_points_earned change_to" name="change_points_earned">
								<?php
								$options = array(
									''  => __( '— No Change —', 'wc_points_rewards' ),
									'1' => __( 'Change to:', 'wc_points_rewards' ),
									'2' => __( 'Increase by (fixed amount or %):', 'wc_points_rewards' ),
									'3' => __( 'Decrease by (fixed amount or %):', 'wc_points_rewards' )
								);
								foreach ( $options as $key => $value ) {
									echo '<option value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
								}
								?>
							</select>
						</span>
				</label>
				<label class="alignright">
					<input type="text" name="_wc_points_earned" class="text points_earned" placeholder="<?php _e( 'Enter Points Earned', 'wc_points_rewards' ); ?>" value="" />
				</label>
			</div>
		<?php
	}


	/**
	 * Save the 'Points Earned' bulk edit field
	 *
	 * @since 1.0
	 */
	public function save_points_field_bulk_edit( $product ) {

		if ( ! empty( $_REQUEST['change_points_earned'] ) ) {

			$option_selected                = absint( $_REQUEST['change_points_earned'] );
			$requested_points_earned_change = stripslashes( $_REQUEST['_wc_points_earned'] );
			$current_points_earned          = ( ! empty( $product->wc_points_earned ) ) ? $product->wc_points_earned : '';

			switch ( $option_selected ) {

				// change 'Points Earned' to fixed amount
				case 1 :
					$new_points_earned = $requested_points_earned_change;
					break;

				// increase 'Points Earned' by fixed amount/percentage
				case 2 :
					if ( false !== strpos( $requested_points_earned_change, '%' ) ) {
						$percent = str_replace( '%', '', $requested_points_earned_change ) / 100;
						$new_points_earned = $current_points_earned + ( $current_points_earned * $percent );
					} else {
						$new_points_earned = $current_points_earned + $requested_points_earned_change;
					}
					break;

				// decrease 'Points Earned' by fixed amount/percentage
				case 3 :
					if ( false !== strpos( $requested_points_earned_change, '%' ) ) {
						$percent = str_replace( '%', '', $requested_points_earned_change ) / 100;
						$new_points_earned = $current_points_earned - ( $current_points_earned * $percent );
					} else {
						$new_points_earned = $current_points_earned - $requested_points_earned_change;
					}
					break;
			}

			// update to new Points Earned if different than current Points Earned
			if ( ! empty( $new_points_earned ) && $new_points_earned != $current_points_earned )
				update_post_meta( $product->id, '_wc_points_earned', $new_points_earned );
		}
	}


	/** Product Category methods ******************************************************/


	/**
	 * Add the points earned / maximum discount fields to the add product category page
	 *
	 * @since 1.0
	 */
	public function render_product_category_fields() {

		$this->get_product_category_fields_html();
	}


	/**
	 * Add the points earned / maximum discount fields to the view/edit product category page
	 *
	 * @since 1.0
	 * @param object $term the term object
	 */
	public function render_edit_product_category_fields( $term ) {

		// get points earned / maximum points discount from product category meta
		$points_earned = get_woocommerce_term_meta( $term->term_id, '_wc_points_earned', true );
		$max_discount  = get_woocommerce_term_meta( $term->term_id, '_wc_points_max_discount', true );

		$this->get_product_category_fields_html( $points_earned, $max_discount );

	}


	/**
	 * Return the points field HTML for the product category page
	 *
	 * @since 1.0
	 * @param string $points points earned for the category, if available
	 * @param string $max_discount the maximum points discount for the category, if set
	 */
	private function get_product_category_fields_html( $points = '', $max_discount = '' ) {
		global $woocommerce;

		$points_earned_description = __( 'This can either be a fixed number of points earned for the purchase of any product that belongs to this category, or a percentage which assigns points based on the price of the product. For example, if you want to award points equal to double the normal rate, enter 200%.  This setting modifies the global Points Conversion Rate, but can be overridden by a product/variation. Use 0 to assign no points for products belonging to this category, and empty to use the global setting.', 'wc_points_rewards' );
		$max_discount_description  = __( 'Enter either a fixed maximum discount amount or percentage which restricts the amount of points that can be redeemed for a discount based on the price of the product in this category. For example, if you want to restrict the discount on this category to a maximum of 50%, enter 50%, or enter $5 to restrict the maximum discount to $5.  This setting overrides the global default, but can be overridden by a product/variation. Use 0 to disable point discounts for this product, and blank to use the global/category default.', 'wc_points_rewards' );
		?>
			<tr class="formfield">
				<th scope="row" valign="top"><label><?php _e( 'Points Earned', 'wc_points_rewards' ); ?></label></th>
				<td>
					<input type="text" size="5" name="_wc_points_earned" value="<?php echo esc_attr( $points ); ?>" step="any" min="0" placeholder="<?php _e( 'Category Points Earned', 'wc_points_rewards' ); ?>" />
					<img class="help_tip" data-tip="<?php echo esc_attr( $points_earned_description ); ?>" src="<?php echo esc_url( $woocommerce->plugin_url() . '/assets/images/help.png' ); ?>" height="16" width="16" />
				</td>
			</tr>
			<tr class="formfield">
				<th scope="row" valign="top"><label><?php _e( 'Maximum Points Discount', 'wc_points_rewards' ); ?></label></th>
				<td>
					<input type="text" size="5" name="_wc_points_max_discount" value="<?php echo esc_attr( $max_discount ); ?>" />
					<img class="help_tip" data-tip="<?php echo esc_attr( $max_discount_description ); ?>" src="<?php echo esc_url( $woocommerce->plugin_url() . '/assets/images/help.png' ); ?>" height="16" width="16" />
				</td>
			</tr>
		<?php
	}


	/**
	 * Save the points earned / maximum discount fields
	 *
	 * @since 1.0
	 * @param int $term_id term ID being saved
	 */
	public function save_product_category_points_field( $term_id ) {

		// points earned
		if ( isset( $_POST['_wc_points_earned'] ) && '' !== $_POST['_wc_points_earned'] )
			update_woocommerce_term_meta( $term_id, '_wc_points_earned', $_POST['_wc_points_earned'] );
		else
			delete_woocommerce_term_meta( $term_id, '_wc_points_earned' );

		// max points discount
		if ( isset( $_POST['_wc_points_max_discount'] ) && '' !== $_POST['_wc_points_max_discount'] )
			update_woocommerce_term_meta( $term_id, '_wc_points_max_discount', $_POST['_wc_points_max_discount'] );
		else
			delete_woocommerce_term_meta( $term_id, '_wc_points_max_discount' );
	}


	/**
	 * Add a 'Points Earned' column header to the product category list table
	 *
	 * @since 1.0
	 * @param array $columns associative array of column id to title
	 * @return array
	 */
	public function add_product_category_list_table_points_column_header( $columns ) {

		$new_columns = array();

		foreach ( $columns as $column_key => $column_title ) {

			$new_columns[ $column_key ] = $column_title;

			// add column header immediately after 'Slug'
			if ( 'slug' == $column_key )
				$new_columns['points_earned'] = __( 'Points Earned', 'wc_points_rewards' );
		}

		return $new_columns;
	}


	/**
	 * Add the 'Points Earned' column content to the product category list table
	 *
	 * @since 1.0
	 * @param array $columns column content
	 * @param string $column column ID
	 * @param int $term_id the product category term ID
	 * @return array
	 */
	public function add_product_category_list_table_points_column( $columns, $column, $term_id ) {

		$points_earned = get_woocommerce_term_meta( $term_id, '_wc_points_earned' );

		if ( 'points_earned' == $column )
			echo ( '' !== $points_earned ) ? esc_html( $points_earned ) : '&mdash;';

		return $columns;
	}


} // end \WC_Points_Rewards_Admin class
