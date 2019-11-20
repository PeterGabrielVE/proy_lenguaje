<?php

namespace App\Http\Controllers;

use App\Helpers\DRBAgencyFunctions;

use App\ContractorsModel;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

class ContractorsController extends Controller 
{
    // start get functions
    public function index(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_contractors = \DB::select('SELECT * FROM contractors limit 0, 50');
        return view( 'contractor_views/contractors', ['contractors'=>$get_contractors] );
    }
 
    public function contractorsListWithPageNo($getPageNo = null){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $result = ContractorsModel::modelContractorsListWithPageNo($getPageNo);
        return view( 'contractor_views/contractors', $result);
    }

    public function getContractorWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( is_numeric($the_id) ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = intval('1');
        }
        $get_contractors_with_id_sql = \DB::select("SELECT * FROM contractors WHERE ID = $get_the_id");
        return view('contractor_views/contractors_single', ['contractors'=>$get_contractors_with_id_sql] );
    }

    public function getContractorWithID2(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $the_id = htmlspecialchars(trim(Input::get('id')));
        $newContractorsController = new ContractorsController();
        $return_val = $newContractorsController->getContractorWithID($the_id);
        return $return_val;
    }

    //start edit functions
    public function getContractorToEditWithID($the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_contractor_with_id_sql = \DB::select("SELECT * FROM contractors WHERE ID = $the_id");
        return view('contractor_views/contractors_edit', ['contractor_with_id'=>$get_contractor_with_id_sql] );
        
    }

    public function editContractorWithID(Request $request){
        if (!(Auth::check())) {
            return redirect('/login');
        }

    
        if (isset($request->title)) {
           
            $title = $request->title;
            $select_title = implode(',',$title);

        }else{
            $select_title = "";

        }
        //dd($request->all());
        //dd($select_title);

         //var_dump(Input::get('contractor_Thursday_End'));
        // die();
    ;
        if (isset($request->referred)) {
            
            $referred = $request->referred;
            $select_referred = implode(',',$referred);

        }else{
            $select_referred = "";

        }

        if (isset($request->language)) {
         
            $language = $request->language;
            $select_language = implode(',',$language);

        }else{
            $select_language = "";

        }


         /* MONDAY */

         if (isset($request->check_day_monday)) {
            
            $ava_monday = $request->check_day_monday;

        }else{
            $ava_monday = "NO";

        }

         /* TUESDAY */

         if (isset($request->check_day_tuesday)) {
            
            $ava_tuesday = $request->check_day_tuesday;

        }else{
            $ava_tuesday = "NO";

        }

         /* WEDNESDAY */

         if (isset($request->check_day_wednesday)) {
            
            $ava_wednesday = $request->check_day_wednesday;

        }else{
            $ava_wednesday = "NO";

        }

         /* THURSDAY */

         if (isset($request->check_day_thursday)) {
            
            $ava_thursday = $request->check_day_thursday;

        }else{
            $ava_thursday = "NO";

        }

         /* FRIDAY */


        if (isset($request->check_day_friday)) {
            
            $ava_friday = $request->check_day_friday;

        }else{
            $ava_friday = "NO";

        }

        // $file = $request->file('contractor_edit_contractor_file_upload');
        // if ( !isset( $file ) ) {
        //     $contractor_file_edit_name = Input::get('original_file_name');
        // } else{
        //     $upload_succes = Storage::putfile('public/llcuploads', $request->file('contractor_edit_contractor_file_upload'));
        //     $contractor_file_edit_name = substr($upload_succes, 18);
        // }

        // var_dump($request->file('contractor_edit_contractor_file_upload'));
        // die();
    
                   
        // var_dump( $request->file('contractor_edit_contractor_file_upload'));
        //     die();

        // var_dump(Input::get('edit_con_old_val'));
        // die();
        
          if( count($request->input('attachment_contractor_file_upload')) > 0 ) {
            
            $all_files_array = array();

            for ($i=0; $i < count($request->input('attachment_contractor_file_upload')); $i++)  {
            $file = $request->input('attachment_contractor_file_upload')[$i];
            $save_name = $file;

            $contractors = new ContractorsModel();
            $contractors->Con_Attachments = $save_name;
           

            array_push($all_files_array, $save_name);
        }
         
       
        $get_all_files_array_0 = implode(",", $all_files_array);
        $get_all_files_array = $get_all_files_array_0 . ", " . $request->input('edit_con_old_val'); 
        }else if (is_null($request->input('attachment_contractor_file_upload'))){
          
            $get_all_files_array = Input::get('edit_con_old_val');
        } else {
            $get_all_files_array = Input::get('edit_con_old_val');
        } 

        // ARRAY CERTIFICATIONS

        if( count($request->input('certification_edit_contractor_file_upload')) > 0 ) {
            
            $all_certifications_array = array();

            for ($i=0; $i < count($request->input('certification_edit_contractor_file_upload')); $i++)  {
            $file = $request->input('certification_edit_contractor_file_upload')[$i];
            $save_name = $file;

            $contractors = new ContractorsModel();
            $contractors->Con_Expertise_Certifications = $save_name;
           

            array_push($all_certifications_array, $save_name);
        }
         
       
        $get_all_certifications_array_0 = implode(",", $all_certifications_array);
        $get_all_certifications_array = $get_all_certifications_array_0 . ", " . $request->input('edit_certification_old_val');  
        } else if (is_null($request->input('certification_edit_contractor_file_upload'))){
          
            $get_all_certifications_array = Input::get('edit_certification_old_val');
        } else {
            $get_all_certifications_array = Input::get('edit_certification_old_val');
        }



        if( count($request->input('depost_edit_contractor_file_upload')) > 0 ) {
            
            $all_deposit_array = array();

            for ($i=0; $i < count($request->input('depost_edit_contractor_file_upload')); $i++)  {
            $file = $request->input('depost_edit_contractor_file_upload')[$i];
            $save_name = $file;

            $contractors = new ContractorsModel();
            $contractors->Con_Rate_Depost = $save_name;
           

            array_push($all_deposit_array, $save_name);
        }
         
       
        $get_all_deposit_array_0 = implode(",", $all_deposit_array);
        $get_all_deposit_array = $get_all_deposit_array_0 . ", " . $request->input('edit_deposit_con_old_val');

          
        } else if (is_null($request->input('depost_edit_contractor_file_upload'))){
          
            $get_all_deposit_array = Input::get('edit_deposit_con_old_val');
        } else {
            $get_all_deposit_array = Input::get('edit_deposit_con_old_val');
        } 



        $update_contractor_sql_code = "UPDATE contractors SET 
            Con_Suffix = " . \DB::connection()->getPDO()->quote(Input::get('Suffix')) .", 
            Con_Title = " . \DB::connection()->getPDO()->quote($select_title) .",
            Con_First_Name = " . \DB::connection()->getPDO()->quote(Input::get('Name')) .",
            Con_Initial = " . \DB::connection()->getPDO()->quote(Input::get('Initial')) .",  
            Con_Last_Name = " . \DB::connection()->getPDO()->quote(Input::get('Last_Name')) .", 
            Con_DBA = " . \DB::connection()->getPDO()->quote(Input::get('Decision_DBA')) .",
            Con_DBA_Name = " . \DB::connection()->getPDO()->quote(Input::get('DBA_Name')) .",
            Con_DBA_SSN = " . \DB::connection()->getPDO()->quote(Input::get('SSN')) .",
            Con_DBA_DBO = " . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Date_of_Birth')) ) .",     
            Con_DBA_Country = " . \DB::connection()->getPDO()->quote(Input::get('Country_of_Origin')) .", 
            Con_Physical_Address = " . \DB::connection()->getPDO()->quote(Input::get('Physical_Address')) .", 
            Con_City = " . \DB::connection()->getPDO()->quote(Input::get('City')) .", 
            Con_State = " . \DB::connection()->getPDO()->quote(Input::get('State')) .", 
            Con_Zip = " . \DB::connection()->getPDO()->quote(Input::get('Zip')) .", 
            Con_County = " . \DB::connection()->getPDO()->quote(Input::get('County')) .",
            Con_Mailing_Address = " . \DB::connection()->getPDO()->quote(Input::get('Mailing_Address')) .", 
            Con_MA_City = " . \DB::connection()->getPDO()->quote(Input::get('City2')) .", 
            Con_MA_State = " . \DB::connection()->getPDO()->quote(Input::get('State2')) .", 
            Con_MA_Zip_Code = " . \DB::connection()->getPDO()->quote(Input::get('Zip_Code2')) .", 
             Con_MA_County = " . \DB::connection()->getPDO()->quote(Input::get('County2')) .",  
            Con_Home_Phone = " . \DB::connection()->getPDO()->quote(Input::get('Home_Phone_Number')) .",
            Con_Cell_Phone = " . \DB::connection()->getPDO()->quote(Input::get('Mobile_1')) .", 
            Con_Cell_Phone2 = " . \DB::connection()->getPDO()->quote(Input::get('Mobile_2')) .",
            Con_Office_Phone = " . \DB::connection()->getPDO()->quote(Input::get('Office')) .",   
            Con_Fax_Phone = " . \DB::connection()->getPDO()->quote(Input::get('Fax')) .",
            Con_Other_Phone = " . \DB::connection()->getPDO()->quote(Input::get('Other')) .",  
            Con_E_mail_Address = " . \DB::connection()->getPDO()->quote(Input::get('Email_Address_1')) .",
            Con_E_mail_Address_2 = " . \DB::connection()->getPDO()->quote(Input::get('Email_Address_2')) .",
            Con_E_mail_Address_3 = " . \DB::connection()->getPDO()->quote(Input::get('Email_Address_3')) .",
            Con_Skype = " . \DB::connection()->getPDO()->quote(Input::get('Skype')) .", 
            Con_Website = " . \DB::connection()->getPDO()->quote(Input::get('Website')) .",   
            Con_TaxID = " . \DB::connection()->getPDO()->quote(Input::get('TaxID')) .", 
            Con_Birthdate = " . \DB::connection()->getPDO()->quote( setDateInDB(Input::get('Contractor_Birthdate')) ) .", 
            Con_Originating_Country = " . \DB::connection()->getPDO()->quote(Input::get('Originating_Country')) .", 
            Con_Afiliations = " . \DB::connection()->getPDO()->quote(Input::get('Afiliations')) .",
            Con_Language_1 = " . \DB::connection()->getPDO()->quote($select_language) .", 
            Con_Interpreter_Status = " . \DB::connection()->getPDO()->quote(Input::get('Interpreter_Status')) .",
            Con_Services = " . \DB::connection()->getPDO()->quote(Input::get('Services')) .",
            Con_Training_Certifications = " . \DB::connection()->getPDO()->quote(Input::get('TrainingCertifications')) .",
            Con_Payment_Method = " . \DB::connection()->getPDO()->quote(Input::get('PaymentMethod')) .",
            Con_Payment_Decision = " . \DB::connection()->getPDO()->quote(Input::get('Decision_Payment')) .",
            Con_Notes = " . \DB::connection()->getPDO()->quote(Input::get('Con_Fullfillment_Internal_Note')) .", 
            Con_Availability_Monday = " . \DB::connection()->getPDO()->quote($ava_monday) .", 
            Con_Avaiability_Monday_Start = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Monday_Start')) .", 
            Con_Avaiability_Monday_End = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Monday_End')) .", 
            Con_Availability_Tuesday = " . \DB::connection()->getPDO()->quote($ava_tuesday) .", 
            Con_Avaiability_Tuesday_Start = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Tuesday_Start')) .", 
            Con_Avaiability_Tuesday_End = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Tuesday_End')) .", 
            Con_Availability_Wednesday = " . \DB::connection()->getPDO()->quote($ava_wednesday) .", 
            Con_Avaiability_Wednesday_Start = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Wednesday_Start')) .", 
            Con_Avaiability_Webnesday_End = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Wednesday_End')) .", 
            Con_Availability_Thursday = " . \DB::connection()->getPDO()->quote($ava_thursday) .", 
            Con_Avaiability_Thursday_Start = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Thursday_Start')) .", 
            Con_Avaiability_Thursday_End = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Thursday_End')) .", 
            Con_Availability_Friday = " . \DB::connection()->getPDO()->quote($ava_friday) .", 
            Con_Avaiability_Friday_Start = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Friday_Start')) .", 
            Con_Avaiability_Friday_End = " . \DB::connection()->getPDO()->quote(Input::get('contractor_Friday_End')) .", 
            Con_Availability_Saturday = " . \DB::connection()->getPDO()->quote( processSelectVal((Input::get('Contractor_Availability_Saturday')) ) ) .", 
            Con_Avaiability_Saturday_Start = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Availability_Saturday_Start')) .", 
            Con_Avaiability_Saturday_End = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Availability_Saturday_End')) .", 
            Con_Availability_Sunday = " . \DB::connection()->getPDO()->quote( processSelectVal((Input::get('Contractor_Availability_Sunday')) ) ) .", 
            Con_Avaiability_Sunday_Start = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Availability_Sunday_Start')) .", 
            Con_Avaiability_Sunday_End = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Availability_Sunday_End')) .",
            Con_Additional_Info = " . \DB::connection()->getPDO()->quote(Input::get('Additional_Info')) .",  
            Con_Expertise = " . \DB::connection()->getPDO()->quote(Input::get('Expertise')) .",
            Con_Expertise_Other = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Other_Expertise')) .", 
            Con_Education_Degree = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Degree')) .", 
            Con_Education_Major = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Major')) .", 
            Con_Education_Institution = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Institution')) .", 
            Con_Education_Country = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Country')) .", 
            Con_Education_Cetifications = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Certifications')) .", 
            Con_Education_Certifications_Organization = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Certifications_Organization')) .",
            Con_Function_Training = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Function_Training')) .",
            Con_Field_Expertise = " . \DB::connection()->getPDO()->quote(Input::get('FieldExpertise')) .",
            Con_Services_Offered = " . \DB::connection()->getPDO()->quote(Input::get('ServicesOffered')) .",
            Con_Rate_Interpret_Medical_PerHour = " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_M')) .", 
            Con_Rate_Interpret_Medical_Minimum = " . \DB::connection()->getPDO()->quote(Input::get('Minimum_M')) .", 
            Con_Rate_Interpret_Medical_Mile = " . \DB::connection()->getPDO()->quote(Input::get('Per_Mile_M')) .",
            Con_Rate_Interpret_Medical_NoShow = " . \DB::connection()->getPDO()->quote(Input::get('No_Show_M')) .", 
            Con_Rate_Interpret_Medical_Cancelation = " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_M')) .", 
            Con_Rate_Interpret_Medical_Rush = " . \DB::connection()->getPDO()->quote(Input::get('Rush_M')) .",
            Con_Rate_Interpret_Medical_TravelTime = " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_M')) .",
            Con_Rate_Interpret_Medical_Other = " . \DB::connection()->getPDO()->quote(Input::get('Other_ME')) .",
            Con_Rate_Interpret_Legal_PerHour = " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_L')) .", 
            Con_Rate_Interpret_Legal_Medium = " . \DB::connection()->getPDO()->quote(Input::get('NoonDay_L')) .",
            Con_Rate_Interpret_Legal_FullDay = " . \DB::connection()->getPDO()->quote(Input::get('FullDay_L')) .", 
            Con_Rate_Interpret_Legal_PerMile = " . \DB::connection()->getPDO()->quote(Input::get('Per_Mile_L')) .",
            Con_Rate_Interpret_Legal_Cancelation_PerHour= " . \DB::connection()->getPDO()->quote(Input::get('CancelationH_L')) .", 
            Con_Rate_Interpret_Legal_Cancelation_Medium = " . \DB::connection()->getPDO()->quote(Input::get('CancelationN_L')) .",
            Con_Rate_Interpret_Legal_Cancelation_FullDay = " . \DB::connection()->getPDO()->quote(Input::get('CancelationF_L')) .", 
            Con_Rate_Interpret_Legal_TravelTime = " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_L')) .",
             Con_Rate_Interpret_Legal_NoShow_Medium = " . \DB::connection()->getPDO()->quote(Input::get('NoShow_L')) .",
            Con_Rate_Interpret_Legal_NoShow_FullDay = " . \DB::connection()->getPDO()->quote(Input::get('No_Show_Full_Day_L')) .", 
            Con_Rate_Interpret_Legal_Other = " . \DB::connection()->getPDO()->quote(Input::get('Other_LE')) .",

            Con_Rate_Interpret_School_PerHour = " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_S')) .", 
            Con_Rate_Interpret_School_Minimum = " . \DB::connection()->getPDO()->quote(Input::get('Minimum_S')) .", 
            Con_Rate_Interpret_School_PerMile = " . \DB::connection()->getPDO()->quote(Input::get('Per_Mile_S')) .",
            Con_Rate_Interpret_School_NoShow = " . \DB::connection()->getPDO()->quote(Input::get('No_Show_S')) .", 
            Con_Rate_Interpret_School_Cancelation = " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_S')) .", 
            Con_Rate_Interpret_School_TravelTime = " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_S')) .",
            Con_Rate_Interpret_School_TravelTime_2 = " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_2_S')) .",
            Con_Rate_Interpret_School_Other = " . \DB::connection()->getPDO()->quote(Input::get('Other_SCH')) .",

            Con_Rate_Conference_PerHour = " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_C')) .", 
            Con_Rate_Conference_Minimum = " . \DB::connection()->getPDO()->quote(Input::get('Minimum_C')) .", 
            Con_Rate_Conference_Per_Mile = " . \DB::connection()->getPDO()->quote(Input::get('Per_Mile_C')) .",
            Con_Rate_Conference_Medium = " . \DB::connection()->getPDO()->quote(Input::get('NoonDay_C')) .", 
            Con_Rate_Conference_FullDay = " . \DB::connection()->getPDO()->quote(Input::get('FullDay_C')) .",
            Con_Rate_Conference_NoShow = " . \DB::connection()->getPDO()->quote(Input::get('No_Show_C')) .", 
            Con_Rate_Conference_Cancelation = " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_C')) .",
            Con_Rate_Conference_TravelTime = " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_C')) .",
            Con_Rate_Conference_Other = " . \DB::connection()->getPDO()->quote(Input::get('Other_CO')) .",

            Con_Rate_VRI_PerMinute = " . \DB::connection()->getPDO()->quote(Input::get('Per_Minute_VRI')) .",
            Con_Rate_VRI_PerHour = " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_VRI')) .", 
            Con_Rate_VRI_Minimum = " . \DB::connection()->getPDO()->quote(Input::get('Minimum_VRI')) .", 
            Con_Rate_VRI_NoShow = " . \DB::connection()->getPDO()->quote(Input::get('No_Show_VRI')) .", 
            Con_Rate_VRI_Cancelation = " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_VRI')) .",
            Con_Rate_VRI_Other = " . \DB::connection()->getPDO()->quote(Input::get('Other_VRI')) .",

            Con_Rate_Telephonic_PerMinute = " . \DB::connection()->getPDO()->quote(Input::get('Per_Minute_TEL')) .",
            Con_Rate_Telephonic_PerHour = " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_TEL')) .", 
            Con_Rate_Telephonic_Minimum = " . \DB::connection()->getPDO()->quote(Input::get('Minimum_TEL')) .", 
            Con_Rate_Telephonic_NoShow = " . \DB::connection()->getPDO()->quote(Input::get('No_Show_TEL')) .", 
            Con_Rate_Telephonic_Cancelation = " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_TEL')) .",
            Con_Rate_Telephonic_Other = " . \DB::connection()->getPDO()->quote(Input::get('Other_TEL')) .",

            Con_Rate_Translation_PerWord = " . \DB::connection()->getPDO()->quote(Input::get('Per_Word_TRANSL')) .",
            Con_Rate_Translation_PerPage = " . \DB::connection()->getPDO()->quote(Input::get('Per_Page_TRANSL')) .",
            Con_Rate_Translation_PerHour = " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_TRANSL')) .",
            Con_Rate_Translation_Repetition = " . \DB::connection()->getPDO()->quote(Input::get('Repetition_TRANSL')) .",
            Con_Rate_Translation_Rush = " . \DB::connection()->getPDO()->quote(Input::get('RUSH_JOBS_TRANSL')) .",
            Con_Rate_Translation_RushPerWord = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Per_Word_TRANSL')) .",
            Con_Rate_Translation_RushPerPage = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Per_Page_TRANSL')) .",
            Con_Rate_Translation_RushPerHour = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Per_Hour_TRANSL')) .",
            Con_Rate_Translation_RushMinimum = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Minimum_Charge_TRANSL')) .",
            Con_Rate_Translation_RushRepetition = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Repetition_TRANSL')) .",

            Con_Rate_Transcription_PerWord = " . \DB::connection()->getPDO()->quote(Input::get('Per_Word_TRANSC')) .",
            Con_Rate_Transcription_PerPage = " . \DB::connection()->getPDO()->quote(Input::get('Per_Page_TRANSC')) .",
            Con_Rate_Transcription_PerHour = " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_TRANSC')) .",
            Con_Rate_Transcription_Rush = " . \DB::connection()->getPDO()->quote(Input::get('RUSH_JOBS_TRANSC')) .",
            Con_Rate_Transcription_RushPerWord = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Per_Word_TRANSC')) .",
            Con_Rate_Transcription_RushPerPage = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Per_Page_TRANSC')) .",
            Con_Rate_Transcription_RushPerHour = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Per_Hour_TRANSC')) .",
            Con_Rate_Transcription_RushMinimum = " . \DB::connection()->getPDO()->quote(Input::get('Rush_Minimum_Charge_TRANSC')) .",
            Con_Rate_Transcription_Other = " . \DB::connection()->getPDO()->quote(Input::get('Other_TRANSC')) .",
            Con_Rate_Other_Services = " . \DB::connection()->getPDO()->quote(Input::get('Other_Services')) .",

            Con_Attachments = '" . $get_all_files_array ."',
            Con_Expertise_Certifications = '" . $get_all_certifications_array ."',
            Con_Rate_Depost = '" . $get_all_deposit_array ."',  
            Con_Rate_Notes = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Rate_Notes')) .",
            Con_Function_Training = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Function_Training')) .", 
            Con_Agency_YesNo = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_An_Agency?')) .", 
            Con_Referred_By = " . \DB::connection()->getPDO()->quote($select_referred) .",
             Con_Referred_By_Name = " . \DB::connection()->getPDO()->quote(Input::get('Name_Interpreter')) .",
            Con_Referred_By_Other = " . \DB::connection()->getPDO()->quote(Input::get('Other_2')) .", 
            Con_Picture   = " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Picture')) ."
            WHERE ID =  " . Input::get('contractor_id');

        // var_dump($update_contractor_sql_code);
        // die();

        $update_contractor_with_id_sql = \DB::update($update_contractor_sql_code);

        // var_dump($update_contractor_with_id_sql);
        
        // $l_get_contractors_with_id_sql = \DB::select("SELECT * FROM contractors WHERE ID = " . Input::get('contractor_id'));
        // return view('contractor_views/contractors_single', ['contractors'=>$l_get_contractors_with_id_sql] );

        if ($update_contractor_with_id_sql){
            return response()->json("Contractor Successfully Updated");
        } else {
            return response()->json("Error. Could Not Update Contractor");
        }
        
    }
    //end edit functions

    ////////////////////////////////////////////////////////////

    // start create functions
    public function getCreateContractorsView(Request $the_request){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        return view('contractor_views/contractors_create');
    }

     public function titleContractor(Request $request){

         $title = $request->post('dataString'); 
         $mensaje = "hola";

            return response()->json([
                'name'  => $title,
                'mensaje' => $mensaje,
            ]);

       
    }    
    
    public function createContractor(Request $the_request){
        if (!(Auth::check())) {
            return redirect('/login');
        }

        // $file = $the_request->file('contractor_create_contractor_file_upload');
        // if ( !isset( $file ) ) {
        //     $file_name = " ";
        // } else{
        //     $upload_succes = Storage::putfile('public/llcuploads', $the_request->file('contractor_create_contractor_file_upload'));
        //     $file_name = substr($upload_succes, 18);
        // }


        $date_of_birth = $_POST['date_of_birth'];
        $date_of_birth = date("Y-m-d H:i:s", strtotime("$date_of_birth"));

        //$select_title = explode(',',$_POST['Title']); 

        //dd($the_request->all());
      
        //dd($date_of_birth);



        //dd($the_request->title);
        if (isset($the_request->title)) {
           
            $title = $the_request->title;
            $select_title = implode(',',$title);

        }else{
            $select_title = "";

        }
        
        //dd($select_title);
        
        if (isset($the_request->referred)) {
            
            $referred = $the_request->referred;
            $select_referred = implode(',',$referred);

        }else{
            $select_referred = "";

        }

        if (isset($the_request->language)) {
         
            $language = $the_request->language;
            $select_language = implode(',',$language);

        }else{
            $select_language = "";

        }

        /* MONDAY */

         if (isset($the_request->check_day_monday)) {
            
            $ava_monday = $the_request->check_day_monday;

        }else{
            $ava_monday = "NO";

        }

         /* TUESDAY */

         if (isset($the_request->check_day_tuesday)) {
            
            $ava_tuesday = $the_request->check_day_tuesday;

        }else{
            $ava_tuesday = "NO";

        }

         /* WEDNESDAY */

         if (isset($the_request->check_day_wednesday)) {
            
            $ava_wednesday = $the_request->check_day_wednesday;

        }else{
            $ava_wednesday = "NO";

        }

         /* THURSDAY */

         if (isset($the_request->check_day_thursday)) {
            
            $ava_thursday = $the_request->check_day_thursday;

        }else{
            $ava_thursday = "NO";

        }

         /* FRIDAY */


        if (isset($the_request->check_day_friday)) {
            
            $ava_friday = $the_request->check_day_friday;

        }else{
            $ava_friday = "NO";

        }

        
        $get_all_files_array = "";

        if( count($the_request->input('attachment_create_contractor_file_upload')) > 0 ) {
            
           $all_files_array = array();


            for ($i=0; $i < count($the_request->input('attachment_create_contractor_file_upload')); $i++)  {
            $file = $the_request->input('attachment_create_contractor_file_upload')[$i];
            $save_name = $file;

            $contractors = new ContractorsModel();
            $contractors->Con_Attachments = $save_name;
           

            array_push($all_files_array, $save_name);
            }

            $get_all_files_array = implode(",", $all_files_array);

        }


        $get_all_certifications_array = "";

          if( count($the_request->input('certification_create_contractor_file_upload')) > 0 ) {
            
           $all_certifications_array = array();


            for ($i=0; $i < count($the_request->input('certification_create_contractor_file_upload')); $i++)  {
            $file = $the_request->input('certification_create_contractor_file_upload')[$i];
            $save_name = $file;

            $contractors = new ContractorsModel();
            $contractors->Con_Expertise_Certifications = $save_name;
           

            array_push($all_certifications_array, $save_name);
            }

            $get_all_certifications_array = implode(",", $all_certifications_array);

        }

        $get_all_depost_array ="";

        if( count($the_request->input('depost_create_contractor_file_upload')) > 0 ) {
            
           $all_depost_array = array();


            for ($i=0; $i < count($the_request->input('depost_create_contractor_file_upload')); $i++)  {
            $file = $the_request->input('depost_create_contractor_file_upload')[$i];
            $save_name = $file;

            $contractors = new ContractorsModel();
            $contractors->Con_Rate_Depost = $save_name;
           

            array_push($all_depost_array, $save_name);
            }

            $get_all_depost_array = implode(",", $all_depost_array);

        }



        


        $create_new_contractor_sql_code = "
            INSERT INTO contractors 
                (   ID,
                    Con_Suffix, 
                    Con_Title,
                    Con_First_Name,
                    Con_Initial, 
                    Con_Last_Name,
                    Con_DBA,
                    Con_DBA_Name,
                    Con_DBA_SSN,
                    Con_DBA_DBO,
                    Con_DBA_Country,
                    Con_Physical_Address,
                    Con_City, 
                    Con_State, 
                    Con_Zip, 
                    Con_County, 
                    Con_Mailing_Address,
                    Con_MA_City, 
                    Con_MA_State, 
                    Con_MA_Zip_Code, 
                    Con_MA_County, 
                    Con_Home_Phone, 
                    Con_Cell_Phone,
                    Con_Cell_Phone2, 
                    Con_Office_Phone,
                    Con_Fax_Phone, 
                    Con_Other_Phone, 
                    Con_E_mail_Address,
                    Con_E_mail_Address_2, 
                    Con_E_mail_Address_3,  
                    Con_Skype,
                    Con_Website,  
                    Con_SSN, 
                    Con_TaxID, 
                    Con_Birthdate, 
                    Con_Referred_By,
                    Con_Referred_By_Name,
                    Con_Referred_By_Other,
                    Con_Language_1,
                    Con_Afiliations, 
                    Con_Interpreter_Status,
                    Con_Services,
                    Con_Training_Certifications,
                    Con_Payment_Method,
                    Con_Payment_Decision, 
                    Con_Notes,
                    Con_Expertise,
                    Con_Expertise_Other, 
                    Con_Education_Degree, 
                    Con_Education_Major, 
                    Con_Education_Institution, 
                    Con_Education_Country, 
                    Con_Education_Cetifications, 
                    Con_Education_Certifications_Organization,
                    Con_Function_Training,
                    Con_Services_Offered,
                    Con_Field_Expertise,  
                    Con_Availability_Monday, 
                    Con_Avaiability_Monday_Start, 
                    Con_Avaiability_Monday_End, 
                    Con_Availability_Tuesday, 
                    Con_Avaiability_Tuesday_Start, 
                    Con_Avaiability_Tuesday_End, 
                    Con_Availability_Wednesday, 
                    Con_Avaiability_Wednesday_Start, 
                    Con_Avaiability_Webnesday_End, 
                    Con_Availability_Thursday, 
                    Con_Avaiability_Thursday_Start, 
                    Con_Avaiability_Thursday_End, 
                    Con_Availability_Friday, 
                    Con_Avaiability_Friday_Start, 
                    Con_Avaiability_Friday_End, 
                    Con_Availability_Saturday, 
                    Con_Avaiability_Saturday_Start, 
                    Con_Avaiability_Saturday_End, 
                    Con_Availability_Sunday, 
                    Con_Avaiability_Sunday_Start, 
                    Con_Avaiability_Sunday_End, 
                    Con_Additional_Info,
                    Con_Rate_Interpret_Medical_PerHour,
                    Con_Rate_Interpret_Medical_Minimum,
                    Con_Rate_Interpret_Medical_Mile,
                    Con_Rate_Interpret_Medical_NoShow,
                    Con_Rate_Interpret_Medical_Cancelation,
                    Con_Rate_Interpret_Medical_Rush,
                    Con_Rate_Interpret_Medical_TravelTime,
                    Con_Rate_Interpret_Medical_Other,
                    Con_Rate_Interpret_Legal_PerHour, 
                    Con_Rate_Interpret_Legal_Medium, 
                    Con_Rate_Interpret_Legal_FullDay,
                    Con_Rate_Interpret_Legal_PerMile,
                    Con_Rate_Interpret_Legal_Cancelation_PerHour, 
                    Con_Rate_Interpret_Legal_Cancelation_Medium, 
                    Con_Rate_Interpret_Legal_Cancelation_FullDay, 
                    Con_Rate_Interpret_Legal_TravelTime,
                    Con_Rate_Interpret_Legal_NoShow_Medium,
                    Con_Rate_Interpret_Legal_NoShow_FullDay,
                    Con_Rate_Interpret_Legal_Other,
                    Con_Rate_Interpret_School_PerHour,
                    Con_Rate_Interpret_School_Minimum,
                    Con_Rate_Interpret_School_PerMile,
                    Con_Rate_Interpret_School_NoShow,
                    Con_Rate_Interpret_School_Cancelation,
                    Con_Rate_Interpret_School_TravelTime,
                    Con_Rate_Interpret_School_TravelTime_2,
                    Con_Rate_Interpret_School_Other,
                    Con_Rate_Conference_PerHour,
                    Con_Rate_Conference_Minimum,
                    Con_Rate_Conference_Per_Mile,
                    Con_Rate_Conference_Medium,
                    Con_Rate_Conference_FullDay,
                    Con_Rate_Conference_NoShow,
                    Con_Rate_Conference_Cancelation,
                    Con_Rate_Conference_TravelTime,
                    Con_Rate_Conference_Other,
                    Con_Rate_VRI_PerMinute,
                    Con_Rate_VRI_PerHour,
                    Con_Rate_VRI_Minimum,
                    Con_Rate_VRI_NoShow,
                    Con_Rate_VRI_Cancelation,
                    Con_Rate_VRI_Other,
                    Con_Rate_Telephonic_PerMinute,
                    Con_Rate_Telephonic_PerHour,
                    Con_Rate_Telephonic_Minimum,
                    Con_Rate_Telephonic_NoShow,
                    Con_Rate_Telephonic_Cancelation,
                    Con_Rate_Telephonic_Other,
                    Con_Rate_Translation_PerWord,
                    Con_Rate_Translation_PerPage,
                    Con_Rate_Translation_PerHour,
                    Con_Rate_Translation_Repetition,
                    Con_Rate_Translation_Rush,
                    Con_Rate_Translation_RushPerWord,
                    Con_Rate_Translation_RushPerPage,
                    Con_Rate_Translation_RushPerHour,
                    Con_Rate_Translation_RushRepetition,
                    Con_Rate_Translation_RushMinimum,
                    Con_Rate_Transcription_PerWord,
                    Con_Rate_Transcription_PerPage,
                    Con_Rate_Transcription_PerHour,
                    Con_Rate_Transcription_Rush,
                    Con_Rate_Transcription_RushPerWord,
                    Con_Rate_Transcription_RushPerPage,
                    Con_Rate_Transcription_RushPerHour,
                    Con_Rate_Transcription_RushMinimum,
                    Con_Rate_Transcription_Other,
                    Con_Rate_Other_Services,
                    Con_Attachments,
                    Con_Expertise_Certifications,
                    Con_Rate_Depost,
                    Con_Rate_Notes,
                    Con_Agency_YesNo, 
                    Con_Picture
                )
            VALUES 
                (
                    DEFAULT,
                    " . \DB::connection()->getPDO()->quote(Input::get('Suffix')) .", 
                     " . \DB::connection()->getPDO()->quote($select_title) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Name')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Initial')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Last_Name')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Decision_DBA')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('DBA_Name')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('SSN')) .",
                    " . \DB::connection()->getPDO()->quote($date_of_birth) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Country_of_Origin')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Physical_Address')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('City')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('State')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Zip')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('County')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Mailing_Address')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('City_2')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('State_2')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Zip_Code_2')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('County_2')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Home_Phone')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Mobile_1')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Mobile_2')) .",   
                    " . \DB::connection()->getPDO()->quote(Input::get('Office')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Fax')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('E-mail_1')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('E-mail_2')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('E-mail_3')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Skype')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Web_Site')) .", 
                    
                    " . \DB::connection()->getPDO()->quote(Input::get('SSN')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('TaxID')) .", 
                    ". \DB::connection()->getPDO()->quote( setDateInDB3( Input::get('Contractor_Birthdate') ) ) .",
                    " . \DB::connection()->getPDO()->quote($select_referred) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Name_Interpreter_2')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_2')) .", 
                    " . \DB::connection()->getPDO()->quote($select_language) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Affiliations')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Interpreter_Status')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Services')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('TrainingCertifications')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('PaymentMethod')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Decision_Payment')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Con_Fullfillment_Internal_Note')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Expertise')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Other_Expertise')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Degree')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Major')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Institution')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Country')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Certifications')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Education_Certifications_Organization')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Function_Training')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('ServicesOffered')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('FieldExpertise')) .",   
                    " . \DB::connection()->getPDO()->quote($ava_monday) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Monday_Start')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Monday_End')) .", 
                    " . \DB::connection()->getPDO()->quote($ava_tuesday) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Tuesday_Start')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Tuesday_End')) .", 
                    " . \DB::connection()->getPDO()->quote($ava_wednesday) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get( 'contractor_Wednesday_Start')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Wednesday_End')) .", 
                    " . \DB::connection()->getPDO()->quote($ava_thursday) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Thursday_Start')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Thursday_End')) .", 
                    " . \DB::connection()->getPDO()->quote($ava_friday) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Friday_Start')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('contractor_Friday_End')) .", 
                    " . \DB::connection()->getPDO()->quote( processSelectVal((Input::get('Contractor_Availability_Saturday')) ) ) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Availability_Saturday_Start')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Availability_Saturday_End')) .", 
                    " . \DB::connection()->getPDO()->quote( processSelectVal((Input::get('Contractor_Availability_Sunday')) ) ) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Availability_Sunday_Start')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Availability_Sunday_End')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Additional_Info')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_M')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Minimum_M')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Mile_M')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('No_Show_M')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_M')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Rush_M')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_M')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_M')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Noon_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Full_Day_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Mile_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('CancelationH_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('CancelationN_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('CancelationFD_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('No_Show_Noon_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('No_Show_Full_Day_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_L')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_S')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Minimum_S')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Mile_S')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('No_Show_S')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_S')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_S')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_2_S')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_S')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Minimum_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Mile_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Noon_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Full_Day_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('No_Show_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Travel_Time_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_C')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Minute_V')) .",
                     " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_V')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Minimum_V')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('No_Show_V')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_V')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_V')) .",
                     " . \DB::connection()->getPDO()->quote(Input::get('Per_Minute_Tel')) .",
                     " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_Tel')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Minimum_Tel')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('No_Show_Tel')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Cancelation_Tel')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_Tel')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Word_T')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Page_T')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_T')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Repetition_T')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('RUSH_JOBS_T')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Word_TR')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Page_TR')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_TR')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Repetition_TR')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Minimum_Charge_TR')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Word_Tra')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Page_Tra')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_Tra')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('RUSH_JOBS_Tra')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Word_TraR')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Page_TraR')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Per_Hour_TraR')) .",  
                    " . \DB::connection()->getPDO()->quote(Input::get('Minimum_Charge_TraR')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_Tra')) .",
                    " . \DB::connection()->getPDO()->quote(Input::get('Other_Services_O')) .",    
                    '" . $get_all_files_array ."', 
                    '" . $get_all_certifications_array ."', 
                    '" . $get_all_depost_array ."', 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Rate_Notes')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_An_Agency')) .", 
                    " . \DB::connection()->getPDO()->quote(Input::get('Contractor_Picture')) . ")";
        $create_new_contractor = \DB::insert($create_new_contractor_sql_code);
        return redirect()->route('all_contractors_route');
        
        // if ($create_new_contractor){
        //     return response()->json("Contractor Created Successfully");
        // } else {
        //     return response()->json("Error. Could Not Create Contractor");
        // }
    }
    // end create functions

    
    public function deleteContractor(Request $the_id){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $delete_contractor_sql_code = 
        " 
            DELETE FROM contractors WHERE 
            ID = ". \DB::connection()->getPDO()->quote(Input::get('get_the_id')) ." 
        ";
        $delete_contractor = \DB::delete($delete_contractor_sql_code);
        if ($delete_contractor){
            return response()->json("Contractor Deleted Successfully");
        } else {
            return response()->json("Error. Could Not Delete Contractor");
        }
    }

    public function getContractorsWithFilterAll(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_the_lang = Input::get('lang');
        $get_the_state = Input::get('state');
        $get_the_city = Input::get('city');
        $get_the_zip = Input::get('zip');
        $get_the_distance_radius = htmlspecialchars(trim(stripslashes( Input::get('distance_radius') )));
        
        if ( (intval( Input::get('page') ) > 0 ) ){
            $pageNumber = intval(Input::get('page'));
        } else {
            $pageNumber = 1;
        }

        if ( ( ( !isset($get_the_zip) ) || (strlen($get_the_zip) < 3) ) ) {
            $get_the_distance_radius = "";
            $get_the_zip = "";
        }

        $sql_query_1 = "SELECT * FROM contractors WHERE";
        $sql_count_query_1 = "SELECT count(*) as count FROM contractors WHERE";

        if ( isset($get_the_lang) && ( strlen($get_the_lang) > 2 ) && (!empty($get_the_lang))  ) {
            $sql_query_1 .= " Con_Language_1 LIKE '%".$get_the_lang."%'";    
            $sql_count_query_1 .= " Con_Language_1 LIKE '%".$get_the_lang."%'";    

            // $sql_query_1 .= " Con_Language_1 = '".$get_the_lang."'";    
            // $sql_count_query_1 .= " Con_Language_1 = '".$get_the_lang."'";    

        } else {
            $sql_query_1 .= " Con_Language_1 NOT LIKE ''";    
            $sql_count_query_1 .= " Con_Language_1 NOT LIKE ''";    

            // $sql_query_1 .= " Con_Language_1 != ''"; 
            // $sql_count_query_1 .= " Con_Language_1 != ''";
        }

        if ( isset($get_the_state) && ( strlen($get_the_state) > 1 ) && (!empty($get_the_state))  ) {
            $sql_query_1 .= " AND Con_State = '".$get_the_state."'";
            $sql_count_query_1 .= " AND Con_State = '".$get_the_state."'";
        } else {
            $sql_query_1 .= " AND Con_State != ''";
            $sql_count_query_1 .= " AND Con_State != ''";
        }

        if ( isset($get_the_city) && ( strlen($get_the_city) > 2 ) && (!empty($get_the_city))  ) {
            $sql_query_1 .= " AND Con_City LIKE '%".$get_the_city."%'";
            $sql_count_query_1 .= " AND Con_City LIKE '%".$get_the_city."%'";
        } else {
            $sql_query_1 .= " AND Con_City != ''";
            $sql_count_query_1 .= " AND Con_City != ''";
        }

        if ( isset($get_the_zip) && ( strlen($get_the_zip) > 2 ) && (!empty($get_the_zip))  ) {

            if ( isset($get_the_distance_radius) && (!empty($get_the_distance_radius))  ) {
                $zip_codes_in_ranges = getZipCodesWithZipRadius($get_the_zip, $get_the_distance_radius);
                // var_dump($zip_codes_in_ranges_new);
                // die();
                

                $zip_codes_in_ranges_new = "'" . implode("' , '", $zip_codes_in_ranges) . "'";

                $sql_query_1 .= " AND Con_Zip IN (". $zip_codes_in_ranges_new .")";
                    $sql_count_query_1 .= " AND Con_Zip IN (". $zip_codes_in_ranges_new .")";
            
                // for ($i=0; $i < count($zip_codes_in_ranges); $i++) { 
                //     $sql_query_1 .= "Con_Zip LIKE '%" . $zip_codes_in_ranges[$i] . "%' OR ";
                //     $sql_count_query_1 .= "Con_Zip LIKE '%" . $zip_codes_in_ranges[$i] . "%' OR ";

                //     $arr_last_val = count($zip_codes_in_ranges) - 1;
                //     if ($i == $arr_last_val) {
                //         $sql_query_1 .= "Con_Zip LIKE '%" . $zip_codes_in_ranges[$arr_last_val] . "%'";
                //         $sql_count_query_1 .= "Con_Zip LIKE '%" . $zip_codes_in_ranges[$arr_last_val] . "%'";
                //     }
                // }
            } else {
                $sql_query_1 .= " AND Con_Zip LIKE '%".$get_the_zip."%'";    
                $sql_count_query_1 .= " AND Con_Zip LIKE '%".$get_the_zip."%'";
            }
        } else {
            $sql_query_1 .= " AND Con_Zip NOT LIKE ''";
            $sql_count_query_1 .= " AND Con_Zip NOT LIKE ''";
        }

        
        // var_dump($sql_query_1);
        // die();
        try {
            $result_contractor = ContractorsModel::modelContractorsFilterSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);    
            return view( 'contractor_views/contractor_with_filter', $result_contractor);

        } catch (Exception $e){
            return view( 'contractor_views/contractor_with_filter', "Error");

        } 
        
    }

    /* public function getContractorsMainSearch(Request $request){

        //dd($request->get('q'));
        $contractors = Contractor::name($request->get('q'))->orderBy('id','DESC')->paginate();
   
    } */


    public function getContractorsMainSearch(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
         $query = htmlspecialchars(trim(stripcslashes(Input::get('q'))));

        
        if ( (intval( Input::get('pg') ) > 0 ) ){
            $pageNumber = intval(Input::get('pg'));
        } else {
            $pageNumber = 1;
        }

        $sql_query_1 = 
        "
           SELECT * FROM contractors WHERE Con_First_Name LIKE '%{$query}%' OR Con_Last_Name LIKE '%{$query}%'
        ";

        $sql_count_query_1 = 
        "
            SELECT count(*) as count FROM contractors WHERE MATCH (Con_First_Name,Con_Last_Name,Con_Middle_Name,Con_Notes,Con_Additional_Info,Con_Rate_Notes) AGAINST ('". $query ."' IN NATURAL LANGUAGE MODE)
        ";
        $result_contractor = ContractorsModel::modelContractorsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        return view( 'contractor_views/contractor_with_search', $result_contractor);
    } 


    public function getContractorsCitySearch(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_the_city = htmlspecialchars(trim(stripcslashes(Input::get('s_city'))));
        
        if ( (intval( Input::get('pg') ) > 0 ) ){
            $pageNumber = intval(Input::get('pg'));
        } else {
            $pageNumber = 1;
        } 

        $sql_query_1 = "SELECT * FROM contractors WHERE Con_City LIKE '%".$get_the_city."%' ";
        $sql_count_query_1 = 
        "SELECT count(*) as count FROM contractors WHERE Con_City LIKE '%".$get_the_city."%' ";

        
        $result_contractor = ContractorsModel::modelContractorsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        return view( 'contractor_views/contractor_with_search_by_city', $result_contractor);
    }

    public function getContractorsLanguageSearch(){
        if (!(Auth::check())) {
            return redirect('/login');
        }
        $get_the_language = htmlspecialchars(trim(stripcslashes(Input::get('s_language'))));
        
        if ( (intval( Input::get('pg') ) > 0 ) ){
            $pageNumber = intval(Input::get('pg'));
        } else {
            $pageNumber = 1;
        }

        $sql_query_1 = "SELECT * FROM contractors WHERE Con_Language_1 LIKE '%".$get_the_language."%' ";
        $sql_count_query_1 = 
        "SELECT count(*) as count FROM contractors WHERE Con_Language_1 LIKE '%".$get_the_language."%' ";

        
        $result_contractor = ContractorsModel::modelContractorsGeneralSearchWithPageNo($pageNumber, $sql_query_1, $sql_count_query_1);
        return view( 'contractor_views/contractor_with_search', $result_contractor);
    }

    

    public function showJobsByContractorMethod($first_name, $last_name){
        $all_results_array = array();
        $get_first_name = htmlspecialchars(trim($first_name));
        $get_last_name = htmlspecialchars(trim($last_name));
        $showJobsByContractor_sql_code = "SELECT * FROM jobs WHERE Jobs_Contractor_First_Name = '".$get_first_name."' AND Jobs_Contractor_Last_Name =  '".$get_last_name."'";
        $get_showJobsByContractor_query = \DB::select($showJobsByContractor_sql_code);
        for ($i=0; $i < count($get_showJobsByContractor_query) ; $i++) { 
            $showJobsByContractor_query =  
                get_object_vars($get_showJobsByContractor_query[$i]);
            array_push($all_results_array, $showJobsByContractor_query);
        }
        if ( count($all_results_array) > 0 ) {
            return response()->json($all_results_array);
        } else {
            return response()->json("empty");
        }
    }


    public function sendBulkEmailToContractors(){
        redirectIfNotLoggedIn();
        $the_emails = htmlspecialchars(trim(Input::get('bulk_email_emails')));
        $get_message = htmlspecialchars(trim(Input::get('bulk_email_textarea')));
        $send_bulk_email_result = sendEmail($the_emails, "Language Link LLC Job Assignment Message", $get_message, null, null );
        if (!$send_bulk_email_result) {
            return response()->json("Could not send email");
        } else {
            return response()->json("Email was sent Successfully");
        }
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
}

