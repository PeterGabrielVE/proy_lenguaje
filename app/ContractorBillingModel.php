<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorBillingModel extends Model
{
    //
    public static function modelContractorBillingsListWithPageNo($getPageNo = null){
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

		$no_of_rows_result = \DB::select('select count(*) as count from contractor_billing');
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

		$get_contractor_billings = \DB::select("SELECT * FROM contractor_billing ORDER BY ID DESC LIMIT $limit_to_start_from, $no_of_posts_to_show ");
		
    	return array('contractor_billings'=>$get_contractor_billings, 'get_no_of_pages_left'=>$pages_left, 'get_current_page_number'=>$get_page_number, 'get_next_page_number'=>$the_next_page_number, 'get_previous_page_number'=>$the_previous_page_number, 'get_showing_start_at'=>$limit_to_start_from, 'get_showing_end_at'=>$get_showing_end_at, 'total_number_of_entries'=>$pages_count);
    }
}
