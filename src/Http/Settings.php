<?php

namespace Sylain\CyberTrail\Http;

use Illuminate\Http\Request;
use Session;

class Settings {

	/**
	 * Users choice for tables to be displayed from database
	 * Table configuration is saved to json file
	 * @param array $request form data with chosen tables to be imported from the database
	 */
	public function setTables(Request $request) {

		$json = file_get_contents(dirname(__DIR__). '/config/settings.json');

		$json = json_decode($json);
		$tablesArray = [];

		if($request->table) {
			foreach($request->table as $table) {
				$tablesArray[] = $table;
			}

			$json->tables = $tablesArray;

		} else {

			$json->tables = [];
		}
		

		$newJson = json_encode($json);

		file_put_contents(dirname(__DIR__) .'/config/settings.json', $newJson);

		Session::flash('success', 'Your configuration has been saved!');
		Session::flash('alert_type', 'alert-success');

		return redirect()->back();

	}

	/**
	 * Get all tables from json file
	 */
	public static function getTables() {

		$json = file_get_contents(dirname(__DIR__) .'/config/settings.json');

		$json = json_decode($json);

		$tables = $json->tables;

		return $tables;

	}
}