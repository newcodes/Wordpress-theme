<?php

class Armadio_Galery_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'armadio-galery',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}


}
