<div class="row">
        <div class="col-md-12" style="text-align: left;">
                <div style="text-align: left;">
                        <i class="ti-comments-smiley text-info font-size-30" style="float: left;margin: 6px 5px 0 0px;"></i>Use this section to filter search. Select the options for the search filter. Select as many options as needed and click the Filter button at the bottom, the results will be shown on the right panel, based on your search filter parameters.
              </div>
        </div>
    </div>
    <br>
    <div class="row">
           <div class="col-md-6" style="">
            <div class="create-job-btn">
                <a href="{{url('/jobs/create/new')}}" class="btn-enlace">
                    
                        <i class="fa fa-plus"></i> Create New Job
                </a>      
            </div>
            </div> 
            
            <div class="col-md-3" id="btn_select_filter" style="margin-left:-6rem">
    
                    <button type="button" class="btn-filter dropdown-toggle select-filter-job" data-toggle="dropdown">Select Filter
                    <span class="caret"></span></button>
                   
                   <ul class="dropdown-menu scrollable-menu" role="menu" style="height: auto;max-height: 200px; overflow-x: hidden;">
                    <li><a class="dropdown-item" href="#!"  id="show">Search All Jobs</a></li>
                    <li><a class="dropdown-item" href="#!" id="show2">By ID Number</a></li>
                    <li><a class="dropdown-item" href="#!" id="show3">Date Range</a></li>
                    <li><a class="dropdown-item" href="#!" id="show4">By Status</a></li>
                    <li><a class="dropdown-item" href="#!" id="show5">By Type</a></li>
                    <li><a class="dropdown-item" href="#!" id="show6">By Service Type</a></li>
                    <li><a class="dropdown-item" href="#!" id="show7">By Language</a></li>
                    <li><a class="dropdown-item" href="#!" id="show8">By State</a></li>
                    <li><a class="dropdown-item" href="#!" id="show9">By City</a></li>
                    <li><a class="dropdown-item" href="#!" id="show10">Search By PO Number</a></li>
                    <li><a class="dropdown-item" href="#!" id="show11">By Distance/Radius From Zip Code</a></li>
                    <li><a class="dropdown-item" href="#!" id="show12">By Date Range</a></li>
                </ul>
                
            </div>


            
            <div class="col-md-3" id="element" style="display: none;">
            
                   <div id="close"><a href="#" id="hide"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                    <!-- start first filter form here -->
                    <form action="{{url('/jobs/s/')}}" method="GET">
                        <div class=""></div>
                        <div style="text-align: center;">Search All Jobs</div>
                        
                        <input type="text" class="form-control" value="" placeholder="Search...." name="q" required />
                        <div class="mrg-top-10"></div>

                        <div class="filter-submit">
                            <div class="row">
                                <div class="col-md-6" >
                                    <input type="submit" class="btn btn-success" id="frm1-submit-id" value="Search" style="width:180px;">
                                </div> 
                            </div>

                        </div>
                    </form>
                    <!-- end first filter form here -->
                </div>
        

            <div class="col-md-3" id="element2" style="display: none;">
    
                   <div id="close"><a href="#" id="hide2"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                    <!-- start first filter form here -->
                    <form action="{{url('/jobs/showWithID/')}}" method="GET" class="showJobByIDFormcl viewContrByID-cl" id="showJobByIDFormID">
                        <div class="mrg-top-10"></div>

                        <a href="{{url('/jobs/')}}" class="showJobByIDFormclURL"></a>
                        <div style="text-align: center;"><b>By ID Number</b></div>
                        Type a Job ID and click "GO" to view it. This part of the job search shows a single job, using an ID you supply.
                        <br/>
                        <input type="text" name="id" class="job_id form-control" id="job_id">
                        <input type="submit" name="g" value="GO" class="btn btn-info viewContrByID-submit-cl">
                        

                    </form>
                <!-- end first filter form here -->
                </div>

            <div class="col-md-3"  id="element3" style="display: none;">
                <div id="close"><a href="#" id="hide3"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                 <!-- start first filter form here -->
                <form action="{{url('/jobs/filter_start_end_date/')}}" method="GET">
                    <div class="mrg-top-10"></div>
                    <div style="text-align: center;"><b>Select Date Range</b></div>
                    <div style="text-align: center;">
                        This job search part shows a job start and end date, using a range.
                        When you select the date, select a date range to view when a "Job Start" & "Job End" date falls in the range.   
                    </div>
                    <br/>
                    <input type="text" id="date-range-picker" class="form-control" value="<?php echo date('m/d/Y')  . " - " . date('m/d/Y'); ?>" placeholder="Date range picker" name="date_start_end" />
                    <div class="mrg-top-20"></div>
                    
                    <div class="filter-submit">
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <input type="submit" name="" class="btn btn-success job-search-date-range-cl" id="frm1-submit-id" value="Show me jobs that fall in this date range">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end first filter form here -->
            </div>

