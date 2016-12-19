<?php
class Search_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    
    public function getAllDataFromTable($tableName) 
    {
        $this->db->select('*');
        $this->db->from($tableName);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function joinTableData($maintbl, $jointbl, $data, $relation, $wh, $whereData)
    {
        $this->db->select($data);
        $this->db->from($maintbl);
        $this->db->join($jointbl, $relation, 'left');
        if($wh == TRUE){
        $this->db->where($whereData);    
        }
        //echo $this->db->last_query();
        $query = $this->db->get();
        
        return $query->result_array();
                         
    }
    public function getmultiConditionData($data, $table, $whereData)
    {
        $this->db->select($data);
        $this->db->from($table);
        $this->db->where($whereData);  
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function getSinglefield($maintbl, $data, $fieldName, $matchdata)
    {
        $this->db->select($data);
        $this->db->from($maintbl);
        $this->db->where($fieldName,$matchdata);
        $query = $this->db->get();
        return $query->result_array();
                         
    }
    
    public function getApplicantdata($matchdata)
    {
        $this->db->select('p_appinfo.*,p_empinfo.*,p_givinganswer.*,p_rentalhistory.*,p_rentformother.*');
        $this->db->from('p_appinfo');
        $this->db->join('p_empinfo','p_empinfo.empinfo_id = p_appinfo.appinfo_id','left');
        $this->db->join('p_givinganswer','p_givinganswer.appinfo_id = p_appinfo.appinfo_id','left');
        $this->db->join('p_rentalhistory','p_rentalhistory.appinfo_id = p_appinfo.appinfo_id','left');
        $this->db->join('p_rentformother','p_rentformother.appinfo_id = p_appinfo.appinfo_id','left');
        $this->db->where('p_appinfo.appinfo_id',$matchdata);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array(); 
    }
    
     public function getTenantdata($tableName, $wh, $fieldName,$matchdata)
    {
        $this->db->select('p_tenant.*,property.property_name,unit.unit_name');
        $this->db->from($tableName);
        $this->db->join('property','property.property_id = p_tenant.property_name','left');
        $this->db->join('unit','unit.unit_id = p_tenant.vacant_unit','left');
        
        if($wh == TRUE){
        $this->db->where($fieldName,$matchdata);    
        }
        
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array(); 
    }
    
    //
    public function getPropertydataByid($table,$fieldName,$matchdata)
    {
        $this->db->select('property.frequency,property.property_address');
        $this->db->from($table);
        $this->db->where($fieldName,$matchdata);
        $query = $this->db->get();
        return $query->result();
    }
    
    //
    public function getUnitdataByid($table,$fieldName,$matchdata, $wh2)
    {
        $this->db->select('unit.unit_id,unit.unit_name');
        $this->db->from($table);
        $this->db->where($fieldName,$matchdata);
        
        if($wh2 == 1):
            $this->db->where('vacant_status',0);
        endif;
        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAllDataFromTableBycondition($tableName,$fieldName,$matchdata) 
    {
        
        $sql=$this->db->get_where($tableName,array($fieldName=>$matchdata));
        return $sql->result_array();
        
    }
   
}