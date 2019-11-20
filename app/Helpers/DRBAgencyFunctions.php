<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ContractorsModel;

ini_set('max_execution_time', '5000' );

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

use Illuminate\Support\Facades\Storage;
//use Auth;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

	//RDB Agency Custom Functions Defined Here

	function noOfPagesLeft($pages_count_input, $current_page_number_input, $limit){
		$no_of_pages_left = ceil(intval($pages_count_input) / $limit) - intval($current_page_number_input);
		$pages_left = $no_of_pages_left < 0 ? '0' : $no_of_pages_left;
		return $pages_left;
	}

	// function editJobInput($var_name, $raw_name){
	//     $get_var_name = str_replace("'", "", $var_name);
	//     $get_var_name_id = str_replace(" ", "_", $raw_name) . "_id";
	    
	//     return 
	//     	" <label for=". $get_var_name_id .">". $raw_name .":</label>" .
	//     {!! Form::text('Jobs_LEP_Name', $get_var_name, ['class' => 'form-control', 'id'=>'Jobs_LEP_Name_id']) !!}
	// }

	function setDateValueInView($get_date_val){
		$date_val = strval(str_replace("'", "", $get_date_val));
		if ( ( $date_val === '0000-00-00' ) || ( $date_val === '0000-00-00 00:00:00' ) ){
			$date_val = '0000/00/00 00:00:00';
			return $date_val;
		} else if ( ( $date_val === '1970-10-02 02:02:02' ) || ( $date_val === '1970-10-02 02:02:02' ) ){
			$date_val = '0000/00/00 00:00:00';
			return $date_val;
		} else if ( strlen($date_val) < 1 ){
			$date_val = '0000/00/00 00:00:00';
			return $date_val;
		} else{
			$date_val_0 = date("Y/m/d H:i:s", strtotime($date_val));
			return $date_val_0;
		}
	}

	function setDateValueInViewPretty($get_date_val){
		$date_val = strval(str_replace("'", "", $get_date_val));
		if ( ( $date_val === '0000-00-00' ) || ( $date_val === '0000-00-00 00:00:00' ) ){
			$date_val = '0000/00/00 00:00:00';
			return $date_val;
		} else if ( ( $date_val === '1970-10-02 02:02:02' ) || ( $date_val === '1970-10-02 02:02:02' ) ){
			$date_val = '0000/00/00 00:00:00';
			return $date_val;
		} else if ( strlen($date_val) < 1 ){
			$date_val = '0000/00/00 00:00:00';
			return $date_val;
		} else{
			// $date_val_0 = date("D d F Y/m/d H:i:s", strtotime($date_val));
			$date_val_0 = date("F, D d, Y H:i", strtotime($date_val));
			return $date_val_0;
		}
	}

	//this function is called to accespt inputs from the form, 
	//format it and set it for it to be inserted in the datsbase
	function setDateInDB($date_val){
		//$date_val = str_replace("'", "", $get_date_val);
		
		if ( ( $date_val === '0000/00/00' ) || ( $date_val === '0000/00/00 00:00:00' ) ){
			$date_val_0 = date("Y-m-d H:i:s", strtotime("1970-10-02 02:02:02"));
			//$date_val = '';
			return $date_val_0;
		} else if ( ( $date_val === '0000-00-00' ) || ( $date_val === '0000-00-00 00:00:00' ) ){
			$date_val_0 = date("Y-m-d H:i:s", strtotime("1970-10-02 02:02:02"));
			//$date_val = '';
			return $date_val_0;
		} else if ( strlen($date_val) < 1 ){
			$date_val_0 = date("Y-m-d H:i:s", strtotime("1970-10-02 02:02:02"));
			//$date_val = '';
			return $date_val_0;
		} else {
			$date_val_1 = str_replace("'", "", $date_val);
			$date_val_0 = date("Y-m-d H:i:s", strtotime($date_val_1));
			return $date_val_0;
		}
	}

	function setDateInDB2($date_val){
		//$date_val = str_replace("'", "", $get_date_val);
		
		if ( ( $date_val === '0000/00/00' ) || ( $date_val === '0000/00/00 00:00:00' ) ){
			$date_val_0 = date("Y-m-d H:i:s", strtotime("1970-10-02 02:02:02"));
			//$date_val = '';
			return $date_val_0;
		} else if ( ( $date_val === '0000-00-00' ) || ( $date_val === '0000-00-00 00:00:00' ) ){
			$date_val_0 = date("Y-m-d H:i:s", strtotime("1970-10-02 02:02:02"));
			//$date_val = '';
			return $date_val_0;
		} else if ( strlen($date_val) < 1 ){
			$date_val_0 = date("Y-m-d H:i:s", strtotime("1970-10-02 02:02:02"));
			//$date_val = '';
			return $date_val_0;
		} else {
			$date_val_1 = str_replace("'", "", $date_val);
			// var_dump($date_val_1);
			// die();
			$date_val_0 = date("Y-m-d H:i:s", strtotime($date_val_1));
			return $date_val_0;
			//return $date_val;
			// var_dump($date_val_0);
			// die();
		}
	}

	//this function is called to accespt inputs from the form, 
	//format it and set it for it to be inserted in the datsbase
	function setDateInDB3($date_val){
		$return_value = "";
		if ( ( $date_val === '0000/00/00' ) || ( $date_val === '0000/00/00 00:00:00' ) ){
			$return_value = date("Y-m-d H:i:s", strtotime("1970-10-02 02:02:02"));
		} else if ( ( $date_val === '0000-00-00' ) || ( $date_val === '0000-00-00 00:00:00' ) ){
			$return_value = date("Y-m-d H:i:s", strtotime("1970-10-02 02:02:02"));
		} else {
			$return_value = date("Y-m-d H:i:s", strtotime($date_val));
		}
		return $return_value;
	}

	function removeQuotes($input){
		return utf8_decode(str_replace("'", "", $input));
	}

	function processStateWithAbb($state_input){
		$get_state_input = utf8_decode(str_replace("'", "", $state_input));
		switch ($get_state_input) {
			case 'AL':
				return $get_state_input . " - Alabama";
				break;
			case 'AK':
				return $get_state_input . " - Alaska";
				break;
			case 'AZ':
				return $get_state_input . " - Arizona";
				break;
			case 'AR':
				return $get_state_input . " - Arkansas";
				break;
			case 'CA':
				return $get_state_input . " - California";
				break;
			case 'CO':
				return $get_state_input . " - Colorado";
				break;
			case 'CT':
				return $get_state_input . " - Connecticut";
				break;
			case 'DE':
				return $get_state_input . " - Delaware";
				break;
			case 'DC':
				return $get_state_input . " - District of Columbia";
				break;
			case 'FL':
				return $get_state_input . " - Florida";
				break;
			case 'GA':
				return $get_state_input . " - Georgia";
				break;
			case 'HI':
				return $get_state_input . " - Hawaii";
				break;
			case 'ID':
				return $get_state_input . " - Idaho";
				break;
			case 'IL':
				return $get_state_input . " - Illinois";
				break;
			case 'IN':
				return $get_state_input . " - Indiana";
				break;
			case 'IA':
				return $get_state_input . " - Iowa";
				break;
			case 'KS':
				return $get_state_input . " - Kansas";
				break;
			case 'KY':
				return $get_state_input . " - Kentucky";
				break;
			case 'LA':
				return $get_state_input . " - Louisiana";
				break;
			case 'ME':
				return $get_state_input . " - Maine";
				break;
			case 'MD':
				return $get_state_input . " - Maryland";
				break;
			case 'MA':
				return $get_state_input . " - Massachusetts";
				break;
			case 'MI':
				return $get_state_input . " - Michigan";
				break;
			case 'MN':
				return $get_state_input . " - Minnesota";
				break;
			case 'MS':
				return $get_state_input . " - Mississippi";
				break;
			case 'MO':
				return $get_state_input . " - Missouri";
				break;
			case 'MT':
				return $get_state_input . " - Montana";
				break;
			case 'NE':
				return $get_state_input . " - Nebraska";
				break;
			case 'NV':
				return $get_state_input . " - Nevada";
				break;
			case 'NH':
				return $get_state_input . " - New Hampshire";
				break;
			case 'NJ':
				return $get_state_input . " - New Jersey";
				break;
			case 'NM':
				return $get_state_input . " - New Mexico";
				break;
			case 'NY':
				return $get_state_input . " - New York";
				break;
			case 'NC':
				return $get_state_input . " - North Carolina";
				break;
			case 'ND':
				return $get_state_input . " - North Dakota";
				break;
			case 'OH':
				return $get_state_input . " - Ohio";
				break;
			case 'OK':
				return $get_state_input . " - Oklahoma";
				break;
			case 'OR':
				return $get_state_input . " - Oregon";
				break;
			case 'PA':
				return $get_state_input . " - Pennsylvania";
				break;
			case 'RI':
				return $get_state_input . " - Rhode Island";
				break;
			case 'SC':
				return $get_state_input . " - South Carolina";
				break;
			case 'SD':
				return $get_state_input . " - South Dakota";
				break;
			case 'TN':
				return $get_state_input . " - Tennessee";
				break;
			case 'TX':
				return $get_state_input . " - Texas";
				break;
			case 'UT':
				return $get_state_input . " - Utah";
				break;
			case 'VT':
				return $get_state_input . " - Vermont";
				break;
			case 'VA':
				return $get_state_input . " - Virginia";
				break;
			case 'WA':
				return $get_state_input . " - Washington";
				break;
			case 'WV':
				return $get_state_input . " - West Virginia";
				break;
			case 'WI':
				return $get_state_input . " - Wisconsin";
				break;
			case 'WY':
				return $get_state_input . " - Wyoming";
				break;
			default:
				return $get_state_input;
				break;
		}
	}


	//this function displays the row item in a list of all model, int he main model list page
	//for example, it;s been used in the page: (url)/invoices, (url)/services, (url)/contractors
	//it gets two values, the label and the column name.
	function displayRowItem($get_val_1, $get_val_2){
		return $get_val_1.": <b> ". str_replace("'", "", $get_val_2) ." </b> <br/> ";
	}

	
	function returnTextForServiceSingleView($g_value_1, $g_value_2){
		echo "
			<li>
				". $g_value_1 .":
				<b>
				". str_replace("'", "", $g_value_2) ."
				</b>
			</li>
			";
	}

	function returnTextForModelSingleView($g_value_1, $g_value_2){
		echo "
			<li style='margin-bottom:10px;'>
				". $g_value_1 .":
				<b>
				". utf8_decode(str_replace("'", "", $g_value_2)) ."
				</b>
			</li>
			";
	}

	function returnTextForContractorSingleView($g_value_1, $g_value_2){
		// $g_value_2_modified = str_replace("'", "", $g_value_2);
		echo "
			<li>
				". $g_value_1 .":
				<b>
				". utf8_decode(str_replace("'", "", $g_value_2)) ."
				</b>
			</li>
			";
	}

	function returnTextForContractorSingleView2($g_value_2){
		echo "
			<li class='backgrounded-li width100'>
				<b>
				". utf8_decode(str_replace("'", "", $g_value_2)) ."
				</b>
			</li>
			";
		    
	}

	function returnInputFieldForServiceCreateView($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='service".$value_joined."_id'>".$value.":</label>
			<input type='text' name='".$value_joined."' class='form-control' id='service_".$value_joined."_id'>";
		    
	}

	function returnInputFieldForContractorCreateView($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<input type='text' name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id'>";
		    
	}

	function returnInputFieldForContractorCreateView2($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<input type='text' name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id'>";
		    
	}

	
	function returnInputFieldForContractorCreateView3($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>Mailing Address:(If Different From Above)</label>
			<input type='text' name='Mailing_Address' class='form-control' id='contractor_".$value_joined."_id'>";
		    
	}

	function returnInputFieldForContractorCreateViewMailing($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<input type='text' name='".$value_joined."_2' class='form-control' id='contractor_".$value_joined."_id'>";
		    
	}


	function returnTextareaFieldForContractorCreateView($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnTextareaFieldForContractorCreateViewRateLegal($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_L' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnTextareaFieldForContractorCreateViewRateSchool($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_S' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnTextareaFieldForContractorCreateViewRateConference($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_C' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnTextareaFieldForContractorCreateViewRateVRI($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_V' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnTextareaFieldForContractorCreateViewRateTelephonic($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_Tel' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnTextareaFieldForContractorCreateViewRateTranslation($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_T' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnTextareaFieldForContractorCreateViewRateTranscrition($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_Tra' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}
	function returnTextareaFieldForContractorCreateViewRateOther($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_O' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnTextareaFieldForContractorCreateViewRate($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."_M' class='form-control' id='contractor_".$value_joined."_id'></textarea>
			";		    
	}

	function returnInputFieldForCreateViewLi($value, $model_name){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					<label for='".$model_name."_".$value_joined."_id'>".$value.":</label>
					<input type='text' name='".$value_joined."' class='form-control' id='".$model_name."_".$value_joined."_id'>
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLi($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					<label for='contractor_".$value_joined."_id'>".$value.":</label>
					<input type='text' name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id'>
				</li>
			";
	}
	function returnInputFieldForContractorCreateViewLi2($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					<label for='contractor_".$value_joined."_id'>".$value.":</label>
					<input type='text' name='".$value_joined."_2' class='form-control' id='contractor_".$value_joined."_id'>
				</li>
			";
	}
	function returnInputFieldForContractorCreateViewLiRateMedical($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_M' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateLegal($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_L' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}



	function returnInputFieldForContractorCreateViewLiRateMedicalCancelation($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='Cancelation_M' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateLegalNoon($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='Noon_L' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateLegalFullDay($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='Full_Day_L' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateLegalCHour($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='CancelationH_L' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}
	function returnInputFieldForContractorCreateViewLiRateLegalCNoon($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='CancelationN_L' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateLegalCFullDay($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='CancelationFD_L' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateLegalNoShow($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='No_Show_Noon_L' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateSchool($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_S' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateConference($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_C' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateConferenceNoon($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='Noon_C' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateConferenceFullDay($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='Full_Day_C' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}


	function returnInputFieldForContractorCreateViewLiRateConferenceCancelation($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='Cancelation_C' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateVRI($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_V' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateTelephonic($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_Tel' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateTranslation($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_T' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateTranslationRush($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_TR' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateTranscription($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_Tra' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiRateTranscriptionRush($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."_TraR' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}


	function returnInputFieldForContractorCreateViewLiRate($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					$<input type='text' name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id' style=' outline: 0;
                       border-width: 0 0 2px'><label for='contractor_".$value_joined."_id'>".$value."</label>
					
				</li>
			";
	}

	function returnInputFieldForContractorCreateViewLiAvailabitity($value){
		$value_joined = str_replace(" ", "_", $value);
		echo 
			"
				<li>
					<label for='contractor_".$value_joined."_id'>".$value.":</label>
					<input type='text' name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id' style='width:200px;'>
				</li>
			";
	}


	function returnInputFieldForjobsCreateView($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='jobs_".$value_joined."_id'>".$value.":</label>
			<input type='text' name='".$value_joined."' class='form-control' id='jobs_".$value_joined."_id'>";
		    
	}

	function inputFieldServiceEditView($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
				<label for='service_".$value_joined."_id'>".$value1.":</label>
				<input type='text' name='".$value_joined."' class='form-control' id='service_".$value_joined."_id' value='".$get_value2."'>
			";
	}

	function inputFieldInvoicesEditView($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
				<label for='invoices_".$value_joined."_id'>".$value1.":</label>
				<input type='text' name='".$value_joined."' class='form-control' id='invoices_".$value_joined."_id' value=".$get_value2.">
			";
	}

	function inputFieldModelEditViewLi($value1, $value2, $model_name){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
			<li>
				<label for='".$model_name."_".$value_joined."_id'>".$value1.":</label>
				<input type='text' value='".$get_value2."' name='".$value_joined."' class='form-control' id='".$model_name."_".$value_joined."_id' >
			</li>
			";
	}

	function inputFieldDisabledModelEditViewLi($value1, $value2, $model_name){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
			<li>
				<label for='".$model_name."_".$value_joined."_id'>".$value1.":</label>
				<input type='text' value='".$get_value2."' name='".$value_joined."' class='form-control' id='".$model_name."_".$value_joined."_id' disabled >
			</li>
			";
	}

	function textareaFieldModelEditViewLi($value1, $value2, $model_name){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
			<li>
				<label for='".$model_name."_".$value_joined."_id'>".$value1.":</label>
				<input type='text' name='".$value_joined."' class='form-control' id='".$model_name."_".$value_joined."_id' value='".$get_value2."'>
			</li>
			";
	}

	function dateInputFieldModelEditViewLi($value1, $value2, $model_name){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
			<li>
				<label for='".$value_joined."_id'>".$value1.":</label>
				<input type='text' name='".$value_joined."' class='form-control' id='".$value_joined."_id' value='".$get_value2."'>
			</li>
			";
	}

	

	// function inputFieldServiceEditView($value1, $value2){
	// 	$value_joined = str_replace(" ", "_", $value1);
	// 	$get_value2 = str_replace("'", "", $value2);
	// 	echo 
	// 		"
	// 			<label for='service_".$value_joined."_id'>".$value1.":</label>
	// 			<input type='text' name='".$value_joined."' class='form-control' id='service_".$value_joined."_id' value=".$get_value2.">
	// 		";
	// }

	function inputFildContractorEditView($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
				<label for='contractor_".$value_joined."_id'>".$value1.":</label>
				<input type='text' name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."'>
			";
	}

	function inputFildContractorEditView2($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
				<label for='contractor_".$value_joined."_id'>".$value1.":</label>
				<input type='text' name='".$value_joined."2' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."'>
			";
	}

	function inputFildContractorEditViewLi2($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
				<li>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					<input type='text' name='".$value_joined."_2' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."'>
				</li>
			";
	}
	function inputFildContractorEditViewLi3($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='".$value_joined."_M' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi4($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='".$value_joined."_L' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi5($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='".$value_joined."_S' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi6($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='".$value_joined."_C' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi7($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='".$value_joined."_VRI' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi8($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='".$value_joined."_TEL' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi9($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='".$value_joined."_TRANSL' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi10($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='".$value_joined."_TRANSC' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi6Noon($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='NoonDay_C' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi6Full($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='FullDay_C' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi6Cancelation($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='Cancelation_C' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}


	function inputFildContractorEditViewLi4Noon($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='NoonDay_L' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi4Full($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='FullDay_L' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi4CHour($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='CancelationH_L' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi4CNoon($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='CancelationN_L' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi4CFull($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='CancelationF_L' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi4NoShow($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='NoShow_L' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi3C($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 

			"
				<li>
					$<input type='text' name='Cancelation_M' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."' style='outline: 0;border-width: 0 0 2px'>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					
				</li>
			";
	}

	function inputFildContractorEditViewLi($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo 
			"
				<li>
					<label for='contractor_".$value_joined."_id'>".$value1.":</label>
					<input type='text' name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id' value='".$get_value2."'>
				</li>
			";
	}

	function textareaContractorEditView($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaContractorEditViewMedical($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."_ME' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaContractorEditViewLegal($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."_LE' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaContractorEditViewSchool($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."_SCH' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaContractorEditViewConference($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."_CO' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaContractorEditViewVRI($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."_VRI' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaContractorEditViewTelephonic($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."_TEL' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaContractorEditViewTranslation($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."_TRANSL' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaContractorEditViewTranscription($value1, $value2){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."_TRANSC' class='form-control' id='contractor_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function textareaModelEditView($value1, $value2, $model_name){
		$value_joined = str_replace(" ", "_", $value1);
		$get_value2 = str_replace("'", "", $value2);
		echo "
			<label for='".$model_name."_".$value_joined."_id'>".$value1.":</label>
			<textarea name='".$value_joined."' class='form-control' id='".$model_name."_".$value_joined."_id' >".$value2."</textarea>
			";		    
	}

	function processSelectVal($array_input){
		$return_val = "select";
		if ( ( $array_input == "yes" ) ) {
			$return_val = "yes";
		} else if ( ( $array_input == "no" ) ) {
			$return_val = "no";
		} else if ( ( $array_input == "select" ) ) {
			$return_val = " ";
		} else {
			$return_val = " ";
		}
		
		return $return_val;
		 
	}

	function processGetSelectVal($array_input){
		$return_val = "";
		if ( $array_input == "yes" ) {
			$return_val = 
			"
				<option value='select'>select</option>
                <option value='yes' selected>YES</option>
                <option value='no'>NO</option>
			";
		} else if ( $array_input == "no" ) {
			$return_val = 
			"
				<option value='select'>select</option>
                <option value='yes'>YES</option>
                <option value='no' selected>NO</option>
			";
		} else if ( $array_input == " " ) {
			$return_val = 
			"
				<option value='select' selected>select</option>
                <option value='yes'>YES</option>
                <option value='no'>NO</option>
			";
		} else {
			$return_val = 
			"
				<option value='select' selected>select</option>
                <option value='yes'>YES</option>
                <option value='no'>NO</option>
			";
		}
		return $return_val;
	}


	function noOfContractors(){
		$get_contractors = \DB::select('SELECT count(*) as count FROM contractors');
		return get_object_vars($get_contractors[0])['count'];
	}

	function noOfJobs(){
		$get_jobs = \DB::select('SELECT count(*) as count FROM jobs');
		return get_object_vars($get_jobs[0])['count'];
	}

	function noOfCustomers(){
		$get_customers = \DB::select('SELECT count(*) as count FROM customers');
		return get_object_vars($get_customers[0])['count'];
	}

	function getContractIDWithEmail($the_email){
		if ( isset($the_email) && strlen($the_email) > 0 ) {
			$get_the_email = str_replace("'", "", $the_email); 
			$get_contractors_id = \DB::select("SELECT ID FROM contractors WHERE Con_E_mail_Address = '\'".$get_the_email."\''" );
			if ( isset($get_contractors_id[0]) ) {
				return get_object_vars($get_contractors_id[0])['ID'];
			} else {
				//do nothing
			}
			
		} else {
			//do nothing
		}
		
               
          // var_dump();

		// $get_the_email = \DB::connection()->getPDO()->quote($the_email);
		// $get_contractors_id = \DB::select("SELECT ID FROM contractors WHERE Con_E_mail_Address = ". $get_the_email );
		// return $get_contractors_id;
	}

	//this function gets zip codes, in a radius, using the supplied zip code and distance radius
	function getZipCodesWithZipRadius($input_zip, $input_radius){

		$get_the_distance_radius = $input_radius;
		$get_the_zip = $input_zip;
		$result_array = array();

		//if no distance radius is supplie,d it uses 50 as a default value.
        if ( !(is_numeric($get_the_distance_radius)) ) {
            $distance_rad = "50";  
        } else {
            $distance_rad = $get_the_distance_radius;  
        }
        
        $get_lat_long_from_db_sql_code = "SELECT latitude, longitude FROM zip_codes WHERE zip = $get_the_zip";
        $get_lat_long_from_db = \DB::select($get_lat_long_from_db_sql_code);

        $get_lat_long_from_db_array = get_object_vars($get_lat_long_from_db[0]);
        $start_lat = $get_lat_long_from_db_array['latitude'];
        $start_long = $get_lat_long_from_db_array['longitude'];
       
        //radius of the earth
        $r = 3959;

        //compute max and min latitudes / longitudes for search square
        $latN = rad2deg(asin(sin(deg2rad($start_lat)) * cos($distance_rad / $r) + cos(deg2rad($start_lat)) * sin($distance_rad / $r) * cos(deg2rad(0))));
        $latS = rad2deg(asin(sin(deg2rad($start_lat)) * cos($distance_rad / $r) + cos(deg2rad($start_lat)) * sin($distance_rad / $r) * cos(deg2rad(180))));
        $lonE = rad2deg(deg2rad($start_long) + atan2(sin(deg2rad(90)) * sin($distance_rad / $r) * cos(deg2rad($start_lat)), cos($distance_rad / $r) - sin(deg2rad($start_lat)) * sin(deg2rad($latN))));
        $lonW = rad2deg(deg2rad($start_long) + atan2(sin(deg2rad(270)) * sin($distance_rad / $r) * cos(deg2rad($start_lat)), cos($distance_rad / $r) - sin(deg2rad($start_lat)) * sin(deg2rad($latN))));

        // $distance_rad_query = "SELECT zip FROM zip_codes WHERE (latitude <= $latN AND latitude >= $latS AND longitude <= $lonE AND longitude >= $lonW) AND (latitude != $start_lat AND longitude != $start_long) ORDER BY state, city, latitude, longitude";

        $distance_rad_query = "SELECT zip FROM zip_codes WHERE (latitude <= $latN AND latitude >= $latS AND longitude <= $lonE AND longitude >= $lonW) ORDER BY state, city, latitude, longitude";
            
        $get_distance_rad = \DB::select($distance_rad_query);

        for ($i=0; $i < count($get_distance_rad); $i++) { 
            $convert_to_array = get_object_vars($get_distance_rad[$i]);
            $zip_code_in_str = $convert_to_array["zip"];
            
            //echo "Zip " . $i . ": " .  $convert_to_array["zip"] . "<br/><br/>";
            array_push($result_array, $convert_to_array["zip"]);
            
        }

        return $result_array;
	}

	function getCustomerNameWithID($thecustomerid){
		
		if ( isset($the_id) && intval($the_id) >= 1 ) {
            $get_the_id = $the_id;
        } else {
            $get_the_id = 1;
        }
        $get_customers_with_id_sql = \DB::select("SELECT * FROM customers WHERE ID = " . $thecustomerid);
        //var_dump($get_customers_with_id_sql[0]);
        if ($get_customers_with_id_sql) {
        	$all_customer_details = get_object_vars($get_customers_with_id_sql[0]);
	        $customer_company_name = $all_customer_details["Cus_Company_Name"];
	        return $customer_company_name;
        }
        
	}

	function processEchoFiles($all_the_files = null, bool $show_close_btn){
		if ( isset($all_the_files) && count($all_the_files) > 0 ) {
			$all_returned_files = explode(",", removeQuotes($all_the_files));
    		for ($i=0; $i < count($all_returned_files); $i++) { 
        		
        		$strip_all_returned_files = trim(stripslashes($all_returned_files[$i]));
        		$file_absolute_url = url('/storage/app/public/llcuploads')."/".$strip_all_returned_files;

        		$file_name = $strip_all_returned_files;

        		$four_ext_file = substr($strip_all_returned_files, -4);
        		$three_ext_file = substr($strip_all_returned_files, -3);
        		$file_extension = substr($strip_all_returned_files, -3);
        		
        		if( ($four_ext_file == 'jpeg' ) || ($three_ext_file == 'jpg' ) || ($three_ext_file == 'png' ) ) {
    				echo
    					"<div class='single_job_view_img_cl' data-filename='".$strip_all_returned_files."'>
    						<a target='_blank' href='".$file_absolute_url."'> 
    							<img src='".$file_absolute_url."' height='84'/>
    						</a>
    						";
    						if ($show_close_btn) {
    							echo "
    								<div class='file-name-up'>".substr($file_name,14)."</div>
    								<div class='delete-img-cl-1' id='delete-img-id-1' data-filename='".$strip_all_returned_files."'>
    							    		Delete <i class='fa fa-close'></i>
    							    </div>
    							";
    						} else{
    							//do nothing
    						}

    				echo		"
    					</div>";
        		} else if(  strlen($file_extension) < 1 ) {
        			echo " ";
        		} else {
    				echo "
    					<div class='single_job_view_img_cl' data-filename='".$strip_all_returned_files."'>
    						<div class='empty_img_1'>
    							<a target='_blank' href='".$file_absolute_url."'>".$file_extension." file</a>
    						</div>
    						<br/>
    						";
    						if ($show_close_btn) {
    							echo "
    								<div class='file-name-up'>".substr($file_name,14)."</div>
    								<div class='delete-img-cl-1' id='delete-img-id-1' data-filename='".$strip_all_returned_files."'>
    							    		Delete <i class='fa fa-close'></i>
    							    </div>
    							";
    						} else{
    							//do nothing
    						}
    				echo		"
    					</div>

    					";
        		}
	    	}
    				echo '<div style="clear:both;"></div>';
		} else {
			echo " ";
		}
	}

	function processEchoFiles2($all_the_files = null, bool $show_close_btn){
		if ( isset($all_the_files) && count($all_the_files) > 0 ) {
			$all_returned_files = explode(",", removeQuotes($all_the_files));
    		for ($i=0; $i < count($all_returned_files); $i++) { 
        		
        		$strip_all_returned_files = trim(stripslashes($all_returned_files[$i]));
        		$file_absolute_url = url('/storage/app/public/llcuploads')."/".$strip_all_returned_files;

        		$file_name = $strip_all_returned_files;

        		$four_ext_file = substr($strip_all_returned_files, -4);
        		$three_ext_file = substr($strip_all_returned_files, -3);
        		$file_extension = substr($strip_all_returned_files, -3);

        		
        		if( ($four_ext_file == 'jpeg' ) || ($three_ext_file == 'jpg' ) || ($three_ext_file == 'png' )) {
    				echo
    					"
    					<div class='attachments-single-1' data-filename='".$strip_all_returned_files."'>
    						<a target='_blank' href='".$file_absolute_url."'> 
    							<img src='".$file_absolute_url."' height='84'/>
    						</a>

    						";
    						if ($show_close_btn) {
    							echo "
    								
    								<div class='delete-img-cl-1' id='delete-img-id-1' data-filename='".$strip_all_returned_files."'>
    							    		Delete <i class='fa fa-close'></i>
    							    </div>
    							";
    						} else{
    							//do nothing
    						}

    				echo		"
    					<div class='file-name-up'>".substr($file_name,14)."</div>
    					</div>
    					";
        		} else if(  strlen($file_extension) < 1 ) {
        			echo " ";
        		} else {
    				echo "
    					<div style='width:100px; display: inline-table; vertical-align: top;'>
    					<div data-filename='".$strip_all_returned_files."'>
    						<div class='empty_img_1' style='width:100px;'>
    							<a target='_blank' href='".$file_absolute_url."'>".$file_extension." file</a><br/>
    						</div>
    						
    						
    						";
    						if ($show_close_btn) {
    							echo "
    								
    								<div class='delete-img-cl-1' id='delete-img-id-1' data-filename='".$strip_all_returned_files."'>
    							    		Delete <i class='fa fa-close'></i>
    							    </div>
    							";
    						} else{
    							//do nothing
    						}
    				echo		"
    					
    					</div>
    					<div class='file-name-up' style='display: block; width: 100%; clear: both; word-break: break-all;'>".substr($file_name,14)."</div>
						<div></div></div>
    					";
        		}
	    	}
    				echo '<div style="clear:both;"></div>';
		} else {
			echo " ";
		}
	}


	function processEchoFiles3($all_the_files = null, bool $show_close_btn){
		if ( isset($all_the_files) && count($all_the_files) > 0 ) {
			$all_returned_files = explode(",", removeQuotes($all_the_files));
    		for ($i=0; $i < count($all_returned_files); $i++) { 
        		
        		$strip_all_returned_files = trim(stripslashes($all_returned_files[$i]));
        		$file_absolute_url = url('/storage/app/public/llcuploads')."/".$strip_all_returned_files;

        		$file_name = $strip_all_returned_files;

        		$four_ext_file = substr($strip_all_returned_files, -4);
        		$three_ext_file = substr($strip_all_returned_files, -3);
        		$file_extension = substr($strip_all_returned_files, -3);
        		
        		if( ($four_ext_file == 'jpeg' ) || ($three_ext_file == 'jpg' ) || ($three_ext_file == 'png' ) ) {
    				echo
    					"<div class='single_job_view_img_cl' data-filename='".$strip_all_returned_files."'>
    						<a target='_blank' href='".$file_absolute_url."'> 
    							<img src='".$file_absolute_url."' height='84'/>
    						</a>
    						";
    						if ($show_close_btn) {
    							echo "
    								<div class='file-name-up'>".substr($file_name,14)."</div>
    								<div class='delete-img-cl-3' id='delete-img-id-3' data-filename='".$strip_all_returned_files."'>
    							    		Delete <i class='fa fa-close'></i>
    							    </div>
    							";
    						} else{
    							//do nothing
    						}

    				echo		"
    					</div>";
        		} else if(  strlen($file_extension) < 1 ) {
        			echo " ";
        		} else {
    				echo "
    					<div class='single_job_view_img_cl' data-filename='".$strip_all_returned_files."'>
    						<div class='empty_img_1'>
    							<a target='_blank' href='".$file_absolute_url."'>".$file_extension." file</a>
    						</div>
    						<br/>
    						";
    						if ($show_close_btn) {
    							echo "
    								<div class='file-name-up'>".substr($file_name,14)."</div>
    								<div class='delete-img-cl-3' id='delete-img-id-3' data-filename='".$strip_all_returned_files."'>
    							    		Delete <i class='fa fa-close'></i>
    							    </div>
    							";
    						} else{
    							//do nothing
    						}
    				echo		"
    					</div>

    					";
        		}
	    	}
    				echo '<div style="clear:both;"></div>';
		} else {
			echo " ";
		}
	}

function processEchoFiles4($all_the_files = null, bool $show_close_btn){
		if ( isset($all_the_files) && count($all_the_files) > 0 ) {
			$all_returned_files = explode(",", removeQuotes($all_the_files));
    		for ($i=0; $i < count($all_returned_files); $i++) { 
        		
        		$strip_all_returned_files = trim(stripslashes($all_returned_files[$i]));
        		$file_absolute_url = url('/storage/app/public/llcuploads')."/".$strip_all_returned_files;

        		$file_name = $strip_all_returned_files;

        		$four_ext_file = substr($strip_all_returned_files, -4);
        		$three_ext_file = substr($strip_all_returned_files, -3);
        		$file_extension = substr($strip_all_returned_files, -3);
        		
        		if( ($four_ext_file == 'jpeg' ) || ($three_ext_file == 'jpg' ) || ($three_ext_file == 'png' ) ) {
    				echo
    					"<div class='single_job_view_img_cl' data-filename='".$strip_all_returned_files."'>
    						<a target='_blank' href='".$file_absolute_url."'> 
    							<img src='".$file_absolute_url."' height='84'/>
    						</a>
    						";
    						if ($show_close_btn) {
    							echo "
    								<div class='file-name-up'>".substr($file_name,14)."</div>
    								<div class='delete-img-cl-4' id='delete-img-id-4' data-filename='".$strip_all_returned_files."'>
    							    		Delete <i class='fa fa-close'></i>
    							    </div>
    							";
    						} else{
    							//do nothing
    						}

    				echo		"
    					</div>";
        		} else if(  strlen($file_extension) < 1 ) {
        			echo " ";
        		} else {
    				echo "
    					<div class='single_job_view_img_cl' data-filename='".$strip_all_returned_files."'>
    						<div class='empty_img_1'>
    							<a target='_blank' href='".$file_absolute_url."'>".$file_extension." file</a>
    						</div>
    						<br/>
    						";
    						if ($show_close_btn) {
    							echo "
    								<div class='file-name-up'>".substr($file_name,14)."</div>
    								<div class='delete-img-cl-4' id='delete-img-id-4' data-filename='".$strip_all_returned_files."'>
    							    		Delete <i class='fa fa-close'></i>
    							    </div>
    							";
    						} else{
    							//do nothing
    						}
    				echo		"
    					</div>

    					";
        		}
	    	}
    				echo '<div style="clear:both;"></div>';
		} else {
			echo " ";
		}
	}



	function processContractorID($the_contractor_id, $the_contractor_email_address){
		if ( intval($the_contractor_id) && is_numeric($the_contractor_id) ) {
			return $the_contractor_id;
		//if value has single quotes on either sides
		} else if (
			(substr($the_contractor_id, 0, 1) === "'") && (substr($the_contractor_id, -1, 1) === "'") || (substr($the_contractor_id, 0, 1) !== "'") && (substr($the_contractor_id, -1, 1) !== "'")
		){
			if ( (substr($the_contractor_email_address, 0, 1) === "'") && (substr($the_contractor_email_address, -1, 1) === "'") && strlen($the_contractor_email_address) > 1 && ( isset($the_contractor_email_address) ) ){
				$get_the_contractor_email = str_replace("'", "", $the_contractor_email_address);
			} else if ( (substr($the_contractor_email_address, 0, 1) !== "'") && (substr($the_contractor_email_address, -1, 1) !== "'") && strlen($the_contractor_email_address) > 1 && ( isset($the_contractor_email_address) ) ) {
				$get_the_contractor_email = $the_contractor_email_address;
			} else {
				//email is not set
				return "There was an error, could not get contractor ID. Either the email address is not set, or the contractor has in invalid ID. Try searching manually for the contractor and setting their email address to a single valid email";
			}

			$get_customers_with_id_sql_with_email = \DB::select("SELECT ID FROM contractors WHERE Con_E_mail_Address = " . "'\'" . $get_the_contractor_email . "\''");
			
			// var_dump( count($get_customers_with_id_sql_with_email) );
			// die();

			if ( count($get_customers_with_id_sql_with_email) > 0 ) {
				$get_customers_with_id_sql_with_email_int = get_object_vars($get_customers_with_id_sql_with_email[0]);
				$get_id = $get_customers_with_id_sql_with_email_int['ID'];
				
				return $get_id;
			} else {
				return "There was an error, could not get contractor ID. Either the email address is not set, or the contractor has in invalid ID. Try searching manually for the contractor and setting their email address to a single valid email";
			}

			

		} else {
			return "There was an error, could not get contractor ID. Either the email address is not set, or the contractor has in invalid ID. Try searching manually for the contractor and setting their email address to a single valid email";
		}
	}

	function getServiceRatesUsingIDOnly($customer_id){
        $srv_rates_details_arr = array();
        
        if ( isset($customer_id) && intval(htmlspecialchars(trim($customer_id))) > 0 ){
        	$g_customer_id = $customer_id;
        } else {
        	$g_customer_id = 0;
        }

        
        $get_srv_rates_sql = "SELECT * FROM services WHERE customer_id = $g_customer_id ORDER BY Service_Type DESC ";
        // var_dump($get_srv_rates_sql);
        // die();
        $get_srv_rates = \DB::select($get_srv_rates_sql);

        for ($i=0; $i < count($get_srv_rates); $i++) { 
        	array_push($srv_rates_details_arr,  get_object_vars($get_srv_rates[$i]));
        }
        // var_dump($srv_rates_details_arr);

        // $srv_rates = get_object_vars($get_srv_rates[0]);


        // var_dump(get_object_vars($get_srv_rates[0]));
        // die();
        // for ($i=0; $i < count($get_srv_rates); $i++) {

        //     array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Name"]));
            
        //     array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_State"]));

        //     array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Code"]));
            
        //     array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Rate"]));

        //     array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Cus_Number"]));
            
        //     array_push($srv_rates_details_arr, str_replace("'", "", get_object_vars($get_srv_rates[$i])["Service_Type"]));

        // }

        // if ( count($srv_rates_details_arr) > 0 ){
        	return $srv_rates_details_arr;
        	// var_dump($srv_rates_details_arr);
            // return response()->json($srv_rates_details_arr);
        // } else {
        // 	return $srv_rates;

        //     // return response()->json($srv_rates_details_arr);
        // 	// var_dump($srv_rates_details_arr);
        // }
    }

    function displayNextNoOfDays($next_no_of_days, $text_display){
    	date_default_timezone_set('America/New_York');
        $date=date_create(date("m/d/Y"));
        date_add($date,date_interval_create_from_date_string(strval($next_no_of_days)));
        $next_days = date_format($date,"m/d/Y");
        return "<a href='".url('/jobs/filter_start_end_date?date_start_end='). date('m/d/Y') . ' - ' . $next_days . "' class='btn btn-success btn-next-days'>" . $text_display . "</a>";
    }

    
    function displayPrevNoOfDays($next_no_of_days, $text_display){
    	date_default_timezone_set('America/New_York');
        $date=date_create(date("m/d/Y"));
        date_sub($date,date_interval_create_from_date_string(strval($next_no_of_days)));
        $prev_days = date_format($date,"m/d/Y");
        return "<a href='".url('/jobs/filter_start_end_date?date_start_end='). $prev_days . ' - ' . date('m/d/Y') . "' class='btn btn-success btn-next-days'>" . $text_display . "</a>";
    }

    function homepageContractorList(){
    	$get_contractors = \DB::select("SELECT * FROM contractors ORDER BY ID DESC LIMIT 0, 50 ");
    	$run_code = array('contractors'=>$get_contractors);
    	echo "<ol class='home-page-contractor-list-li'>";
    	for ($i=0; $i < count($run_code["contractors"]); $i++) { 
    		$each_array = get_object_vars($run_code["contractors"][$i]);
    		echo "<li><a href='". url('/contractors/')."/".$each_array["ID"] ."'> <b>" . $each_array["Con_First_Name"] . " " . $each_array["Con_Last_Name"] . "</b> - " . $each_array["Con_Language_1"] .  "</a></li>";
    	}
    	echo "</ol>";
    }

    function redirectIfNotLoggedIn(){
    	if (!(Auth::check())) {
            return redirect('/login');
        }
    }

    function sendEmail($the_emails, $subject, $message, $attachment_name, $attachment_content){
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
        $mail->Subject = $subject;

        if ( isset($attachment_name) && (!empty($attachment_name)) && isset($attachment_content) && (!empty($attachment_content)) ) {
        	$file_name = $attachment_name . ".pdf";
	        ob_get_clean();
	        $html2pdf = new HTML2PDF('P','A4','en',false,'UTF-8');
	        $html2pdf->WriteHTML($attachment_content, false);
	        ob_end_clean();
	        $generated_pdf = $html2pdf->Output($file_name, 'S');
	        $mail->addStringAttachment($generated_pdf, $file_name, 'base64', 'pdf'); 
        }

        
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
        $mail->AltBody = 'Hermes Workflow | Beacon Link LLC';
        $new_emails_array = explode(",", $the_emails);
        foreach ($new_emails_array as $key => $value) {
            $mail->AddBCC($value);
        }
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    function getDistance($addressFrom, $addressTo){
    // Google API key
    $accessToken = 'pk.eyJ1IjoiZ2Fib2xlYWwxMjMiLCJhIjoiY2p3MjJ4Mnp5MHNmNzQzb2RkeTZkdm5yZCJ9.QU-Uj98qEWcwwlnKGVgLzQ';
    
    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo     = str_replace(' ', '+', $addressTo);
    
    // Geocoding API request with start address
    $geocodeFrom = file_get_contents('https://api.mapbox.com/geocoding/v5/mapbox.places/'.$formattedAddrFrom.'.json?access_token='.$accessToken);
    $outputFrom = json_decode($geocodeFrom);
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }
    
    // Geocoding API request with end address
    $geocodeTo = file_get_contents('https://api.mapbox.com/geocoding/v5/mapbox.places/'.$formattedAddrTo.'.json?access_token='.$accessToken);
    $outputTo = json_decode($geocodeTo);
    if(!empty($outputTo->error_message)){
        return $outputTo->error_message;
    }
    
    // Get latitude and longitude from the geodata
    $latitudeFrom = $outputFrom->features[0]->geometry->coordinates[0];
    $longitudeFrom = $outputFrom->features[0]->geometry->coordinates[1];

    $latitudeTo    = $outputTo->features[0]->geometry->coordinates[0];

    $longitudeTo   = $outputTo->features[0]->geometry->coordinates[1];;
    
    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;
    
    // Convert unit and return distance
    
     return round($miles, 2).' miles';

}

?>




