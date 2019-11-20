<?php


namespace App\Http\Controllers;

use App\CustomersModel;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Storage;


class CustomersController extends Controller
{
    // start get functions
    public function index(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_customers = \DB::select('SELECT * FROM customers limit 0, 50');
        return view( 'customers_views', ['customers'=>$get_customers] );
    }

    public function customersListWithPageNo($getPageNo = null){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $result = CustomersModel::modelCustomersListWithPageNo($getPageNo);
        return view( 'customers_views/customers', $result);
    }

    public function getCustomersWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_customers_with_id_sql = \DB::select("SELECT * FROM customers WHERE ID = $the_id");
        return view('customers_views/customers_single', ['customers'=>$get_customers_with_id_sql] );
    }

    public function getCustomersWithID2(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $newCustomersController = new CustomersController();
        $g_the_id = htmlspecialchars(trim($_GET['id']));
        $g_result = $newCustomersController->getCustomersWithID($g_the_id);
        return $g_result;
        // $the_id = htmlspecialchars(trim($_GET['g_the_id']));
        // if ( isset($the_id) && intval($the_id) >= 1 ) {
        //     $get_the_id = $the_id;
        // } else {
        //     $get_the_id = 1;
        // }
        // $get_customers_with_id_sql = \DB::select("SELECT * FROM customers WHERE ID = $the_id");
        // return view('customers_views/customers_single', ['customers'=>$get_customers_with_id_sql] );
    }



    //start edit functions
    public function getCustomersToEditWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_customers_with_id_sql = \DB::select("SELECT * FROM customers WHERE ID = $the_id");
        return view('customers_views/customers_edit', ['customers_with_id'=>$get_customers_with_id_sql] );
    }

    public function editCustomersWithID(Request $request){
        if (!(Auth::check())) {
            return redirect('/login');
        }

        if ( count($request->file('custmr_edit_file_upload')) > 0 ) {
            $all_files_array = array();
            for ($i=0; $i < count($request->file('custmr_edit_file_upload')); $i++) { 
                
                $file = $request->file('custmr_edit_file_upload')[$i];
                if ( !isset( $file ) ) {
                    $file_name = " ";
                } else{
                    $upload_succes = Storage::putfile('public/llcuploads', $request->file('custmr_edit_file_upload')[$i]);
                    $file_name = substr($upload_succes, 18);
                }  
                array_push($all_files_array, $file_name);
            }
            $get_all_files_array_0 = implode(",", $all_files_array);
            $get_all_files_array = $get_all_files_array_0 . ", " . Input::get('edit_custmr_old_val');
            // $get_all_files_array = implode(",", $all_files_array);
        } else if (is_null($request->file('custmr_edit_file_upload'))){
            // $get_all_files_array = " ";
            $get_all_files_array = Input::get('edit_custmr_old_val');
        } else {
            $get_all_files_array = Input::get('edit_custmr_old_val');
        }

        $update_customers_sql_code = "UPDATE customers SET 
            Cus_First_Name = " . \DB::connection()->getPDO()->quote(Input::get('Customer_First_Name')) .", 
            Cus_Middle_Name = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Middle_Name')) .", 
            Cus_Last_Name = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Last_Name')) .", 
            Cus_Company_Name = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Company_Name')) .", 
            Cus_Billing_Street_Address_1 = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Street_Address_1')) .", 
            Cus_Billing_Street_Address_2 = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Street_Address_2')) .", 
            Cus_Billing_City = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_City')) .", 
            Cus_Billing_State = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_State')) .", 
            Cus_Billing_Zip = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Zip')) .", 
            Cus_Notes = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Notes')) .", 
            Cus_Billing_Notes = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Notes')) .", 
            Cus_Service = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Service')) .", 
            Cus_Attachments = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Attachments')) .", 
            Cus_Billing_Term = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Term')) .", 
            Cus_Phone_Number = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Phone_Number')) .", 
            Cus_Fax_Number = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Fax_Number')) .", 
            Cus_Phone_Other = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Phone_Other')) .", 
            Cus_WebSite = " . \DB::connection()->getPDO()->quote(Input::get('Customer_WebSite')) .", 
            Cus_Email_Address = " . \DB::connection()->getPDO()->quote(Input::get('Customer_Email_Address')) .", 
            Cus_LL_Wiki = " . \DB::connection()->getPDO()->quote(Input::get('Customer_LL_Wiki')) .",
            attachments =  '" . $get_all_files_array . "'
            WHERE ID =  " . Input::get('customer_id');

        // var_dump($update_customers_sql_code);
        // die();
        $update_customers_with_id_sql = \DB::update($update_customers_sql_code);
        if ($update_customers_with_id_sql){
            return response()->json("Customer Successfully Updated");
        } else {
            return response()->json("Error. Could Not Update Customer");
        }
    }
    //end edit functions

    ////////////////////////////////////////////////////////////

    // start create functions
    public function getCreateCustomersView(Request $the_request){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        return view('customers_views/customers_create');
    }
    
    public function createCustomers(Request $the_request){
        if (!(Auth::check())) {
            return redirect('/login');
        }

        $all_files_array = array();

        for ($i=0; $i < count($the_request->file('custmr_create_file_upload')); $i++) { 
            
            $file = $the_request->file('custmr_create_file_upload')[$i];
            if ( !isset( $file ) ) {
                $file_name = " ";
            } else{
                $upload_succes = Storage::putfile('public/llcuploads', $the_request->file('custmr_create_file_upload')[$i]);
                $file_name = substr($upload_succes, 18);
            }  
            array_push($all_files_array, $file_name);
        }
        $get_all_files_array = implode(",", $all_files_array);


        $create_new_customers_sql_code = "
            INSERT INTO customers 
                (   ID,
					Cus_First_Name,
					Cus_Middle_Name,
					Cus_Last_Name,
					Cus_Company_Name,
					Cus_Billing_Street_Address_1,
					Cus_Billing_Street_Address_2,
					Cus_Billing_City,
					Cus_Billing_State,
					Cus_Billing_Zip,
					Cus_Notes,
					Cus_Billing_Notes,
					Cus_Service,
					Cus_Attachments,
					Cus_Billing_Term,
					Cus_Phone_Number,
					Cus_Fax_Number,
					Cus_Phone_Other,
					Cus_WebSite,
					Cus_Email_Address,
					Cus_LL_Wiki,
                    attachments
                )
            VALUES 
                (
                    DEFAULT,
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_First_Name')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Middle_Name')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Last_Name')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Company_Name')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Street_Address_1')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Street_Address_2')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_City')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_State')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Zip')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Notes')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Notes')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Service')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Attachments')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Billing_Term')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Phone_Number')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Fax_Number')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Phone_Other')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_WebSite')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_Email_Address')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Customer_LL_Wiki')) . ", '". $get_all_files_array . "'" .
                ")";
        // var_dump($create_new_customers_sql_code);
        // die();
        $create_new_customers = \DB::insert($create_new_customers_sql_code);
        // var_dump($create_new_customers);
        // die();
        if ($create_new_customers){
            return response()->json("Customers Created Successfully");
        } else {
            return response()->json("Error. Could Not Create Customers");
        }
    }
    // end create functions

    
    public function deleteCustomers(Request $the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    // public function deleteCustomers($the_id){
        $delete_customers_sql_code = 
        " 
            DELETE FROM customers WHERE 
            ID = ". \DB::connection()->getPDO()->quote(Input::get('get_the_id')) ." 
        ";
        $delete_customers = \DB::delete($delete_customers_sql_code);
        // var_dump($delete_customers);
        // die();
        if ($delete_customers){
            return response()->json("Customers Deleted Successfully");
        } else {
            return response()->json("Error. Could Not Delete Customers");
        }
        //$create_new_customers_sql_code = "DELETE FROM customers WHERE ID = ". $the_id ."  ";
    }

    public function getCustomersMainSearch(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $query = htmlspecialchars(trim(stripcslashes(Input::get('q'))));
        
        if ( (intval( Input::get('page') ) > 0 ) ){
            $pageNumber = intval(Input::get('page'));
        } else {
            $pageNumber = 1;
        }

        $sql_query_1 = 
        "
            SELECT * FROM customers WHERE MATCH (Cus_First_Name, Cus_Middle_Name, Cus_Last_Name, Cus_Company_Name, Cus_Notes, Cus_Billing_Notes, Cus_Service, Cus_Billing_Term, Cus_Phone_Other, Cus_WebSite, Cus_Email_Address, Cus_LL_Wiki) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";

        $sql_count_query_1 = 
        "
            SELECT count(*) as count FROM customers WHERE MATCH (Cus_First_Name, Cus_Middle_Name, Cus_Last_Name, Cus_Company_Name, Cus_Notes, Cus_Billing_Notes, Cus_Service, Cus_Billing_Term, Cus_Phone_Other, Cus_WebSite, Cus_Email_Address, Cus_LL_Wiki) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";

        // var_dump($sql_query_1);
        // var_dump($sql_count_query_1);
        // die();

        $result_customers = CustomersModel::modelCustomersGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        // var_dump($result_customers);
        // die();
        return view( 'customers_views/customers_search', $result_customers);
    }

}

