<?php
class Operation_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
     public function totalLateDayCalculation($endDate)
    {
        $now = time();
        $your_date = strtotime($endDate);
        
        if($now > $your_date){
            
            $datediff = $now - $your_date;
            $totalDate =  floor($datediff/(60*60*24));
            return $totalDate;
        }
    }
    public function totalLateFeeCalculation($leaseId, $tenantId,$rentAmount,$lateday)
    {
         //$isAppliedLate = $this->getSingleDataOfTable('isAppliedLate', 'leaseId', $leaseId, 'p_lease');

//        if($isAppliedLate == 1){
            
            $getTenantLateId = $this->getSingleDataOfTable('latefee_rule', 'tenantId', $tenantId, 'p_lease');    
            $lateFeeData = $this->db->get_where('p_late_fee_setting', array('id' => $getTenantLateId))->result_array();
            
            if($lateFeeData[0]['fee_frequency'] == 1){
                
                $totalFee = (($lateFeeData[0]['fee_amount'] * $lateday ));
                return $totalFee;
                
            }elseif ($lateFeeData[0]['fee_frequency'] == 2) {
                
                $perDay = ((($lateFeeData[0]['fee_ratio'] * $rentAmount ) / 100) * $lateday);
                return $perDay;
            }

//        }
        
    }
    public function getNextId($tableName)
    {
        $cq = "SHOW TABLE STATUS LIKE '{$tableName}'";
        $cqres = mysql_query($cq) or die(mysql_error());
        $cqr = mysql_fetch_assoc($cqres) or die(mysql_error());
        $nid = $cqr['Auto_increment'];
        return $nid;
    }
    
    public function generateStudentId($batch)
    {
        $year = date('y');
        $constant = 0;
        $numberId = $year.$constant.$batch;
        $max=($numberId*1000)+1000;
        $min=($numberId*1000);
        $s='select max(student_id) from student where student_id>'.$min.' and student_id<'.$max;
        $sql=mysql_query($s);
        if(mysql_num_rows($sql)>0)
            $data=mysql_fetch_row($sql);
        else
            $studentId =$min+1;
        if(!isset($studentId)&&(is_null($data[0]))) 
            $studentId = $min+1;
        else
            $studentId = $data[0]+1;
        return $studentId;
    }

    public function generateMemberId($memberType)
    {
        $year = date('y');
        $constant = 0;
        $constant2 = 99;
        $numberId = $year.$memberType.$constant2;
        $max=($numberId*10000)+10000;
        $min=($numberId*10000);
        $s='select max(member_id) from member where member_id>'.$min.' and member_id<'.$max;
        $sql=mysql_query($s);
        if(mysql_num_rows($sql)>0)
            $data=mysql_fetch_row($sql);
        else
            $memberId =$min+1;
        if(!isset($memberId)&&(is_null($data[0]))) 
            $memberId = $min+1;
        else
            $memberId = $data[0]+1;
        return $memberId;
    }
    

    public function insertInToTable($tableName, $insertedData)
    {
        $this->db->insert($tableName, $insertedData);
        $databaseError = $this->db->_error_message(); 
        return $databaseError;
    }
    
    public function checkDublicate($tableName, $checkField, $matchItem)
    {
        $this -> db -> select($checkField);
        $this -> db -> from($tableName);
        $this -> db -> where($checkField, $matchItem);
        $this -> db -> limit(1);
        $query = $this -> db -> get();
        $queryResult = $query->result();
        if($query -> num_rows() == 1)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    public function updateTable($fieldId, $matchId, $tableName, $data)
    {
        $this->db->where($fieldId, $matchId);
        $this->db->update($tableName, $data);
        $databaseError = $this->db->_error_message(); 
        return $databaseError;
    }
    
    public function updatePreviousBalance($fieldId, $matchId, $tableName, $tableField, $fieldVal)
    {
        $this->db->select($tableField);
        $this->db->from($tableName);
        $this->db->where($fieldId, $matchId);
        $query = $this->db->get();
        $row = $query->row_array();
        $preBalance = $row[$tableField];
        
        $newBalance = ($preBalance + $fieldVal);
        
        $newData = array(
            $tableField => $newBalance
        );
         
        $this->db->where($fieldId, $matchId);
        $this->db->update($tableName, $newData);
        $databaseError = $this->db->_error_message(); 
        return $databaseError;
    }
    
    public function deleteTableData($fieldId, $matchId, $tableName)
    {
        $this->db->delete($tableName, array($fieldId => $matchId)); 
        $databaseError = $this->db->_error_message(); 
        return $databaseError;
    }
    
    public function getSingleDataOfTable($tableField, $selectField, $matchField, $tableName, $selectField2, $matchField2)
    {
        $this->db->select($tableField);
        $this->db->from($tableName);
        $this->db->where($selectField, $matchField);
        if(isset($selectField2)):
        $this->db->where($selectField2, $matchField2);
        endif;
        $query = $this->db->get();
        $row = $query->row_array();
        $your_variable = $row[$tableField];
        return $your_variable;
    }
    
    public function getParentTable($tableName)
    {
        $sql = "SELECT * FROM $tableName";
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }
    
    public function getDepositAmount($tenantId, $paymentId)
    {
        $this->db->select('PaidAmount');
        $this->db->from('p_receipt');
        $this->db->where('TenantId', $tenantId);
        $this->db->where('PaymentHeadId', $paymentId);
        $query = $this->db->get();
        $row = $query->row_array();
        $your_variable = $row['PaidAmount'];
        return $your_variable;
    }
    public function getPaidAmount($tenantId)
    {
        $this->db->select('SUM(PaidAmount)');
        $this->db->from('p_receipt');
        $this->db->where('TenantId', $tenantId);
        $query = $this->db->get();
        $row = $query->row_array();
        $your_variable = $row['SUM(PaidAmount)'];
        return $your_variable;
    }
    
    public function weekLeaseAgreement($groupId, $tenantname, $tenantcontact, $property_name,$frequency, $vacant_unit, $rep_name, $rep_contact,
            $rentAmount, $moveinDate,$moveoutDate,$latefee_rule,$depositAmount)
    {
        
//        $TenantId  = $this->Accounting_Model->next_ledger_id($groupId);
        $leaseDate = time();
        //tenant new lease

        $data['tenant_name']    =  $tenantname;
        $data['tenant_contact'] =  $tenantcontact;
        $data['property_name']  =  $property_name;
        $data['frequency']      =  $frequency;
        $data['vacant_unit']    =  $vacant_unit;
        $data['ledger_id']      =  $groupId;
        $data['rep_name']       =  $rep_name;
        $data['rep_contact']    =  $rep_contact;

        $this->db->insert('p_tenant', $data);
        $TenantId = $this->db->insert_id();
        
        //start accounting information
         $cramount = array(
            '200006000' =>round($this->input->post('rent_amount')),
            '405000000' =>$this->input->post('deposit_amount')
        );

        $dramount =  array_sum($cramount);

        //add tenant rent in journal valucher

        $journal_info_no   = $this->Accounting_Model->insertJournalVoucher(date('m-d-Y',time()), '105000000', $dramount, $cramount, $tenantname, $TenantId, $property_name,'Security deposit and first week rent payment');

        // journal entry

        $addJournal        = $this->Accounting_Model->insertJournalTable('105000000', $tenantname, date('m-d-Y',time()), $dramount, $cramount, $property_name, $TenantId, 'Journal_info', $journal_info_no, 'Security deposit and first week rent payment', $this->session->userdata('login_type'));
        //add tenant rent in journal valucher
       
        //end accounting info
        
        //insert lease database
                        
        $les['tenantId']       = $TenantId;
        $les['moveinDate']     = date('Y-m-d', strtotime(str_replace('-', '/', $moveinDate)));
        $les['moveoutDate']    = date('Y-m-d', strtotime(str_replace('-', '/', $moveoutDate)));
        $les['property_name']  = $property_name;
        $les['frequency']      = $frequency;
        $les['vacant_unit']    = $vacant_unit;
        $les['latefee_rule']   = $latefee_rule;
        $les['rentAmount']     = $rentAmount;
        $les['LeaseDate']      = $leaseDate;

        $this->db->insert('p_lease', $les);
        $lastLeaseId  = $this->db->insert_id();
        
        //for genarate invoice
                        
        $bill['InvId']        = 'INV'.time();
        $bill['PropertyId']   = $property_name;
        $bill['TenantId']     = $TenantId;
        $bill['LeaseId']      = $lastLeaseId;
        $bill['UnitId']       = $vacant_unit;
        $bill['Attention']    = $tenantname;
        $bill['PaymentHeadId']= '200006000';
        $bill['RefNo']        = 101;
        $bill['moveinDate']   = date('Y-m-d', strtotime(str_replace('-', '/', $moveinDate)));
        $bill['EnteredBy']    = $this->session->userdata('login_type');
        $bill['Entrydate']    = date('Y-m-d');
        $bill['TotalPrice']   = $rentAmount;
        $bill['BalanceAmount']= $rentAmount;

        $this->db->insert('p_tenant_bill', $bill);
        $lastInvId  = $this->db->insert_id();
        
        //for confirm booking status in app info table
        $dataupdate = array(
           'currentLease' => $lastLeaseId
        );
        $page_data['bookedTenant']  = $this->Operation_Model->updateTable('tenant_id', $TenantId, 'p_tenant',$dataupdate);

        //for confirm vacant status in unit
        $updatevstatus = array(
           'vacant_status' => 1
        );
        $page_data['approveScreening']  = $this->Operation_Model->updateTable('unit_id', $vacant_unit, 'unit',$updatevstatus);
    }

  public function imageUpload($image, $tmpupimage) 
    {
        $target_dir = "./uploads/marketing/";
        $target_file = $target_dir . basename($image);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       // Check if $uploadOk is set to 0 by an error
        if (empty($image)) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($tmpupimage, $target_file)) {
                return $image;
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }

    }

 public function vacancyRateCalculation() {
         
            $unitq = $this->db->query('SELECT * FROM `unit`');
            $totalUnit =  $unitq->num_rows();

            $vacantq = $this->db->query('SELECT * FROM `unit` WHERE `vacant_status` =1');
            $totalVacantUnit =  $vacantq->num_rows();
            
            $vrate = substr($totalVacantUnit/$totalUnit,2,2);
        
            return $vrate;
    }
    
}