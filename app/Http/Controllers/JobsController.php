<?php
namespace App\Http\Controllers;
use App\JobsModel;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

ini_set('max_execution_time', '5000' );

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Auth;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;



date_default_timezone_set('Etc/UTC');

class JobsController extends Controller
{

    private $archivos_path;
    public $arr = array();
         
 
    public function __construct()
    {
        $this->archivos_path = public_path('/images'); 
    }

    public function index(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    	$jobs = \DB::select('select * from jobs limit 0, 50');
    	return view( 'jobs', ['jobs'=>$jobs] );
    }

    public function jobListWithPageNo($getPageNo = null){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    	$result = JobsModel::modelJobListWithPageNo($getPageNo);
    	return view( 'job_views/jobs', $result);
    }

    public function getJobWithFilterAll(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    	$d_status =  htmlspecialchars(trim(stripcslashes(Input::get('status'))));
    	$d_job_type =  htmlspecialchars(trim(stripcslashes(Input::get('job_type'))));
    	$d_serv_type = htmlspecialchars(trim(stripcslashes(Input::get('serv_type'))));
    	$d_lang = htmlspecialchars(trim(stripcslashes(Input::get('lang'))));
        $d_state = htmlspecialchars(trim(stripcslashes(Input::get('state'))));
    	$d_city = htmlspecialchars(trim(stripcslashes(Input::get('city_name'))));

        $get_the_distance_radius_job = htmlspecialchars(trim(stripslashes( Input::get('distance_radius_jobs') )));

        $get_the_zip = Input::get('zip');


        if ( (intval( htmlspecialchars(trim(Input::get('pg'))) ) > 0 ) ){
            $pageNumber = intval(htmlspecialchars(trim(Input::get('pg'))));
        } else {
            $pageNumber = 1;
        }


         if ( ( ( !isset($get_the_zip) ) || (strlen($get_the_zip) < 3) ) ) {
            $get_the_distance_radius_job = "";
            $get_the_zip = "";
        }


        $sql_query_1 = "SELECT * FROM jobs WHERE";
        $sql_count_query_1 = "SELECT count(*) as count FROM jobs WHERE";

        if ( isset($d_lang) && ( strlen($d_lang) > 2 ) && (!empty($d_lang))  ) {
            $sql_query_1 .= " Jobs_Language_Requested LIKE '%".$d_lang."%'";
            $sql_count_query_1 .= " Jobs_Language_Requested LIKE '%".$d_lang."%'";
        } else {
            $sql_query_1 .= " Jobs_Language_Requested NOT LIKE ''";
            $sql_count_query_1 .= " Jobs_Language_Requested NOT LIKE ''";
        }

        if ( isset($d_status) && ( strlen($d_status) > 2 ) && (!empty($d_status))  ) {
            $sql_query_1 .= " AND Jobs_Status LIKE '%".$d_status."%'";
            $sql_count_query_1 .= " AND Jobs_Status LIKE '%".$d_status."%'";
        } else {
            // $sql_query_1 .= " Jobs_Status != ''";
            // $sql_count_query_1 .= " Jobs_Status != ''";
        }

        if ( isset($d_job_type) && ( strlen($d_job_type) > 2 ) && (!empty($d_job_type))  ) {
            $sql_query_1 .= " AND Jobs_Type LIKE '%".$d_job_type."%'";
            $sql_count_query_1 .= " AND Jobs_Type LIKE '%".$d_job_type."%'";
        } else {
            // $sql_query_1 .= " AND Jobs_Type != ''";
            // $sql_count_query_1 .= " AND Jobs_Type != ''";
        }

        if ( isset($d_serv_type) && ( strlen($d_serv_type) > 2 ) && (!empty($d_serv_type))  ) {
            $sql_query_1 .= " AND Jobs_Service_Type LIKE '%".$d_serv_type."%'";
            $sql_count_query_1 .= " AND Jobs_Service_Type LIKE '%".$d_serv_type."%'";
        } else {
            // $sql_query_1 .= " AND Jobs_Service_Type != ''";
            // $sql_count_query_1 .= " AND Jobs_Service_Type != ''";
        }

        if ( isset($d_state) && ( strlen($d_state) >= 2 ) && (!empty($d_state))  ) {
            $sql_query_1 .= " AND Jobs_Assignment_State = ".\DB::connection()->getPDO()->quote($d_state);
            $sql_count_query_1 .= " AND Jobs_Assignment_State = ".\DB::connection()->getPDO()->quote($d_state);
        } else {
            // $sql_query_1 .= " AND Jobs_Assignment_State != ''";
            // $sql_count_query_1 .= " AND Jobs_Assignment_State != ''";
        }

        if ( isset($d_city) && ( strlen($d_city) > 2 ) && (!empty($d_city))  ) {
            $sql_query_1 .= " AND Jobs_Assignment_City LIKE '%".$d_city."%'";
            $sql_count_query_1 .= " AND Jobs_Assignment_City LIKE '%".$d_city."%'";
        } else {
            // $sql_query_1 .= " AND Jobs_Assignment_City NOT LIKE ''";
            // $sql_count_query_1 .= " AND Jobs_Assignment_City NOT LIKE ''";
        }
       
        if ( isset($get_the_zip) && ( strlen($get_the_zip) > 2 ) && (!empty($get_the_zip))  ) {

        if ( isset($get_the_distance_radius_job) && (!empty($get_the_distance_radius_job)) ) {
                $zip_codes_in_ranges = getZipCodesWithZipRadius($get_the_zip, $get_the_distance_radius);
           
                $zip_codes_in_ranges_new = "'" . implode("' , '", $zip_codes_in_ranges) . "'";

                $sql_query_1 .= " AND Con_Zip IN (". $zip_codes_in_ranges_new .")";
                    $sql_count_query_1 .= " AND Con_Zip IN (". $zip_codes_in_ranges_new .")";

            } else {
                $sql_query_1 .= " AND Con_Zip LIKE '%".$get_the_zip."%'";    
                $sql_count_query_1 .= " AND Con_Zip LIKE '%".$get_the_zip."%'";
            }}

        $result_contractor = JobsModel::modelJobsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        return view( 'job_views/job_filter', $result_contractor);
    }
    // filter all job function end


    public function getJobSearchByPONumber(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_the_po_number =  htmlspecialchars(trim(stripcslashes(Input::get('po_number'))));
        if ((strlen($get_the_po_number) > 2) && isset($get_the_po_number) ) {
            $the_po_number = $get_the_po_number;
        } else {
            $the_po_number = "";
        }
        if ( (intval( htmlspecialchars(trim(Input::get('pg'))) ) > 0 ) ){
            $pageNumber = intval(htmlspecialchars(trim(Input::get('pg'))));
        } else {
            $pageNumber = 1;
        } 
        $sql_query_1 = "SELECT * FROM jobs WHERE Jobs_Customers_PO_Number LIKE '%".$the_po_number."%'";
        $sql_count_query_1 = "SELECT count(*) as count FROM jobs WHERE Jobs_Customers_PO_Number LIKE '%".$the_po_number."%'";
        // var_dump($sql_query_1);
        // die();
        $result_contractor = JobsModel::modelJobsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        return view( 'job_views/job_search_by_po_number', $result_contractor);
    }


    public function getJobRequestDate(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    	$start_end_date = Input::get('req_date');
    	$start = date("Y-m-d", strtotime(substr($start_end_date, 0, 10))) . " 00:00:00";
    	$end = date("Y-m-d", strtotime(substr($start_end_date, 13))) . " 00:00:00";
    	// echo "Start Date: " . $start;
    	// echo "<br/><br/>";
    	// echo "End Date: " . $end;
    	// die();
        if ( (intval( htmlspecialchars(trim(Input::get('pg'))) ) > 0 ) ){
            $pageNumber = intval(htmlspecialchars(trim(Input::get('pg'))));
        } else {
            $pageNumber = 1;
        }
        $sql_query_1 = "SELECT * FROM jobs WHERE Job_Request_Date BETWEEN '$start' AND '$end'";
        $sql_count_query_1 = "SELECT count(*) as count FROM jobs WHERE Job_Request_Date BETWEEN '$start' AND '$end'";
        $result_contractor = JobsModel::modelJobsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        return view( 'job_views/job_req_date', $result_contractor);
    }

