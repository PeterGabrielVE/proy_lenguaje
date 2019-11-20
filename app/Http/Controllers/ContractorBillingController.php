<?php

namespace App\Http\Controllers;

use App\ContractorBillingModel;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

class ContractorBillingController extends Controller
{
    // start get functions
    public function index(){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_contractor_billings = \DB::select('SELECT * FROM contractor_billing limit 0, 50');
        return view( 'contractor_billing_views', ['contractor_billings'=>$get_contractor_billings] );
    }

    public function contractorBillingsListWithPageNo($getPageNo = null){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $result = ContractorBillingModel::modelContractorBillingsListWithPageNo($getPageNo);
        return view( 'contractor_billing_views/contractor_billing', $result);
    }

    public function getContractorBillingsWithID($the_id){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_contractor_billing_with_id_sql = \DB::select("SELECT * FROM contractor_billing WHERE ID = $the_id");
        return view('contractor_billing_views/contractor_billing_single', ['contractor_billings'=>$get_contractor_billing_with_id_sql] );
    }

    public function getContractorBillingsWithID2(){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $the_id = htmlspecialchars(trim($_GET['g_the_id']));
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_contractor_billing_with_id_sql = \DB::select("SELECT * FROM contractor_billing WHERE ID = $the_id");
        return view('contractor_billing_views/contractor_billing_single', ['contractor_billings'=>$get_contractor_billing_with_id_sql] );
    }

    //start edit functions
    public function getContractorBillingToEditWithID($the_id){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_contractor_billing_with_id_sql = \DB::select("SELECT * FROM contractor_billing WHERE ID = $the_id");
        return view('contractor_billing_views/contractor_billing_edit', ['contractor_billing_with_id'=>$get_contractor_billing_with_id_sql] );
    }

    public function editContractorBillingsWithID(Request $request){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $update_contractor_billing_sql_code = "UPDATE contractor_billing SET 
            ConBill_Status = " . \DB::connection()->getPDO()->quote(Input::get('Status')) .", 
			ConBill_Con_Number = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Number')) .", 
			ConBill_Con_DBA = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_DBA')) .", 
			ConBill_First_Name = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_First_Name')) .", 
			ConBill_Last_Name = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Last_Name')) .", 
			ConBill_Address_Street_1 = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Address_Street_1')) .", 
			ConBill_Address_Street_2 = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Address_Street_2')) .", 
			ConBill_City = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_City')) .", 
			ConBill_State = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_State')) .", 
			ConBill_Zip = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Zip')) .", 
			ConBill_Job_ID = " . \DB::connection()->getPDO()->quote(Input::get('Job_ID')) .", 
			ConBill_Job_Name = " . \DB::connection()->getPDO()->quote(Input::get('Job_Name')) .", 
			ConBill_Jobs_Service_Name = " . \DB::connection()->getPDO()->quote(Input::get('Jobs_Service_Name')) .", 
			ConBill_Jobs_Service_Name_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Jobs_Service_Name_Rate')) .", 
			ConBill_Jobs_Customer_Number = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Number')) .", 
			ConBill_Jobs_Customer_Company = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Company')) .", 
			ConBill_Jobs_Assignment_Location = " . \DB::connection()->getPDO()->quote(Input::get('Assignment_Location')) .", 
			ConBill_Job_Actual_Start_Time = " . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Actual_Start_Time')) ) .", 
			ConBill_Job_Actual_Finish_Time = " . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Actual_Finish_Time')) ) .", 
			ConBill_Job_Total_Billing_Time = " . \DB::connection()->getPDO()->quote(Input::get('Total_Billing_Time')) .", 
			ConBill_Con_Billing_Service_Name = " . \DB::connection()->getPDO()->quote(Input::get('Billing_Service_Name')) .", 
			ConBill_Con_Billing_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Billing_Rate')) .",
			ConBill_Con_Billing_Service_Name_Total = " . \DB::connection()->getPDO()->quote(Input::get('Billing_Service_Name_Total')) .",
			ConBill_Job_LEP_Name = " . \DB::connection()->getPDO()->quote(Input::get('LEP_Name')) .",
			ConBill_Job_Special_Request = " . \DB::connection()->getPDO()->quote(Input::get('Special_Request')) .",
			ConBill_Job_Special_request_Fee = " . \DB::connection()->getPDO()->quote(Input::get('Special_Request_Fee')) .", 
			ConBill_Job_No_Show_Fee = " . \DB::connection()->getPDO()->quote(Input::get('No_Show_Fee')) .", 
			ConBill_Job_Cancellation_Fee = " . \DB::connection()->getPDO()->quote(Input::get('Cancellation_Fee')) .", 
			ConBill_Job_Mileage = " . \DB::connection()->getPDO()->quote(Input::get('Mileage')) .", 
			ConBill_Job_Mileage_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Mileage_Rate')) .", 
			ConBill_Job_Con_Mileage_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Mileage_Rate')) .", 
			ConBill_Job_Con_Mileage_Rate_Fee = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Mileage_Rate_Fee')) .", 
			ConBill_Job_Parking_Fees = " . \DB::connection()->getPDO()->quote(Input::get('Parking_Fees')) .", 
			ConBill_Job_Travel_Time = " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time')) .", 
			ConBill_Job_Travel_Time_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_Rate')) .", 
			ConBill_Job_Con_Travel_Time_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Travel_Time_Rate')) .", 
			ConBill_job_Con_Travel_Time_Rate_Fee = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Travel_Time_Rate_Fee')) .", 
			ConBill_Job_Post_Outcome = " . \DB::connection()->getPDO()->quote(Input::get('Post_Outcome')) .", 
			ConBill_Job_InvoiceTotal = " . \DB::connection()->getPDO()->quote(Input::get('InvoiceTotal')) .", 
			ConBill_Job_BillTotal = " . \DB::connection()->getPDO()->quote(Input::get('BillTotal')) .", 
			ConBill_Notes = " . \DB::connection()->getPDO()->quote(Input::get('Notes')) .", 
			ConBill_Attachments = " . \DB::connection()->getPDO()->quote(Input::get('Attachments')) ." 
            WHERE ID =  " . Input::get('contractor_billing_id');

        // var_dump($update_contractor_billing_sql_code);
        // die();

        $update_contractor_billing_with_id_sql = \DB::update($update_contractor_billing_sql_code);
        // var_dump($update_contractor_billing_with_id_sql);
        // die();

        if ($update_contractor_billing_with_id_sql){
            return response()->json("Contractor Billing Successfully Updated");
        } else {
            return response()->json("Error. Could Not Update Invoices");
        }
        
    }
    //end edit functions

