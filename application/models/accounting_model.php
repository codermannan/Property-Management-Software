<?php
class Accounting_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    
    function next_ledger_id($group_id)
    {
        $max=($group_id*1000000)+1000000;
        $min=($group_id*1000000)-1;

        $this->db->select('MAX(ledger_id)');
        $this->db->from('accounts_ledger');
        $this->db->where('ledger_id >', $min);
        $this->db->where('ledger_id <', $max);
        
        $query = $this->db->get();
        
        if ($query->num_rows()>0){
            $row = $query->row_array();
            $data = $row['MAX(ledger_id)'];
        }else{
            $acc_no=$min+1;
       }
       
       if(!isset($acc_no)&&(is_null($data))){ 
            $acc_no=$min+1;
       }else{
            $acc_no=$data+1000;
       } 
  
        return $acc_no;
    }
    
    function next_value($field,$table){
        $this->db->select_max($field);
        $result = $this->db->get($table)->row();
        
        $value=$result->$field+1;

        if(empty($value))
        {
                $value=100001;
        }
        return $value;
   }
    
    function next_journal_voucher_id(){

        $p_id= date("Ymd")."0000";
        
        $this->db->select_max('jv_no');
        $result = $this->db->get('journal')->row();
        $jv_no = $result->jv_no;
        
        if($jv_no>$p_id)
            $jv=$jv_no+1;
        else
            $jv=$p_id+1;
        return $jv;
    }
    
    function get_property_ledger_id($propertyId){
        
        $data = $this->Operation_Model->getSingleDataOfTable('ledger_id', 'property_id', $propertyId, 'property');
        
        return $data;
        
    }
    
    //getLedgerIdByName
    function getLedgerIdByName($LedgerGroupName,$propertyLedger){
        
        $groupid = $this->Operation_Model->getSingleDataOfTable('group_id', 'group_name', $LedgerGroupName, 'ledger_group');
        
        $data = $this->Operation_Model->getSingleDataOfTable('ledger_id', 'ledger_group_id', $groupid, 'accounts_ledger', 'property_ledger', $propertyLedger);
       
        return $data;
        
    }
    
    // account ledger entry
     public function insertAccountLedger($TenantId, $tenantname, $groupId)
    {
        $acl['ledger_id']      =  $TenantId;
        $acl['ledger_name']    =  $tenantname;
        $acl['ledger_group_id']=  $groupId;
        $acl['balance_type']   =  'Both';
        $acl['proj_id']        =  'PMS';
                        
        $this->db->insert('accounts_ledger', $acl);
        $databaseError = $this->db->_error_message(); 
        return $databaseError;
    }
    
    // account ledger entry
     public function insertJournalVoucher($date, $dr_ledger_id, $dr_amount, $cr_array, $tenantname, $tenantId, $propertyId, $narration)
    {
        
         $m     = date('m', strtotime(str_replace('-', '/', $date)));
         $d     = date('d', strtotime(str_replace('-', '/', $date)));
         $y     = date('Y', strtotime(str_replace('-', '/', $date)));

         $journal_info_date = mktime(0,0,0,$m,$d,$y);
         
        //journal voucher  debit part
        $journal_info_no = $this->next_value('journal_info_no', 'journal_info');

        $jvd['journal_info_no']      =  $journal_info_no;
        $jvd['journal_info_date']    =  $journal_info_date;
        $jvd['proj_id']              = 'PMS';
        $jvd['narration']            =  $narration;
        $jvd['ledger_id']            =  $dr_ledger_id;
        $jvd['dr_amt']               =  $dr_amount;
        $jvd['cr_amt']               = '0';
        $jvd['type']                 = 'Debit';
        $jvd['cur_bal']              = 0;
        $jvd['received_from']        = $tenantname;
        $jvd['receiver_id']          = $tenantId;
        $jvd['cc_code']              = $propertyId;

        $this->db->insert('journal_info', $jvd);
        
        //journal voucher credit part
        foreach ($cr_array as $ledger_id_cr => $cr_amount) {
      
            $jvc['journal_info_no']      = $journal_info_no;
            $jvc['journal_info_date']    = $journal_info_date;
            $jvc['proj_id']              = 'PMS';
            $jvc['narration']            = $narration;
            $jvc['ledger_id']            = $ledger_id_cr;
            $jvc['dr_amt']               = '0';
            $jvc['cr_amt']               = $cr_amount;
            $jvc['type']                 = 'Credit';
            $jvc['cur_bal']              = $cr_amount;           //needs to retrieve
            $jvc['received_from']        = $tenantname;
            $jvc['receiver_id']          = $tenantId;
            $jvc['cc_code']              = $propertyId;

            if($cr_amount <> 0):
                $this->db->insert('journal_info', $jvc);
            endif;
         }
        return $journal_info_no;
    }
    
    // account receipt entry
     public function insertReceiptVoucher($date, $cr_ledger_id, $dr_ledger_id, $paid_amount, $tenantname, $propertyId, $narration, $chk_no, $chk_date, $tenantId, $propertyId, $user_id)
    {
        
         $m     = date('m', strtotime(str_replace('-', '/', $date)));
         $d     = date('d', strtotime(str_replace('-', '/', $date)));
         $y     = date('Y', strtotime(str_replace('-', '/', $date)));

         $receipt_date = mktime(0,0,0,$m,$d,$y);
         
         $cm     = date('m', strtotime(str_replace('-', '/', $chk_date)));
         $cd     = date('d', strtotime(str_replace('-', '/', $chk_date)));
         $cy     = date('Y', strtotime(str_replace('-', '/', $chk_date)));

         $chk_date = mktime(0,0,0,$cm,$cd,$cy);
         
         //receipt voucher credit part
        
        $receipt_no = $this->next_value('receipt_no', 'receipt');

        $rc['receipt_no']           = $receipt_no;
        $rc['receipt_date']         = $receipt_date;
        $rc['proj_id']              = 'PMS';
        $rc['narration']            = $narration;
        $rc['ledger_id']            = $cr_ledger_id;
        $rc['dr_amt']               = '0';
        $rc['cr_amt']               = $paid_amount;
        $rc['type']                 = 'Credit';
        $rc['cur_bal']              = $paid_amount; 
        $rc['received_from']        = $tenantname;
        $rc['cheq_no']              = $chk_no;
        $rc['cheq_date']            = $chk_date;
        $rc['bank']                 = $dr_ledger_id; 
        $rc['receiver_id']          = $tenantId; 
        $rc['cc_code']              = $propertyId; 

        $this->db->insert('receipt', $rc);
        
        // journal entry credit part

        $jv_no           = $this->next_journal_voucher_id();
        
        $rjc['proj_id']     = 'PMS';
        $rjc['jv_no']       = $jv_no;
        $rjc['jv_date']     = $receipt_date;
        $rjc['ledger_id']   = $cr_ledger_id;
        $rjc['narration']   = $narration;
        $rjc['dr_amt']      =  0;
        $rjc['cr_amt']      = $paid_amount;
        $rjc['tr_from']     = 'receipt';
        $rjc['tr_no']       = $receipt_no;
        $rjc['receiver_id'] = $tenantId; 
        $rjc['cc_code']     = $propertyId; 
        $rjc['user_id']     = $user_id;

        $this->db->insert('journal', $rjc);
        
        //receipt voucher  debit part
        
        $rd['receipt_no']           =  $receipt_no;
        $rd['receipt_date']         =  $receipt_date;
        $rd['proj_id']              = 'PMS';
        $rd['narration']            = $narration;
        $rd['ledger_id']            = $dr_ledger_id;
        $rd['dr_amt']               = $paid_amount;
        $rd['cr_amt']               =  0;
        $rd['type']                 = 'Credit';
        $rd['cur_bal']              = $paid_amount; 
        $rd['received_from']        = $tenantname;
        $rd['cheq_no']              = $chk_no;
        $rd['cheq_date']            = $chk_date;
        $rd['bank']                 = $dr_ledger_id; 
        $rd['receiver_id']          = $tenantId; 
        $rd['cc_code']              = $propertyId; 

        $this->db->insert('receipt', $rd);
        
        // journal entry debit part

        $rjd['proj_id']     = 'PMS';
        $rjd['jv_no']       = $jv_no;
        $rjd['jv_date']     = $receipt_date;
        $rjd['ledger_id']   = $dr_ledger_id;
        $rjd['narration']   = $narration;
        $rjd['dr_amt']      = $paid_amount;
        $rjd['cr_amt']      = '0';
        $rjd['tr_from']     = 'receipt';
        $rjd['tr_no']       = $receipt_no;
        $rjd['receiver_id'] = $tenantId; 
        $rjd['cc_code']     = $propertyId;
        $rjd['user_id']     = $user_id;

        $this->db->insert('journal', $rjd);
 
        return $journal_info_no;
    }
    
    // account journal entry
     public function insertJournalTable($dr_ledger_id, $tenantname, $date, $dr_amount , $cr_array, $propertyId, $tenantId, $tr_from, $tr_no, $narration, $user_id){
         
         $m     = date('m', strtotime(str_replace('-', '/', $date)));
         $d     = date('d', strtotime(str_replace('-', '/', $date)));
         $y     = date('Y', strtotime(str_replace('-', '/', $date)));

         $jv_date = mktime(0,0,0,$m,$d,$y);
         
        // journal entry debit part

        $jv_no_dr = $this->next_journal_voucher_id();

        $jd['proj_id']     = 'PMS';
        $jd['jv_no']       = $jv_no_dr;
        $jd['jv_date']     = $jv_date;
        $jd['ledger_id']   = $dr_ledger_id;
        $jd['narration']   = $narration;
        $jd['dr_amt']      = $dr_amount;
        $jd['cr_amt']      = '0';
        $jd['tr_from']     = $tr_from;
        $jd['tr_no']       = $tr_no;
        $jd['receiver_id'] = $tenantId;
        $jd['cc_code']     = $propertyId;
        $jd['user_id']     = $user_id;
        
        $this->db->insert('journal', $jd);
        
        // journal entry credit part

        $jv_no_cr  = $this->next_journal_voucher_id();
       
        foreach ($cr_array as $ledger_id_cr => $cr_amt) {
            
            $jc['proj_id']     = 'PMS';
            $jc['jv_no']       = $jv_no_cr;
            $jc['jv_date']     = $jv_date;
            $jc['ledger_id']   = $ledger_id_cr;
            $jc['narration']   = $narration;
            $jc['dr_amt']      =  0;
            $jc['cr_amt']      = $cr_amt;
            $jc['tr_from']     = $tr_from;
            $jc['tr_no']       = $tr_no;
            $jc['receiver_id'] = $tenantId;
            $jc['cc_code']     = $propertyId;
            $jc['user_id']     = $user_id;
            
            if($cr_amt <> 0):
                $this->db->insert('journal', $jc);
            endif;
            
            
        }
        
     }
     
     // tenant ledger report
     public function tenantLedgerReport($tenid){
        
        $this->db->select('a.jv_date,b.ledger_name,a.dr_amt,a.cr_amt,a.tr_from,a.narration,a.jv_no,a.tr_no');
        $this->db->from('journal as a');
        $this->db->join('accounts_ledger as b','b.ledger_id = a.ledger_id','true');
        $this->db->where('a.receiver_id ', $tenid);
        $this->db->where('a.ledger_id ', '105000000');
        $query = $this->db->get();
        return $query->result_array();

     }
     
     // tenant ledger report
     public function getPropertyIncome($pId, $start_date, $end_date){

        $this->db->select('SUM(a.cr_amt)');
        $this->db->from('journal as a');
        //$this->db->join('accounts_ledger as b','b.ledger_id = a.ledger_id','true');
        $this->db->where('a.cc_code ', $pId);
        $this->db->where('a.ledger_id ', '105000000');
        $this->db->where('a.jv_date >=', $start_date);
        $this->db->where('a.jv_date <=', $end_date);
        $query = $this->db->get();
//       echo $this->db->last_query(). "<br>";
        return $query->result_array();

     }
     
     function getLedgerIdwiseexpense($fdate,$tdate,$pid,$ledger_id) {
            
            $this->db->select('SUM(dr_amt)');
            $this->db->from('journal');
            $this->db->where('ledger_id ', $ledger_id);
            $this->db->where('cc_code ', $pid);
            $this->db->where('jv_date >=', $fdate);
            $this->db->where('jv_date <=', $tdate);
            $query = $this->db->get();
            return $query->result_array();
  
        }
     
     function weeklyReport($month, $propertyId) {
            
            $timestamp = strtotime($month);
            $yearMonth = date('Y-m-', $timestamp);

            $daysInMonth = (int)date('t', $timestamp);

            for ($i = 1; $i <= $daysInMonth; $i++) {

                 $dateString[date('Y-m-d', strtotime($yearMonth . $i))] = date('l', strtotime($yearMonth . $i));

            }

            foreach ($dateString as $key => $value) {

                if($value == 'Thursday'){
                    $first_day_of_week =  strtotime($key);
                    $last_day_of_week  = strtotime(" +6 days", $first_day_of_week);
                    $data[]  = $this->getPropertyIncome($propertyId,$first_day_of_week, $last_day_of_week);               
                }


            }
            
            return $data;
            
        }
        
        function monthlyPropertyExpense($sdate,$edate,$Property_Id) {

            $mortgage                = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'501000000');
            $water                   = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'504002000');
            $gas                     = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'504001000');
            $electric                = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'504002000');
            $internet                = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'504003000');
            $mgmt                    = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'300001000');
            $OwnerPay                = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'400002000'); //paid up capital nned ledger
            $repair                  = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'510000000');
            $adminexp                = $this->getLedgerIdwiseexpense(strtotime($sdate),strtotime($edate),$Property_Id,'300002000');
            
            $finalArray = array($mortgage,$water,$gas,$electric,$internet,$mgmt,$OwnerPay,$repair,$adminexp);
            
            return $finalArray;
  
        }
        
        //summuation of montly expense
    function summationofMontlyExpense($expensearray){
        
        $sum = 0;
        foreach($expensearray as $values) {
            
            $sum += $values[0][ 'SUM(dr_amt)' ];
        }
        
        return $sum;
    }
}