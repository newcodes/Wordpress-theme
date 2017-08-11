<?php


class Armadio_Galery_Activator {
    
    public $armadio_db_version = '1.0';

	public static function activate() {
        global $wpdb;
        global $armadio_db_version;
        $table_name = $wpdb->prefix . 'categories';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            descriptin text NOT NULL,
            url varchar(255) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
        );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        add_option( 'armadio_db_version', $armadio_db_version );
	}

}