    public function getJobStartEndDate(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    	$start_end_date = htmlspecialchars(trim(Input::get('date_start_end')));
        $no_of_days = htmlspecialchars(trim(Input::get('get_no_of_days')));
    	// $start = date("Y-m-d", strtotime(substr($start_end_date, 0, 10))) . " 00:00:00";
    	// $end = date("Y-m-d", strtotime(substr($start_end_date, 13))) . " 00:00:00";
    	$start = date("Y-m-d", strtotime(substr($start_end_date, 0, 10)));
        $end = date("Y-m-d", strtotime(substr($start_end_date, 13)));
        if ( (intval( htmlspecialchars(trim(Input::get('pg'))) ) > 0 ) ){
            $pageNumber = intval(htmlspecialchars(trim(Input::get('pg'))));
        } else {
            $pageNumber = 1;
        }
        $sql_query_1 = "SELECT * FROM jobs WHERE Jobs_Start_Time BETWEEN '$start' AND '$end'";
        $sql_count_query_1 = "SELECT count(*) as count FROM jobs WHERE Jobs_Start_Time BETWEEN '$start' AND '$end'";    
        // var_dump($sql_query_1);
        // die();
        // $sql_count_query_1 = "SELECT count(*) as count FROM jobs WHERE Jobs_Start_Time > '$start' AND Jobs_End_Time < '$end'";
        $result_contractor = JobsModel::modelJobsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        return view( 'job_views/job_start_end', $result_contractor);
    }
  

