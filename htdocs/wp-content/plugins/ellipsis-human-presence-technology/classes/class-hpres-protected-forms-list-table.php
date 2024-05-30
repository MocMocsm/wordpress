<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

// WP_List_Table is not loaded automatically so we need to load it in our application
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create the Protected Forms table class that will extend the WP_List_Table
 */
class HumanPresenceProtectedFormsListTable extends WP_List_Table {
	/**
	 * Returns an associative array containing the bulk action
	 *
	 * @return Array
	 */
	public function get_bulk_actions() {
		$actions = array(
			'enable'  => 'Enable',
			'disable' => 'Disable'
		);

		return $actions;
	}

	/**
	 * Process the bulk actions
	 *
	 * @return Void
	 */
	public function process_bulk_action() {
		$nonce         = isset( $_GET['_wpnonce'] ) ? esc_attr( sanitize_text_field( $_GET['_wpnonce'] ) ) : null;
		$nonce_die_msg = '<div class="notice notice-error below-h2"><p><strong>Error:</strong> Invalid nonce value detected.</p></div>';

		if ( isset( $_GET['id'] ) ) {
			// Verify the request nonce
			if ( ! wp_verify_nonce( $nonce, 'fm_action_nonce' ) ) {
				// Handle invalid nonce value
				wp_die( esc_html( $nonce_die_msg ) );
			}

			// Handle individual Enable/Disable actions
			$fid        = sanitize_text_field( $_GET['id'] );
			$enabled    = 0;
			$alert_type = 'warning';

			if ( $this->current_action() === 'enable' ) {
				$enabled    = 1;
				$alert_type = 'success';
			}

			// Show admin notice
			HumanPresenceForms::show_protected_forms_admin_notice( $fid, $enabled, $alert_type );
			// Enable the form to be protected
			HumanPresenceForms::enable_forms( $fid, $enabled );
		} elseif ( isset( $_GET['bulk-enable'] ) ) {
			// Verify the nonce generated by the bulk actions menu
			if ( ! wp_verify_nonce( $nonce, 'bulk-' . $this->_args['plural'] ) ) {
				// Handle invalid nonce value
				wp_die( esc_html( $nonce_die_msg ) );
			}

			// Handle Bulk Enable/Disable actions
			$enabled    = 0;
			$alert_type = 'warning';
			if ( $this->current_action() === 'enable' ) {
				$enabled    = 1;
				$alert_type = 'success';
			}

			// Handle Bulk Enable/Disable actions
			if ( count( $_GET['bulk-enable'] ) > 1 ) {
				// Handle Multiple IDs
				$bulk_enable = array_map( 'sanitize_text_field', $_GET['bulk-enable'] );
				foreach ( $bulk_enable as $bfid ) {
					$fid = sanitize_text_field( $bfid );
					HumanPresenceForms::show_protected_forms_admin_notice( $fid, $enabled, $alert_type );
					HumanPresenceForms::enable_forms( $fid, $enabled );
				}
			} else {
				$fid = isset( $_GET['bulk-enable'] ) && is_array( $_GET['bulk-enable'] ) && isset( $_GET['bulk-enable'][0] ) ? sanitize_text_field( $_GET['bulk-enable'][0] ) : '';
				HumanPresenceForms::show_protected_forms_admin_notice( $fid, $enabled, $alert_type );
				HumanPresenceForms::enable_forms( $fid, $enabled );
			}
		}
	}

	/**
	 * Prepare the items for the table to process
	 *
	 * @return Void
	 */
	public function prepare_items() {
		$columns  = $this->get_columns();
		$hidden   = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();
		$data     = HumanPresenceForms::forms_list();
		usort( $data, array( &$this, 'sort_data' ) );
		$perPage     = 10;
		$currentPage = $this->get_pagenum();
		$totalItems  = count( $data );

		$this->set_pagination_args(
			array(
				'total_items' => $totalItems,
				'per_page'    => $perPage
			)
		);

		/** Process bulk action */
		$this->process_bulk_action();

		$data                  = array_slice( $data, ( ( $currentPage - 1 ) * $perPage ), $perPage );
		$this->_column_headers = array( $columns, $hidden, $sortable );
		$this->items           = $data;
	}

	/**
	 * Override the parent columns method. Defines the columns to use in your listing table
	 *
	 * @return Array
	 */
	// ID | Enable | Name | Type | Submissions(Human, Suspicious, Total) | Activity
	public function get_columns() {
		$columns = array(
			'cb'          => '<input type="checkbox" />', //Render a checkbox instead of text
			'enabled'     => 'Enabled',
			'name'        => 'Name',
			'type'        => 'Type',
			'submissions' => 'Submissions',
			'activity'    => 'Activity'
		);

		return $columns;
	}

	/**
	 * Define which columns are hidden
	 *
	 * @return Array
	 */
	public function get_hidden_columns() {
		return array();
	}

	/**
	 * Define the sortable columns
	 *
	 * @return Array
	 */
	public function get_sortable_columns() {
		return array(
			'name' => array( 'name', false ),
			'type' => array( 'type', false )
		);
	}

	/**
	 * Method for name column
	 *
	 * @param Array $item an array of column data
	 *
	 * @return String
	 */
	public function column_name( $item ) {
		// // Create a nonce to protect against CSRF attacks
		// $form_action_nonce = wp_create_nonce( 'fm_action_nonce' );
		// $name = '<strong>' . $item['name'] . '</strong>';
		// $actions = array(
		//   'edit'    => sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Enable</a>', 'wp-human-presence', 'enable', $item['id'], $form_action_nonce),
		//   'delete'  => sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Disable</a>', 'wp-human-presence', 'disable', $item['id'], $form_action_nonce)
		// );
		//
		// return $name . $this->row_actions( $actions );

		// Disable row actions in favor of AJAX enable switches
		return '<strong>' . $item['name'] . '</strong>';
	}

	/**
	 * Render the bulk enable checkbox
	 *
	 * @param Array $item
	 *
	 * @return String
	 */
	public function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-enable[]" value="%s" />', $item['id']
		);
	}

	/**
	 * Define what data to show on each column of the table
	 *
	 * @param  Array $item Data
	 * @param  String $column_name - Current column name
	 *
	 * @return Mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'enabled':
			case 'name':
			case 'type':
			case 'submissions':
			case 'activity':
				return $item[ $column_name ];

			default:
				return print_r( $item, true );
		}
	}

	/**
	 * Allows you to sort the data by the variables set in the $_GET
	 *
	 * @return Mixed
	 */
	private function sort_data( $a, $b ) {
		// Set defaults
		$orderby = 'name';
		$order   = 'asc';

		// If orderby is set, use this as the sort column
		if ( ! empty( $_GET['orderby'] ) ) {
			$orderby = sanitize_text_field( $_GET['orderby'] );
		}

		// If order is set use this as the order
		if ( ! empty( $_GET['order'] ) ) {
			$order = sanitize_text_field( $_GET['order'] );
		}

		$result = strcmp( $a[ $orderby ], $b[ $orderby ] );

		if ( 'asc' === $order ) {
			return $result;
		}

		return - $result;
	}

	public static function display_protected_forms_table() {
		$protected_forms_table = new self();
		$protected_forms_table->prepare_items();
		$protected_forms_table->display();
	}
}