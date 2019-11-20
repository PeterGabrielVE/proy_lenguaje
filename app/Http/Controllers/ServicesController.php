<?php
namespace App\Http\Controllers;
use App\ServicesModel;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    // start get functions
    public function index(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_services = \DB::select('SELECT * FROM services limit 0, 50');
        return view( 'services_views', ['services'=>$get_services] );
    }

    public function servicesListWithPageNo($getPageNo = null){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $result = ServicesModel::modelServicesListWithPageNo($getPageNo);
        return view( 'services_views/services', $result);
    }

    public function getServicesWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_services_with_id_sql = \DB::select("SELECT * FROM services WHERE ID = $the_id");
        return view('services_views/services_single', ['services'=>$get_services_with_id_sql] );
    }

    public function getServicesWithID2(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $the_id = htmlspecialchars(trim($_GET['g_the_id']));
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_services_with_id_sql = \DB::select("SELECT * FROM services WHERE ID = $the_id");
        return view('services_views/services_single', ['services'=>$get_services_with_id_sql] );
    }

    //start edit functions
    public function getServicesToEditWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_services_with_id_sql = \DB::select("SELECT * FROM services WHERE ID = $the_id");
        return view('services_views/services_edit', ['services_with_id'=>$get_services_with_id_sql] );
    }

    public function editServicesWithID(Request $request){
        if (!(Auth::check())) {
            return redirect('/login');
        }

        $all_files_array = array();

        if ( count($request->file('edit_service_file_upload')) > 0 ) {
            for ($i=0; $i < count($request->file('edit_service_file_upload')); $i++) { 
            
                $file = $request->file('edit_service_file_upload')[$i];
                if ( !isset( $file ) ) {
                    $file_name = " ";
                } else{
                    $upload_succes = Storage::putfile('public/llcuploads', $request->file('edit_service_file_upload')[$i]);
                    $file_name = substr($upload_succes, 18);
                }  
                array_push($all_files_array, $file_name);
            }
            $get_all_files_array_0 = implode(",", $all_files_array);
            $get_all_files_array = $get_all_files_array_0 . ", " . Input::get('edit_serv_old_vals');
            // $get_all_files_array = implode(",", $all_files_array);
        } else if (is_null($request->file('edit_service_file_upload'))){
            // $get_all_files_array = " ";
            $get_all_files_array = Input::get('edit_serv_old_vals');
        } else {
            $get_all_files_array = Input::get('edit_serv_old_vals');
        }
        // var_dump($get_all_files_array);
        // die();
        // $get_customer_name_and_id = Input::get('customer_name_and_id');
        // var_dump( explode(",", $get_customer_name_and_id) );
        // die();
        

        $update_services_sql_code = "UPDATE services SET 
            Service_Name = " . \DB::connection()->getPDO()->quote(Input::get('Service_Name')) .", 
            Service_State = " . \DB::connection()->getPDO()->quote(Input::get('Service_State')) .", 
            Service_Code = " . \DB::connection()->getPDO()->quote(Input::get('Service_Code')) .", 
            Service_Rate = " . \DB::connection()->getPDO()->quote(Input::get('Service_Rate')) .", 
            Service_Type = " . \DB::connection()->getPDO()->quote(Input::get('Service_Type')) .",   
                attachments = '" . $get_all_files_array ."' 
            WHERE ID =  " . Input::get('service_id');


        // var_dump($update_services_sql_code);
        // die();

        $update_services_with_id_sql = \DB::update($update_services_sql_code);

        // var_dump($update_services_with_id_sql);
        // die();

        if ($update_services_with_id_sql){
            return response()->json("Services Successfully Updated");
        } else {
            return response()->json("Error. Could Not Update Services");
        }
        
    }
    //end edit functions

    ////////////////////////////////////////////////////////////

    // start create functions
    public function getCreateServicesView(Request $the_request){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        return view('services_views/services_create');
    }
    
    public function createServices(Request $the_request){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $all_files_array = array();

        for ($i=0; $i < count($the_request->file('create_service_file_upload')); $i++) { 
            
            $file = $the_request->file('create_service_file_upload')[$i];
            if ( !isset( $file ) ) {
                $file_name = " ";
            } else{
                $upload_succes = Storage::putfile('public/llcuploads', $the_request->file('create_service_file_upload')[$i]);
                $file_name = substr($upload_succes, 18);
            }  
            array_push($all_files_array, $file_name);
        }
        $get_all_files_array = implode(",", $all_files_array);

        $get_cu_name_with_id = \DB::select("SELECT Cus_Company_Name from customers WHERE ID = " . Input::get('Service_Customer_ID'));
        $cu_name = get_object_vars($get_cu_name_with_id[0])["Cus_Company_Name"];
        // die();

        $create_new_services_sql_code = "
            INSERT INTO services 
                (   ID,
					Service_Name,
					Service_State,
					Service_Code,
					Service_Rate,
					Service_Cus_Number,
					Service_Type,
                    attachments,
                    customer_id
                )
            VALUES 
                (
                    DEFAULT,
                    " . \DB::connection()->getPDO()->quote(Input::get('Service_Name')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Service_State')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Service_Code')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Service_Rate')) .", 
                    " . \DB::connection()->getPDO()->quote($cu_name) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Service_Type')) . ", '" . $get_all_files_array . "',
                    " . \DB::connection()->getPDO()->quote(Input::get('Service_Customer_ID')) .
                ")";

        // var_dump($create_new_services_sql_code);
        // die();

        $create_new_services = \DB::insert($create_new_services_sql_code);
        if ($create_new_services){
            return response()->json("Service Created Successfully");
        } else {
            return response()->json("Error. Could Not Create Services");
        }
    }
    // end create functions

    
    public function deleteServices(Request $the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    // public function deleteServices($the_id){
        $delete_services_sql_code = 
        " 
            DELETE FROM services WHERE 
            ID = ". \DB::connection()->getPDO()->quote(Input::get('get_the_id')) ." 
        ";
        $delete_services = \DB::delete($delete_services_sql_code);
        // var_dump($delete_services);
        // die();
        if ($delete_services){
            return response()->json("Services Deleted Successfully");
        } else {
            return response()->json("Error. Could Not Delete Services");
        }
        //$create_new_services_sql_code = "DELETE FROM services WHERE ID = ". $the_id ."  ";
    }

    
    public function getServicesMainSearch(Request $the_state){
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
            SELECT * FROM services WHERE MATCH (Service_Name, Service_State, Service_Cus_Number, Service_Type) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";

        $sql_count_query_1 = 
        "
            SELECT count(*) as count FROM services WHERE MATCH (Service_Name, Service_State, Service_Cus_Number, Service_Type) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";
        $result_job_main_search = ServicesModel::modelServicesGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        // var_dump($result_job_main_search);
        // die();
        return view( 'services_views/services_search', $result_job_main_search);

    }



}

