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
            <a href="{{url('/services/create')}}" class="btn-enlace">
                <i class="fa fa-plus"></i> Create New Service
            </a>        
        </div>
	</div> 
			
	<div class="col-md-3" style="margin-left:-4rem; margin-right:1rem;">
		<div class="select-filter-job" style="">	                
			<button type="button" class="btn-filter dropdown-toggle" data-toggle="dropdown">Select Filter<span class="caret"></span></button>
	        <ul class="dropdown-menu scrollable-menu" role="menu" style="height: auto;max-height: 200px; overflow-x: hidden;">
	        	<li><a class="dropdown-item" href="#!"  id="show">Search</a></li>
	            <li><a class="dropdown-item" href="#!" id="show2">Type Services ID To View</a></li>
	        </ul>
        </div>
	</div>
	
	<div class="col-md-3" id="element" style="display: none;">
		<div id="close">
			<a href="#" id="hide">
				<button type="button" class="close" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
				</button>
			</a>
		</div>
		<!-- start first filter form here -->
		<form action="{{url('/services/s/')}}" method="GET">
		    <div class="mrg-top-20"></div>
			<div class="filter-sec-title">Search:</div>
		    <br/>
			<input type="text" name="q" class="form-control">                
			<br/>
			<div style="text-align: center;">
			    <input type="submit" id="frm2-submit-id" class="btn btn-success" value="Search">
	        </div>
		    <div class="mrg-top-30"></div>
        </form>
        <!-- end first filter form here -->
	</div>
	<div class="col-md-3" id="element2" style="display: none;">
		<div id="close">
			<a href="#" id="hide2">
				<button type="button" class="close" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
				</button>
			</a>
		</div>
		<!-- start first filter form here -->
		<form action="{{url('/services/showWithID/')}}" method="GET" id="viewContrByID" class="viewContrByID-cl">
		    <label for="cont_id">Type Services ID To View:</label>
		    <br/>
            <div class="mrg-top-20"></div>
		    <input type="text" name="g_the_id" class="form-control" id="cont_id">
		    <br/><br/>
		    <input type="submit" name="g" value="GO" class="btn btn-info">
		</form>
        <!-- end first filter form here -->
	</div>
</div>