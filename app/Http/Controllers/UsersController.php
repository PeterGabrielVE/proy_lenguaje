<?php


namespace App\Http\Controllers;

use App\UsersModel;
use App\CustomersModel;
use App\Http\Controllers\Auth\RegisterController;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

class UsersController extends Controller
{
    // start get functions
    public function index(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_users = \DB::select('SELECT * FROM users limit 0, 50');
        return view( 'users_views', ['users'=>$get_users] );
    }

    // public function modelUsersListWithPageNo($getPageNo = null){
       
    // }

    public function usersListWithPageNo($getPageNo = null){
        if (!(Auth::check())) {
            return redirect('/login');
        }

         if ( (isset( $getPageNo )) && (!empty( $getPageNo )) && (intval( $getPageNo ) > 0 ) ){
            $get_page_number = intval($getPageNo);
        } else {
            $get_page_number = 1;
        }

        if ( $get_page_number === 1 ){
            $modified_page_number =  1;
        } else if ( $get_page_number <= 0 ){
            $modified_page_number =  1;
        } else {
            $modified_page_number = $get_page_number;
        }

        $no_of_posts_to_show = 50;

        $limit_to_start_from = 0;
        $limit_to_start_from = ( intval($modified_page_number) - 1) * $no_of_posts_to_show;
        $get_all_postss_array = array(" ");

        $no_of_rows_result = \DB::select('select count(*) as count from users');
        $convert_obj_to_arr = get_object_vars($no_of_rows_result[0]);
        $pages_count = $convert_obj_to_arr["count"];
        $current_page_number_input = $get_page_number;

        $no_of_pages_left = ceil(intval($pages_count) / $no_of_posts_to_show) - intval($current_page_number_input);
        $pages_left = $no_of_pages_left < 0 ? '0' : intval($no_of_pages_left);

        $the_next_page_number = $get_page_number + 1;
        if (($get_page_number - 1) <= 0) {
            $the_previous_page_number = 1;
        } else {
            $the_previous_page_number = $get_page_number - 1;
        }

        $get_showing_end_at = $limit_to_start_from + 50;

        $get_users = \DB::select("SELECT * FROM users ORDER BY ID DESC LIMIT $limit_to_start_from, $no_of_posts_to_show ");
        
        return view('users_views/users', ['users'=>$get_users, 'get_no_of_pages_left'=>$pages_left, 'get_current_page_number'=>$get_page_number, 'get_next_page_number'=>$the_next_page_number, 'get_previous_page_number'=>$the_previous_page_number, 'get_showing_start_at'=>$limit_to_start_from, 'get_showing_end_at'=>$get_showing_end_at, 'total_number_of_entries'=>$pages_count]);


        // $result = this.modelUsersListWithPageNo($getPageNo);
        // return view( 'users_views/users', $result);
    }

    public function getUsersWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_users_with_id_sql = \DB::select("SELECT * FROM users WHERE ID = $the_id");
        return view('users_views/users_single', ['users'=>$get_users_with_id_sql] );
    }

    public function getUsersWithID2(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $the_id = htmlspecialchars(trim($_GET['g_the_id']));
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_users_with_id_sql = \DB::select("SELECT * FROM users WHERE ID = $the_id");
        return view('users_views/users_single', ['users'=>$get_users_with_id_sql] );
    }



    //start edit functions
    public function getUsersToEditWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_users_with_id_sql = \DB::select("SELECT * FROM users WHERE ID = $the_id");
        return view('users_views/users_edit', ['users_with_id'=>$get_users_with_id_sql] );
    }

    public function editUsersWithID(Request $request){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if(Input::get("password")!=''){
            $update_users_sql_code = "UPDATE users SET 
                name = " . \DB::connection()->getPDO()->quote(Input::get('Full_Name')) .",
                password = ". \DB::connection()->getPDO()->quote(bcrypt(Input::get('password'))) ."
                WHERE id =  " . Input::get('user_id');
        }else{
            $update_users_sql_code = "UPDATE users SET 
                name = " . \DB::connection()->getPDO()->quote(Input::get('Full_Name')) ."
                WHERE id =  " . Input::get('user_id');
        }
        $update_users_with_id_sql = \DB::update($update_users_sql_code);
        if ($update_users_with_id_sql){
            return response()->json("User Successfully Updated");
        } else {
            return response()->json("Error. Could Not Update User");
        }
    }
    //end edit functions

    ////////////////////////////////////////////////////////////

    // start create functions
    public function getCreateUsersView(Request $the_request){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        return view('users_views/users_create');
    }
    
    public function createUsers(Request $the_request){
         if (!(Auth::check())) {
            return redirect('/login');
        }
        // var_dump(Input::get('User_Full_Name'));
        // var_dump(Input::get('Email_Address'));
        // var_dump(Input::get('Password'));
        $user_find = \DB::select("SELECT * FROM users where email = ".Input::get('Email_Address'));
        if(count($user_find)>0){
            return response()->json("Error. Could Not Create Users");
        }else{
            $pass_array = array("name"=>Input::get('User_Full_Name'), "email"=>Input::get('Email_Address'), "password"=>Input::get('Password'), "is_admin"=>Input::get('IsAdmin'));
        //var_dump($pass_array);
        
            RegisterController::accessCreate($pass_array);
        }
        // if (RegisterController::accessCreate($pass_array)) {
        //     echo "True";
        // } else {
        //     echo "False";
        // }
        //var_dump();

        //die();
        //var_dump($create_new_users_sql_code);
        // $create_new_users = \DB::insert($create_new_users_sql_code);
        // if ($create_new_users){
        //     return response()->json("Users Created Successfully");
        // } else {
        //     return response()->json("Error. Could Not Create Users");
        // }
    }
    // end create functions

    
    public function deleteUsers(Request $the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
    // public function deleteUsers($the_id){
        $delete_users_sql_code = 
        " 
            DELETE FROM users WHERE 
            ID = ". \DB::connection()->getPDO()->quote(Input::get('get_the_id')) ." 
        ";
        $delete_users = \DB::delete($delete_users_sql_code);
        // var_dump($delete_users);
        // die();
        if ($delete_users){
            return response()->json("Users Deleted Successfully");
        } else {
            return response()->json("Error. Could Not Delete Users");
        }
        //$create_new_users_sql_code = "DELETE FROM users WHERE ID = ". $the_id ."  ";
    }


}

