<?php

?>
@extends('layouts.app')

@section('content')
<body>
    <div class="app">
        <div class="layout">
            
            @include('sidebar')

            @include('header')

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-title">
                            
                            <h1 style="text-align: center;">All Users</h1>

                            <div class="breadcrumbs">
                                <div class="fa fa-hand-o-right"></div> 
                                You are here: 
                                <a href="{{url('/')}}">Home </a>
                                    >
                                <a href="{{url('/users/')}}">All Users</a>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-block">
                                        <a href="{{url('/users/create')}}" class="btn btn-flat btn-edit-cl"> 
                                                            <i class="fa fa-plus"></i> Create User
                                                        </a>
                                        @foreach ($users as $user)
                                        <div class="card single-contractor-loop-card">
                                            <div class="card-body card-body-2">
                                                <div class="row single-job-row-1">

                                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                        User ID: <b><a href="{{url('/users/')}}/{{$user->id}}">{{ $user->id }}</a></b>
                                                        
                                                        <br/>
                                                        Name: 
                                                        <b>
                                                            <?php echo removeQuotes($user->name); ?>
                                                        </b>

                                                        <br/>
                                                        
                                                        Email: 
                                                        <b>
                                                            <?php echo removeQuotes($user->email); ?>
                                                        </b>

                                                        <br/>
                                                        
                                                        Is Admin?
                                                        <b>
                                                            <?php 
                                                                if ( $user->is_admin === 1 ) {
                                                                    echo "Yes";
                                                                } else {
                                                                    echo "No";
                                                                }
                                                            ?>
                                                        </b>

                                                    </div>    
                                                </div>
                                            </div>
                                            <div class="card-footer border top">
                                                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                                                    
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/users/')}}/{{$user->id}}" class="btn btn-flat btn-view-cl"> 
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/users/edit')}}/{{$user->id}}" class="btn btn-flat btn-edit-cl"> 
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <?php
                                                            echo Form::open(array('url'=>'users/delete/'.$user->id, 'method'=>'PUT', 'id'=>'delete_users_form_id'))
                                                        ?>
                                                            <input type="hidden" name="get_the_id" value="<?php echo $user->id; ?>">
                                                            <input 
                                                            type="submit" 
                                                            class="btn btn-flat btn-delete-cl"
                                                            id="delete_single_user" value="DELETE">
                                                        {!! Form::close() !!}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>                                       
                                        

                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="{{url('/users/page/')}}{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    <span>
                                                        Page
                                                            <select class="list-pagination-select-1">
                                                                <option value="">
                                                                    <a href="">{{$get_current_page_number}}</a>
                                                                </option>
                                                            </select>
                                                            
                                                        Of 
                                                            {{$get_no_of_pages_left}}
                                                    </span>
                                                    <a class="btn btn-default" 
                                                        href="{{url('/users/page')}}/{{$get_next_page_number}}">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                    <?php
                                                        //var_dump(url()->current());
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
@endsection
