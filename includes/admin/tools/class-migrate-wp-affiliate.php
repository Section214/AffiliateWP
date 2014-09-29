<?php

class Affiliate_WP_Migrate_WP_Affiliate extends Affiliate_WP_Migrate_Base {

	public function process( $step = 1, $part = '' ) {

		switch( $part ) {

			case 'affiliates' :

				$affiliates = $this->do_affiliates( $step );

				if( ! empty( $affiliates ) ) {

					$this->step_forward( $step, 'affiliates' );

				}

				break;

		}

		$this->finish();

	}

	public function step_forward( $step = 1, $part = '' ) {

		$step++;
		$redirect          = add_query_arg( array(
			'page'         => 'affiliate-wp-migrate',
			'type'         => 'wp-affiliate',
			'part'         => $part,
			'step'         => $step
		), admin_url( 'index.php' ) );
		wp_redirect( $redirect ); exit;

	}

	public function do_affiliates( $step = 1 ) {

		global $wpdb;
		$offset     = ($step - 1) * 100;
		$affiliates = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}affiliates_tbl LIMIT $offset, 100;" );

		$to_delete = array();

		if( $affiliates ) {
			foreach( $affiliates as $affiliate ) {

				if( empty( $affiliate->email ) ) {
					continue;
				}

				$user = get_user_by( 'email', $affiliate->email );
				if( ! $user ) {
					$user_id = wp_insert_user( array(
						'user_email' => $affiliate->email,
						'first_name' => $affiliate->firstname,
						'last_name'  => $affiliate->lastname,
						'user_url'   => $affiliate->website,
						'user_pass'  => '',
						'user_login' => $affiliate->refid
					) );
				} else {
					$user_id = $user->ID;
				}

				$payment_email = ! empty( $affiliate->paypalemail ) ? $affiliate->paypalemail : $affiliate->email;
				$status        = 'approved' == $affiliate->account_status ? 'active' : 'pending';

				$args = array(
					'date_registered' => date( 'Y-n-d H:i:s', strtotime( $affiliate->date ) ),
					'user_id'         => $user_id,
					'payment_email'	  => $payment_email,
					'rate'            => $affiliate->commissionlevel,
					'status'          => $status
				);

				// Try to get an existing affiliate based on the user_id
				$existing_affiliate = affiliate_wp()->affiliates->get_by( 'user_id', $user_id );

				if( $existing_affiliate ) {
					continue;
				}

				// Insert a new affiliate - we need to always insert to make sure the affiliate_ids will match
				$id = affiliate_wp()->affiliates->insert( $args, 'affiliate' );

			}

			return true;

		} else {

			// No affiliates found, so all done
			return false;

		}

	}

	public function finish() {
		delete_option( 'affwp_migrate_direct_affiliates' );
		wp_redirect( admin_url( 'admin.php?page=affiliate-wp' ) ); exit;
	}

}