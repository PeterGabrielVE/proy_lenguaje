<?php
namespace App\Http\Controllers;

use App\InvoicesModel;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

ini_set('max_execution_time', '5000' );

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

use Auth;

use Mockery as m;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Classes\PHPExcel;
use Excel;

//ini_set('sys_temp_dir', '/Applications/XAMPP/xamppfiles/temp');
//'sys_temp_dir' = '/Applications/XAMPP/xamppfiles/temp';

class InvoicesController extends Controller
{
    // start get functions
    public function index(){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_invoices = \DB::select('SELECT * FROM invoices limit 0, 50');
        return view( 'invoices_views', ['invoices'=>$get_invoices] );
    }

    public function invoicesListWithPageNo($getPageNo = null){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $result = InvoicesModel::modelInvoicesListWithPageNo($getPageNo);
        return view( 'invoices_views/invoices', $result);
    }

    public function getInvoicesWithID($the_id){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_invoices_with_id_sql = \DB::select("SELECT * FROM invoices WHERE ID = $get_the_id");
        return view('invoices_views/invoices_single', ['invoices'=>$get_invoices_with_id_sql] );
    }

    public function getInvoicesWithID2(){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $the_id = htmlspecialchars(trim($_GET['g_the_id']));
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_invoices_with_id_sql = \DB::select("SELECT * FROM invoices WHERE ID = $get_the_id");
        return view('invoices_views/invoices_single', ['invoices'=>$get_invoices_with_id_sql] );
    }

    //start edit functions
    public function getInvoicesToEditWithID($the_id){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_invoices_with_id_sql = \DB::select("SELECT * FROM invoices WHERE ID = $get_the_id");
        return view('invoices_views/invoices_edit', ['invoices_with_id'=>$get_invoices_with_id_sql] );
    }

