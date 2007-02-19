<?php
/**
 * @since Max v0.3.30 - 20-Nov-2006
 */

require_once MAX_PATH . '/lib/max/Dal/db/db.inc.php';

class MAX_Dal_Admin_Client
{
    /**
     * 
     * 
     * @param $keyword  string  Keyword to look for
     * @param $agencyId int  Agency Id
     * 
     * @return RecordSet
     * @access public
     */
    function getClientByKeyword($keyword, $agencyId = null)
    {
        $whereClient = is_numeric($keyword) ? " OR c.clientid=$keyword" : '';
        
        $query = "
            SELECT
                c.clientid AS clientid,
                c.clientname AS clientname
            FROM 
                clients AS c
            WHERE
                (
                c.clientname LIKE '%$keyword%'
                $whereClient
                )
        ";
        
        if($agencyId !== null) {
            $query .= " AND c.agencyid=".DBC::makeLiteral($agencyId);
        }
        
        return DBC::NewRecordSet($query);
    }
}

class ClientModel extends MAX_Dal_Admin_Client {}

?>