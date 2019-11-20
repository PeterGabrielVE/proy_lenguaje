<?php
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
		return str_replace("'", "", $input);
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
				". str_replace("'", "", $g_value_2) ."
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
				". str_replace("'", "", $g_value_2) ."
				</b>
			</li>
			";
	}

	function returnTextForContractorSingleView2($g_value_2){
		echo "
			<li class='backgrounded-li width100'>
				<b>
				". str_replace("'", "", $g_value_2) ."
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

	function returnTextareaFieldForContractorCreateView($value){
		$value_joined = str_replace(" ", "_", $value);
		echo "
			<label for='contractor_".$value_joined."_id'>".$value.":</label>
			<textarea name='".$value_joined."' class='form-control' id='contractor_".$value_joined."_id'></textarea>
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
?>