    public function editInvoicesWithID(Request $request){
    	if (!(Auth::check())) {
            return redirect('/login');
        }

        if ( count($request->file('invoice_edit_file')) > 0 ) {
            $all_files_array = array();
            for ($i=0; $i < count($request->file('invoice_edit_file')); $i++) { 
                
                $file = $request->file('invoice_edit_file')[$i];
                if ( !isset( $file ) ) {
                    $file_name = " ";
                } else{
                    $upload_succes = Storage::putfile('public/llcuploads', $request->file('invoice_edit_file')[$i]);
                    $file_name = substr($upload_succes, 18);
                }  
                array_push($all_files_array, $file_name);
            }
            
            $get_all_files_array_0 = implode(",", $all_files_array);
            $get_all_files_array = $get_all_files_array_0 . ", " . Input::get('edit_invoice_old_val');
            // $get_all_files_array . ", " . Input::get('edit_invoice_old_val'); 

            // var_dump($get_all_files_array);
            // var_dump(Input::get('edit_invoice_old_val'));

            // var_dump($get_all_files_array . ", " . Input::get('edit_invoice_old_val'));
            // die();

        } else if (is_null($request->file('invoice_edit_file'))){
            // $get_all_files_array = " ";
            $get_all_files_array = Input::get('edit_invoice_old_val');
        } else {
            $get_all_files_array = Input::get('edit_invoice_old_val');
        }

        $update_invoices_sql_code = "UPDATE invoices SET 
            		Invoice_Status = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Status')) .", 
					Invoice_Jobs_Number = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Number')) .", 
					Invoice_Jobs_Name = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Name')) .", 
					Invoice_Jobs_Provider_Name = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Provider_Name')) .", 
					Invoice_Jobs_Service_Address = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Service_Address')) .", 
					Invoice_Jobs_PO_Number = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_PO_Number')) .", 
					Invoice_Job_Cus_Number = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Job_Cus_Number')) .", 
					Invoice_Cus_Company_Name = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Company_Name')) .", 
					Invoice_Cus_Billing_Contact_Name_First = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Contact_Name_First')) .", 
					Invoice_Cus_Billing_Contact_Name_last = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Contact_Name_last')) .", 
					Invoice_Cus_Billing_Company_Street_1 = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Company_Street_1')) .", 
					Invoice_Cus_Billing_Company_Street_2 = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Company_Street_2')) .", 
					Invoice_Cus_Billing_City = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_City')) .", 
					Invoice_Cus_Billing_State = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_State')) .", 
					Invoice_Cus_Billing_Zip = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Zip')) .", 
					Invoice_Cus_Billing_Term = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Term')) .", 
					Invoice_Cus_Billing_E_mail = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_E_mail')) .", 
					Invoice_Return_Company = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_Company')) .", 
					Invoice_Return_Contact_Name = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_Contact_Name')) .", 
					Invoice_Return_Street_1 = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_Street_1')) .", 
					Invoice_return_Street_2 = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_return_Street_2')) .", 
					Invoice_Return_City = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_City')) .", 
					Invoice_Return_State = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_State')) .", 
					Invoice_Return_Zip = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_Zip')) .", 
					Invoice_Jobs_Contractor_ID = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Contractor_ID')) .", 
					Invoice_Jobs_Contractor_First_Name = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Contractor_First_Name')) .", 
					Invoice_Jobs_Contractors_Last_Name = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Contractors_Last_Name')) .", 
					Invoice_Jobs_Service_Name = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Service_Name')) .", 
					Invoice_Jobs_Sevice_Name_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Sevice_Name_Rate')) .", 
					Invoice_Jobs_Service_Name_Total = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Service_Name_Total')) .", 
					Invoice_Jobs_Mileage = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Mileage')) .", 
					Invoice_Jobs_Mileage_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Mileage_Rate')) .", 
					Invoice_Jobs_Mileage_Fee = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Mileage_Fee')) .", 
					Invoice_Jobs_Parking_Fees = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Parking_Fees')) .", 
					Invoice_Jobs_Travel_Time = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Travel_Time')) .", 
					Invoice_Jobs_Travel_Time_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Travel_Time_Rate')) .", 
					Invoice_Jobs_Travel_Time_Fee = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Travel_Time_Fee')) .", 
					Invoice_Jobs_LEP_Name = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_LEP_Name')) .", 
					Invoice_Jobs_Special_Request = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Special_Request')) .", 
					Invoice_Jobs_Special_Request_Total = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Special_Request_Total')) .", 
					Invoice_Jobs_Post_Outcome = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Post_Outcome')) .", 
					Invoice_Jobs_Post_Outcome_Fee = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Post_Outcome_Fee')) .", 
					Invoice_Jobs_Scheduled_Appointment_Time = " . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Invoice_Jobs_Scheduled_Appointment_Time')) ) .", 
					Invoice_Billing_Time = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Billing_Time')) .", 
					Invoice_Line_Item_1_Note = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_1_Note')) .", 
					Invoice_Line_Item_1 = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_1')) .", 
					Invoice_Line_Item_2_Note = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_2_Note')) .", 
					Invoice_Line_Item_2 = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_2')) .", 
					Invoice_Line_Item_3_Note = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_3_Note')) .", 
					Invoice_Line_Item_3 = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_3')) .", 
					Invoice_Total = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Total')) .", 
					Invoice_Notes = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Notes')) .", 
					Invoice_Attachments = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Attachments')) .", 
					Invoice_Due_Date = " . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Invoice_Due_Date')) ) .", 
					Invoice_Jobs_Request_FirstName = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Request_FirstName')) .", 
					Invoice_Jobs_Request_LastName  = " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Request_LastName')) .",
					attachments = '". $get_all_files_array ."'
            		WHERE ID =  " . Input::get('invoice_id');

        // var_dump($update_invoices_sql_code);
        // die();

        $update_invoices_with_id_sql = \DB::update($update_invoices_sql_code);
        // var_dump($update_invoices_with_id_sql);
        // die();

        if ($update_invoices_with_id_sql){
            return response()->json("Invoice Successfully Updated");
        } else {
            return response()->json("Error. Could Not Update Invoices");
        }
        
    }
    //end edit functions

    ////////////////////////////////////////////////////////////

