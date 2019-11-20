
            <div class="mrg-top-30"></div>
            
            <div class="create-job-btn">
                <a href="{{url('/jobs/create/new')}}">
                    <h3 class="btn btn-success" style="text-align: center;">
                        <i class="fa fa-plus"></i> Create New Job
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

            <!-- start first filter form here -->
            <form action="{{url('/jobs/s/')}}" method="GET">
                <div class="mrg-top-10"></div>
                <div style="text-align: center;">Search All Jobs</div>
                
                <input type="text" class="form-control" value="" placeholder="Search...." name="q" required />
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
            <!-- end first filter form here -->

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>


            <!-- start first filter form here -->
            <form action="{{url('/jobs/showWithID/')}}" method="GET" class="showJobByIDFormcl viewContrByID-cl" id="showJobByIDFormID">
                <div class="mrg-top-10"></div>

                <a href="{{url('/jobs/')}}" class="showJobByIDFormclURL"></a>
                <div style="text-align: center;"><b>Show Job With ID</b></div>
                Type a Job ID and click "GO" to view it. This part of the job search shows a single job, using an ID you supply.
                <br/>
                <input type="text" name="id" class="job_id form-control" id="job_id">
                <input type="submit" name="g" value="GO" class="btn btn-info viewContrByID-submit-cl">
                

            </form>
            <!-- end first filter form here -->

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>

            <!-- start first filter form here -->
            <form action="{{url('/jobs/filter_start_end_date/')}}" method="GET">
                <div class="mrg-top-10"></div>
                <div style="text-align: center;"><b>Select Job START DATE & END DATE Range To View Job</b></div>
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
            
            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>
            <div class="mrg-top-30"></div>
            
            <!-- start second filter form here -->                                        
            <form action="{{url('/jobs/filter_all/')}}" method="GET">
                <div class="filter-sec-title">By Job Status</div>
                <div class="mrg-top-10">
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

                <div class="mrg-top-20"></div>
                <div class="filter-sec-title">By Job Type</div>
                <div class="mrg-top-10">
                    <select id="selectize-dropdown-job-type" name="job_type">
                        <option value="" disabled selected>Select a job type...</option>
                        <option value="Interpretation">Interpretation</option>
                        <option value="Translation">Translation</option>
                        <option value="Telephonic_Interpretation">Telephonic Interpretation</option>
                        <option value="VRI">(VRI) Video Remote Interpretation</option>
                    </select>
                </div>

                <div class="mrg-top-20"></div>
                <div class="filter-sec-title">By Service Type</div>
                <div class="mrg-top-10">
                    <select id="selectize-dropdown-job-type" name="serv_type">
                        <option value="" disabled selected>Select a job service type...</option>
                        <option value="Medical">Medical</option>
                        <option value="Standard">Standard</option>
                    </select>
                </div>

                <div class="mrg-top-20"></div>
                <div class="filter-sec-title">By Language</div>
                
                <div class="mrg-top-10">
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

                <div class="mrg-top-20"></div>
                <div class="filter-sec-title">By State:</div>
                <select id="selectize-dropdown-state" class="selectize-dropdown-state-cl" name="state">
                    <option value="" disabled selected>Select a State...</option>
                    @include('static_state_view')
                </select>    

                <div class="mrg-top-20"></div>
                <div style="text-align: center;">By City</div>
                
                <input type="text" class="form-control" value="" placeholder="City Name" name="city_name"/>

                <div class="mrg-top-30"></div>

                <div class="filter-submit">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <input type="submit" id="frm2-submit-id" class="btn btn-success" value="Filter">
                        </div>
                    </div>
                </div>
            </form>
            <!-- end second filter form here -->

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>
            <div class="mrg-top-30"></div>

            <!-- start third filter form here -->
            <form action="{{url('/jobs/filter_req_date/')}}" method="GET">
                <div style="text-align: center;">Select Job REQUEST DATE Range To View Job</div>
                <input type="text" id="date-range-picker-2" class="form-control" value="06/01/2017 - 11/01/2017" placeholder="Date range picker" name="req_date" />
                    
                <div class="mrg-top-30"></div>

                <div class="filter-submit">
                    <div class="row">
                        <div class="col-md-6" style="text-align: center;">
                            <input type="submit" id="frm3-submit-id" class="btn btn-success" value="Filter">
                        </div>
                    </div>
                </div>
            </form>
            <!-- end third filter form here -->

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>
            
            <form action="{{url('/jobs/search_by_po_no/')}}" method="GET">
                <div class="mrg-top-10"></div>
                <div style="text-align: center;">Search Job By PO Number</div>
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

            <div class="line-divide"></div>

            <div class="sidebar-job-date-ranges">
                <?php
                    echo displayNextNoOfDays("0 days", "Today's Jobs");
                ?>
                <?php
                   echo displayNextNoOfDays("2 days", "Next Day Jobs");
                ?>
                <br/>
                <?php
                    echo displayNextNoOfDays("3 days", "Next 2 Days Jobs");
                ?>
                <br/>
                <?php
                    echo displayNextNoOfDays("8 days", "Next 7 Days Jobs");
                ?>
                <br/>
                <?php
                    echo displayNextNoOfDays("31 days", "Next 30 Days Jobs");
                ?>
                <br/>
                <?php
                    echo displayPrevNoOfDays("8 days", "Last 7 Days Jobs");
                ?>
                <br/>
                <?php
                    echo displayPrevNoOfDays("3 days", "Last 2 Days Jobs");
                ?>
                <?php
                    echo displayPrevNoOfDays("31 days", "Last 30 Days Jobs");
                ?>
            </div>
            <!-- end first filter form here -->

            