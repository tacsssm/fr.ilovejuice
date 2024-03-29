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
 * # WooCommerce Core Actions Integration Class
 *
 * This class adds the WooCommerce core actions of product review and user
 * account registration as point earning actions.  This also provides a sample
 * integration for 3rd party plugins to follow to add their own custom point
 * reward actions.
 */
class WC_Points_Rewards_Actions {


	/**
	 * Initialize the WooCommerce core Points & Rewards integration class
	 *
	 * @since 1.0
	 */
	public function __construct() {

		// add the WooCommerce core action settings
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			add_filter( 'wc_points_rewards_action_settings', array( $this, 'points_rewards_action_settings' ), 1 );
		}

		// add the WooCommerce core actions event descriptions
		add_filter( 'wc_points_rewards_event_description', array( $this, 'add_action_event_descriptions' ), 10, 3 );

		// add points for user signup & writing a review
		add_action( 'comment_post',                 array( $this, 'product_review_action' ) );
		add_action( 'user_register', array( $this, 'create_account_action' ) );

	}


	/**
	 * Adds the WooCommerce core actions integration settings
	 *
	 * @since 1.0
	 * @param array $settings the settings array
	 * @return array the settings array
	 */
	public function points_rewards_action_settings( $settings ) {

		$settings = array_merge(
			$settings,
			array(
				array(
					'title'    => __( 'Points earned for account signup', 'wc_points_rewards' ),
					'desc_tip' => __( 'Enter the amount of points earned when a customer signs up for an account.', 'wc_points_rewards' ),
					'id'       => 'wc_points_rewards_account_signup_points',
				),

				array(
					'title'    => __( 'Points earned for writing a review', 'wc_points_rewards' ),
					'desc_tip' => __( 'Enter the amount of points earned when a customer first reviews a product.', 'wc_points_rewards' ),
					'id'       => 'wc_points_rewards_write_review_points',
				),
			)
		);

		return $settings;
	}


	/**
	 * Provides an event description if the event type is one of 'product-review' or
	 * 'account-signup'
	 *
	 * @since 1.0
	 * @param string $event_description the event description
	 * @param string $event_type the event type
	 * @param object $event the event log object, or null
	 * @return string the event description
	 */
	public function add_action_event_descriptions( $event_description, $event_type, $event ) {
		global $wc_points_rewards;

		$points_label = $wc_points_rewards->get_points_label( $event ? $event->points : null );

		// set the description if we know the type
		switch ( $event_type ) {
			case 'product-review': $event_description = sprintf( __( '%s earned for product review', 'wc_points_rewards' ), $points_label ); break;
			case 'account-signup': $event_description = sprintf( __( '%s earned for account signup', 'wc_points_rewards' ), $points_label ); break;
		}

		return $event_description;
	}


	/**
	 * Add points to customer for posting a product review
	 *
	 * @since 1.0
	 */
	public function product_review_action() {

		if ( ! is_user_logged_in() )
			return;

		$post_type = get_post_type();

		if ( 'product' == $post_type )
			$points = get_option( 'wc_points_rewards_write_review_points' );

		if ( ! empty( $points ) ) {

			// only award points for the first comment placed on a particular product by a user
			$comments = get_comments( array( 'user_id' => get_current_user_id(), 'post_id' => get_the_ID() ) );

			if ( count( $comments ) <= 1 ) {
				WC_Points_Rewards_Manager::increase_points( get_current_user_id(), $points, 'product-review', array( 'product_id' => get_the_ID() ) );
			}
		}
	}


	/**
	 * Add points to customer for creating an account
	 *
	 * @since 1.0
	 */
	public function create_account_action( $user_id ) {
		$points = get_option( 'wc_points_rewards_account_signup_points' );

		if ( ! empty( $points ) )
			WC_Points_Rewards_Manager::increase_points( $user_id, $points, 'account-signup' );
	}


}