    // start create functions
    public function getCreateInvoicesView(Request $the_request){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        return view('invoices_views/invoices_create');
    }
    
    public function createInvoices(Request $the_request){
    	if (!(Auth::check())) {
            return redirect('/login');
        }

        $all_files_array = array();

        for ($i=0; $i < count($the_request->file('invoice_create_file_upload')); $i++) { 
            
            $file = $the_request->file('invoice_create_file_upload')[$i];
            if ( !isset( $file ) ) {
                $file_name = " ";
            } else{
                $upload_succes = Storage::putfile('public/llcuploads', $the_request->file('invoice_create_file_upload')[$i]);
                $file_name = substr($upload_succes, 18);
            }  
            array_push($all_files_array, $file_name);
        }
        $get_all_files_array = implode(",", $all_files_array);

        $create_new_invoices_sql_code = "
            INSERT INTO invoices 
                (   ID,
					Invoice_Status,
					Invoice_Jobs_Number,
					Invoice_Jobs_Name,
					Invoice_Jobs_Provider_Name,
					Invoice_Jobs_Service_Address,
					Invoice_Jobs_PO_Number,
					Invoice_Job_Cus_Number,
					Invoice_Cus_Company_Name,
					Invoice_Cus_Billing_Contact_Name_First,
					Invoice_Cus_Billing_Contact_Name_last,
					Invoice_Cus_Billing_Company_Street_1,
					Invoice_Cus_Billing_Company_Street_2,
					Invoice_Cus_Billing_City,
					Invoice_Cus_Billing_State,
					Invoice_Cus_Billing_Zip,
					Invoice_Cus_Billing_Term,
					Invoice_Cus_Billing_E_mail,
					Invoice_Return_Company,
					Invoice_Return_Contact_Name,
					Invoice_Return_Street_1,
					Invoice_return_Street_2,
					Invoice_Return_City,
					Invoice_Return_State,
					Invoice_Return_Zip,
					Invoice_Jobs_Contractor_ID,
					Invoice_Jobs_Contractor_First_Name,
					Invoice_Jobs_Contractors_Last_Name,
					Invoice_Jobs_Service_Name,
					Invoice_Jobs_Sevice_Name_Rate,
					Invoice_Jobs_Service_Name_Total,
					Invoice_Jobs_Mileage,
					Invoice_Jobs_Mileage_Rate,
					Invoice_Jobs_Mileage_Fee,
					Invoice_Jobs_Parking_Fees,
					Invoice_Jobs_Travel_Time,
					Invoice_Jobs_Travel_Time_Rate,
					Invoice_Jobs_Travel_Time_Fee,
					Invoice_Jobs_LEP_Name,
					Invoice_Jobs_Special_Request,
					Invoice_Jobs_Special_Request_Total,
					Invoice_Jobs_Post_Outcome,
					Invoice_Jobs_Post_Outcome_Fee,
					Invoice_Jobs_Scheduled_Appointment_Time,
					Invoice_Billing_Time,
					Invoice_Line_Item_1_Note,
					Invoice_Line_Item_1,
					Invoice_Line_Item_2_Note,
					Invoice_Line_Item_2,
					Invoice_Line_Item_3_Note,
					Invoice_Line_Item_3,
					Invoice_Total,
					Invoice_Notes,
					Invoice_Attachments,
					Invoice_Due_Date,
					Invoice_Jobs_Request_FirstName,
					Invoice_Jobs_Request_LastName,
					attachments
                )
            VALUES 
                (
                    DEFAULT,
                    " . \DB::connection()->getPDO()->quote(Input::get('Invoice_Status')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Number')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Provider_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Service_Address')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_PO_Number')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Job_Cus_Number')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Company_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Contact_Name_First')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Contact_Name_last')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Company_Street_1')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Company_Street_2')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_City')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_State')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Zip')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_Term')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Cus_Billing_E-mail')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_Company')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_Contact_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_Street_1')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_return_Street_2')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_City')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_State')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Return_Zip')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Contractor_ID')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Contractor_First_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Contractors_Last_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Service_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Sevice_Name_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Service_Name_Total')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Mileage')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Mileage_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Mileage_Fee')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Parking_Fees')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Travel_Time')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Travel_Time_Rate')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Travel_Time_Fee')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_LEP_Name')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Special_Request')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Special_Request_Total')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Post_Outcome')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Post_Outcome_Fee')) .", 
					" . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Invoice_Jobs_Scheduled_Appointment_Time')) ) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Billing_Time')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_1_Note')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_1')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_2_Note')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_2')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_3_Note')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Line_Item_3')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Total')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Notes')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Attachments')) .", 
					" . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Invoice_Due_Date')) ) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Request_FirstName')) .", 
					" . \DB::connection()->getPDO()->quote(Input::get('Invoice_Jobs_Request_LastName')) . 
					", '" . $get_all_files_array . "' " .

                ")";

         // var_dump($create_new_invoices_sql_code);
         // die();
        
        $create_new_invoices = \DB::insert($create_new_invoices_sql_code);
        
        if ($create_new_invoices){
            return response()->json("Invoice Created Successfully");
        } else {
            return response()->json("Error. Could Not Create Invoices");
        }
    }
    // end create functions

    
    public function deleteInvoices(Request $the_id){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
    // public function deleteInvoices($the_id){
        $delete_invoices_sql_code = 
        " 
            DELETE FROM invoices WHERE 
            ID = ". \DB::connection()->getPDO()->quote(Input::get('get_the_id')) ." 
        ";
        $delete_invoices = \DB::delete($delete_invoices_sql_code);
        // var_dump($delete_invoices);
        // die();
        if ($delete_invoices){
            return response()->json("Invoice Deleted Successfully");
        } else {
            return response()->json("Error. Could Not Delete Invoice");
        }
        //$create_new_invoices_sql_code = "DELETE FROM invoices WHERE ID = ". $the_id ."  ";
    }

    public function getInvoicesMainSearch(Request $the_state){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        $query = htmlspecialchars(trim(stripcslashes(Input::get('q'))));
        
        if ( (intval( Input::get('pg') ) > 0 ) ){
            $pageNumber =  htmlspecialchars(trim(intval(Input::get('pg')))) ;
        } else {
            $pageNumber = 1;
        }

        $sql_query_1 = 
        "
            SELECT * FROM invoices WHERE MATCH (Invoice_Jobs_Name, Invoice_Jobs_Provider_Name, Invoice_Cus_Company_Name, Invoice_Cus_Billing_Contact_Name_First, Invoice_Cus_Billing_Contact_Name_last, Invoice_Jobs_Contractor_First_Name, Invoice_Jobs_Contractors_Last_Name, Invoice_Jobs_Service_Name, Invoice_Jobs_LEP_Name, Invoice_Jobs_Special_Request, Invoice_Jobs_Post_Outcome, Invoice_Line_Item_1_Note, Invoice_Line_Item_2_Note, Invoice_Line_Item_3_Note, Invoice_Notes) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";

        $sql_count_query_1 = 
        "
            SELECT count(*) as count FROM invoices WHERE MATCH (Invoice_Jobs_Name, Invoice_Jobs_Provider_Name, Invoice_Cus_Company_Name, Invoice_Cus_Billing_Contact_Name_First, Invoice_Cus_Billing_Contact_Name_last, Invoice_Jobs_Contractor_First_Name, Invoice_Jobs_Contractors_Last_Name, Invoice_Jobs_Service_Name, Invoice_Jobs_LEP_Name, Invoice_Jobs_Special_Request, Invoice_Jobs_Post_Outcome, Invoice_Line_Item_1_Note, Invoice_Line_Item_2_Note, Invoice_Line_Item_3_Note, Invoice_Notes) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";
        $result_invoices_main_search = InvoicesModel::modelInvoicesGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        // var_dump($result_invoices_main_search);
        // die();
        return view( 'invoices_views/invoices_search', $result_invoices_main_search);

    }

    public function getInvoicePDF(){ 
    	if (!(Auth::check())) {
            return redirect('/login');
        }
        return view( 'invoice_pdf');
    }

    //   	ob_end_clean();
		// $html2pdf = new Html2Pdf();
		
		// $html2pdf->writeHTML( view( 'invoice_pdf') );

		// $html2pdf->output();


    public function generateInvoicePDF(){ 
    	if (!(Auth::check())) {
            return redirect('/login');
        }
		try {
    		ob_start();

	        $get_the_id = 1;
	        // $get_invoices_with_id_sql = \DB::select("SELECT * FROM invoices WHERE ID = $get_the_id");
	        $get_invoices_with_id_sql = \DB::select("SELECT ID, Invoice_Total, Invoice_Cus_Company_Name, Invoice_Due_Date, Invoice_Jobs_Number FROM invoices WHERE ID = $get_the_id");
			$content = view('invoice_pdf', ['invoices'=>$get_invoices_with_id_sql] );
			// $content = view('invoice_pdf');
			ob_get_clean();
			$html2pdf = new HTML2PDF('P','A4','en',false,'UTF-8');
			$html2pdf->WriteHTML($content, false);
			ob_end_clean();
			$html2pdf->Output('helloworld.pdf');
		} catch (Html2PdfException $e) {
		    $formatter = new ExceptionFormatter($e);
		    echo $formatter->getHtmlMessage();
		}
    }

    public function exportInvoicesExcel($all_the_ids){
    	$todays_date = date('Y-m-d-H-i-s');
    	$all_the_ids_array = explode(",", $all_the_ids);
    	$all_the_invoice_array = array();
    	foreach ($all_the_ids_array as $key => $value) {
    		if ((intval($value) > 1) && isset($value)){
        		$get_single_invoice = \DB::select('SELECT invoices.Invoice_Cus_Company_Name as Invoice_Cus_Company_Name, invoices.Invoice_Cus_Billing_E_mail as Invoice_Cus_Billing_E_mail, invoices.Invoice_Jobs_Service_Address as Invoice_Jobs_Service_Address, invoices.date_created as date_created, invoices.Invoice_Due_Date as Invoice_Due_Date, invoices.Invoice_Jobs_PO_Number as Invoice_Jobs_PO_Number, invoices.ID as invoice_id, invoices.Location as invoice_Location, jobs.Jobs_Start_Time as Jobs_Start_Time, invoices.Invoice_Jobs_Name as Invoice_Jobs_Name, invoices.description as description, invoices.quantity as quantity, invoices.Invoice_Jobs_Sevice_Name_Rate as Invoice_Jobs_Sevice_Name_Rate, invoices.Invoice_Total as Invoice_Total
        			FROM invoices 
        			LEFT JOIN jobs ON invoices.Invoice_Jobs_Number = jobs.ID
        			WHERE invoices.ID = '.$value);
        		// var_dump($get_single_invoice);
        		// die();
        		$get_single_invoice_array = get_object_vars($get_single_invoice[0]);
        		$single_invoice_array = array();
        		foreach ($get_single_invoice_array as $key => $value) {
        			if ( $key === "invoice_id" ) {
        				$value = "LLVC".$value;
        			}
        			array_push($single_invoice_array, str_replace("'", "", $value));
        		}
        		array_push($all_the_invoice_array, $single_invoice_array);
    		}
    	}
    	// var_dump($all_the_invoice_array);
    	Excel::create('Invoice-Export-'.$todays_date, function($excel) use($all_the_invoice_array) {
	    	$excel->sheet('Excel sheet', function($sheet) use($all_the_invoice_array) {
				$sheet->fromArray($all_the_invoice_array, null, 'A1', false, false);
	    		$sheet->prependRow(array(
				     'Customer Name', 'Customer Email', 'Customer Address', 'Invoice Date', 'Due Date', 'P.O. Number', 'Invoice Number', 'Location', 'Service Date', 'Product/Service', 'Description', 'Quantity', 'Rate', 'Amount'
				));
	    	});
		})->export('csv');
    }
}

