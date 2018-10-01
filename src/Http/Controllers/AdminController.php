<?php

namespace Sylain\CyberTrail\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Sylain\CyberTrail\Http\Settings as Settings;

use Illuminate\Http\Request;
use DB;
use Schema;
use Session;
use Carbon\Carbon;
use Hash;

class AdminController extends Controller
{

    /**
     * Show dashboard with table names
     *
     */
    public function index() {

        // Get all table names
        $tables = Settings::getTables();

        return view('CyberTrail::pages.dashboard')->withTables($tables);
    }

    /**
     * Show selected table with columns
     * 
     * @param Request $request form request with table data
     */
    public function showTable(Request $request) {

        // Get all table names
        $tables = Settings::getTables();

        $selectedTable = $request->slug;
        $tbl = lcfirst($request->slug);

        // Exclude certain columns from array
        $tableName = array_diff(Schema::getColumnListing($tbl), ['password', 'permissions', 'created_at', 'updated_at']);

        // Get all data from selected table
        $tableData = DB::table(''.$tbl.'')->get();

        return view('CyberTrail::pages.showTable')
            ->withTables($tables)
            ->withSelectedTable($selectedTable)
            ->withTableData($tableData)
            ->withTableName($tableName);
    }

    /**
     * Show view with create form
     * 
     * @param Request $request form request with new data
     */
    public function addToTable(Request $request) {

        // Get all table names
        $tables = Settings::getTables();

        $selectedTable = $request->slug;
        $tbl = lcfirst($request->slug);

        $tableName = array_diff(Schema::getColumnListing($tbl), ['last_login', 'permissions', 'created_at', 'updated_at']);
        
        // If no pid is passed, return all table data
        // Else return only data where id == pid
        if($request->pid == null) {

            $tableData = DB::table(''.$tbl.'')->get();

            return view('CyberTrail::pages.addToTable')
                ->withTables($tables)
                ->withSelectedTable($selectedTable)
                ->withTableData($tableData)
                ->withTableName($tableName);
                
        } else {

            $tableData = DB::table(''.$tbl.'')->where('id', $request->pid)->first();

            return view('CyberTrail::pages.editTable')
                ->withTables($tables)
                ->withSelectedTable($selectedTable)
                ->withTableData($tableData)
                ->withTableName($tableName);
        }   
    }

    /**
     * Create or update table rows
     * 
     * @param Request $request form request with new data
     */
    public function store(Request $request) {

        $values = array_slice($request->all(), 2);

        unset($values['tableid']);
        unset($values['id']);

        // Check if image is submitted
        $values = self::checkForImage($request, $values);
  

        // If password is submitted, hash it
        if($request->password != null) {

            unset($values['password']);
            $values['password'] = Hash::make($request->password);
        }
        
        // Check if table has created_at column
        // If true, set it to current timestamp
        if(!empty($values['created_at'])) {
            $values['created_at'] = Carbon::now();
        }

        // Check if table has updated_at column
        // If true, set it to current timestamp
        if(!empty($values['updated_at'])) {
            $values['updated_at'] = Carbon::now();
        }
        
        // If tableid is passed, update table row
        // If tableid is NOT passed, create new table row
        if($request->tableid == null) {
            $table = DB::table(''.$request->tableName.'')->insert($values);

            Session::flash('status', 'Created successfuly');
            Session::flash('alert_type', 'alert-success');
        } else {
            $table = DB::table(''.$request->tableName.'')->where('id', $request->tableid)->update($values);

            Session::flash('status', 'Updated successfuly');
            Session::flash('alert_type', 'alert-warning');
        }

        return redirect()->back();
    }

    /**
     * Delete row from table
     *
     * @param Request $request form request with table name
     * @param int $id id of the row to delete
     */
    public function delete(Request $request, $id) {

        // Delete row from table
        DB::table(''.$request->tableName.'')->where('id', $id)->delete();

        Session::flash('status', 'Deleted successfuly!');
        Session::flash('alert_type', 'alert-danger');

        return redirect()->back();
    }

    /**
     * Show settings page
     */
    public function settings() {

        // Get all table names
        $tables = Settings::getTables();

        // Get all tables from json file
        $jsonTables = $this->getTables();

        return view('CyberTrail::pages.settings')
            ->withTables($tables)
            ->withJsonTables($jsonTables);

    }

    /**
     * Return all table names from the database
     *
     * @param string $exclude table name to exclude from search
     */
    private function getTables($exclude = null) {

        // Select all tables from database
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);

        return $tables;
    }

    /**
     * Check if image request is send
     * If true, move to destination folder and write to database
     * @param array $request
     * @param array $values
     */
    private static function checkForImage($request, $values) {

        if($request->image != null) {

            unset($values['image']);
            unset($values['destination']);

            $file = $request->image;

            // If image destination is specified, save it to a variable
            // Else, set default destination
            if($request->destination != null) {

                $destination = public_path().'/'.$request->destination.'';

            } else {

                $destination = public_path().'/images/CyberTrail';
            }
            
            // Get original file name
            $fileName = $file->getClientOriginalName();

            //Move file to specified destination
            $file->move($destination, $fileName);

            $values['image'] = $request->destination. '/' .$fileName;

            return $values;
            
        } else {

            unset($values['image']);
            unset($values['destination']);

            return $values;
        }
    }
}
