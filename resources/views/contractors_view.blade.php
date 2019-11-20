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
                            <h1 style="text-align: center;">Contractors</h1>
                        </div>
                        
                        @foreach ( $get_contractors_view as $contractors_single )
                            {{ $contractors_single->Con_First_Name }}
                            {{ $contractors_single->Con_Last_Name }}
                        @endforeach
                    </div>
                </div>
                <!-- Content Wrapper END -->

               


@endsection