    ////////////////////////////////////////////////////////////

    // start create functions
    public function getCreateContractorBillingView(Request $the_request){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        return view('contractor_billing_views/contractor_billing_create');
    }
    
    public function createContractorBilling(Request $the_request){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $create_new_contractor_billing_sql_code = "
            INSERT INTO contractor_billing 
                (   ID,
					ConBill_Status,
					ConBill_Con_Number,
					ConBill_Con_DBA,
					ConBill_First_Name,
					ConBill_Last_Name,
					ConBill_Address_Street_1,
					ConBill_Address_Street_2,
					ConBill_City,
					ConBill_State,
					ConBill_Zip,
					ConBill_Job_ID,
					ConBill_Job_Name,
					ConBill_Jobs_Service_Name,
					ConBill_Jobs_Service_Name_Rate,
					ConBill_Jobs_Customer_Number,
					ConBill_Jobs_Customer_Company,
					ConBill_Jobs_Assignment_Location,
					ConBill_Job_Actual_Start_Time,
					ConBill_Job_Actual_Finish_Time,
					ConBill_Job_Total_Billing_Time,
					ConBill_Con_Billing_Service_Name,
					ConBill_Con_Billing_Rate,
					ConBill_Con_Billing_Service_Name_Total,
					ConBill_Job_LEP_Name,
					ConBill_Job_Special_Request,
					ConBill_Job_Special_request_Fee,
					ConBill_Job_No_Show_Fee,
					ConBill_Job_Cancellation_Fee,
					ConBill_Job_Mileage,
					ConBill_Job_Mileage_Rate,
					ConBill_Job_Con_Mileage_Rate,
					ConBill_Job_Con_Mileage_Rate_Fee,
					ConBill_Job_Parking_Fees,
					ConBill_Job_Travel_Time,
					ConBill_Job_Travel_Time_Rate,
					ConBill_Job_Con_Travel_Time_Rate,
					ConBill_job_Con_Travel_Time_Rate_Fee,
					ConBill_Job_Post_Outcome,
					ConBill_Job_InvoiceTotal,
					ConBill_Job_BillTotal,
					ConBill_Notes,
					ConBill_Attachments
                )
            VALUES 
                (
                    DEFAULT,
                    " . \DB::connection()->getPDO()->quote(Input::get('Status')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Contractor_Number')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Contractor_DBA')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('First_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Last_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Address_Street_1')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Address_Street_2')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('City')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('State')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Zip')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_ID')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Jobs_Service_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Jobs_Service_Name_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Jobs_Customer_Number')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Jobs_Customer_Company')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Jobs_Assignment_Location')) .", 
					" . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Job_Actual_Start_Time')) ) .", 
					" . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Job_Actual_Finish_Time')) ) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Total_Billing_Time')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Contractor_Billing_Service_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Contractor_Billing_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Contractor_Billing_Service_Name_Total')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_LEP_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Special_Request')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Special_request_Fee')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_No_Show_Fee')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Cancellation_Fee')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Mileage')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Mileage_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Con_Mileage_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Con_Mileage_Rate_Fee')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Parking_Fees')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Travel_Time')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Travel_Time_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Con_Travel_Time_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('job_Con_Travel_Time_Rate_Fee')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_Post_Outcome')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_InvoiceTotal')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Job_BillTotal')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Notes')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Attachments')) .
                ")";
        $create_new_contractor_billing = \DB::insert($create_new_contractor_billing_sql_code);
        // var_dump($create_new_contractor_billing);
        // die();
        if ($create_new_contractor_billing){
            return response()->json("Contractor Billing Created Successfully");
        } else {
            return response()->json("Error. Could Not Create Invoices");
        }
    }
    // end create functions

    
    public function deleteContractorBilling(Request $the_id){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
    // public function deleteInvoices($the_id){
        $delete_contractor_billing_sql_code = 
        " 
            DELETE FROM contractor_billing WHERE 
            ID = ". \DB::connection()->getPDO()->quote(Input::get('get_the_id')) ." 
        ";
        $delete_invoices = \DB::delete($delete_contractor_billing_sql_code);
        // var_dump($delete_invoices);
        // die();
        if ($delete_invoices){
            return response()->json("Contractor Billing Deleted Successfully");
        } else {
            return response()->json("Error. Could Not Delete Contractor Billing");
        }
        //$create_new_contractor_billing_sql_code = "DELETE FROM contractor_billing WHERE ID = ". $the_id ."  ";
    }


}

