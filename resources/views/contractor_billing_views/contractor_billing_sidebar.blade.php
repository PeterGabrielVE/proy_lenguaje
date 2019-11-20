
            <div class="mrg-top-30"></div>
            
            <div class="create-job-btn">
                <a href="{{url('/contractor-billings/create')}}">
                    <h3 class="btn btn-success" style="text-align: center;">
                        <i class="fa fa-plus"></i> Create Contractor Billing
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

            <form action="{{url('/contractor-billings/showWithID/')}}" method="GET" id="viewContrByID" class="viewContrByID-cl">
                <label for="cont_id">Type ID To View:</label>
                <br/>
                <input type="text" name="g_the_id" class="form-control" id="cont_id">
                <input type="submit" name="g" value="GO" class="btn btn-info">
            </form>

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>
            <!-- end second filter form here -->