    public function getJobWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }

        if ( intval($the_id) > 0  ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = intval('1');
        }

        $get_job_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $get_the_id");
        return view('job_views/job_single', ['jobs'=>$get_job_with_id_sql] );
    }

    public function showJobWithID(){
        if (!(Auth::check())) {
            return redirect('/login');
        }

        var_dump(Input::get('id'));
        die();

        $the_id = htmlspecialchars(trim(Input::get('id')));
    
        if ( intval($the_id) > 0  ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = intval('1');
        }

        $get_job_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $get_the_id");
        return view('job_views/job_single', ['jobs'=>$get_job_with_id_sql] );

        //$the_id = htmlspecialchars(trim(Input::get('id')));
        //$newJobsController = new JobsController();
        //$return_val = $newJobsController->getJobWithID($the_id);
        //return $return_val;
    }


    public function getJobToEditWithID($the_id, Request $request){
        if (!(Auth::check())) {
            return redirect('/login');
        }

     
            
            
    	if ( isset($the_id) && intval($the_id) >= 1 ) {
    		$get_the_id = $the_id;
    	} else {
    		$get_the_id = 1;
    	}
    	$get_job_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $the_id");
    	return view('job_views/job_edit', ['jobs'=>$get_job_with_id_sql] );
    }

    public function getJobWithCity($the_city){
        if (!(Auth::check())) {
            return redirect('/login');
        }

    	if ( isset($the_city) && strlen($the_city) > 1 ) {
    		$get_the_city = $the_city;
    	} else {
    		$get_the_city = "";
    	}
    	$get_job_with_city_sql = \DB::select("SELECT * FROM jobs WHERE Jobs_Assignment_State = '$get_the_city'");
    	return view('job_views/jobs', ['jobs'=>$get_job_with_city_sql] );
    }

    public function getJobWithState($the_state){
        if (!(Auth::check())) {
            return redirect('/login');
        }

    	if ( isset($the_state) && strlen($the_state) > 1 ) {
    		$get_the_state = $the_state;
    	} else {
    		$get_the_state = "";
    	}
    	$get_job_with_state_sql = \DB::select("SELECT * FROM jobs WHERE Jobs_Assignment_State = '$the_state'");
    	return view('job_views/jobs', ['jobs'=>$get_job_with_state_sql] );
    }

    public function getJobWithMultipleParams($the_state, $the_city, $the_language, $service_type, 
    									$job_type, $job_status, $job_start_date, $job_end_date, $job_request_date){
        if (!(Auth::check())) {
            return redirect('/login');
        }

    	
    	if ( !isset($the_id) && intval($the_id) > 1 ) {
    		$get_the_id = $the_id;
    	} else {
    		$get_the_id = 1;
    	}

    	$get_job_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $the_id");
    	return view('job_views/job_single', ['jobs'=>$get_job_with_id_sql] );
    }

    public function getCreateJobView(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    	
        //return view('job_views/job_single');
        
         return view('job_views/job_create');
    }

    public function createNewJobEntry(Request $request){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        
        //dd($request->all());

         $get_all_files_array = "";

        if(count($request->input('job_create_contractor_file_upload')) > 0 ) {
            
           $all_files_array = array();


            for ($i=0; $i < count($request->input('job_create_contractor_file_upload')); $i++)  {
            $file = $request->input('job_create_contractor_file_upload')[$i];
            $save_name = $file;

            $jobs = new JobsModel();
            $jobs->Jobs_Attachments = $save_name;
           

            array_push($all_files_array, $save_name);
            }

            $get_all_files_array = implode(",", $all_files_array);

        }


    	$create_job_sql_statement = "
    	INSERT INTO jobs 
    	( 
    		ID, Jobs_Status, Job_Request_Date, Jobs_Job_Name, Jobs_Type, Jobs_Special_Request, Jobs_Special_Request_Surcharge, Jobs_Special_Request_Surcharge_Total, Jobs_Gender_Preference, Jobs_Invoice_Date, Jobs_Invoice_Acceptance_Date, Jobs_Contractor_ID, Jobs_Contractor_First_Name, Jobs_Contractor_Last_Name, Jobs_Contractor_Home_Phone, Jobs_Contractor_Cell_Phone, Jobs_Contractor_Email, Jobs_LEP_Name, Jobs_LEP_Phone, Jobs_Language_Requested, Job_Medical_Record_Number, Jobs_Court_Record_Number, Jobs_Service_Type, Jobs_Customers_Cus_Number, Jobs_Customers_First, Jobs_Customers_Last, Jobs_Customers_Company, Jobs_Customers_Email, Jobs_Customers_PO_Number, Jobs_Assignment_Provider_Name, Jobs_Assignment_Location, Jobs_Assignment_Department, Jobs_Assignment_Contact_Person, Jobs_Assignment_Phone_Number, Jobs_Assignment_Email, Jobs_Assignment_Street_Address_1, Jobs_Assignment_Street_Address_2, Jobs_Assignment_State, Jobs_Assignment_City, Jobs_Assignment_Zip, Jobs_Start_Time, Jobs_End_Time, Jobs_Start_Working_Time, Jobs_Finish_Working_time, Jobs_Parking_Fees, Jobs_Mileage, Jobs_Travel_Time, Jobs_Travel_Time_Code, Jobs_Travel_Time_Rate, Jobs_Total_Billing_Hours, Jobs_Notes, Jobs_Notes_Post, Jobs_Service_Name, Jobs_Service_Code, Jobs_Service_Name_Rate, Jobs_Service_Hours_Estimate, Jobs_Service_Hours_Estimate_Cost, Jobs_Service_Mileage_Code, Jobs_Service_Mileage_Rate, Jobs_Service_Mileage_Estimate, Jobs_Service_Mileage_Cost_Estimate, Jobs_Travel_Time_Estimate, Jobs_Travel_Time_Estimate_Cost, Jobs_Service_SubTotal_Estimate, Jobs_Service_Total_Estimate, Jobs_Post_Outcome, Jobs_Attachments, Job_Fullfillment_Notes 
    	) 
    	VALUES 
    	( DEFAULT, 
    		" . \DB::connection()->getPDO()->quote(Input::get('Job_Status')) .",
    		". \DB::connection()->getPDO()->quote(setDateInDB(Input::get('Request_Date'))) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Job_Name')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Job_Type')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Special_Request')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Special_Request_Surcharge')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Special_Request_Surcharge_Total')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Gender')) .",
	    	". \DB::connection()->getPDO()->quote(setDateInDB(Input::get('Invoice_Date'))) .",
	    	". \DB::connection()->getPDO()->quote(setDateInDB(Input::get('Invoice_Acceptance_Date'))) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Contractor_ID')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Contractor_First_Name')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Contractor_Last_Name')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Contractor_Home_Phone_Number')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Contractor_Cell_Phone_Number')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Contractor_Email')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Jobs_LEP_Name')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('LEP_Phone_Number')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Jobs_Language_Requested')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Medical_Record')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Court_Record')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('The_Service_Type')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Customer_Number')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Customer_First_Name')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Customer_Last_Name')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Customer_Company')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Customer_Email')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Customer_PO_Number')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Provider_Name')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_Location')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_Department')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_Contact_Person')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_Phone_Number')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_Email')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_Street_Address_1')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_Street_Address_2')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_State')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_City')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Assignment_Zip_Code')) .",
	    	". \DB::connection()->getPDO()->quote(setDateInDB(Input::get('Appointment_Start_Date'))) .",
	    	". \DB::connection()->getPDO()->quote(setDateInDB(Input::get('Appointment_End_Date'))) .",
	    	". \DB::connection()->getPDO()->quote(setDateInDB(Input::get('Start_Working_Time'))) .",
	    	". \DB::connection()->getPDO()->quote(setDateInDB(Input::get('Finish_Working_Time'))) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Jobs_Parking_Fees')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Jobs_Mileage')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Estimated_Travel_Time')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Travel_Time_Code')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Travel_Time_Rate')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Jobs_Total_Billing_Hours')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Job_Notes')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Input_Jobs_Notes_Post')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Service_For')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Service_Code')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Service_Name_Rate')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Estimated_Service_Hours')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Estimated_Service_Cost')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Mileage_Code')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Mileage_Rate')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Estimated_Miles')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Estimated_Mileage_Cost')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Travel_Time_Estimate')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Estimated_Travel_Time_Fee')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('SubTotal_Estimate')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Total_Estimate')) .",
	    	". \DB::connection()->getPDO()->quote(Input::get('Input_Post_Outcome')) .",
            '". $get_all_files_array ."',
	    	". \DB::connection()->getPDO()->quote(Input::get('Job_Fullfillment_Internal_Notes')) . ")" ;
        
        // var_dump($create_job_sql_statement);
        // die();

    	$create_job_sql = \DB::insert($create_job_sql_statement);
        
    	if ($create_job_sql){
    		return response()->json("Job Created Successfully");
    	} else {
    		return response()->json("Could Not Create Job");
    	}
    }

    public function editJobWithID($the_id, Request $request){
        if (!(Auth::check())) {
            return redirect('/login');
        }


        //dd($request->input('edit_job_old_val'));
        
        if( count($request->input('job_create_contractor_file_upload')) > 0 ) {
            
            $all_files_array = array();

            /*for ($i=0; $i < count($request->input('job_create_contractor_file_upload')); $i++) { 
                
                $file = $request->input('job_create_contractor_file_upload')[$i];
                if ( !isset( $file ) ) {
                    $file_name = " ";
                } else{
                    $upload_succes = Storage::putfile('public/llcuploads', $request->input('job_create_contractor_file_upload')[$i]);
                    $file_name = substr($upload_succes, 18);
                }  
                array_push($all_files_array, $file_name);
            }*/
           /* $files = $request->input('job_create_contractor_file_upload');
            if(!empty($files)) :
                foreach($files as $file) :
                  
                  array_push($all_files_array, $file);
                endforeach;
            endif;*/

            for ($i=0; $i < count($request->input('job_create_contractor_file_upload')); $i++)  {
            $file = $request->input('job_create_contractor_file_upload')[$i];
            $save_name = $file;

            $jobs = new JobsModel();
            $jobs->Jobs_Attachments = $save_name;
           

            /*return Response::json([
            'message' => $file
            ], 200); */

            array_push($all_files_array, $save_name);
            }
         
       

            $get_all_files_array_0 = implode(",", $all_files_array);
            $get_all_files_array = $get_all_files_array_0 . ", " . $request->input('edit_job_old_val');

            /*return Response::json([
            'message' => $get_all_files_array
        ], 200); */
            
            // $get_all_files_array = implode(",", $all_files_array);
        } else if (is_null($request->input('job_create_contractor_file_upload'))){
            // $get_all_files_array = " ";
            $get_all_files_array = Input::get('edit_job_old_val');
        } else {
            $get_all_files_array = Input::get('edit_job_old_val');
        } 

         //dd($request->all());

         //dd($request->input('job_create_contractor_file_upload'));

    	$update_sql_code = "UPDATE jobs 
    		SET Jobs_Status = " . \DB::connection()->getPDO()->quote(Input::get('Job_Status')) .",
    		 Job_Request_Date = '". setDateInDB(Input::get('Request_Date')) ."',
    		 Jobs_Job_Name =  ". \DB::connection()->getPDO()->quote(Input::get('Job_Name')) .",
    		 Jobs_Type = ". \DB::connection()->getPDO()->quote(Input::get('Job_Type')) .",
    		 Jobs_Special_Request = ". \DB::connection()->getPDO()->quote(Input::get('Special_Request')) .",
    		 Jobs_Special_Request_Surcharge = ". \DB::connection()->getPDO()->quote(Input::get('Special_Request_Surcharge')) .",
    		 Jobs_Special_Request_Surcharge_Total = ". \DB::connection()->getPDO()->quote(Input::get('Special_Request_Surcharge_Total')) .",
             Jobs_Invoice_Date = '". setDateInDB(Input::get('Invoice_Date')) ."',
             Jobs_Invoice_Acceptance_Date = '". setDateInDB(Input::get('Invoice_Acceptance_Date')) ."',
    		 Jobs_Gender_Preference = ". \DB::connection()->getPDO()->quote(Input::get('Gender')) .",
    		 Jobs_Contractor_ID = ". \DB::connection()->getPDO()->quote(Input::get('Contractor_ID')) .",
    		 Jobs_Contractor_First_Name = ". \DB::connection()->getPDO()->quote(Input::get('Contractor_First_Name')) .",
    		 Jobs_Contractor_Last_Name = ". \DB::connection()->getPDO()->quote(Input::get('Contractor_Last_Name')) .",
    		 Jobs_Contractor_Home_Phone = ". \DB::connection()->getPDO()->quote(Input::get('Contractor_Home_Phone_Number')) .",
    		 Jobs_Contractor_Cell_Phone = ". \DB::connection()->getPDO()->quote(Input::get('Contractor_Cell_Phone_Number')) .",
    		 Jobs_Contractor_Email = ". \DB::connection()->getPDO()->quote(Input::get('Contractor_Email')) .",
    		 Jobs_LEP_Name = ". \DB::connection()->getPDO()->quote(Input::get('Jobs_LEP_Name')) .",
    		 Jobs_LEP_Phone = ". \DB::connection()->getPDO()->quote(Input::get('LEP_Phone_Number')) .",
    		 Jobs_Language_Requested = ". \DB::connection()->getPDO()->quote(Input::get('Jobs_Language_Requested')) .",
    		 Job_Medical_Record_Number = ". \DB::connection()->getPDO()->quote(Input::get('Medical_Record')) .",
    		 Jobs_Court_Record_Number = ". \DB::connection()->getPDO()->quote(Input::get('Court_Record')) .",
    		 Jobs_Customers_Cus_Number = ". \DB::connection()->getPDO()->quote(Input::get('Customer_Number')) .",
    		 Jobs_Customers_First = ". \DB::connection()->getPDO()->quote(Input::get('Customer_First_Name')) .",
    		 Jobs_Customers_Last = ". \DB::connection()->getPDO()->quote(Input::get('Customer_Last_Name')) .",
    		 Jobs_Customers_Company = ". \DB::connection()->getPDO()->quote(Input::get('Customer_Company')) .",
    		 Jobs_Customers_PO_Number = ". \DB::connection()->getPDO()->quote(Input::get('Customer_PO_Number')) .",
    		 Jobs_Assignment_Provider_Name = ". \DB::connection()->getPDO()->quote(Input::get('Provider_Name')) .",
    		 Jobs_Assignment_Location = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_Location')) .",
    		 Jobs_Assignment_Department = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_Department')) .",
    		 Jobs_Assignment_Contact_Person = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_Contact_Person')) .",
    		 Jobs_Assignment_Phone_Number = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_Phone_Number')) .",
    		 Jobs_Assignment_Email = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_Email')) .",
    		 Jobs_Assignment_Street_Address_1 = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_Street_Address_1')) .",
    		 Jobs_Assignment_Street_Address_2 = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_Street_Address_2')) .",
    		 Jobs_Assignment_State = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_State')) .",
    		 Jobs_Assignment_City = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_City')) .",
    		 Jobs_Assignment_Zip = ". \DB::connection()->getPDO()->quote(Input::get('Assignment_Zip_Code')) .",
    		 Jobs_Start_Time = '". setDateInDB(Input::get('Appointment_Start_Date')) ."',
    		 Jobs_End_Time = '". setDateInDB(Input::get('Appointment_End_Date')) ."',
    		 Jobs_Start_Working_Time = '". setDateInDB(Input::get('Start_Working_Time')) ."',
    		 Jobs_Finish_Working_time = '". setDateInDB(Input::get('Finish_Working_Time')) ."',
    		 Jobs_Travel_Time = ". \DB::connection()->getPDO()->quote(Input::get('Estimated_Travel_Time')) .",
    		 Jobs_Travel_Time_Code = ". \DB::connection()->getPDO()->quote(Input::get('Travel_Time_Code')) .",
    		 Jobs_Travel_Time_Rate = ". \DB::connection()->getPDO()->quote(Input::get('Travel_Time_Rate')) .",
    		 Jobs_Notes = ". \DB::connection()->getPDO()->quote(Input::get('Job_Notes')) .",
    		 Jobs_Service_Name = ". \DB::connection()->getPDO()->quote(Input::get('Service_For')) .",
    		 Jobs_Service_Code = ". \DB::connection()->getPDO()->quote(Input::get('Service_Code')) .",
    		 Jobs_Service_Name_Rate = ". \DB::connection()->getPDO()->quote(Input::get('Service_Name_Rate')) .",
    		 Jobs_Service_Hours_Estimate = ". \DB::connection()->getPDO()->quote(Input::get('Estimated_Service_Hours')) .",
    		 Jobs_Service_Hours_Estimate_Cost = ". \DB::connection()->getPDO()->quote(Input::get('Estimated_Service_Cost')) .",
    		 Jobs_Service_Mileage_Code = ". \DB::connection()->getPDO()->quote(Input::get('Mileage_Code')) .",
    		 Jobs_Service_Mileage_Rate = ". \DB::connection()->getPDO()->quote(Input::get('Mileage_Rate')) .",
    		 Jobs_Service_Mileage_Estimate = ". \DB::connection()->getPDO()->quote(Input::get('Estimated_Miles')) .",
    		 Jobs_Service_Mileage_Cost_Estimate = ". \DB::connection()->getPDO()->quote(Input::get('Estimated_Mileage_Cost')) .",
    		 Jobs_Travel_Time_Estimate_Cost = ". \DB::connection()->getPDO()->quote(Input::get('Estimated_Travel_Time_Fee')) .",
    		 Jobs_Service_SubTotal_Estimate = ". \DB::connection()->getPDO()->quote(Input::get('SubTotal_Estimate')) .",
    		 Jobs_Service_Total_Estimate = ". \DB::connection()->getPDO()->quote(Input::get('Total_Estimate')) .",
             Jobs_Attachments = '". $get_all_files_array ."',
    		 Job_Fullfillment_Notes = ". \DB::connection()->getPDO()->quote(Input::get('Job_Fullfillment_Internal_Notes')) ."
    		WHERE ID =  " . Input::get('Job_ID');

    	$update_job_with_id_sql = \DB::update($update_sql_code);
        $get_job_with_id_sql_2 = \DB::select("SELECT * FROM jobs WHERE ID = " . Input::get('Job_ID'));
        return view('job_views/job_single', ['jobs'=>$get_job_with_id_sql_2] );
    }

    public function editJobWithID2(){
        if (!(Auth::check())) {
            return redirect('/login');
        }

    	if ( isset($the_id) && intval($the_id) > 1 ) {
    		$get_the_id = $the_id;
    	} else {
    		$get_the_id = 1;
    	}
    	$get_job_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $the_id");
    	return view('job_views/job_single', ['jobs'=>$get_job_with_id_sql] );
    }

     public function update(Request $request, $id){
        if (!(Auth::check())) {
            return redirect('/login');
        }

        //$candidate = Candidate::findOrFail($id);
        $input = Request::all();
        $JobsModel->update($input);
        return redirect('put_edit_single_job_route');
    }

    public function deleteJob(Request $the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    
        
        $delete_customers_sql_code = 
        "DELETE FROM jobs WHERE ID = ". \DB::connection()->getPDO()->quote(Input::get('get_the_id'));
        $delete_customers = \DB::delete($delete_customers_sql_code);
        if ($delete_customers){
            return response()->json("Job Deleted Successfully");
        } else {
            return response()->json("Error. Could Not Delete Job");
        }
    }

    
    public function getJobsMainSearch(){
        $query = htmlspecialchars(trim(stripcslashes(Input::get('q'))));
        
        if ( (intval( htmlspecialchars(trim(Input::get('pg'))) ) > 0 ) ){
            $pageNumber =  htmlspecialchars(trim(intval(htmlspecialchars(trim(Input::get('pg')))))) ;
        } else {
            $pageNumber = 1;
        }

        $sql_query_1 = 
        "
            SELECT * FROM jobs WHERE MATCH (Jobs_Job_Name,Jobs_Special_Request,Jobs_Contractor_Email,Jobs_LEP_Name,Jobs_Language_Requested,Jobs_Customers_First,Jobs_Customers_Last,Jobs_Customers_Company,Jobs_Assignment_Provider_Name,Jobs_Assignment_Department,Jobs_Assignment_Contact_Person,Jobs_Notes,Jobs_Notes_Post,Jobs_Service_Name,Jobs_Post_Outcome,Job_Fullfillment_Notes) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";

        $sql_count_query_1 = 
        "
            SELECT count(*) as count FROM jobs WHERE MATCH (Jobs_Job_Name,Jobs_Special_Request,Jobs_Contractor_Email,Jobs_LEP_Name,Jobs_Language_Requested,Jobs_Customers_First,Jobs_Customers_Last,Jobs_Customers_Company,Jobs_Assignment_Provider_Name,Jobs_Assignment_Department,Jobs_Assignment_Contact_Person,Jobs_Notes,Jobs_Notes_Post,Jobs_Service_Name,Jobs_Post_Outcome,Job_Fullfillment_Notes) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";
        $result_job_main_search = JobsModel::modelJobsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        return view( 'job_views/job_search', $result_job_main_search);
    }

    public function getJobsSearchByCity(){
        $city_name = htmlspecialchars(trim(stripcslashes(Input::get('city_name'))));
        
        if ( (intval( htmlspecialchars(trim(Input::get('pg'))) ) > 0 ) ){
            $pageNumber =  htmlspecialchars(trim(intval(htmlspecialchars(trim(Input::get('pg')))))) ;
        } else {
            $pageNumber = 1;
        }

        $sql_query_1 = "SELECT * FROM jobs WHERE Jobs_Assignment_City LIKE '%".$city_name."%' ";
        $sql_query_count_1 = "SELECT count(*) as count FROM jobs WHERE Jobs_Assignment_City LIKE '%".$city_name."%' ";

        $result_job_main_search = JobsModel::modelJobsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_query_count_1);
        return view( 'job_views/job_city_search', $result_job_main_search);
    }

    public function getContractorJobs($f_name, $l_name, $getPageNo = null){
        // $get_f_name = htmlspecialchars(trim(stripcslashes($f_name)));
        // $get_l_name = htmlspecialchars(trim(stripcslashes($l_name)));
        
        // $the_f_name = \DB::connection()->getPDO()->quote($get_f_name);
        // $the_l_name = \DB::connection()->getPDO()->quote($get_l_name);

        $get_f_name = htmlspecialchars(trim(stripcslashes($f_name)));
        $get_l_name = htmlspecialchars(trim(stripcslashes($l_name)));

        if ( (intval( $getPageNo ) > 0 ) ){
            $pageNumber = intval($getPageNo);
        } else {
            $pageNumber = 1;
        }
        // SELECT * FROM jobs WHERE Jobs_Contractor_ID = '\'Maggi\'' AND Jobs_contractor_First_name = '\'Maggi\''

        $sql_query_1 = "SELECT * FROM jobs WHERE Jobs_Contractor_ID = '\'".$get_f_name."\'' AND Jobs_contractor_First_name = '\'".$get_l_name."\''";
        $sql_count_query_1 = "SELECT count(*) as count FROM jobs WHERE Jobs_Contractor_ID = '\'".$get_f_name."\'' AND Jobs_contractor_First_name = '\'".$get_l_name."\''";
        // var_dump($sql_query_1);
        // var_dump($sql_count_query_1);
        // die();
        $result_contractor = JobsModel::modelJobsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        // var_dump($result_contractor);
        // die();
        
        return view('job_views/jobs_by_contractors', $result_contractor);
    }

    public function getContractorDetailsWithID($the_contractor_id){
        $get_the_contractor_id_val = 
            htmlspecialchars(trim(stripcslashes($the_contractor_id)));
        if ( (intval( $get_the_contractor_id_val ) > 0 ) ){
            $get_the_contractor_id = intval($get_the_contractor_id_val);
        } else {
            $get_the_contractor_id = 1;
        }
        $get_the_contractor_sql = "SELECT Con_E_mail_Address, Con_Home_Phone, Con_Fax_Phone, Con_Cell_Phone, Con_First_Name, Con_Last_Name FROM contractors WHERE ID = ".$get_the_contractor_id;
        $the_contractor_sql = \DB::select($get_the_contractor_sql);
        if (  isset($the_contractor_sql['0']) && count($the_contractor_sql['0']) > 0 ) {
            $the_contractor_sql_result = get_object_vars($the_contractor_sql['0']);        
            return response()->json($the_contractor_sql_result);
        } else {
            return response()->json("False");
        }
    }

    public function generateContractorForm($the_id){ 
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        try {
            ob_start();
            $get_invoices_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $get_the_id");
            $content = view('job_views/jobs_contractor_pdf_form', ['jobs'=>$get_invoices_with_id_sql] );

            $all_jobs = get_object_vars($get_invoices_with_id_sql[0]);
            $get_file_name =  str_replace("'", "", $all_jobs['Jobs_Job_Name']) . "_invoice_" . $all_jobs['Jobs_Start_Time'];
            $file_name = $get_file_name . ".pdf";
            ob_get_clean();
            $html2pdf = new HTML2PDF('P','A4','en',false,'UTF-8');
            $html2pdf->WriteHTML($content, false);
            ob_end_clean();
            //$generated_pdf = $html2pdf->Output($file_name, 'D'); //this downloads the form
            $generated_pdf = $html2pdf->Output($file_name);
        } catch (Html2PdfException $e) {
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

    public function generateCustomerForm($the_id){ 
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        try {
            ob_start();
            $get_invoices_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $get_the_id");
            $content = view('job_views/jobs_customer_pdf_form', ['jobs'=>$get_invoices_with_id_sql] );
            
            $all_jobs = get_object_vars($get_invoices_with_id_sql[0]);
            $get_file_name =  str_replace("'", "", $all_jobs['Jobs_Job_Name']) . "_invoice_" . $all_jobs['Jobs_Start_Time'];
            $file_name = $get_file_name . ".pdf";
            // var_dump($file_name);

            // die();
            ob_get_clean();
            $html2pdf = new HTML2PDF('P','A4','en',false,'UTF-8');
            $html2pdf->WriteHTML($content, false);
            ob_end_clean();
            //$html2pdf->Output('helloworld.pdf');
            $html2pdf->Output($file_name);
        } catch (Html2PdfException $e) {
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

    public function emailFooterSignature(){
        return "
            <div style='font-size: 12px'>
                <a href='https://www.beacon-link.com/'><img src='https://i.imgur.com/NpAGP9G.png' style='width: 200px;'></a> <br/>
                José Alfredo Herrera <br/>
                Beacon Link, LLC <br/>
                Operation Manager <br/>
                <a href='tel:+14703154949'>470 315 4949</a> (o) Ext 301 <br/>
                <a href='tel:+14705547751'>470.554.7751</a> Direct <br/>
                678 999 5383 (fax) <br/>
                <a href='tel:+18447067388'>1 844 706 7388</a> (toll free) <br/>
                <a href='tel:+16783159046'>678 315.9046</a> © <br/>
                <a href='https://www.beacon-link.com/'>www.beacon-link.com</a> <br/>
                <a href='https://www.proz.com/interpreter/1290224'>http://www.proz.com/profile/1290224</a> <br/>
                <span style='color: #0e7fbd; font-weight: bold;'>The power of Language. One Language at the time. Communication Made simple &reg;</span> <br/>
                This e-mail and any attachments are confidential and may be protected by legal privilege. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of this e-mail or any attachment is prohibited. If you have received this e-mail in error, please notify us immediately by returning it to the sender and delete this copy from your system. Thank you for your co-operation.
                </div>
        ";
    }

    // this function sends an email with PDF file attachment
    // It uses HTML2PDF to convert the file to a PDF
    // It gets the content from a view that will be passed to it.
    public function sendMailWithPDFAttachment($email_address, $message, $attachment_name, $attachment_content){
        $file_name = $attachment_name . ".pdf";
        ob_get_clean();
        $html2pdf = new HTML2PDF('P','A4','en',false,'UTF-8');
        $html2pdf->WriteHTML($attachment_content, false);
        ob_end_clean();
        $generated_pdf = $html2pdf->Output($file_name, 'S');
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->AuthType = 'XOAUTH2';
        $email = 'info@languagelinkllc.net';
        $clientId = '695531997802-io8gesl9uajtbdmanrv8bmcf4inr80jm.apps.googleusercontent.com';
        $clientSecret = 'UorUEotA2HKcdMK7ClQlTEAz';
        $refreshToken = '1/LdxjM86r6QZf-qxLbx623DBr9OglvfL0uuI6U4OvMxs';
        $provider = new Google(
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]
        );
        $mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $email,
                ]
            )
        );
        $mail->setFrom("info@languagelinkllc.net", 'Hermes Workflow | Beacon Link LLC');
        $mail->addAddress($email_address);
        $mail->Subject = 'Beacon Link LLC Job Assignment';
        $mail->addStringAttachment($generated_pdf, $file_name, 'base64', 'pdf'); 
        $mail->CharSet = 'utf-8';
        $mail->Body = "
        <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
        <html>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                <title>Beacon Link LLC</title>
            </head>
            <body>
                <div style='width: 640px; font-family: Arial, Helvetica, sans-serif;'>

                    <div style='margin-bottom: 100px;'>
                        ". $message ."
                    </div>

                   <div style='font-size: 12px'>
                    <a href='https://www.beacon-link.com/'><img src='https://i.imgur.com/NpAGP9G.png' style='width: 200px;'></a> <br/>
                    José Alfredo Herrera <br/>
                    Beacon Link, LLC <br/>
                    Operation Manager <br/>
                    <a href='tel:+14703154949'>470 315 4949</a> (o) Ext 301 <br/>
                    <a href='tel:+14705547751'>470.554.7751</a> Direct <br/>
                    678 999 5383 (fax) <br/>
                    <a href='tel:+18447067388'>1 844 706 7388</a> (toll free) <br/>
                    <a href='tel:+16783159046'>678 315.9046</a> © <br/>
                    <a href='https://www.beacon-link.com/'>www.beacon-link.com</a> <br/>
                    <a href='https://www.proz.com/interpreter/1290224'>http://www.proz.com/profile/1290224</a> <br/>
                    <span style='color: #0e7fbd; font-weight: bold;'>The power of Language. One Language at the time. Communication Made simple &reg;</span> <br/>
                    This e-mail and any attachments are confidential and may be protected by legal privilege. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of this e-mail or any attachment is prohibited. If you have received this e-mail in error, please notify us immediately by returning it to the sender and delete this copy from your system. Thank you for your co-operation.
                    </div>

                </div>
            </body>
        </html>
        ";
        $mail->AltBody = 'Beacon Link LLC Job Assignment';
        return $mail->send();
        // if (!$mail->send()) {
        //     return "Could not send email";
        // } else {
        //     return "Email was sent Successfully";
        // }
    }

    public function emailContractorAboutJob($the_id){
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        try {
            ob_start();
            $get_invoices_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $get_the_id");
            $content = view('job_views/jobs_contractor_pdf_form', ['jobs'=>$get_invoices_with_id_sql] );

            $all_jobs = get_object_vars($get_invoices_with_id_sql[0]);
            $get_file_name =  str_replace("'", "", $all_jobs['Jobs_Job_Name']) . "_invoice_" . $all_jobs['Jobs_Start_Time'];
            $get_contractor_fname =  str_replace("'", "", $all_jobs['Jobs_Contractor_First_Name']);
            $get_contractor_lname =  str_replace("'", "", $all_jobs['Jobs_Contractor_Last_Name']);
            $get_contractor_name = $get_contractor_fname . $get_contractor_lname;
            // $get_contractor_email =  $all_jobs['Jobs_Contractor_Email'];
            

            
            $file_name = $get_file_name . ".pdf";
            // var_dump($file_name);

            // die();
            ob_get_clean();
            $html2pdf = new HTML2PDF('P','A4','en',false,'UTF-8');
            $html2pdf->WriteHTML($content, false);
            ob_end_clean();
            //$html2pdf->Output('helloworld.pdf');
            $generated_pdf = $html2pdf->Output($file_name, 'S');
            //$generated_pdf = $html2pdf->Output('', 'S');

            //start email sending with attachement
            $mail = new PHPMailer;
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();
            $mail->isHTML(true);
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 0;
            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;
            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //Set AuthType to use XOAUTH2
            $mail->AuthType = 'XOAUTH2';
            //Fill in authentication details here
            //Either the gmail account owner, or the user that gave consent
            $email = 'info@languagelinkllc.net';
            
            // belongs to info@hermesworkflow.com
            // $clientId = '794020756572-v2kubfouhoa4e6gkao2lbt2g7gg4n39i.apps.googleusercontent.com';
            // $clientSecret = 'iEGwD4-tbo-JTpEIHon-0llr';
            // $refreshToken = '1/pAMJdhbrwzMUNQSWCLC_pQY4t8vx3OZLHALZU5UN18U';
            // belongs to info@hermesworkflow.com

            $clientId = '695531997802-io8gesl9uajtbdmanrv8bmcf4inr80jm.apps.googleusercontent.com';
            $clientSecret = 'UorUEotA2HKcdMK7ClQlTEAz';
            $refreshToken = '1/LdxjM86r6QZf-qxLbx623DBr9OglvfL0uuI6U4OvMxs';
            
            $provider = new Google(
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );
            //Pass the OAuth provider instance to PHPMailer
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                        'refreshToken' => $refreshToken,
                        'userName' => $email,
                    ]
                )
            );
            //Set who the message is to be sent from
            //For gmail, this generally needs to be the same as the user you logged in as
            // $mail->setFrom($email, 'Hermes Workflow');
            $mail->setFrom("info@languagelinkllc.net", 'Hermes Workflow');
            //Set who the message is to be sent to
            
            //Set the subject line
            $mail->Subject = 'Beacon Link LLC Job Assignment';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            
            //$mail->addbinattachement("document.pdf", $generated_pdf);
            $mail->addStringAttachment($generated_pdf, $file_name, 'base64', 'pdf'); 

            // $mail->addStringAttachment($generated_pdf, 'file.pdf');
            //$mail->addAttachment($generated_pdf);
            $mail->CharSet = 'utf-8';
            
            // $mail->msgHTML(file_get_contents('contentsutf8.html'), __DIR__);
            $mail->Body = "
            <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
            <html>
                <head>
                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    <title>Beacon Link LLC</title>
                </head>
                <body>
                    <div style='width: 640px; font-family: Arial, Helvetica, sans-serif;'>

                        <div style='margin-bottom: 100px;'>
                            Hello " . $get_contractor_name . ". 
                            <br/><br/>
                            Thank you for accepting the job for which we are attaching details. Please, don’t forget to:
                            <ul>
                                <li>Take the encounter form provided to you to the appointment and ask the doctor, provider or receptionist to sign for you once you are done with the job.</li>
                                <li>Get to the job site at least 15 minutes prior the appointment time</li>
                                <li>Check in with us (by texting or calling to 470.554.7754, or emailing at: info@beacon-link.com) as soon as you arrive to the job site.</li>
                                <li>Wear your interpreter badge ID at all times (If you don’t have one yet, please ask us)</li>
                                <li>If the LEP does not show up to the appointment: a. wait, at least 20 minutes and then approach reception to ask if there is a cancellation, if the LEP is reported to coming late and/or if the LEP will be seen if arrive late. B. Report to the agency and DO NOT LEAVE the facility until you are released.</li>
                                <li>Send your signed and completed ENCOUNTER FORM to us within 24 hrs to ensure complete and accurate payment.</li>
                            </ul>
                            Once 48 hrs have passed after the job is completed we will only be responsible for paying the minimum agreed. 
                        </div>

                        <div style='font-size: 12px'>
                        <a href='https://www.beacon-link.com/'><img src='https://i.imgur.com/NpAGP9G.png' style='width: 200px;'></a> <br/>
                        José Alfredo Herrera <br/>
                        Beacon Link, LLC <br/>
                        Operation Manager <br/>
                        <a href='tel:+14703154949'>470 315 4949</a> (o) Ext 301 <br/>
                        <a href='tel:+14705547751'>470.554.7751</a> Direct <br/>
                        678 999 5383 (fax) <br/>
                        <a href='tel:+18447067388'>1 844 706 7388</a> (toll free) <br/>
                        <a href='tel:+16783159046'>678 315.9046</a> © <br/>
                        <a href='https://www.beacon-link.com/'>www.beacon-link.com</a> <br/>
                        <a href='https://www.proz.com/interpreter/1290224'>http://www.proz.com/profile/1290224</a> <br/>
                        <span style='color: #0e7fbd; font-weight: bold;'>The power of Language. One Language at the time. Communication Made simple &reg;</span> <br/>
                        This e-mail and any attachments are confidential and may be protected by legal privilege. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of this e-mail or any attachment is prohibited. If you have received this e-mail in error, please notify us immediately by returning it to the sender and delete this copy from your system. Thank you for your co-operation.
                        </div>

                    </div>
                </body>
            </html>
            ";
            $mail->AltBody = 'Beacon Link LLC Job Assignment';
            // if (!$mail->send()) {
            //     echo "Mailer Error: " . $mail->ErrorInfo;
            // } else {
            //     echo "Message sent!";
            // }
            $get_contractor_email =  $all_jobs['Jobs_Contractor_Email'];
            if (strrpos($get_contractor_email, ",")){
                $new_emails_array = explode(",", $get_contractor_email);
                foreach ($new_emails_array as $key => $value) {
                    $mail->AddBCC($value);
                }   
            } else {
                $mail->addAddress($get_contractor_email, $get_contractor_name);
            }
            if (!$mail->send()) {
                return response()->json("Could not send email");
            } else {
                return response()->json("Email was sent Successfully");
            }


            //die();

        } catch (Html2PdfException $e) {
            // $formatter = new ExceptionFormatter($e);
            // echo $formatter->getHtmlMessage();
        }
    }

    public function emailContractorAboutJobManual($the_id, $email_add, $message){
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        try {
            ob_start();
            $get_invoices_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $get_the_id");
            $content = view('job_views/jobs_contractor_pdf_form', ['jobs'=>$get_invoices_with_id_sql] );

            $all_jobs = get_object_vars($get_invoices_with_id_sql[0]);
            $get_file_name =  str_replace("'", "", $all_jobs['Jobs_Job_Name']) . "_invoice_" . $all_jobs['Jobs_Start_Time'];
            $get_contractor_fname =  str_replace("'", "", $all_jobs['Jobs_Contractor_First_Name']);
            $get_contractor_lname =  str_replace("'", "", $all_jobs['Jobs_Contractor_Last_Name']);
            $get_contractor_name = $get_contractor_fname . $get_contractor_lname;

            $contractor_email = htmlspecialchars(trim($email_add));
            if ( self::sendMailWithPDFAttachment($contractor_email, $message, $get_file_name, $content) ) {
                return response()->json("Email was sent Successfully");
            } else {
                return response()->json("Could not send email");
            }

            // $get_contractor_email =  str_replace("'", "", $all_jobs['Jobs_Contractor_Email']);
            // $file_name = $get_file_name . ".pdf";
            // ob_get_clean();
            // $html2pdf = new HTML2PDF('P','A4','en',false,'UTF-8');
            // $html2pdf->WriteHTML($content, false);
            // ob_end_clean();
            // $generated_pdf = $html2pdf->Output($file_name, 'S');
            // $mail = new PHPMailer;
            // $mail->isSMTP();
            // $mail->isHTML(true);
            // $mail->SMTPDebug = 0;
            // $mail->Host = 'smtp.gmail.com';
            // $mail->Port = 587;
            // $mail->SMTPSecure = 'tls';
            // $mail->SMTPAuth = true;
            // $mail->AuthType = 'XOAUTH2';
            // $email = 'info@languagelinkllc.net';
            // $clientId = '695531997802-io8gesl9uajtbdmanrv8bmcf4inr80jm.apps.googleusercontent.com';
            // $clientSecret = 'UorUEotA2HKcdMK7ClQlTEAz';
            // $refreshToken = '1/LdxjM86r6QZf-qxLbx623DBr9OglvfL0uuI6U4OvMxs';
            
            // $provider = new Google(
            //     [
            //         'clientId' => $clientId,
            //         'clientSecret' => $clientSecret,
            //     ]
            // );
            // $mail->setOAuth(
            //     new OAuth(
            //         [
            //             'provider' => $provider,
            //             'clientId' => $clientId,
            //             'clientSecret' => $clientSecret,
            //             'refreshToken' => $refreshToken,
            //             'userName' => $email,
            //         ]
            //     )
            // );
            // $get_contractor_email = htmlspecialchars(trim($email_add));
            // $mail->setFrom("info@languagelinkllc.net", 'Hermes Workflow');
            // $mail->addAddress($get_contractor_email);
            // $mail->Subject = 'Language Link LLC Job Assignment';
            // $mail->addStringAttachment($generated_pdf, $file_name, 'base64', 'pdf'); 
            // $mail->CharSet = 'utf-8';
            // $mail->Body = "
            // <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
            // <html>
            //     <head>
            //         <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
            //         <title>Language Link LLC</title>
            //     </head>
            //     <body>
            //         <div style='width: 640px; font-family: Arial, Helvetica, sans-serif;'>

            //             <div style='margin-bottom: 100px;'>
            //                 " . $message . ". 
            //                 <br/><br/>
            //             </div>

            //             <div style='font-size: 12px'>
            //             <a href='http://www.languagelinkllc.net/'><img src='http://www.languagelinkllc.net/assets/img/logo1.png' style='width: 200px;'></a> <br/>
            //             Alfredo Herrera de Conde <br/>
            //             Language Link, LLC <br/>
            //             Operation Manager <br/>
            //             <a href='tel:+14703154949'>470 315 4949</a> (o) Ext 301 <br/>
            //             <a href='tel:+14705547751'>470.554.7751</a> Direct <br/>
            //             678 999 5383 (fax) <br/>
            //             <a href='tel:+18447067388'>1 844 706 7388</a> (toll free) <br/>
            //             <a href='tel:+16783159046'>678 315.9046</a> © <br/>
            //             <a href='http://www.languagelinkllc.net/'>www.Languagelinkllc.net</a> <br/>
            //             <a href='https://www.proz.com/interpreter/1290224'>http://www.proz.com/profile/1290224</a> <br/>
            //             <span style='color: #0e7fbd; font-weight: bold;'>The power of Language. One Language at the time. Communication Made simple &reg;</span> <br/>
            //             This e-mail and any attachments are confidential and may be protected by legal privilege. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of this e-mail or any attachment is prohibited. If you have received this e-mail in error, please notify us immediately by returning it to the sender and delete this copy from your system. Thank you for your co-operation.
            //             </div>

            //         </div>
            //     </body>
            // </html>
            // ";
            // $mail->AltBody = 'Language Link LLC Job Assignment';
            // if (!$mail->send()) {
            //     return response()->json("Could not send email");
            // } else {
            //     return response()->json("Email was sent Successfully");
            // }
        } catch (Html2PdfException $e) {
            // $formatter = new ExceptionFormatter($e);
            // echo $formatter->getHtmlMessage();
        }
    }

    public function emailCustomerAboutJobManual($the_id, $email_add, $message){
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        try {
            ob_start();
            $get_invoices_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $get_the_id");
            $content = view('job_views/jobs_customer_pdf_form', ['jobs'=>$get_invoices_with_id_sql] );

            $all_jobs = get_object_vars($get_invoices_with_id_sql[0]);
            $get_file_name =  str_replace("'", "", $all_jobs['Jobs_Job_Name']) . "_invoice_" . $all_jobs['Jobs_Start_Time'];
            $get_customer_name =  str_replace("'", "", $all_jobs['Jobs_Customers_First']);
            
            $customer_email = htmlspecialchars(trim($email_add));
            
            if ( strlen($customer_email) > 4 ) {
                $get_customer_email = $customer_email;
            } else{
                return response()->json("Could not send email. Please check email address.");
            }

            if ( self::sendMailWithPDFAttachment($customer_email, $message, $get_file_name, $content) ) {
                return response()->json("Email was sent Successfully");
            } else {
                return response()->json("Could not send email");
            }

        } catch (Html2PdfException $e) {
            // $formatter = new ExceptionFormatter($e);
            // echo $formatter->getHtmlMessage();
        }
    }

    

    public function emailCustomerAboutJob($the_id){ 
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        try {
            ob_start();
            $get_invoices_with_id_sql = \DB::select("SELECT * FROM jobs WHERE ID = $get_the_id");
            $content = view('job_views/jobs_customer_pdf_form', ['jobs'=>$get_invoices_with_id_sql] );

            $all_jobs = get_object_vars($get_invoices_with_id_sql[0]);
            $get_file_name =  str_replace("'", "", $all_jobs['Jobs_Job_Name']) . "_invoice_" . $all_jobs['Jobs_Start_Time'];
            $get_customer_name =  str_replace("'", "", $all_jobs['Jobs_Customers_First']);
            
            $customer_email_1 = str_replace("'", "", $all_jobs['Jobs_Assignment_Email']);
            $customer_email_2 = str_replace("'", "", $all_jobs['Jobs_Customers_Email']);

            if ( strlen($customer_email_1) > 4 ) {
                $get_customer_email = $customer_email_1;
            } else if ( strlen($customer_email_2) > 4 ) {
                $get_customer_email = $customer_email_2;
            }
            $file_name = $get_file_name . ".pdf";
            ob_get_clean();
            $html2pdf = new HTML2PDF('P','A4','en',false,'UTF-8');
            $html2pdf->WriteHTML($content, false);
            ob_end_clean();
            $generated_pdf = $html2pdf->Output($file_name, 'S');
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->isHTML(true);
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            $email = 'info@languagelinkllc.net';
            $clientId = '695531997802-io8gesl9uajtbdmanrv8bmcf4inr80jm.apps.googleusercontent.com';
            $clientSecret = 'UorUEotA2HKcdMK7ClQlTEAz';
            $refreshToken = '1/LdxjM86r6QZf-qxLbx623DBr9OglvfL0uuI6U4OvMxs';
            $provider = new Google(
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                        'refreshToken' => $refreshToken,
                        'userName' => $email,
                    ]
                )
            );
            $mail->setFrom("info@languagelinkllc.net", 'Hermes Workflow');
            $mail->addAddress($get_customer_email, $get_customer_name);
            $mail->Subject = 'Beacon Link LLC Job Assignment';
            $mail->addStringAttachment($generated_pdf, $file_name, 'base64', 'pdf'); 
            $mail->CharSet = 'utf-8';
            $mail->Body = "
            <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
            <html>
                <head>
                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    <title>Beacon Link LLC</title>
                </head>
                <body>
                    <div style='width: 640px; font-family: Arial, Helvetica, sans-serif;'>

                        <div style='margin-bottom: 100px;'>
                            Hello " . $get_customer_name . ". Please find attached to this mail the assignment details and form.
                        </div>

                        <div style='font-size: 12px'>
                        <a href='https://www.beacon-link.com/'><img src='https://i.imgur.com/NpAGP9G.png' style='width: 200px;'></a> <br/>
                        José Alfredo Herrera <br/>
                        Beacon Link, LLC <br/>
                        Operation Manager <br/>
                        <a href='tel:+14703154949'>470 315 4949</a> (o) Ext 301 <br/>
                        <a href='tel:+14705547751'>470.554.7751</a> Direct <br/>
                        678 999 5383 (fax) <br/>
                        <a href='tel:+18447067388'>1 844 706 7388</a> (toll free) <br/>
                        <a href='tel:+16783159046'>678 315.9046</a> © <br/>
                        <a href='https://www.beacon-link.com/'>www.beacon-link.com</a> <br/>
                        <a href='https://www.proz.com/interpreter/1290224'>http://www.proz.com/profile/1290224</a> <br/>
                        <span style='color: #0e7fbd; font-weight: bold;'>The power of Language. One Language at the time. Communication Made simple &reg;</span> <br/>
                        This e-mail and any attachments are confidential and may be protected by legal privilege. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of this e-mail or any attachment is prohibited. If you have received this e-mail in error, please notify us immediately by returning it to the sender and delete this copy from your system. Thank you for your co-operation.
                        </div>

                    </div>
                </body>
            </html>
            ";
            $mail->AltBody = 'Beacon Link LLC Job Assignment';
            if (!$mail->send()) {
                return response()->json("Could not send email");
            } else {
                return response()->json("Email was sent Successfully");
            }
        } catch (Html2PdfException $e) {
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

    public function getAllServicesForCustomer($customer_name){
        $services_arr = array();
        $g_customer_name = trim($customer_name);
        $get_services_for_customer_sql = "SELECT Service_Name FROM services WHERE Service_Cus_Number LIKE '%$g_customer_name%' AND Service_Type = 'Service'";
        // var_dump($get_services_for_customer_sql);
        // die();
        
        $get_services_for_customer = \DB::select($get_services_for_customer_sql);
        for ($i=0; $i < count($get_services_for_customer); $i++) {
            // $service_name = str_replace("'", "", get_object_vars($get_services_for_customer[$i])["Service_Name"]);
            $service_name = get_object_vars($get_services_for_customer[$i])["Service_Name"];
            array_push($services_arr, $service_name);
        }
        if ( count($services_arr) > 0 ){
            return response()->json($services_arr);
        } else {
            return response()->json($services_arr);
        }
    }

    public function getAllMileageForCustomer($customer_name){
        $services_arr = array();
        $g_customer_name = trim($customer_name);
        $get_services_for_customer_sql = "SELECT Service_Name, Service_Code, Service_Rate FROM services WHERE Service_Cus_Number LIKE '%$g_customer_name%' AND Service_Type = 'Mileage'";
        // var_dump($get_services_for_customer_sql);
        // die();
        
        $get_services_for_customer = \DB::select($get_services_for_customer_sql);
        for ($i=0; $i < count($get_services_for_customer); $i++) {
            // $service_name = str_replace("'", "", get_object_vars($get_services_for_customer[$i])["Service_Name"]);
            $service_name = get_object_vars($get_services_for_customer[$i])["Service_Name"];
            array_push($services_arr, $service_name);
        }
        if ( count($services_arr) > 0 ){
            return response()->json($services_arr);
        } else {
            return response()->json($services_arr);
        }
    }

    public function getAllMileageServicesForCustomer($customer_name){
        $services_arr = array();
        $services_arr_outer = array();
        $g_customer_name = trim($customer_name);
        $get_services_for_customer_sql = "SELECT Service_Name, Service_Code, Service_Rate FROM services WHERE Service_Cus_Number LIKE '%$g_customer_name%' AND Service_Type = 'Mileage'";
        $get_services_for_customer = \DB::select($get_services_for_customer_sql);
        // var_dump($get_services_for_customer);
        // die();
        for ($i=0; $i < count($get_services_for_customer); $i++) {
                
                $service_name = str_replace("'", "", get_object_vars($get_services_for_customer[$i])["Service_Name"]);
                array_push($services_arr, $service_name);

                // $Service_Code = str_replace("'", "", get_object_vars($get_services_for_customer[$i])["Service_Code"]);
                // array_push($services_arr, $Service_Code);

                // $Service_Rate = str_replace("'", "", get_object_vars($get_services_for_customer[$i])["Service_Rate"]);
                // array_push($services_arr, $Service_Rate);
            

            // array_push($services_arr_outer, $services_arr);
        }
        if ( count($services_arr) > 0 ){
            return response()->json($services_arr);
        } else {
            return response()->json($services_arr);
        }
    }

    public function getCustomerDetails($customer_name){
        $customer_details_arr = array();
        $g_customer_name = trim($customer_name);
        $get_customer_details_sql = "SELECT ID, Cus_Company_Name, Cus_First_Name, Cus_Last_Name, Cus_Email_Address FROM customers WHERE Cus_Company_Name LIKE '%$g_customer_name%'";
        $get_customer_details = \DB::select($get_customer_details_sql);
        for ($i=0; $i < count($get_customer_details); $i++) {

            // $l_Cus_ID = str_replace("'", "", get_object_vars($get_customer_details[$i])["ID"]);
            $l_Cus_ID = get_object_vars($get_customer_details[$i])["ID"];
            array_push($customer_details_arr, $l_Cus_ID);

            // $l_Cus_First_Name = str_replace("'", "", get_object_vars($get_customer_details[$i])["Cus_First_Name"]);
            $l_Cus_First_Name = get_object_vars($get_customer_details[$i])["Cus_First_Name"];
            array_push($customer_details_arr, $l_Cus_First_Name);

            // $l_Cus_Last_Name = str_replace("'", "", get_object_vars($get_customer_details[$i])["Cus_Last_Name"]);
            $l_Cus_Last_Name = get_object_vars($get_customer_details[$i])["Cus_Last_Name"];
            array_push($customer_details_arr, $l_Cus_Last_Name);

            // $l_Cus_Email_Address = str_replace("'", "", get_object_vars($get_customer_details[$i])["Cus_Email_Address"]);
            $l_Cus_Email_Address = get_object_vars($get_customer_details[$i])["Cus_Email_Address"];
            array_push($customer_details_arr, $l_Cus_Email_Address);
        }
        if ( count($customer_details_arr) > 0 ){
            return response()->json($customer_details_arr);
        } else {
            return response()->json($customer_details_arr);
        }
    }

    public function getServiceRates($service_name, $company_name){
        $srv_rates_details_arr = array();
        $g_service_name = trim($service_name);
        $g_company_name = trim($company_name);
        $get_srv_rates_sql = "SELECT * FROM services WHERE Service_Name LIKE '%$g_service_name%' AND Service_Cus_Number LIKE '%$g_company_name%' ";
        // var_dump($get_srv_rates_sql);
        // die();
        $get_srv_rates = \DB::select($get_srv_rates_sql);
        // var_dump("SELECT * FROM services WHERE Service_Name LIKE '%$g_service_name%' AND Service_Cus_Number LIKE '%$g_company_name%' ");
        // var_dump($get_srv_rates);
        // die();

        for ($i=0; $i < count($get_srv_rates); $i++) {

            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Name"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Name"]);
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_State"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_State"]);

            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Code"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Code"]);
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Rate"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Rate"]);

            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Cus_Number"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Cus_Number"]);
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Type"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Type"]);

        }

        //var_dump($srv_rates_details_arr);
        //die();

        if ( count($srv_rates_details_arr) > 0 ){
            return response()->json($srv_rates_details_arr);
        } else {
            return response()->json($srv_rates_details_arr);
        }
    }
    public function getMileageRates($service_name, $company_name){
        $srv_rates_details_arr = array();
        $g_service_name = trim($service_name);
        $g_company_name = trim($company_name);
        $get_srv_rates_sql = "SELECT * FROM services WHERE Service_Name LIKE '%$g_service_name%' AND Service_Cus_Number LIKE '%$g_company_name%' ";
        // var_dump($get_srv_rates_sql);
        // die();
        $get_srv_rates = \DB::select($get_srv_rates_sql);
        // var_dump("SELECT * FROM services WHERE Service_Name LIKE '%$g_service_name%' AND Service_Cus_Number LIKE '%$g_company_name%' ");
        // var_dump($get_srv_rates);
        // die();

        for ($i=0; $i < count($get_srv_rates); $i++) {

            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Name"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Name"]);
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_State"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_State"]);

            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Code"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Code"]);
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Rate"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Rate"]);

            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Cus_Number"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Cus_Number"]);
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Type"]));
            array_push($srv_rates_details_arr, get_object_vars($get_srv_rates[$i])["Service_Type"]);

        }

        //var_dump($srv_rates_details_arr);
        //die();

        if ( count($srv_rates_details_arr) > 0 ){
            return response()->json($srv_rates_details_arr);
        } else {
            return response()->json($srv_rates_details_arr);
        }
    }

    public function getLanguagesForView(){
        $get_languages_arr = array();
        // $g_service_name = trim($service_name);
        // $g_company_name = trim($company_name);
        $get_languages_sql = "SELECT language FROM languages";
        $languages_sql = \DB::select($get_languages_sql);
         // var_dump($languages_sql);
         // die();

        for ($i=0; $i < count($languages_sql); $i++) {

            array_push($get_languages_arr, str_replace("'", "", get_object_vars($languages_sql[$i])["language"]));
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_State"]));

            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Code"]));
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Rate"]));

            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Cus_Number"]));
            
            // array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Type"]));

        }

        //var_dump($get_languages_arr);
        //die();

        if ( count($get_languages_arr) > 0 ){
            return response()->json($get_languages_arr);
        } else {
            return response()->json($get_languages_arr);
        }
    }

    public function getDateRange(Request $request){

        dd($request->get('date'));
    }

    
      public function storeUpload(Request $request)
    {
            $path = storage_path('app/public/llcuploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file = $request->file('file');

            $name = uniqid() . '_' . trim($file->getClientOriginalName());

            $file->move($path, $name);

            return response()->json([
                'name'          => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
 
        
    }

    public function upload(Request $request){

            $path = storage_path('app/public/llcuploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file = $request->file('file');

            $name = uniqid() . '_' . trim($file->getClientOriginalName());

            $file->move($path, $name);

    
            return response()->json([
                'name'          => $name,
                'original_name' => $file->getClientOriginalName(),
              
            ]);

    }

    public function upload2(Request $request, FileName $fileName ){

    }

    public function inicio(){
        return view('job_edit');
    }

    
}
