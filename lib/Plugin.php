<?php
/**
 * Main plugin class
 */

//rename using your namespace.
namespace PLUGIN_NAMESPACE;


class Plugin extends \WpAtk implements \Pluggable
{
	public $dbTables = [];

	public function init()
	{
		parent::init();
		$this->dbConnect();
		$this->setDbTables();
	}

	public function activatePlugin()
	{
		$this->install();
	}

	public function deactivatePlugin()
	{}

	public function uninstallPlugin()
	{}

	public function setDbTables()
	{
		global $wpdb;
	}

	public function getDbTableName ( $table )
	{}

	protected function install()
	{
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $this->getDbSchema() );
	}

	private function getDbSchema() 
	{}

}