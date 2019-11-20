<!-- Side Nav START -->
<div class="side-nav">
    <div class="side-nav-inner">
        <div class="side-nav-logo">
            <a href="{{url('/home')}}">
                <div class="logo logo-dark" style="background-image: url('./images/logo/logo.png')"></div>
                <div class="logo logo-white" style="background-image: url('./images/logo/logo-white.png')"></div>
            </a>
            <div class="mobile-toggle side-nav-toggle">
                <a href="#">
                    <i class="ti-arrow-circle-left"></i>
                </a>
            </div>
        </div>
        <ul class="side-nav-menu scrollable">
            <li class="nav-item active">
                <a class="mrg-top-30" href="{{ url('/') }}">
                    <span class="icon-holder">
                            <i class="ti-home"></i>
                        </span>
                    <span class="title">Dashboard</span>

                </a>
            </li>
            
            <li class="nav-item dropdown">
                <a href="{{ url('/jobs') }}">
                    <span class="icon-holder">
                        <i class="fa fa-briefcase"></i>
                    </span>
                    <span class="title">Jobs </span> 
                    <!-- <i class="fa-right-side-cl-1 fa fa-caret-right"></i> -->
                </a>
            </li>

            <!-- <li class="nav-item dropdown nav-item-2">
                <a href="{{ url('/jobs/create/new') }}">
                    <span class="icon-holder">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <span class="title">Create New Job</span>
                </a>
            </li> -->

            <li class="nav-item dropdown">
                <a href="{{ url('/services') }}">
                    <span class="icon-holder">
                        <i class="fa fa-language"></i>
                    </span>
                    <span class="title">Services</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ url('/customers') }}">
                    <span class="icon-holder">
                        <i class="fa fa-users"></i>
                    </span>
                    <span class="title">Customers</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ url('/contractors') }}">
                    <span class="icon-holder">
                        <i class="fa fa-user-times"></i>
                    </span>
                    <span class="title">Contractors</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ url('/invoices') }}">
                    <span class="icon-holder">
                        <i class="fa fa-file-text"></i>
                    </span>
                    <span class="title">Invoices</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ url('/contractor-billings') }}">
                    <span class="icon-holder">
                        <i class="fa fa-money"></i>
                    </span>
                    <span class="title">Contractor Billing</span>
                </a>
            </li>

            <?php
                //check is user is logged in
                if ( Auth::check() ) {
                    if ( Auth::user()->is_admin == 1) {
            ?>  
            <li class="nav-item dropdown">
                <a href="{{ url('/users') }}">
                    <span class="icon-holder">
                        <i class="fa fa-user"></i>
                    </span>
                    <span class="title">Users</span>
                </a>
            </li>
            
            <!-- <li class="nav-item dropdown">
                <a href="{{ url('/reports') }}">
                    <span class="icon-holder">
                        <i class="fa fa-area-chart"></i>
                    </span>
                    <span class="title">Reports</span>
                </a>
            </li> -->
            <?php
                    } else {
                        //do nothing.
                    } 
                } else {
                    //do nothing.
                } 
            ?>
        </ul>
    </div>
</div>
<!-- Side Nav END