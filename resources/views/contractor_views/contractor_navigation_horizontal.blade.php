<div class="row">
		<div class="col-md-12" style="text-align: left;">
	            <div style="text-align: left;">
	                    <i class="ti-comments-smiley text-info font-size-30" style="float: left;margin: 6px 5px 0 0px;"></i>Use this section to filter search. Select the options for the search filter. Select as many options as needed and click the Filter button at the bottom, the results will be shown on the right panel, based on your search filter parameters.
	          </div>
	    </div>
	</div>
	<br>  

	<div class="row">
           <div class="col-md-6">
            <div class="create-job-btn">
              <a href="{{url('/contractors/create')}}" class="btn-enlace">
                <i class="fa fa-plus"></i> Create New Contractor
                </a>      
            </div>
	</div> 
			
	<div class="col-md-3" id="select_filter_contractor" style="margin-left:-4rem; margin-right:1rem;">
				

				<div class="select-filter-job" style="">	                
					       <button type="button" class="btn-filter dropdown-toggle select-filter-job" data-toggle="dropdown">Select Filter<span class="caret"></span></button>
	               
	               <ul class="dropdown-menu scrollable-menu" role="menu" style="height: auto;max-height: 200px; overflow-x: hidden;">
	                <li><a class="dropdown-item" href="#!"  id="show1_contractor">By Contractor’s Name</a></li>
	               <li><a class="dropdown-item" href="#!"  id="show2_contractor">By Contractor ID</a></li>
	                <li><a class="dropdown-item" href="#!" id="show3_contractor">By Language</a></li>
	                <li><a class="dropdown-item" href="#!" id="show4_contractor">By City</a></li> 
	                <li><a class="dropdown-item" href="#!" id="show5_contractor">By State</a></li>
	                <li><a class="dropdown-item" href="#!" id="show6_contractor">Zip Code</a></li>
	                <li><a class="dropdown-item" href="#!" id="show7_contractor">Distance/Radius From Zip Code</a></li>
	                
	            </ul>
                </div>
	</div>
	
	<div class="col-md-3" id="contractorName" style="display: none;">
			
				   <div id="close"><a href="#" id="hide1_contractor"><button type="button" class="close" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
					</button></a></div>
					<!-- start first filter form here -->
				    <form action="{{url('/contractors/s/')}}" method="GET" id="mainContrSearchid" class="mainContrSearch-cl">
                        <label for="main_cont_search_id">By Contractor’s Name:</label>
                        <br/>
                        <input type="text" name="q" class="form-control contrctr-search-btn" id="main_cont_search_id">
                        <br/>
                        <div class="contrctr-search-div">
                            <input type="submit" name="s" value="Show Results" class="btn btn-warning contrctr-search-submit">
                        </div>
            </form>
          <!-- end first filter form here --> 
	</div>
	<div class="col-md-3" id="contractorID" style="display: none;">
			
				   <div id="close"><a href="#" id="hide2_contractor"><button type="button" class="close" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
					</button></a></div>
					<!-- start first filter form here -->
				  <form action="{{url('/contractors/showWithID/')}}" method="GET" id="viewContrByID" class="viewContrByID-cl">
             <label for="cont_id">By Contractor ID:</label>
             <br/>
             <div style="margin-bottom: 10px;">
                  <input type="text" name="id" class="form-control" id="cont_id">
              </div>
              <div class="contrctr-search-div">
                  <input type="submit" name="g" value="Show Results" class="btn btn-info viewContrByID-submit-cl">
               </div>
            </form>

            		<!-- end first filter form here --> 
	</div>


   <form action="{{url('/contractors/filter_all/')}}" method="GET">
                <div class="mrg-top-20"></div>

                <div class="col-md-12"  id="contractorLanguage" style="display: none;">
                  <div id="close"><a href="#" id="hide3_contractor"><button type="button" class="close" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button></a></div>
                      <div class="filter-sec-title">By Language</div>
                      <select id="selectize-dropdown-job-type" name="lang">
                          <option value="" disabled selected>Select a Language...</option>
                          <!-- <option value="4">Standard</option> -->
                          <?php
                              $get_all_the_languages_from_db = \DB::select('SELECT language FROM languages');
                              if ( isset($_GET['lang']) && strlen($_GET['lang']) > 2 && !empty($_GET['lang']) ) {
                                  $get_the_language = $_GET['lang'];
                              } else{
                                  $get_the_language = "";
                              }
                        

                        foreach ($get_all_the_languages_from_db as $key => $value) {
                            $get_array = get_object_vars($value);
                            $language_trimmed = utf8_decode(trim($get_array['language']));
                          
                            echo "<option value='". $language_trimmed ."'> ". $language_trimmed ."</option>";    
                        }
                    ?>
                </select>
              </div>  
                <div class="mrg-top-20"></div>

             <div class="col-md-12"  id="contractorCity" style="display: none;">
                  <div id="close"><a href="#" id="hide4_contractor"><button type="button" class="close" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button></a></div>
                <div class="filter-sec-title">
                  <label for="main_cont_search_id">By City:</label>
                </div>
                <br/>
                <input type="text" name="city" class="form-control contrctr-search-btn" id="main_cont_search_id" placeholder="City name">
                <br/>
            </div>
                <div class="mrg-top-20"></div>

          <div class="col-md-12"  id="contractorState" style="display: none;">
                  <div id="close"><a href="#" id="hide5_contractor"><button type="button" class="close" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button></a></div>
                <div class="filter-sec-title">By State:</div>
                <select id="selectize-dropdown-state" class="selectize-dropdown-state-cl" name="state">
                    <option value="" disabled selected>Select a State...</option>
                    @include('static_state_view')
                </select>    
          </div>
               
                <div class="mrg-top-20"></div>

           <div class="col-md-12"  id="contractorZip" style="display: none;">
                  <div id="close"><a href="#" id="hide6_contractor"><button type="button" class="close" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button></a></div>      
                <div class="filter-sec-title">Zip Code:</div>
                <br/>
                <input type="text" class="form-control" name="zip" placeholder="zip code">
            </div>    

                <div class="mrg-top-20"></div>

            <div class="col-md-12"  id="contractorDistance" style="display: none;">
                  <div id="close"><a href="#" id="hide7_contractor"><button type="button" class="close" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                </button></a></div>        
                <div class="filter-sec-title">Distance/Radius From Zip Code</div>
                <div class="mrg-top-10">
                  
                    <select name="distance_radius" class="contrctr_select_cl">
                          <option value="" disabled selected>Select a distance radius...</option>
                          <option value="5">5 Miles</option>
                          <option value="10">10 Miles</option>
                          <option value="20">20 Miles</option>
                          <option value="25">25 Miles</option>
                          <option value="35">35 Miles</option>
                          <option value="50">50 Miles</option>
                          <option value="75">75 Miles</option>
                          <option value="100">100 Miles</option>
                          <option value="150">150 Miles</option>
                          <option value="200">200 Miles</option>
                          <option value="250">250 Miles</option>
                          <option value="500">500 Miles</option>
                    </select>
                </div>
            </div>

            <div class="mrg-top-30"></div>
            <div class="filter-submit">
                    <div class="col-md-12">
                        <div class="col-md-12" id="btn_submit_contractor"  style="text-align: center; display: none;">
                            <input type="submit" id="frm2-submit-id" class="btn btn-success" value="Show Results">
                        </div>
                          
                                <div class="col-md-12" id="btn_add_filter_contractor" style="display: none;">
                                    <input type="button" class="btn btn-success" id="mostrar_contractor" value="Add Other Filter">
                                </div> 
                    </div>
              </div>
            </form>			
		
</div>