<?php

class Armadio_Category_Image_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'armadio-category-image',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}


}