<!-- ================================================== -->
             <form action="{{url('/jobs/filter_all/')}}" method="GET">
            <div class="mrg-top-20"></div>

            <div class="col-md-12"  id="element4" style="display: none;">
                <div id="close"><a href="#" id="hide4"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
               
                <div class="filter-sec-title">By Status</div>
                <div class="mrg-top-20">
                    <select id="selectize-dropdown-job-status" name="status">
                        <option value="" disabled selected>Select a job status...</option>
                        <option value="Request">Request</option>
                        <option value="Canceled">Canceled</option>
                        <option value="Completed">Completed</option>
                        <option value="Invoice_Sent">Invoice Sent</option>
                        <option value="Bill_Sent">Bill Sent</option>
                        <option value="Quote">Quote</option>
                        <option value="Miss_Trip">Miss Trip</option>
                        <option value="In_Progress">In Progress</option>
                        <option value="Closed">Closed</option>
                        <option value="Ready_for_Invoicing">Ready for Invoicing</option>
                        <option value="Missed_Opportunity">Missed Opportunity</option>
                        <option value="Partially_paid">Partially paid</option>
                        <option value="Missed oportunity">Missed oportunity</option>
                    </select>
                </div>
            </div>
             
                <div class="mrg-top-20"></div>
                
                <div class="col-md-12"  id="element5" style="display: none;">
                <div id="close"><a href="#" id="hide5"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                
                <div class="filter-sec-title">By Type</div>
                <div class="mrg-top-20">
                    <select id="selectize-dropdown-job-type" name="job_type">
                        <option value="" disabled selected>Select a job type...</option>
                        <option value="Interpretation">Interpretation</option>
                        <option value="Translation">Translation</option>
                        <option value="Telephonic_Interpretation">Telephonic Interpretation</option>
                        <option value="VRI">(VRI) Video Remote Interpretation</option>
                    </select>
                </div>
              
            </div>

            <div class="mrg-top-20"></div>
               
            <div class="col-md-12"  id="element6" style="display: none;">
                <div id="close"><a href="#" id="hide6"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                <form action="{{url('/jobs/filter_all/')}}" method="GET">
                <div class="filter-sec-title">By Service Type</div>
                <div class="mrg-top-20">
                    <select id="selectize-dropdown-job-type" name="serv_type">
                        <option value="" disabled selected>Select a job service type...</option>
                        <option value="Medical">Medical</option>
                        <option value="Standard">Standard</option>
                    </select>
                </div>
             
            </div>

            <div class="mrg-top-20"></div>

            <div class="col-md-12"  id="element7" style="display: none;">
                <div id="close"><a href="#" id="hide7"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                
                    <div class="filter-sec-title">By Language</div>
                
                <div class="mrg-top-20">
                    <select id="selectize-dropdown-job-type" name="lang">
                        <option value="" disabled selected>Select a Language...</option>
                        <?php
                            $get_all_the_languages_from_db = \DB::select('SELECT language FROM languages');
                            foreach ($get_all_the_languages_from_db as $key => $value) {
                                $get_array = get_object_vars($value);
                                echo "<option value='".$get_array['language']."'>".$get_array['language']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="mrg-top-20"></div>

            <div class="col-md-12"  id="element8" style="display: none;">
                <div id="close"><a href="#" id="hide8"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
               
                <div class="filter-sec-title">By State:</div>
                <select id="selectize-dropdown-state" class="selectize-dropdown-state-cl" name="state">
                    <option value="" disabled selected>Select a State...</option>
                    @include('static_state_view')
                </select> 
                
            </div>

            <div class="mrg-top-20"></div>

            <div class="col-md-12"  id="element9" style="display: none;">
                <div id="close"><a href="#" id="hide9"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                    <div style="text-align: center;">By City</div>
                    <input type="text" class="form-control" value="" placeholder="City Name" name="city_name"/>

            </div>

                <div class="mrg-top-20"></div>

             <div class="col-md-12"  id="element11" style="display: none;">
                <div id="close"><a href="#" id="hide11"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
             
                 <div class="filter-sec-title">Distance/Radius From Zip Code</div>
                <div class="mrg-top-10">
                    <!-- <select id="selectize-dropdown-job-status" name="distance_radius"> -->
                    <select name="distance_radius_jobs" class="contrctr_select_cl">
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
            </div>

                <div class="filter-submit">
                    <div class="col-md-12" id="btn_submit_filter" style="display: none;">
                        <div class="col-md-12">
                            <input type="submit" id="" class="btn btn-success" value="Filter" style="width: 180px;">
                        </div>
                    </div>
                     <div class="col-md-12" id="btn_add_filter" style="display: none;">
                                <div class="col-md-12">
                                    <input type="button" class="btn btn-success" id="mostrar" value="Add Other Filter">
                                </div> 
                    </div>
                </div>
            </form>

<!-- ======================================================= -->
    
            <div class="col-md-3"  id="element10" style="display: none;">
                <div id="close"><a href="#" id="hide10"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                        <form action="{{url('/jobs/search_by_po_no/')}}" method="GET">
                <div class="mrg-top-10"></div>
                <div style="text-align: center;">Search By PO Number</div>
                <input type="text" class="form-control" value="" placeholder="Enter PO Number...." name="po_number" required/>
                <div class="mrg-top-20"></div>
                <div class="filter-submit">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-success" id="frm1-submit-id" value="Search">
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </form>
            </div>

             <div class="col-md-3"  id="ele11" style="display: none;">
                <div id="close"><a href="#" id="hide11"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
            <form action="{{url('/jobs/filter_all/')}}" method="GET">
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
            

            </div>



            <div class="col-md-3"  id="element13" style="display: none;">
                <div id="close"><a href="#" id="hide11"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                <form action="{{url('/jobs/filter_all/')}}" method="GET">   
                <div class="mrg-top-10"> <div style="text-align: center;">By Date Range</div>
                    <select id="selectize-dropdown-job-date-range" name="date">
                        <option value="" disabled selected>Select a Date Range</option>
                         <option value='<?php displayPrevNoOfDays("3 days", "Last 2 Days Jobs"); ?>'>Today's</option>
                         <option value='<?php displayNextNoOfDays("2 days", "Next Day Jobs");
                         ?>'>Next Day</option>
                         <option value='<?php displayNextNoOfDays("3 days", "Next 2 Days Jobs");
                         ?>'>Next 2 Days</option>
                         <option value='<?php displayNextNoOfDays("8 days", "Next 7 Days Jobs");
                         ?>'>Next 7 Days</option>
                         <option value='<?php displayNextNoOfDays("31 days", "Next 30 Days Jobs");
                         ?>'>Next 30 Days</option>
                         <option value=' <?php displayPrevNoOfDays("8 days", "Last 7 Days Jobs");
                         ?>'>Last 2 Days</option>
                         <option value='<?php displayPrevNoOfDays("3 days", "Last 2 Days Jobs");
                         ?>'>Last 7 Days</option>
                         <option value=' <?php displayPrevNoOfDays("31 days", "Last 30 Days Jobs");
                        ?>'>Last 30 Days</option>
               
                    </select>
                </div> 
                 <div class="filter-submit">
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <input type="submit" name="" class="btn btn-success " id="frm1-submit-id" value="Filters">
                            </div>
                        </div>
                    </div>  
            </form>
            </div> 

            <div class="col-md-3"  id="element12" style="display: none;">
                <div id="close"><a href="#" id="hide12"><button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></a></div>
                <form action="{{url('/jobs/filter_start_end_date/')}}" method="GET">    
                <div class="mrg-top-10"> <div style="text-align: center;">By Date Range</div>
                    <select id="" name="date_start_end" onchange="this.form.submit()">
                        <option value="" disabled selected>Select a Date Range</option>
                        
                        <?php
                            $today = date('d-m-Y');
                            $date = date_create_from_format('d/m/y', '27/05/1990');  
                            $Date = strtotime('Y-m-d');
                        ?>
                         <option value="<?php echo $today ."-". date('d-m-Y',strtotime($today.'+ 0 days')); ?>">Today's</option>
                         <option value="<?php echo $today ."-". date('d-m-Y',strtotime($today.'+ 2 days')) ?>">Next</option>
                         <option value="<?php echo $today ."-". date('d-m-Y',strtotime($today.'+ 3 days')) ?>">Next 2 Days</option>
                         <option value="<?php echo $today ."-". date('d-m-Y',strtotime($today.'+ 8 days')) ?>">Next 7 Days</option>
                         <option value="<?php echo $today ."-". date('d-m-Y',strtotime($today.'+ 31 days')) ?>">Next 30 Days</option>
                         <option value="<?php echo $today ."-". date('d-m-Y',strtotime($today.'- 3 days')) ?>">Last 2 Days</option>
                         <option value="<?php echo $today ."-". date('d-m-Y',strtotime($today.'- 8 days')) ?>">Last 7 Days</option>
                         <option value="<?php echo $today ."-". date('d-m-Y',strtotime($today.'- 31 days')) ?>">Last 30 Days</option>
                
                    </select>
                </div> 
                
            </form>
            
            </div>
        
        
  </div>    
 
 <!-- <script>
   function muestra_oculta(id){
        if (document.getElementById){ //se obtiene el id
        var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
        el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
        }
    }
    
    window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
        muestra_oculta('contenido_a_mostrar');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
      } 
 </script> -->