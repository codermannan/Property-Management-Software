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

class Report extends CI_Controller
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
	
        /***MANAGE operation**/
	function manage_operation($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		//cash flow report
                if ($param1 == 'cashflow') {
                    
                        $page_data['page_name']      = 'cash_flow_r';
                        $page_data['page_title']     = get_phrase('operations_report');
                        $page_data['property']       = $this->db->get('property')->result_array();
                        
                        $this->load->view('index', $page_data);
                }
                //graphical report
                if ($param1 == 'plot') {
                    
                        $page_data['page_name']      = 'reports/graphical_report';
                        $page_data['page_title']     = get_phrase('all_operating_expenses');
                        $page_data['property']       = $this->db->get('property')->result_array();
                        
                        //start income
                            $page_data['january']  = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-01-01'), strtotime($param3.'-01-31'));
                            $page_data['february'] = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-02-01'), strtotime($param3.'-02-28'));
                            $page_data['march']    = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-03-01'), strtotime($param3.'-03-31'));
                            $page_data['april']    = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-04-01'), strtotime($param3.'-04-30'));
                            $page_data['may']      = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-05-01'), strtotime($param3.'-05-31'));
                            $page_data['june']     = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-06-01'), strtotime($param3.'-06-30'));
                            $page_data['july']     = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-07-01'), strtotime($param3.'-07-31'));
                            $page_data['august']   = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-08-01'), strtotime($param3.'-08-31'));
                            $page_data['september']= $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-09-01'), strtotime($param3.'-09-30'));
                            $page_data['october']  = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-10-01'), strtotime($param3.'-10-31'));
                            $page_data['november'] = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-11-01'), strtotime($param3.'-11-30'));
                            $page_data['december'] = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-12-01'), strtotime($param3.'-12-31'));
                        //end income
                        
                        //expense
                        //start
                            $page_data['ejanuary']  = $this->Accounting_Model->monthlyPropertyExpense($param3.'-01-01',$param3.'-01-31',$param2);
                            $page_data['efebruary'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-02-01',$param3.'-02-28',$param2);
                            $page_data['emarch']    = $this->Accounting_Model->monthlyPropertyExpense($param3.'-03-01',$param3.'-03-31',$param2);
                            $page_data['eapril']    = $this->Accounting_Model->monthlyPropertyExpense($param3.'-04-01',$param3.'-04-30',$param2);
                            $page_data['emay']      = $this->Accounting_Model->monthlyPropertyExpense($param3.'-05-01',$param3.'-05-31',$param2);
                            $page_data['ejune']     = $this->Accounting_Model->monthlyPropertyExpense($param3.'-06-01',$param3.'-06-30',$param2);
                            $page_data['ejuly']     = $this->Accounting_Model->monthlyPropertyExpense($param3.'-07-01',$param3.'-07-31',$param2);
                            $page_data['eaugust']   = $this->Accounting_Model->monthlyPropertyExpense($param3.'-08-01',$param3.'-08-31',$param2);
                            $page_data['eseptember']= $this->Accounting_Model->monthlyPropertyExpense($param3.'-09-01',$param3.'-09-30',$param2);
                            $page_data['eoctober']  = $this->Accounting_Model->monthlyPropertyExpense($param3.'-10-01',$param3.'-10-31',$param2);
                            $page_data['enovember'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-11-01',$param3.'-11-30',$param2);
                            $page_data['edecember'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-12-01',$param3.'-12-31',$param2);
                        //end
                        //end expense
                        //cashflow
                            $page_data['janCash'] = ($page_data['january'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['ejanuary']));
                            $page_data['febCash'] = ($page_data['february'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['efebruary']));
                            $page_data['marCash'] = ($page_data['march'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['emarch']));
                            $page_data['aprCash'] = ($page_data['april'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['eapril']));
                            $page_data['mayCash'] = ($page_data['may'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['emay']));
                            $page_data['juneCash'] = ($page_data['june'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['ejune']));
                            $page_data['julyCash'] = ($page_data['july'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['ejuly']));
                            $page_data['augCash'] = ($page_data['august'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['eaugust']));
                            $page_data['sepCash'] = ($page_data['september'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['eseptember']));
                            $page_data['octCash'] = ($page_data['october'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['eoctober']));
                            $page_data['novCash'] = ($page_data['november'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['enovember']));
                            $page_data['decCash'] = ($page_data['december'][0]['SUM(a.cr_amt)'] - $this->Accounting_Model->summationofMontlyExpense($page_data['edecember']));
                        //cashflow
                        
                        $this->load->view('index', $page_data);
                }
                if ($param1 == 'getYear') {
                    
                        $page_data['page_name']      = 'cash_flow_r';
                        $page_data['page_title']     = get_phrase('operations_report');
                        $page_data['year']           = $this->input->post('findYear');
                        $page_data['property']       = $this->db->get('property')->result_array();
                        
                        $this->load->view('index', $page_data);
                }
		if ($param1 == 'Weekly') {
                        $page_data['page_name']      = 'reports/weekly_cash_flow_report';
                        $page_data['page_title']     = get_phrase('weekly_cash_flow_report');
                        //start income
                            $page_data['january']  = $this->Accounting_Model->weeklyReport($param3.'-01-01',$param2);
                            $page_data['february'] = $this->Accounting_Model->weeklyReport($param3.'-02-01',$param2);
                            $page_data['march']    = $this->Accounting_Model->weeklyReport($param3.'-03-01',$param2);
                            $page_data['april']    = $this->Accounting_Model->weeklyReport($param3.'-04-01',$param2);
                            $page_data['may']      = $this->Accounting_Model->weeklyReport($param3.'-05-01',$param2);
                            $page_data['june']     = $this->Accounting_Model->weeklyReport($param3.'-06-01',$param2);
                            $page_data['july']     = $this->Accounting_Model->weeklyReport($param3.'-07-01',$param2);
                            $page_data['august']   = $this->Accounting_Model->weeklyReport($param3.'-08-01',$param2);
                            $page_data['september']= $this->Accounting_Model->weeklyReport($param3.'-09-01',$param2);
                            $page_data['october']  = $this->Accounting_Model->weeklyReport($param3.'-10-01',$param2);
                            $page_data['november'] = $this->Accounting_Model->weeklyReport($param3.'-11-01',$param2);
                            $page_data['december'] = $this->Accounting_Model->weeklyReport($param3.'-12-01',$param2);
                        //end income
                        //expense
                        //start
                            $page_data['ejanuary']  = $this->Accounting_Model->monthlyPropertyExpense($param3.'-01-01',$param3.'-01-31',$param2);
                            $page_data['efebruary'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-02-01',$param3.'-02-28',$param2);
                            $page_data['emarch']    = $this->Accounting_Model->monthlyPropertyExpense($param3.'-03-01',$param3.'-03-31',$param2);
                            $page_data['eapril']    = $this->Accounting_Model->monthlyPropertyExpense($param3.'-04-01',$param3.'-04-30',$param2);
                            $page_data['emay']      = $this->Accounting_Model->monthlyPropertyExpense($param3.'-05-01',$param3.'-05-31',$param2);
                            $page_data['ejune']     = $this->Accounting_Model->monthlyPropertyExpense($param3.'-06-01',$param3.'-06-30',$param2);
                            $page_data['ejuly']     = $this->Accounting_Model->monthlyPropertyExpense($param3.'-07-01',$param3.'-07-31',$param2);
                            $page_data['eaugust']   = $this->Accounting_Model->monthlyPropertyExpense($param3.'-08-01',$param3.'-08-31',$param2);
                            $page_data['eseptember']= $this->Accounting_Model->monthlyPropertyExpense($param3.'-09-01',$param3.'-09-30',$param2);
                            $page_data['eoctober']  = $this->Accounting_Model->monthlyPropertyExpense($param3.'-10-01',$param3.'-10-31',$param2);
                            $page_data['enovember'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-11-01',$param3.'-11-30',$param2);
                            $page_data['edecember'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-12-01',$param3.'-12-31',$param2);
                        //end
                        //end expense
                        $this->load->view('index', $page_data);
		}
                if ($param1 == 'Monthly') {
                        $page_data['page_name']      = 'reports/monthly_cash_flow_report';
                        $page_data['page_title']     = get_phrase('monthly_cash_flow_report');
                        //start income
                            $page_data['january']  = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-01-01'), strtotime($param3.'-01-31'));
                            $page_data['february'] = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-02-01'), strtotime($param3.'-02-28'));
                            $page_data['march']    = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-03-01'), strtotime($param3.'-03-31'));
                            $page_data['april']    = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-04-01'), strtotime($param3.'-04-30'));
                            $page_data['may']      = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-05-01'), strtotime($param3.'-05-31'));
                            $page_data['june']     = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-06-01'), strtotime($param3.'-06-30'));
                            $page_data['july']     = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-07-01'), strtotime($param3.'-07-31'));
                            $page_data['august']   = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-08-01'), strtotime($param3.'-08-31'));
                            $page_data['september']= $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-09-01'), strtotime($param3.'-09-30'));
                            $page_data['october']  = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-10-01'), strtotime($param3.'-10-31'));
                            $page_data['november'] = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-11-01'), strtotime($param3.'-11-30'));
                            $page_data['december'] = $this->Accounting_Model->getPropertyIncome($param2,  strtotime($param3.'-12-01'), strtotime($param3.'-12-31'));
                        //end income
                        //expense
                        //start
                            $page_data['ejanuary']  = $this->Accounting_Model->monthlyPropertyExpense($param3.'-01-01',$param3.'-01-31',$param2);
                            $page_data['efebruary'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-02-01',$param3.'-02-28',$param2);
                            $page_data['emarch']    = $this->Accounting_Model->monthlyPropertyExpense($param3.'-03-01',$param3.'-03-31',$param2);
                            $page_data['eapril']    = $this->Accounting_Model->monthlyPropertyExpense($param3.'-04-01',$param3.'-04-30',$param2);
                            $page_data['emay']      = $this->Accounting_Model->monthlyPropertyExpense($param3.'-05-01',$param3.'-05-31',$param2);
                            $page_data['ejune']     = $this->Accounting_Model->monthlyPropertyExpense($param3.'-06-01',$param3.'-06-30',$param2);
                            $page_data['ejuly']     = $this->Accounting_Model->monthlyPropertyExpense($param3.'-07-01',$param3.'-07-31',$param2);
                            $page_data['eaugust']   = $this->Accounting_Model->monthlyPropertyExpense($param3.'-08-01',$param3.'-08-31',$param2);
                            $page_data['eseptember']= $this->Accounting_Model->monthlyPropertyExpense($param3.'-09-01',$param3.'-09-30',$param2);
                            $page_data['eoctober']  = $this->Accounting_Model->monthlyPropertyExpense($param3.'-10-01',$param3.'-10-31',$param2);
                            $page_data['enovember'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-11-01',$param3.'-11-30',$param2);
                            $page_data['edecember'] = $this->Accounting_Model->monthlyPropertyExpense($param3.'-12-01',$param3.'-12-31',$param2);
                        //end
                        //end expense
                        $this->load->view('index', $page_data);
		}
		
	}
        
        
        
}
