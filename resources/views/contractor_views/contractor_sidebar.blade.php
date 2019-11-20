
            <div class="mrg-top-30"></div>
            
            <div class="create-job-btn">
                <a href="{{url('/contractors/create')}}">
                    <h3 class="btn btn-success" style="text-align: center;">
                        <i class="fa fa-plus"></i> Create New Contractor
                    </h3>
                </a>    
                
            </div>
            
            <div class="line-divide"></div>

            <h3 style="text-align: center;">Filter</h3>
            <div style="text-align: center;">
                <div style="text-align: justify;">
                    <i class="ti-comments-smiley text-info font-size-30" style="float: left;margin: 6px 5px 0 0px;"></i>Use this section to filter search. Select the options for the search filter. Select as many options as needed and click the Filter button at the bottom, the results will be shown on the right panel, based on your search filter parameters.
                </div>
            </div>
            
            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>

            <form action="{{url('/contractors/s/')}}" method="GET" id="mainContrSearchid" class="mainContrSearch-cl">
                <label for="main_cont_search_id">Search For Contractor:</label>
                <br/>
                <input type="text" name="q" class="form-control contrctr-search-btn" id="main_cont_search_id">
                <br/>
                <div class="contrctr-search-div">
                    <input type="submit" name="s" value="Show Results" class="btn btn-warning contrctr-search-submit">
                </div>
            </form>

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>

            <!-- <form action="{{url('/contractors/searchbycity/')}}" method="GET" id="mainContrSearchid" class="mainContrSearch-cl">
                <label for="main_cont_search_id">Search For Contractor By City:</label>
                <br/>
                <input type="text" name="s_city" class="form-control contrctr-search-btn" id="main_cont_search_id">
                <br/>
                <div class="contrctr-search-div">
                    <input type="submit" name="s" value="Show Results" class="btn btn-success contrctr-search-submit">
                </div>
            </form> -->

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>

           
            <form action="{{url('/contractors/showWithID/')}}" method="GET" id="viewContrByID" class="viewContrByID-cl">
                <label for="cont_id">Type Contractor ID To View:</label>
                <br/>
                <div style="margin-bottom: 10px;">
                    <input type="text" name="id" class="form-control" id="cont_id">
                </div>
                <div class="contrctr-search-div">
                    <input type="submit" name="g" value="Show Results" class="btn btn-info viewContrByID-submit-cl">
                </div>
            </form>

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>
            
            <!-- start second filter form here -->                                        
            <form action="{{url('/contractors/filter_all/')}}" method="GET">
                <div class="mrg-top-20"></div>
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
                            // if (
                            //         isset($language_trimmed) && 
                            //         (strlen($language_trimmed) > 2) &&
                            //         ($language_trimmed === $get_the_language)
                            //     ) {
                            //     echo "<option value='". $language_trimmed ."' selected> ". $language_trimmed ."</option>";    
                            // } else {
                            //     echo "<option value='". $language_trimmed ."'> ". $language_trimmed ."</option>";    
                            // }
                            echo "<option value='". $language_trimmed ."'> ". $language_trimmed ."</option>";    
                        }
                    ?>
                </select>
                
                <div class="mrg-top-20"></div>

                <div class="filter-sec-title">
                    <label for="main_cont_search_id">By City:</label>    
                </div>
                <br/>
                <input type="text" name="city" class="form-control contrctr-search-btn" id="main_cont_search_id" placeholder="City name">
                <br/>

                <div class="mrg-top-20"></div>

                <div class="filter-sec-title">By State:</div>
                <select id="selectize-dropdown-state" class="selectize-dropdown-state-cl" name="state">
                    <option value="" disabled selected>Select a State...</option>
                    @include('static_state_view')
                </select>    

                <!-- <div class="mrg-top-20"></div>
                <div class="filter-sec-title">By Zip Code. Type Zip Code:</div>
                <div class="mrg-top-10">
                    <input type="text" class="form-control" name="zip">
                </div>
 -->
               <!--  <div class="mrg-top-20"></div>
                <div class="filter-sec-title">Distance/Radius From Zip Code</div>
                <div class="mrg-top-10">
                    <select id="selectize-dropdown-job-status" name="distance_radius">
                          <option value="" disabled selected>Select a distance radius...</option>
                          <option value="5">5 Miles</option>
                          <option value="10">10 Miles</option>
                          <option value="20">20 Miles</option>
                          <option value="25">25 Miles</option>
                          <option value="100">100 Miles</option>
                          <option value="200">200 Miles</option>
                          <option value="500">500 Miles</option>
                    </select>
                </div>
                -->
                <div class="mrg-top-20"></div>
                <div class="filter-sec-title">Zip Code:</div>
                <br/>
                <input type="text" class="form-control" name="zip" placeholder="zip code">
                

                <div class="mrg-top-20"></div>
                <div class="filter-sec-title">Distance/Radius From Zip Code</div>
                <div class="mrg-top-10">
                    <!-- <select id="selectize-dropdown-job-status" name="distance_radius"> -->
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
                <br/>
                <div class="mrg-top-30"></div>

                <div class="filter-submit">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <input type="submit" id="frm2-submit-id" class="btn btn-success" value="Show Results">
                        </div>
                    </div>
                </div>
            </form>
            <!-- end second filter form here -->

