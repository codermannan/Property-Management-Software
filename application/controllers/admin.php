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

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
                $this->load->helper('url');
                $this->load->helper('form');
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
	
	/***ADMIN DASHBOARD***/
	function dashboard()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = get_phrase('admin_dashboard');
                $page_data['vrate'] = $this->db->get('property')->result_array();
                $page_data['project_data'] = $this->Search_Model->joinTableData('p_project', 'property', 'p_project.*, property.property_name', 'p_project.property_address = property.property_id');
		$page_data['work_order'] = $this->db->get('work_order')->result_array();
		$this->load->view('index', $page_data);
	}
	
        /***MANAAGE BUILDING********/
	function manage_landlord($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
                    
			$data['first_name']   = $this->input->post('first_name');
                        $data['last_name']    = $this->input->post('last_name');
                        $data['dob']          = $this->input->post('birth_date');
                        $data['contact_no']   = $this->input->post('phone_number');
                        $data['email']        = $this->input->post('lanlord_email');
                        $data['address']      = $this->input->post('landlord_address');
                        $data['city']         = $this->input->post('city');
                        $data['country']      = $this->input->post('landlord_country');
                        $data['state']        = $this->input->post('landlord_province');
                        $data['zip_code']     = $this->input->post('zip_code');
                        
			$this->db->insert('p_landlord', $data);
			$this->session->set_flashdata('flash_message', get_phrase('landlord_created'));
			redirect(base_url() . 'index.php?admin/manage_landlord', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['first_name']   = $this->input->post('first_name');
                        $data['last_name']    = $this->input->post('last_name');
                        $data['dob']          = $this->input->post('birth_date');
                        $data['contact_no']   = $this->input->post('phone_number');
                        $data['email']        = $this->input->post('lanlord_email');
                        $data['address']      = $this->input->post('landlord_address');
                        $data['city']         = $this->input->post('city');
                        $data['country']      = $this->input->post('landlord_country');
                        $data['state']        = $this->input->post('landlord_province');
                        $data['zip_code']     = $this->input->post('zip_code');
                        
			$this->db->where('landlord_id', $param3);
			$this->db->update('p_landlord', $data);
			$this->session->set_flashdata('flash_message', get_phrase('landlord_updated'));
			redirect(base_url() . 'index.php?admin/manage_landlord', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_landlord'] = $this->db->get_where('p_landlord', array(
				'landlord_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('landlord_id', $param2);
			$this->db->delete('p_landlord');
			$this->session->set_flashdata('flash_message', get_phrase('property_deleted'));
			redirect(base_url() . 'index.php?admin/manage_landlord', 'refresh');
		}
		$page_data['page_name']   = 'manage_landlord';
		$page_data['page_title']  = get_phrase('manage_landlord');
		$page_data['landlord'] = $this->db->get('p_landlord')->result_array();
		$this->load->view('index', $page_data);
		
	}
        /***MANAAGE BUILDING********/
	function manage_property($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
                        
			$data['property_type']        = $this->input->post('property_type');
                        $data['property_name']        = $this->input->post('property_name');
                        $data['frequency']            = $this->input->post('frequency');
                        $data['unit']                 = $this->input->post('unit');
                        $data['tarea']                = $this->input->post('tarea');
                        $data['tarea_munit']          = $this->input->post('tarea_munit');
                        $data['property_address']     = $this->input->post('property_address');
                        $data['city']                 = $this->input->post('city');
                        $data['property_country']     = $this->input->post('property_country');
			$data['property_province']    = $this->input->post('property_province');
                        $data['zip_code']             = $this->input->post('zip_code');
			$this->db->insert('property', $data);
                        
			$this->session->set_flashdata('flash_message', get_phrase('property_opened'));
			redirect(base_url() . 'index.php?admin/manage_property', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['property_type']        = $this->input->post('property_type');
                        $data['property_name']        = $this->input->post('property_name');
                        $data['frequency']            = $this->input->post('frequency');
                        $data['unit']                 = $this->input->post('unit');
                        $data['tarea']                = $this->input->post('tarea');
                        $data['tarea_munit']          = $this->input->post('tarea_munit');
                        $data['property_address']     = $this->input->post('property_address');
                        $data['city']                 = $this->input->post('city');
                        $data['property_country']     = $this->input->post('property_country');
			$data['property_province']    = $this->input->post('property_province');
                        $data['zip_code']             = $this->input->post('zip_code');
                        
			$this->db->where('property_id', $param3);
			$this->db->update('property', $data);
			$this->session->set_flashdata('flash_message', get_phrase('property_updated'));
			redirect(base_url() . 'index.php?admin/manage_property', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_property'] = $this->db->get_where('property', array(
				'property_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('property_id', $param2);
			$this->db->delete('property');
			$this->session->set_flashdata('flash_message', get_phrase('property_deleted'));
			redirect(base_url() . 'index.php?admin/manage_property', 'refresh');
		}
		$page_data['page_name']   = 'manage_property';
		$page_data['page_title']  = get_phrase('manage_property');
		$page_data['property'] = $this->db->get('property')->result_array();
		$this->load->view('index', $page_data);
		
	}
	/***MANAGE UNIT********/
	function manage_unit($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['unit_name']        = $this->input->post('unit_name');
			$data['unit_type']        = $this->input->post('unit_type');
                        $data['property_name']    = $this->input->post('property_name');
			$data['floor_number']     = $this->input->post('floor_number');
                        $data['bedrooms']         = $this->input->post('bedrooms');
			$data['bathrooms']        = $this->input->post('bathrooms');
                        $data['trent']            = $this->input->post('trent');
			$data['trent_period']     = $this->input->post('trent_period');
                        
			$this->db->insert('unit', $data);
			$this->session->set_flashdata('flash_message', get_phrase('unit_opened'));
			redirect(base_url() . 'index.php?admin/manage_unit', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
                    
			$data['unit_name']        = $this->input->post('unit_name');
			$data['unit_type']        = $this->input->post('unit_type');
                        $data['property_name']    = $this->input->post('property_name');
			$data['floor_number']     = $this->input->post('floor_number');
                        $data['bedrooms']         = $this->input->post('bedrooms');
			$data['bathrooms']        = $this->input->post('bathrooms');
                        $data['trent']            = $this->input->post('trent');
			$data['trent_period']     = $this->input->post('trent_period');
                        
			$this->db->where('unit_id', $param3);
			$this->db->update('unit', $data);
			$this->session->set_flashdata('flash_message', get_phrase('unit_updated'));
			redirect(base_url() . 'index.php?admin/manage_unit', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_unit'] = $this->db->get_where('unit', array(
				'unit_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('unit_id', $param2);
			$this->db->delete('unit');
			$this->session->set_flashdata('flash_message', get_phrase('unit_deleted'));
			redirect(base_url() . 'index.php?admin/manage_unit', 'refresh');
		}
		$page_data['page_name']   = 'manage_unit';
		$page_data['page_title']  = get_phrase('manage_unit');
		$page_data['units'] = $this->Search_Model->joinTableData('unit', 'property', 'unit.*,property.property_name', 'property.property_id = unit.property_name');
                $page_data['property'] = $this->Search_Model->getAllDataFromTable('property');
		$this->load->view('index', $page_data);
		
	}
	/***Manage Application**/
	function rental_application($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			//step 1 
                    if($this->input->post('property_name')!=''){
                        
			$data['property_name']      = $this->input->post('property_name');
			$data['movein_date']        = $this->input->post('movein_date');
			$data['no_of_bedroom']      = $this->input->post('no_of_bedroom');
			$data['full_name']          = $this->input->post('full_name');
			$data['phone_number']       = $this->input->post('phone_number');
                        $data['email']              = $this->input->post('email');
			$data['ssn']                = $this->input->post('ssn');
			$data['dob']                = $this->input->post('dob');
			$data['drivinglicense']     = $this->input->post('drivinglicense');
			$data['drivinglicensestate']= $this->input->post('drivinglicensestate');
                        $data['rent_status']        = 0;
			$data['application_date']   = date('d-m-Y');;
                        
                        $this->db->insert('p_appinfo', $data);
                        $appinfo_id = $this->db->insert_id();
                    }
                    if($this->input->post('job_type')!=''){
                        //step 2
                        $job['appinfo_id']         = $appinfo_id;
                        $job['emp_name']           = $this->input->post('emp_name');
			$job['job_type']           = $this->input->post('job_type');
			$job['emp_address']        = $this->input->post('emp_address');
			$job['emp_aphone']         = $this->input->post('emp_aphone');
			$job['position']           = $this->input->post('Position');
                        $job['sup_name']           = $this->input->post('sup_name');
			$job['job_duration']       = $this->input->post('job_duration');
			$job['monthly_income']     = $this->input->post('monthly_income');
			$job['other_income']       = $this->input->post('other_income');
                        
                        $this->db->insert('p_empinfo', $job);
                    }
                    if($this->input->post('cur_address')!=''){
                        //step 3
                        $cur['appinfo_id']         = $appinfo_id;
                        $cur['cur_address']        = $this->input->post('cur_address');
			$cur['curjobyear']         = $this->input->post('curjobyear');
			$cur['cur_renamnt']        = $this->input->post('cur_renamnt');
			$cur['cur_resleaving']     = $this->input->post('cur_resleaving');
			$cur['curlname']           = $this->input->post('curlname');
                        $cur['for_address']        = $this->input->post('for_address');
			$cur['forresyear']         = $this->input->post('forresyear');
			$cur['for_renamnt']        = $this->input->post('for_renamnt');
			$cur['for_resleaving']     = $this->input->post('for_resleaving');
                        $cur['forlname']           = $this->input->post('forlname');
                        $cur['forland_phone']      = $this->input->post('forland_phone');
                        
                        $this->db->insert('p_rentalhistory', $cur);
                    }
                    if($this->input->post('dec_bankrupcy')!=''){
                        //step 4
                        $ans['appinfo_id']        = $appinfo_id;
                        $ans['dec_bankrupcy']     = $this->input->post('dec_bankrupcy');
			$ans['evicted_residence'] = $this->input->post('evicted_residence');
			$ans['rental_due']        = $this->input->post('rental_due');
			$ans['refused_rent']      = $this->input->post('refused_rent');
			$ans['con_felony']        = $this->input->post('con_felony');
                        $ans['sex_offence']       = $this->input->post('sex_offence');
			$ans['drug_crime']        = $this->input->post('drug_crime');
			$ans['parole']            = $this->input->post('parole');
                        
                        $this->db->insert('p_givinganswer', $ans);
                    }
                    if($this->input->post('ref1_name')!=''){
                        //step 5
                        $ref['appinfo_id']        = $appinfo_id;
                        $ref['ref1_name']       = $this->input->post('ref1_name');
			$ref['ref1phone']       = $this->input->post('ref1phone');
                        $ref['ref1relation']    = $this->input->post('ref1relation');
                        $ref['ref2_name']       = $this->input->post('ref2_name');
                        $ref['ref2phone']       = $this->input->post('ref2phone');
                        $ref['ref2relation']    = $this->input->post('ref2relation');
			$ref['emrcontactname']  = $this->input->post('emrcontactname');
                        $ref['emr_contactnumber']= $this->input->post('emr_contactnumber');
                        $ref['emr_contactrel']  = $this->input->post('emr_contactrel');
                        
                        $this->db->insert('p_rentformother', $ref);
                    }   
			
			//$this->email_model->account_opening_email('doctor', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('your_application_has_been_received_successfully'));
			
			redirect(base_url() . 'index.php?admin/rental_application', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']          = $this->input->post('name');
			$data['email']         = $this->input->post('email');
			$data['password']      = $this->input->post('password');
			$data['address']       = $this->input->post('address');
			$data['phone']         = $this->input->post('phone');
			$data['unit_id'] = $this->input->post('unit_id');
			$data['profile']       = $this->input->post('profile');
			
			$this->db->where('doctor_id', $param3);
			$this->db->update('doctor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_doctor', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('doctor', array(
				'doctor_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('doctor_id', $param2);
			$this->db->delete('doctor');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_doctor', 'refresh');
		}
		$page_data['page_name']  = 'rental_application';
		$page_data['page_title'] = get_phrase('rental_application');
		$page_data['property'] = $this->Search_Model->getAllDataFromTable('property');
                $this->load->view('index', $page_data);
		
	}
	
	/*******VIEW rental_application REPORT	********/
	function rental_application_list($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
                if ($param1 == 'screening') {
                       $data = array(
                           'rent_status' => 1
                        );
                        $page_data['page_name']    = 'rental_application_list';
                        $page_data['page_title']   = get_phrase('rental_application_list');
                        $page_data['approveScreening']  = $this->Operation_Model->updateTable('appinfo_id', $param2, 'p_appinfo',$data);
                        redirect(base_url() . 'index.php?admin/rental_application_list', 'refresh');
		}else if ($param1 == 'view') {
                        $page_data['page_name']    = 'rental_applicant_view';
                        $page_data['page_title']   = get_phrase('rental_applicant_view');
                        $page_data['appAlldata'] = $this->Search_Model->getApplicantdata($param2);
                        $this->load->view('index', $page_data);
		}else if ($param1 == 'approve') {
                        $page_data['page_name']  = 'manage_lease';
                        $page_data['page_title'] = get_phrase('new_lease_contact');
                        $page_data['property'] = $this->Search_Model->getAllDataFromTable('property');
                        $page_data['lateFee'] = $this->Search_Model->getAllDataFromTable('p_late_fee_setting');
                        $page_data['appdata'] = $this->Search_Model->getAllDataFromTableBycondition('p_appinfo','appinfo_id',$param2);
                        $this->load->view('index', $page_data);
		}else{
                        $page_data['page_name']    = 'rental_application_list';
                        $page_data['page_title']   = get_phrase('rental_application_list');
                        $page_data['appinfo'] = $this->Search_Model->joinTableData('p_appinfo', 'property', 'p_appinfo.*,property.property_name', 'property.property_id = p_appinfo.property_name');
                        $this->load->view('index', $page_data);
                }
	}
        function retrieveLeaseData()
	{
            $pId  =  $this->uri->segment(3);
            $pdata = $this->Search_Model->getPropertydataByid('property','property_id',$pId);
            echo json_encode($pdata);
        }
        function retrieveVacantData()
	{
            
            $status  =  $this->uri->segment(4);
            $uId     =  $this->uri->segment(3);
            $udata   = $this->Search_Model->getUnitdataByid('unit','property_name',$uId, $status);
            echo json_encode($udata);
        }
        function retrieveUnitPrice()
	{
            $uId  =  $this->uri->segment(3);
            $uprice = $this->Search_Model->getSinglefield('unit', 'trent', 'unit_id', $uId);
            echo json_encode($uprice);
        }
        
        function tenantPaymentReceive()
	{
            $tId  =  $this->uri->segment(3);
            
            $whereData = array('TenantId' => $tId, 'invStatus' => 0);
            
            $tenPayment = $this->Search_Model->joinTableData('p_tenant_bill', 'accounts_ledger', 'p_tenant_bill.*,accounts_ledger.ledger_name', 'accounts_ledger.ledger_id = p_tenant_bill.PaymentHeadId', true, $whereData);
            echo json_encode($tenPayment);
        }
        
        function getTenantData($tenantId){
            $tenInfo = $this->Search_Model->getTenantdata('p_tenant', TRUE, 'p_tenant.tenant_id',$tenantId);
            echo json_encode($tenInfo);
        }
        
        /***MANAGE NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
	function manage_lease($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
                       
                        //tenant new lease
                        
			$data['appinfo_id']     = $this->input->post('appinfo_id');
			$data['tenant_name']    = $this->input->post('tenantname');
                        $data['tenant_contact'] = $this->input->post('tenantcontact');
                        $data['property_name']  = $this->input->post('property_name');
                        $data['frequency']      = $this->input->post('frequency');
			$data['vacant_unit']    = $this->input->post('vacant_unit');
                        //$bill['balance']      = $this->input->post('deposit_amount');
                        
			$this->db->insert('p_tenant', $data);
                        $TenantId = $this->db->insert_id();
                        //start accounting information
                        
                        $paymentArray = array(
                            '200006000' =>round($this->input->post('rent_amount')),
                            '200002000' =>$this->input->post('cleaning_fee'),
                            '200003000' =>$this->input->post('redecorating_fee'),
                            '200004000' =>$this->input->post('pet_fee'),
                            '200005000' =>$this->input->post('other_fee'),
                            '405000000' =>$this->input->post('deposit_amount'),
                            '405001000' =>$this->input->post('pet_deposit'),
                            '405002000' =>$this->input->post('cleaning_deposit')
                        );
                        
                        $dramount =  array_sum($paymentArray);
                    
                        //add tenant rent in journal valucher
                        
                        $journal_info_no   = $this->Accounting_Model->insertJournalVoucher(date('m-d-Y',time()), '105000000', $dramount, $paymentArray, $this->input->post('tenantname'), $TenantId, $this->input->post('property_name'),'Security deposit and first month’s rent payment');
                        
                        // journal entry
                                                                                        
                        $addJournal        = $this->Accounting_Model->insertJournalTable('105000000', $this->input->post('tenantname'), date('m-d-Y',time()), $dramount, $paymentArray, $this->input->post('property_name'), $TenantId, 'Journal_info', $journal_info_no, 'Security deposit and first month’s rent payment', $this->session->userdata('login_type'));
                        
                        //end accounting info
                        
                        //insert lease database
                        
                        $les['tenantId']       = $TenantId;
                        $les['moveinDate']     = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('movein_date'))));
                        $les['moveoutDate']    = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('moveout_date'))));
                        $les['property_name']  = $this->input->post('property_name');
                        $les['frequency']      = $this->input->post('frequency');
			$les['vacant_unit']    = $this->input->post('vacant_unit');
                        $les['latefee_rule']   = $this->input->post('latefee_rule');
                        $les['rentAmount']     = $this->input->post('rent_amount');
                        $les['LeaseDate']      = time();
                        
			$this->db->insert('p_lease', $les);
                        $lastLeaseId  = $this->db->insert_id();
                        
                        
                        //lease details
                        
                        $lesd['leaseId']               = $lastLeaseId;
                        $lesd['personal_property']     = json_encode($this->input->post('personal_property'));
                        $lesd['addenda']               = json_encode($this->input->post('addenda_incorporated'));
                        $lesd['EarnestMoneyReceipt']   = $this->input->post('earnest_money_receipt');
			$lesd['FormMoneyReceipt']      = $this->input->post('form_earnest_money_receipt');
                        $lesd['IsPetAllowed']          = $this->input->post('pet_allowed');
                        $lesd['keys']                  = json_encode($this->input->post('keys'));
                        $lesd['PetInsurance']          = $this->input->post('pet_liability_insurance');
                        $lesd['Utilities']             = json_encode($this->input->post('utilities'));
                        $lesd['PoolChemicals']         = $this->input->post('pool_chemicals');
			$lesd['PoolMaintenance']       = $this->input->post('pool_maintenance');
                        $lesd['FrontYard']             = $this->input->post('front_yard');
                        $lesd['BackYard']              = $this->input->post('back_yard');
                        $lesd['PestControl']           = $this->input->post('routine_pest_control');
			$lesd['Other']                 = $this->input->post('other');
                        $lesd['HoaFees']               = $this->input->post('hoa_fees');
                       
			$this->db->insert('p_leasedetails', $lesd);
                        
                        $initialUpdate = array(
                           'InitialTotalPayment' => $dramount
                        );
                        $upTotalPayment  = $this->Operation_Model->updateTable('leaseId', $lastLeaseId, 'p_lease',$initialUpdate);
                        
                        //for genarate invoice
                        
                        $bill['InvId']        = 'INV'.time();
                        $bill['PropertyId']   = $this->input->post('property_name');
                        $bill['TenantId']     = $TenantId;
                        $bill['LeaseId']      = $lastLeaseId;
                        $bill['UnitId']       = $this->input->post('vacant_unit');
                        $bill['Attention']    = $this->input->post('tenantname');
                        $bill['PaymentHeadId']= 1;
                        $bill['RefNo']        = 101;
                        $bill['moveinDate']   = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('movein_date'))));
                        $bill['EnteredBy']    = $this->session->userdata('login_type');
                        $bill['Entrydate']    = date('Y-m-d');
                        $bill['TotalPrice']   = $dramount;
                        $bill['BalanceAmount']= $this->input->post('rent_amount');
                        //$bill['paidAmount']   = $this->input->post('deposit_amount');
                        
                        $this->db->insert('p_tenant_bill', $bill);
                        $lastInvId  = $this->db->insert_id();
                        
                        //for confirm booking status in app info table
                        $dataupdate = array(
                           'rent_status' => 2
                        );
                        $page_data['bookedTenant']  = $this->Operation_Model->updateTable('appinfo_id', $data['appinfo_id'], 'p_appinfo',$dataupdate);
                        
                        //for confirm vacant status in unit
                        $updatevstatus = array(
                           'vacant_status' => 1
                        );
                        $page_data['approveScreening']  = $this->Operation_Model->updateTable('unit_id', $data['vacant_unit'], 'unit',$updatevstatus);
                        
			$this->session->set_flashdata('flash_message', get_phrase('tenant_inserted'));
			redirect(base_url() . 'index.php?admin/manage_lease/tenant_list', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
//			$data['notice_title']     = $this->input->post('notice_title');
//			$data['notice']           = $this->input->post('notice');
//			$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
//			$this->db->where('notice_id', $param3);
//			$this->db->update('noticeboard', $data);
//			$this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
//			
//			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		} else if ($param1 == 'edit') {
                    
//			$page_data['edit_profile'] = $this->db->get_where('noticeboard', array(
//				'notice_id' => $param2
//			))->result_array();
                        
		} else if ($param1 == 'tenant_list') {
                    
                        $page_data['page_name']  = 'tenant_list';
                        $page_data['page_title'] = get_phrase('tenant_list');
                        $page_data['activeTenant'] = $this->Search_Model->getTenantdata('p_tenant',true,'tenantStatus',0);
                        $page_data['inactiveTenant'] = $this->Search_Model->getTenantdata('p_tenant',true,'tenantStatus',1);
                        $this->load->view('index', $page_data);
                        
                } else if ($param1 == 'moveout') {
                    
                    if( $this->input->post('dr_amount')>0 ){
                        
                        $this->session->set_flashdata('due_payment_message', 'Pleease clear your due payment first');
			
			redirect(base_url() . 'index.php?admin/manage_lease/tdashboard/'.$param2, 'refresh');
                                
                    }  else {
                        
                        $leaseid = $this->Operation_Model->getSingleDataOfTable('currentLease', 'tenant_id', $param2, 'p_tenant');
                        
                        $data['leavingDate']      = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('vacated_date'))));
                        $data['leavingReason']    = $this->input->post('reason_for_leaving');
                        $data['leaseId']          = $leaseid;
                        
			$this->db->insert('p_termination', $data);
                        
                        $terminateId = $this->db->insert_id();
                        
                        //tenant update
                        $utdata['tenantStatus'] = 1;
                        
			$this->db->where('tenant_id', $param2);
			$this->db->update('p_tenant', $utdata);
                        
                        //lease update
                        $uldata['terminationStatus'] = $terminateId;
			$uldata['leaseStatus']       = 1;
			
			$this->db->where('leaseId', $leaseid);
			$this->db->update('p_lease', $uldata);
                        
			$this->session->set_flashdata('ltermination_message', 'The tenant has been mouve out successfully');
			
			redirect(base_url() . 'index.php?admin/manage_lease/tdashboard/'.$param2, 'refresh'); 
                    }
                    
                } else if ($param1 == 'renewLease') {
                    
                        $lease_info = $this->db->get_where('p_lease', array(
				'tenantId' => $param2
			))->result_array();
                        
                        $data['moveinDate']     = $lease_info[0]['moveinDate'];
                        $data['moveoutDate']    = $lease_info[0]['moveinDate'];
                        $data['leaseId']        = $lease_info[0]['leaseId'];
                        $data['renewalDate']    = date('Y-m-d',  time());
                        
			$this->db->insert('p_lease_renew', $data);
                        
                        $renewId = $this->db->insert_id();
                        
                        //tenant update
                        $utdata['tenantStatus'] = 0;
                        
			$this->db->where('tenant_id', $param2);
			$this->db->update('p_tenant', $utdata);
                        
                        //lease update
                        $uldata['moveinDate']        = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('move_in_date'))));
                        $uldata['moveoutDate']       = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('move_out_date'))));;
                        $uldata['renewalStatus']     = $renewId;
			$uldata['leaseStatus']       = 0;
                        $uldata['terminationStatus'] = 0;
			
			$this->db->where('leaseId', $lease_info[0]['leaseId']);
			$this->db->update('p_lease', $uldata);
                        
			$this->session->set_flashdata('renew_message', 'The tenant has been renewed successfully');
			
			redirect(base_url() . 'index.php?admin/manage_lease/tdashboard/'.$param2, 'refresh');
                    
		} else if ($param1 == 'tdashboard') {
                    
                        $page_data['page_name']  = 'tenant_dashboard';
                        $page_data['page_title'] = get_phrase('tenant_dashboard');
                        $whereData = array('TenantId' => $param2);
                        $page_data['ten_dashboard'] = $this->Search_Model->joinTableData('p_tenant_bill', 'p_payment_head_setting', 'p_tenant_bill.*,p_payment_head_setting.head_name', 'p_payment_head_setting.head_id = p_tenant_bill.PaymentHeadId', true, $whereData);
                        $page_data['ten_ledger']    = $this->Accounting_Model->tenantLedgerReport($param2);
                        $page_data['payment_head']  = $this->db->get('p_payment_head_setting')->result_array();
                        
                        $this->load->view('index', $page_data);
		}else{
                        $page_data['page_name']  = 'manage_lease';
                        $page_data['page_title'] = get_phrase('manage_tenants');
                        $page_data['property'] = $this->Search_Model->getAllDataFromTable('property');
                        $this->load->view('index', $page_data);
                }
	}
        
        /***MANAGE ALL LEASE**/
	function lease_managemnet($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
                    
                        $page_data['weeklyTenant'] = $this->Operation_Model->weekLeaseAgreement($this->input->post('underledger'), $this->input->post('tenantname'), $this->input->post('tenantcontact'), $this->input->post('property_name'),$this->input->post('frequency'), $this->input->post('vacant_unit'), $this->input->post('representative_name'), $this->input->post('representative_phone'),
                                                     $this->input->post('rent_amount'), $this->input->post('movein_date'),$this->input->post('moveout_date'),$this->input->post('latefee_rule'),$this->input->post('deposit_amount'));
                                
                        $this->session->set_flashdata('flash_message', get_phrase('tenant_inserted'));
			//redirect(base_url() . 'index.php?admin/manage_lease/tenant_list', 'refresh');
		}
		if ($param1 == 'approveLateFee') {
			$data['isAppliedLate'] = 1;
			$data['lateFee']       = $param3;
			
			$this->db->where('leaseId', $param2);
			$this->db->update('p_lease', $data);
			$this->session->set_flashdata('flash_message', get_phrase('isAppliedLate_updated'));
			
			redirect(base_url() . 'index.php?admin/lease_managemnet', 'refresh');
		}else if ($param1 == 'viewLease') {
                    
                        $page_data['page_name']    = 'lease_agreement_view';
                        $page_data['page_title']   = get_phrase('lease_agreement_view');
                        $page_data['appAlldata'] = $this->Search_Model->getApplicantdata($param2);
                        $this->load->view('index', $page_data);
                        
                }else if ($param1 == 'weeklyLeaseForm'){
                        $page_data['page_name']  = 'weekly_lease';
                        $page_data['page_title'] = get_phrase('weekly_lease');
                        $page_data['property'] = $this->Search_Model->getAllDataFromTable('property');
                        $page_data['lateFee'] = $this->Search_Model->getAllDataFromTable('p_late_fee_setting');
                        $this->load->view('index', $page_data);
                }else{
                        $page_data['page_name']  = 'lease_list';
                        $page_data['page_title'] = get_phrase('active_lease');
                        $page_data['Lease']       = $this->db->get('p_lease')->result_array();
                        $this->load->view('index', $page_data);
                }       
		
	}
        /***MANAGE WORK ORDER**/
	function manage_work_order($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
                if ($param1 == 'create') {
                    
			$data['contractor']       = $this->input->post('contractor');
                        $data['PropertyId']       = $this->input->post('property_address');
			$data['JobTitle']         = $this->input->post('job_title');
                        $data['JobDescription']   = $this->input->post('job_description');
			$data['Material1Cost']    = $this->input->post('mat_1_cost');
                        $data['Material1Description']= $this->input->post('mate_1_description');
			$data['Labor1Charge']     = $this->input->post('labor_1');
                        $data['isWorkDone']       = $this->input->post('work_done');
			$data['Notes']            = $this->input->post('note');
                        $data['Material2Cost']    = $this->input->post('mat_2_cost');
			$data['Material2Description']= $this->input->post('mate_2_description');
                        $data['Labor2Charge']        = $this->input->post('labor_2');
			$data['user']             = $this->session->userdata('login_type');
                        
			$this->db->insert('work_order', $data);
                        
			$this->session->set_flashdata('flash_message', get_phrase('head_created'));
			redirect(base_url() . 'index.php?admin/manage_work_order', 'refresh');
		}
                if ($param1 == 'edit' && $param2 == 'do_update') {
                    
			$data['contractor']       = $this->input->post('contractor');
                        $data['PropertyId']       = $this->input->post('property_address');
			$data['JobTitle']         = $this->input->post('job_title');
                        $data['JobDescription']   = $this->input->post('job_description');
			$data['Material1Cost']    = $this->input->post('mat_1_cost');
                        $data['Material1Description']= $this->input->post('mate_1_description');
			$data['Labor1Charge']     = $this->input->post('labor_1');
                        $data['isWorkDone']       = $this->input->post('work_done');
			$data['Notes']            = $this->input->post('note');
                        $data['Material2Cost']    = $this->input->post('mat_2_cost');
			$data['Material2Description']= $this->input->post('mate_2_description');
                        $data['Labor2Charge']        = $this->input->post('labor_2');
                        $data['isAuthorized']     = $this->input->post('authorized');
			$data['user']             = $this->session->userdata('login_type');
       
                        if($this->input->post('PaidStatus')=='Yes'){
                            $data['isPaid']           = $this->input->post('PaidStatus');
                            $data['datePaid']         = date('Y-m-d');
                        }else{
                            $data['isPaid']           = $this->input->post('PaidStatus');
                        }
			
			$this->db->where('wo_id', $param3);
			$this->db->update('work_order', $data);
			$this->session->set_flashdata('flash_message', get_phrase('work_order_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_work_order', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_workorder'] = $this->db->get_where('work_order', array(
				'wo_id' => $param2
			))->result_array();
		}
                
		$page_data['page_name']  = 'work_order';
		$page_data['page_title'] = get_phrase('work_order');
		$page_data['property'] = $this->db->get('property')->result_array();
                $page_data['work_order'] = $this->db->get('work_order')->result_array();
		$this->load->view('index', $page_data);
	}
        
        /***MANAGE MAINTENANCE LOG*/
	function manage_maintenance_log($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
                if ($param1 == 'create') {
                    
			$data['contractor']       = $this->input->post('contractor');
                        $data['PropertyId']       = $this->input->post('property_address');
                        $data['UnitName']         = $this->input->post('property_unit');
			$data['Category']         = $this->input->post('category');
                        $data['MaintenanceTitle'] = $this->input->post('maintenance_title');
			$data['Description']      = $this->input->post('maintenance_description');
                        $data['when_done']        = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('when_done'))));
			$data['Notes']            = $this->input->post('note');
			$data['user']             = $this->session->userdata('login_type');
                        
			$this->db->insert('p_maintenance_log', $data);
                        
			$this->session->set_flashdata('flash_message', get_phrase('maintenance_log_created'));
			redirect(base_url() . 'index.php?admin/manage_maintenance_log', 'refresh');
		}
                if ($param1 == 'edit' && $param2 == 'do_update') {
                    
			$data['contractor']       = $this->input->post('contractor');
                        $data['PropertyId']       = $this->input->post('property_address');
                        $data['UnitName']         = $this->input->post('property_unit');
			$data['Category']         = $this->input->post('category');
                        $data['MaintenanceTitle'] = $this->input->post('maintenance_title');
			$data['Description']      = $this->input->post('maintenance_description');
                        $data['when_done']        = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('when_done'))));
			$data['Notes']            = $this->input->post('note');
			$data['user']             = $this->session->userdata('login_type');
			
			$this->db->where('log_id', $param3);
			$this->db->update('p_maintenance_log', $data);
			$this->session->set_flashdata('flash_message', get_phrase('maintenance_log_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_maintenance_log', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_maintenance_log'] = $this->db->get_where('p_maintenance_log', array(
				'log_id' => $param2
			))->result_array();
		}
                
		$page_data['page_name']  = 'maintenance_log';
		$page_data['page_title'] = get_phrase('maintenance_log');
		$page_data['property'] = $this->db->get('property')->result_array();
                $page_data['maintenance_log'] = $this->db->get('p_maintenance_log')->result_array();
		$this->load->view('index', $page_data);
	}
        
        /***MANAGE manage_project LOG*/
	function manage_project($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
                if ($param1 == 'create') {
                    
			$data['property_address']= $this->input->post('property_address');
			$data['project_title']   = $this->input->post('project_title');
                        $data['start_date']      = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('start_date'))));
                        $data['end_date']        = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('end_date'))));
                        $data['priority']        = $this->input->post('priority');

			$this->db->insert('p_project', $data);
                        
			$this->session->set_flashdata('flash_message', get_phrase('project_created'));
			redirect(base_url() . 'index.php?admin/manage_project', 'refresh');
		}
                if ($param1 == 'edit' && $param2 == 'do_update') {
                    
			$data['property_address']= $this->input->post('property_address');
			$data['project_title']   = $this->input->post('project_title');
                        $data['start_date']      = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('start_date'))));
                        $data['end_date']        = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('end_date'))));
			
			$this->db->where('project_id', $param3);
			$this->db->update('p_project', $data);
			$this->session->set_flashdata('flash_message', get_phrase('project_updated'));
                        redirect(base_url() . 'index.php?admin/manage_project', 'refresh');

		} else if ($param1 == 'edit') {
			$page_data['edit_project'] = $this->db->get_where('p_project', array(
				'project_id' => $param2
			))->result_array();
		}
                if ($param1 == 'delete') {
			$this->db->where('project_id', $param2);
			$this->db->delete('p_project');
			$this->session->set_flashdata('flash_message', get_phrase('project_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_project', 'refresh');
		}
                
		$page_data['page_name']    = 'manage_project';
		$page_data['page_title']   = get_phrase('capital_improvement_schedule');
		$page_data['property']     = $this->db->get('property')->result_array();
                $page_data['project_data'] = $this->Search_Model->joinTableData('p_project', 'property', 'p_project.*, property.property_name', 'p_project.property_address = property.property_id');
		$this->load->view('index', $page_data);
	}
        /***MANAGE Quick Links*/
        function manage_links($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
                    
			$data['website_title']   = $this->input->post('website_title');
                        $data['quick_links']     = $this->input->post('quick_links');
                        
			$this->db->insert('p_quick_links', $data);
			$this->session->set_flashdata('flash_message', get_phrase('links_created'));
			redirect(base_url() . 'index.php?admin/manage_links', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
                    
			$data['website_title']   = $this->input->post('website_title');
                        $data['quick_links']     = $this->input->post('quick_links');
                        
			$this->db->where('id', $param3);
			$this->db->update('p_quick_links', $data);
			$this->session->set_flashdata('flash_message', get_phrase('links_updated'));
			redirect(base_url() . 'index.php?admin/manage_links', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_links'] = $this->db->get_where('p_quick_links', array(
				'id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('id', $param2);
			$this->db->delete('p_quick_links');
			$this->session->set_flashdata('flash_message', get_phrase('links_deleted'));
			redirect(base_url() . 'index.php?admin/manage_links', 'refresh');
		}
		$page_data['page_name']   = 'manage_quick_link';
		$page_data['page_title']  = get_phrase('quick_links');
		$page_data['links'] = $this->db->get('p_quick_links')->result_array();
		$this->load->view('index', $page_data);
		
	}
        /**********/
        /***MANAGE pass storer*/
	function universal_pass_storer($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
                if ($param1 == 'create') {
                    
			$data['storer_for']       = $this->input->post('storer_for');
                        $data['site']             = $this->input->post('site');
                        $data['name_status']      = $this->input->post('name_status');
			$data['address_on_file']  = $this->input->post('address_on_file');
                        $data['username']         = $this->input->post('user_name');
			$data['pass']             = $this->input->post('password');
                        $data['account']          = $this->input->post('account');
			$data['website']          = $this->input->post('website');
                        $data['phone']            = $this->input->post('phone');
			$data['notes']            = $this->input->post('note');
                        
			$this->db->insert('pass_storer', $data);
                        
			$this->session->set_flashdata('flash_message', get_phrase('pass_storer_saved'));
			redirect(base_url() . 'index.php?admin/universal_pass_storer', 'refresh');
		}
                if ($param1 == 'edit' && $param2 == 'do_update') {
                    
			$data['storer_for']       = $this->input->post('storer_for');
                        $data['site']             = $this->input->post('site');
                        $data['name_status']      = $this->input->post('name_status');
			$data['address_on_file']  = $this->input->post('address_on_file');
                        $data['username']         = $this->input->post('user_name');
			$data['pass']             = $this->input->post('password');
                        $data['account']          = $this->input->post('account');
			$data['website']          = $this->input->post('website');
                        $data['phone']            = $this->input->post('phone');
			$data['notes']            = $this->input->post('note');
			
			$this->db->where('storer_id', $param3);
			$this->db->update('pass_storer', $data);
			$this->session->set_flashdata('flash_message', get_phrase('pass_storer_updated'));
			
			redirect(base_url() . 'index.php?admin/universal_pass_storer', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_ups'] = $this->db->get_where('pass_storer', array(
				'storer_id' => $param2
			))->result_array();
		}
                
		$page_data['page_name']  = 'ups_entry';
		$page_data['page_title'] = get_phrase('universal_pass_storer');
                $page_data['property']   = $this->db->get('property')->result_array();
		$page_data['gen_admin']  = $this->db->get_where('pass_storer', array('storer_for' => 100))->result_array();
                $page_data['property1']  = $this->db->get_where('pass_storer', array('storer_for' => 1))->result_array();
                $page_data['property2']  = $this->db->get_where('pass_storer', array('storer_for' => 2))->result_array();
		$this->load->view('index', $page_data);
	}
        
        /***MANAGE Marketing*/
	function manage_marketing($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
                if ($param1 == 'create') {
                    
			$data['marketingName']    = $this->input->post('marketingname');
                        $data['postingTitle']     = $this->input->post('postingTitle');
                        $data['description']      = $this->input->post('description');
			$data['shortDescription'] = $this->input->post('shortdescription');
                        $data['propertyName']     = $this->input->post('property_name');
			$data['vacantUnit']       = $this->input->post('vacant_unit');
                        $data['availableDate']    = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('available_date'))));
			$data['website']          = $this->input->post('website');
                        $data['featuredRental']   = $this->input->post('featured_rental');
			$data['published']        = $this->input->post('published');
                        $data['forsale']          = $this->input->post('forsale');
                        $data['AllowPets']        = $this->input->post('AllowPets');
			$data['AllowSmoking']     = $this->input->post('AllowSmoking');
                        $upimage                  = $_FILES['propertyImage']['name'];
                        $tmpupimage               = $_FILES["propertyImage"]["tmp_name"];

                        $data['imageUpload']      = $this->Operation_Model->imageUpload($upimage, $tmpupimage);
                        $data['uploadBy']         = $this->session->userdata('login_type');
                        $data['status']           = 1;

			$this->db->insert('p_marketing', $data);
                        
			$this->session->set_flashdata('flash_message', get_phrase('marketing_data_saved'));
			redirect(base_url() . 'index.php?admin/manage_marketing', 'refresh');
		}
                if ($param1 == 'edit' && $param2 == 'do_update') {
                    
			$data['storer_for']       = $this->input->post('storer_for');
                        $data['site']             = $this->input->post('site');
                        $data['name_status']      = $this->input->post('name_status');
			$data['address_on_file']  = $this->input->post('address_on_file');
                        $data['username']         = $this->input->post('user_name');
			$data['pass']             = $this->input->post('password');
                        $data['account']          = $this->input->post('account');
			$data['website']          = $this->input->post('website');
                        $data['phone']            = $this->input->post('phone');
			$data['notes']            = $this->input->post('note');
			
			$this->db->where('storer_id', $param3);
			$this->db->update('pass_storer', $data);
			$this->session->set_flashdata('flash_message', get_phrase('pass_storer_updated'));
			
			redirect(base_url() . 'index.php?admin/universal_pass_storer', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_ups'] = $this->db->get_where('pass_storer', array(
				'storer_id' => $param2
			))->result_array();
		}
                
		$page_data['page_name']  = 'marketing';
		$page_data['page_title'] = get_phrase('manage_marketing');
                $page_data['property']   = $this->Search_Model->getAllDataFromTable('property');
                $page_data['marketing']      = $this->Search_Model->joinTableData('p_marketing', 'unit', 'p_marketing.*,unit.unit_name,unit.unit_type,unit.trent', 'p_marketing.vacantUnit = unit.unit_id');
		$this->load->view('index', $page_data);
	}
	
        /*******VIEW PAYMENT REPORT	********/
	function view_payment($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']  = 'view_payment';
		$page_data['page_title'] = get_phrase('view_payment');
                
                if($param1 == 'weekly'){
                    
                   $start_date = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('start_date'))));
                   $end_date   = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('end_date'))));
                    
                    $page_data['payments']   = $this->db->get_where('p_lease', array('moveinDate' => $start_date, 'moveoutDate' => $end_date))->result_array();
                }
		$this->load->view('index', $page_data);
	}
	
	/***MANAGE NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
	function manage_noticeboard($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['notice_title']     = $this->input->post('notice_title');
			$data['notice']           = $this->input->post('notice');
			$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
			$this->db->insert('noticeboard', $data);
			$this->session->set_flashdata('flash_message', get_phrase('report_created'));
			
			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['notice_title']     = $this->input->post('notice_title');
			$data['notice']           = $this->input->post('notice');
			$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
			$this->db->where('notice_id', $param3);
			$this->db->update('noticeboard', $data);
			$this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('noticeboard', array(
				'notice_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('notice_id', $param2);
			$this->db->delete('noticeboard');
			$this->session->set_flashdata('flash_message', get_phrase('notice_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		}
		$page_data['page_name']  = 'manage_noticeboard';
		$page_data['page_title'] = get_phrase('manage_noticeboard');
		$page_data['notices']    = $this->db->get('noticeboard')->result_array();
		$this->load->view('index', $page_data);
	}
        
        /***MANAGE NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
	function manage_late_fee($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
                    
			$data['fee_title']     = $this->input->post('fee_title');
			$data['fee_type']      = $this->input->post('fee_type');
			$data['fee_frequency'] = $this->input->post('frequency');
			$data['fee_amount']    = $this->input->post('amount');
                        $data['fee_ratio']     = $this->input->post('ratio');
                        $data['due_day']       = $this->input->post('due_day');
                        
			$this->db->insert('p_late_fee_setting', $data);
			$this->session->set_flashdata('flash_message', get_phrase('late_fee_created'));
			
			redirect(base_url() . 'index.php?admin/manage_late_fee', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['notice_title']     = $this->input->post('notice_title');
			$data['notice']           = $this->input->post('notice');
			$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
			$this->db->where('notice_id', $param3);
			$this->db->update('noticeboard', $data);
			$this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('noticeboard', array(
				'notice_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('notice_id', $param2);
			$this->db->delete('noticeboard');
			$this->session->set_flashdata('flash_message', get_phrase('notice_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		}
		$page_data['page_name']  = 'manage_late_fee';
		$page_data['page_title'] = get_phrase('manage_late_fee_rule');
		$page_data['late_fee']    = $this->db->get('p_late_fee_setting')->result_array();
		$this->load->view('index', $page_data);
	}
	
	
	/*****SITE/SYSTEM SETTINGS*********/
	function system_settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param2 == 'do_update') {
			$this->db->where('type', $param1);
			$this->db->update('settings', array(
				'description' => $this->input->post('description')
			));
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
		}
		if ($param1 == 'upload_logo') {
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
		}
		$page_data['page_name']  = 'system_settings';
		$page_data['page_title'] = get_phrase('system_settings');
		$page_data['settings']   = $this->db->get('settings')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
	function manage_profile($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'update_profile_info') {
			$data['name']    = $this->input->post('name');
			$data['email']   = $this->input->post('email');
			$data['address'] = $this->input->post('address');
			$data['phone']   = $this->input->post('phone');
			
			$this->db->where('admin_id', $this->session->userdata('admin_id'));
			$this->db->update('admin', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
		}
		if ($param1 == 'change_password') {
			$data['password']             = $this->input->post('password');
			$data['new_password']         = $this->input->post('new_password');
			$data['confirm_new_password'] = $this->input->post('confirm_new_password');
			
			$current_password = $this->db->get_where('admin', array(
				'admin_id' => $this->session->userdata('admin_id')
			))->row()->password;
			if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
				$this->db->where('admin_id', $this->session->userdata('admin_id'));
				$this->db->update('admin', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', get_phrase('password_updated'));
			} else {
				$this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
			}
			
			redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
		}
		$page_data['page_name']    = 'manage_profile';
		$page_data['page_title']   = get_phrase('manage_profile');
		$page_data['edit_profile'] = $this->db->get_where('admin', array(
			'admin_id' => $this->session->userdata('admin_id')
		))->result_array();
		$this->load->view('index', $page_data);
	}
	
}
