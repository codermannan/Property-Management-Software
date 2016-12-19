<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*	
 *	@author : Abdul Mannan  
 *	date	: 07 August, 2015
 *	Datastate Solutions
 *	Property Management system
 *	www.datastatebd.com
 */

class Payment extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                $this->load->model('Operation_Model');
                $this->load->model('Search_Model');
                $this->load->model('Accounting_Model');
	}
	
	/***Default function, redirects to login page if no admin logged in yet***/
	public function index()
	{
		
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		if ($this->session->userdata('admin_login') == 1)
			redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
	}
       
        /***MANAGE NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
	function manage_tpayment($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'addCharges') {
                        
                        $tenantId = $this->input->post('tenant_id');
//                        $paymentHead = $this->input->post('payment_head');
                        $propertyId  = $this->Operation_Model->getSingleDataOfTable('property_name', 'tenant_id', $tenantId, 'p_tenant');
                        
                        //for genarate invoice
                        $whereData = array('tenantId' => $tenantId, 'leaseStatus' => 0);
                        
                        $lastLeaseId = $this->Search_Model->getmultiConditionData('leaseId', 'p_lease', $whereData);
                        
                        $bill['InvId']        = 'INV'.time();
                        $bill['PropertyId']   = $propertyId;
                        $bill['TenantId']     = $tenantId;
                        $bill['LeaseId']      = $lastLeaseId[0]['leaseId'];
                        $bill['UnitId']       = $this->input->post('chUnitNo');
                        $bill['Attention']    = $this->input->post('chTenantName');
                        $bill['PaymentHeadId']= $this->input->post('payment_head');
                        $bill['RefNo']        = $this->input->post('ref_no');
                        $bill['Remarks']      = $this->input->post('note');
                        $bill['moveinDate']   = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('charges_date'))));
                        $bill['EnteredBy']    = $this->session->userdata('login_type');
                        $bill['Entrydate']    = date('Y-m-d');
                        $bill['TotalPrice']   = $this->input->post('charge_amount');
                        $bill['BalanceAmount']= $this->input->post('charge_amount');
                        
                        
			$this->db->insert('p_tenant_bill', $bill);
                        
                        //start accounting information
                        
                        $paymentArray = array(
                            $this->input->post('payment_head') =>$this->input->post('charge_amount'),
                        );
                        
                        $dramount =  array_sum($paymentArray);
                        
                        $journal_info_no   = $this->Accounting_Model->insertJournalVoucher($this->input->post('charges_date'), '105000000', $dramount, $paymentArray, $this->input->post('chTenantName'), $tenantId, $propertyId,'Fees and rent invoice');
                        
                        // journal entry
                                                                                        
                        $addJournal        = $this->Accounting_Model->insertJournalTable('105000000', $this->input->post('chTenantName'), $this->input->post('charges_date'), $dramount, $paymentArray, $propertyId, $tenantId, 'Journal_info', $journal_info_no, 'Fees and rent invoice', $this->session->userdata('login_type'));
                        
                        //end accounting info
                        
                        
                        $this->session->set_flashdata('flash_message', get_phrase('tenant_inserted'));
			redirect(base_url() . 'index.php?admin/manage_lease/tdashboard/'.$tenantId, 'refresh');
		}
                
                //For receive payment
                
                if ($param1 == 'receivePayment') {
                        
                        $tenantId = $this->input->post('TenantId');
                        
                        foreach($this->input->post('PaymentHeadId') as $key=>$value){
                        
                            $data['ReceiptNo']       = 'RPT'.time().$key;
                            $data['ReceiptDate']     = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('receipt_date'))));
                            $data['InvoiceId']       = $this->input->post('InvoiceNo')[$key];
                            $data['PropertyId']      = $this->input->post('PropertyId');
                            $data['TenantId']        = $tenantId;
                            $data['UnitId']          = $this->input->post('UnitId');
                            $data['TransType']       = 'Receipt';
                            $data['RefNo']           = $this->input->post('RefNo')[$key];
                            $data['PaymentHeadId']   = $value;
                            $data['PaidAmount']      = $this->input->post('PaidAmount')[$key];
                            $data['PaymentType']     = $this->input->post('payment_type');
                            $data['ChequeNO']        = $this->input->post('cheque_no');
                            $data['ChequeDate']      = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('cheque_date'))));
                            $data['ApproveDBy']      = $this->session->userdata('login_type');
                            $data['ApproveDDate']    = date('Y-m-d');
                            $data['EnteredBy']       = $this->session->userdata('login_type');
                            $data['EntryDate']       = date('Y-m-d');
                            $data['UpdateBy']        = $this->session->userdata('login_type');
                            $data['UpdateDate']      = date('Y-m-d');
                            $data['Comments']        = $this->input->post('comments');
                            $data['CompanyBanlId']   = $this->input->post('deposit_to');

                            $this->db->insert('p_receipt', $data);
                        
                            //start accounting information

                            //add tenant rent in journal valucher

                            $addReceipt        = $this->Accounting_Model->insertReceiptVoucher($this->input->post('receipt_date'),'105000000', $this->input->post('deposit_to'), $this->input->post('PaidAmount')[$key], $this->input->post('tenant_name'), $this->input->post('PropertyId'), 'rent payment', $this->input->post('cheque_no'), $this->input->post('cheque_date'),$tenantId, $this->input->post('PropertyId'), $this->session->userdata('login_type'));

                            //end accounting info
                        
                            //update invoice paid amount 

                            $InvoiceId                = $this->input->post('InvoiceNo')[$key];
                            $upinv['PaidAmount']      = $this->input->post('PaidAmount')[$key];
                            $page_data['upInvPaid']   = $this->Operation_Model->updatePreviousBalance('InvId', $InvoiceId, 'p_tenant_bill', 'PaidAmount', $upinv['PaidAmount']);

                            $invStatus['invStatus']      = 1;
                            $this->db->where('InvId', $InvoiceId);
                            $this->db->update('p_tenant_bill', $invStatus);
                        
                            //update lease paid amount 

                            $LeaseId                  = $this->input->post('LeaseId')[$key];
                            $page_data['upLesPaid']   = $this->Operation_Model->updatePreviousBalance('leaseId', $LeaseId, 'p_lease', 'PaidAmount', $upinv['PaidAmount']);
                        
                        //$TenantId                = $this->input->post('TenantId');
                        //$page_data['upTenPaid']  = $this->Operation_Model->updatePreviousBalance('leaseId', $LeaseId, 'p_tenant', 'PaidAmount', $upinv['PaidAmount']);
                        
                    }
                        $TenantId        = $this->input->post('TenantId');
                        
			$this->session->set_flashdata('flash_message', get_phrase('payment_received'));
			redirect(base_url() . 'index.php?admin/manage_lease/tdashboard/'.$TenantId, 'refresh');
		}
                //end receive payment
		
	}
        
        
        
}
