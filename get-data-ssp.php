<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'SELECT track_list.track_name, track_details.td_name, track_list.track_isrc, track_list.release_id, track_list.created_date, track_list.track_id  FROM track_list Left Join track_details on track_details.td_id = track_list.track_id';
$count_query = 'SELECT track_list.track_id FROM track_list Left Join track_details on track_details.td_id = track_list.track_id';
 
$whereResult = "";
$groupByClause = "";

// Table's primary key
$primaryKey = 'track_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'track_name', 'dt' => 0 ),
    array( 'db' => 'td_name',  'dt' => 1 ),
    array( 'db' => 'track_isrc',   'dt' => 2 ),
    array( 'db' => 'release_id',     'dt' => 3 ),
    array(
        'db'        => 'created_date',
        'dt'        => 4,
        // 'formatter' => function( $d, $row ) {
        //     return date( 'jS M y', strtotime($d)
        // );
        // }
    ),
    array( 'db' => 'track_id', 'dt' => 5, 'formatter' => function($d, $row) { $onclick = "View($d)"; return '<button type="button" onclick="'.$onclick.'">View</button>'; })
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'root',
    'db'   => 'test',
    'host' => 'localhost:3308'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $count_query, $whereResult, $groupByClause, $primaryKey, $columns )
);