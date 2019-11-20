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
                <a href="{{url('/contractor-billings/create')}}" class="btn-enlace">
                    <i class="fa fa-plus"></i> Create Contractor Billing
                </a>    
                
            </div>
			</div> 
			
			<div class="col-md-3" style="margin-left:-4rem; margin-right:1rem;">
				<div class="select-filter-job" style="">	                
					<button type="button" class="btn-filter dropdown-toggle select-filter-job" data-toggle="dropdown">Select Filter<span class="caret"></span></button> 
	               <ul class="dropdown-menu scrollable-menu" role="menu" style="height: auto;max-height: 200px; overflow-x: hidden;">
	                <li><a class="dropdown-item" href="#!"  id="show">Type ID To View</a></li>
	               
	            </ul>
                </div>
			</div>
	
			<div class="col-md-3" id="element" style="display: none;">
			
				   <div id="close"><a href="#" id="hide"><button type="button" class="close" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
					</button></a></div>
					<!-- start first filter form here -->
				      <form action="{{url('/contractor-billings/showWithID/')}}" method="GET" id="viewContrByID" class="viewContrByID-cl">
		                <label for="cont_id">Type ID To View:</label>
		                <br/>
		                <input type="text" name="g_the_id" class="form-control" id="cont_id">
		                <input type="submit" name="g" value="GO" class="btn btn-info">
		            </form>
            		<!-- end first filter form here --> 
				</div>
		
</div>