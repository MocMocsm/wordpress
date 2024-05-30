<?php
namespace FileBird\Rest;

defined( 'ABSPATH' ) || exit;

use FileBird\Controller\SettingController;

class SettingApi {
	private $controller;

	public function register_rest_routes() {
		$this->controller = new SettingController();

        register_rest_route(
			NJFB_REST_URL,
			'set-settings',
			array(
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => array( $this->controller, 'setSettings' ),
				'permission_callback' => array( $this, 'permission_callback' ),
			)
		);
	}

    public function permission_callback() {
		return current_user_can( 'upload_files' );
	}

}