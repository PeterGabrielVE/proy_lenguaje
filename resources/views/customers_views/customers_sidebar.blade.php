
            <div class="mrg-top-30"></div>
            
            <div class="create-job-btn">
                <a href="{{url('/customers/create')}}">
                    <h3 class="btn btn-success" style="text-align: center;">
                        <i class="fa fa-plus"></i> Create New Customer
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

            <!-- start second filter form here -->                                        
            <form action="{{url('/customers/s/')}}" method="GET">
                <div class="mrg-top-20"></div>
                <div class="filter-sec-title">Search For Customers:</div>
                
                <div class="mrg-top-30"></div>
                <input type="text" id="" class="form-control" placeholder="Search..." name="q">
                <br/>
                <div style="text-align: center;">
                    <input type="submit" id="frm2-submit-id" class="btn btn-success" value="Search">
                </div>
            </form>
            <!-- end second filter form here -->

            <div class="mrg-top-30"></div>
            <div class="line-divide"></div>

            <form action="{{url('/customers/showWithID/')}}" method="GET" id="viewContrByID" class="viewContrByID-cl">
                <label for="cont_id">Type Customers ID To View:</label>
                <br/>
                <input type="text" name="id" class="form-control" id="cont_id">
                <input type="submit" value="GO" class="btn btn-info">
            </form>

            <div class="mrg-top-30"></div>
                        
            
