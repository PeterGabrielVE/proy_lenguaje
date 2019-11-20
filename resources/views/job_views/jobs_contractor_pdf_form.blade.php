<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
<style type="text/css">
table.table2 {
    max-width: 700px;
    margin: 0 auto;
}
table.table2 tr td {
    border: 1px solid #c7c7c72b;
    padding: 6px 0 6px 7px;
    width: 300px;
    font-size: 14px;
}
.thick-border{
    border-top: 2px solid #000 !important;
    min-height: 0px;
    height: 0px;
    margin: 5px 0;
}

table.table1{
    max-width: 650px;
}

h1{font-size: 22px;}
h2{font-size: 19px;}
h3{font-size: 18px; margin:3px 0px;}
.encounter-txt{display: inline;}
.small-box{height: 20px;width: 25px;min-height: 20px;min-width: 25px;max-height: 20px;max-width: 25px;border:1px solid #000000;display: inline;margin-right: 10px;margin-left: 3px;}
.bif-box{height: 140px;width: 600px;min-height: 140px;min-width: 600px;max-height: 140px;max-width: 600px;border:1px solid #000000;display: inline;margin-right: 10px;margin-left: 3px;}

</style>
<?php
$all_jobs = get_object_vars($jobs[0]);
?>
<page orientation="portrait" style="font-size: 14px">
    <table class="table1" backleft="auto" backright="auto" align="center">
        <tr>
            <td>
                <img src="http://qa.languagelinkllc.net//images/logo/logo.png" style="width: 200px;float: left;"> 
            </td>
            <td>
                <h1 style="text-indent: 100px;"> Assignment Form</h1>
            </td>
        </tr>
    </table>

    <div class="thick-border"></div>

    <h3 style="text-align: center;">Thank you for accepting this assignment. Please find your instructions below.</h3>

    <table class="table2" backleft="auto" backright="auto" align="center">
        <tr>
            <td>
                Assignment ID:
            </td>
            <td>
                <?php
                    echo $all_jobs['ID'];
                ?>
            </td>
        </tr>
       
        <tr>
            <td>
                Assignment Date and Time
            </td>
            <td>
                <?php
                    echo setDateValueInViewPretty($all_jobs['Jobs_Start_Time']);
                    
                    // echo $all_jobs['Jobs_Start_Time'];
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <!-- Interpreter ID / Name: -->
                Interpreter ID:
            </td>
            <td>

                <?php
                    // echo $all_jobs['Jobs_Contractor_ID'];

                    // echo getContractIDWithEmail($all_jobs['Jobs_Contractor_Email']) . " / " . str_replace("'", "", $all_jobs['Jobs_Contractor_First_Name']) . " " . str_replace("'", "", $all_jobs['Jobs_Contractor_Last_Name']);
                   
                   echo str_replace("'", "", $all_jobs['Jobs_Contractor_ID']) . " / " . str_replace("'", "", $all_jobs['Jobs_Contractor_First_Name']) . " " . str_replace("'", "", $all_jobs['Jobs_Contractor_Last_Name']);
                ?>
            </td>
        </tr>
    </table>

    <div class="thick-border"></div>

    <table class="table2" align="center">
        <tr>
            <td>
                Assignment Location:
            </td>
            <td>
                <?php
                    echo "<div style='line-height:20px;'>";
                        echo "<b>" . str_replace("'", "", $all_jobs['Jobs_Assignment_Location']) . "</b>";
                        echo "<br/>";
                        echo str_replace("'", "", $all_jobs['Jobs_Assignment_Street_Address_1']) . " " . str_replace("'", "", $all_jobs['Jobs_Assignment_Street_Address_2']) . ", " .str_replace("'", "", $all_jobs['Jobs_Assignment_City']) . " ". str_replace("'", "", $all_jobs['Jobs_Assignment_State']) . " " . str_replace("'", "", $all_jobs['Jobs_Assignment_Zip']);
                    echo "</div>";
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Department:
            </td>
            <td>
                <?php
                echo str_replace("'", "", $all_jobs['Jobs_Assignment_Department']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Contact Person:
            </td>
            <td>
                <?php
                echo str_replace("'", "", $all_jobs['Jobs_Assignment_Contact_Person']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Contact Phone Number:
            </td>
            <td>
                <?php
                    echo str_replace("'", "", $all_jobs['Jobs_Assignment_Phone_Number']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Providers Name:
            </td>
            <td>
                <?php
                    echo str_replace("'", "", $all_jobs['Jobs_Assignment_Provider_Name']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                LEP Name:
            </td>
            <td>
                <?php
                echo str_replace("'", "", $all_jobs['Jobs_LEP_Name']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                LEP Phone Number:
            </td>
            <td>
                <?php
                   echo str_replace("'", "", $all_jobs['Jobs_LEP_Phone']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Record Numbers (med/court):
            </td>
            <td>
                <?php
                    echo str_replace("'", "", $all_jobs['Jobs_Customers_PO_Number']);

                    // echo str_replace("'", "", $all_jobs['Job_Medical_Record_Number']) . " / " . str_replace("'", "", $all_jobs['Jobs_Court_Record_Number']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Special Instuctions:
            </td>
            <td>
               <?php
                echo str_replace("'", "", $all_jobs['Jobs_Special_Request']);
                ?>
            </td>
        </tr>
            
    </table>

    <div class="thick-border"></div>
        <h3 style="text-align: center; margin-top: -5px;">
            Important Instructions
        </h3>
    <div class="thick-border"></div>

    <b>Check In:</b> <br/>
    <div style="line-height: 25px;margin-top: 10px;">
        Please confirm the night before that you will be available for the assignment by calling (470)315-4949 ext 301 or sending an E-mail to: info@beacon-link.com. When you record your message or E-mail to check-in, don't forget to provide us with your name, assignment ID, location and assignment time. 
    </div>

    <br/><br/>

    <b>Encounter Form</b> <br/>
    <div style="line-height: 25px;margin-top: 10px;">
        Submit your completed encounter form within the following 24 hours of the assignment or sooner to: JobDone@beacon-link.com or mail to: Language Link LLC 685 River Overlook Dr. NW Lawrenceville, GA 30043 or Fax: 678.999.5383
    </div>

    <br/><br/>

    <b>Other Instructions:</b> <br/>
    <div style="line-height: 25px;margin-top: 10px;">
        Arrive to assignment job site at least 15 min before the time of the appointment, and check in with reception desk. Make sure you schedule follow up appointments for the LEP. If the LEP does not show up for the appointment, call the office at 470.315.4949 ext. 301 or Alfredo 678-315-9046. DO NOT leave the site until you are instructed and/or release by us. We will not be able to pay you if you leave the assignment site without being released by us first. If this is a parent/teacher conference (IEP), please call the parents at least one day before the appointment date to confirm parent assistance
    </div>

    <br/><br/>

</page>
<page orientation="portrait" style="font-size: 14px">
    <table class="table1" backleft="auto" backright="auto" align="center">
        <tr>
            <td>
                <img src="http://qa.languagelinkllc.net//images/logo/logo.png" style="width: 200px;float: left;"> 
            </td>
            <td>
                <h1 style="text-indent: 100px;">Interpreter Assignment Form</h1>
            </td>
        </tr>
    </table>

    <div class="thick-border"></div>

    <h3 style="text-align: center;">Thank you for accepting this assignment. Please find your instructions below.</h3>

    <table class="table2" backleft="auto" backright="auto" align="center">
        <tr>
            <td>
                Assignment ID:
            </td>
            <td>
                <?php
                    echo $all_jobs['ID'];
                ?>
            </td>
        </tr>
       
        <tr>
            <td>
                Assignment Date and Time
            </td>
            <td>
                <?php
                    echo setDateValueInViewPretty($all_jobs['Jobs_Start_Time']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Interpreter ID / Name:
            </td>
            <td>
                <?php
                    echo getContractIDWithEmail($all_jobs['Jobs_Contractor_Email']) . " / " . str_replace("'", "", $all_jobs['Jobs_Contractor_First_Name']) . " " . str_replace("'", "", $all_jobs['Jobs_Contractor_Last_Name']);
                    
                   // echo str_replace("'", "", $all_jobs['Jobs_Contractor_ID']) . " / " . str_replace("'", "", $all_jobs['Jobs_Contractor_First_Name']) . " " . str_replace("'", "", $all_jobs['Jobs_Contractor_Last_Name']);
                ?>
            </td>
        </tr>
    </table>

    <div class="thick-border"></div>

    <table class="table2" align="center">
        <tr>
            <td>
                Assignment Location:
            </td>
            <td>
                <?php
                // echo str_replace("'", "", $all_jobs['Jobs_Assignment_Location']);
                
                    echo "<div style='line-height:20px;'>";
                        echo "<b>" . str_replace("'", "", $all_jobs['Jobs_Assignment_Location']) . "</b>";
                        echo "<br/>";
                        echo str_replace("'", "", $all_jobs['Jobs_Assignment_Street_Address_1']) . " " . str_replace("'", "", $all_jobs['Jobs_Assignment_Street_Address_2']) . ", " .str_replace("'", "", $all_jobs['Jobs_Assignment_City']) . " ". str_replace("'", "", $all_jobs['Jobs_Assignment_State']) . " " . str_replace("'", "", $all_jobs['Jobs_Assignment_Zip']);
                    echo "</div>";
            
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Department:
            </td>
            <td>
                <?php
                echo str_replace("'", "", $all_jobs['Jobs_Assignment_Department']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Contact Person:
            </td>
            <td>
                <?php
                echo str_replace("'", "", $all_jobs['Jobs_Assignment_Contact_Person']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Contact Phone Number:
            </td>
            <td>
                <?php
                    echo str_replace("'", "", $all_jobs['Jobs_Assignment_Phone_Number']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Providers Name:
            </td>
            <td>
                <?php
                    echo str_replace("'", "", $all_jobs['Jobs_Assignment_Provider_Name']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                LEP Name:
            </td>
            <td>
                <?php
                echo str_replace("'", "", $all_jobs['Jobs_LEP_Name']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                LEP Phone Number:
            </td>
            <td>
                <?php
                   echo str_replace("'", "", $all_jobs['Jobs_LEP_Phone']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Record Numbers (med/court):
            </td>
            <td>
                <?php
                    echo str_replace("'", "", $all_jobs['Job_Medical_Record_Number']) . " / " . str_replace("'", "", $all_jobs['Jobs_Court_Record_Number']);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Additional Instuctions:
            </td>
            <td>
               <?php
                echo str_replace("'", "", $all_jobs['Jobs_Notes']);
                ?>
            </td>
        </tr>
            
    </table>

    <div class="thick-border"></div>
        <h3 style="text-align: center; margin-top: -5px;">
            Encounter Report:
        </h3>
    <div class="thick-border"></div>   

    Encounter/Service Type:
    
    <br/><br/>
    
        Medical: <div class="small-box"></div>  
        Social: <div class="small-box"></div>
        Clinic Coverage: <div class="small-box"></div>
        Immigration: <div class="small-box"></div>
        Disability Evaluation: <div class="small-box"></div>
        School: <div class="small-box"></div>

        <br/><br/>

        Legal: <div class="small-box"></div>
        Others: __________________

        <br/><br/><br/>

        Did the service start before the appointment time?
        
        <br/><br/>

        Yes: <div class="small-box"></div> No: <div class="small-box"></div> What Time:__________________ Provider's Signature:_____________________________

        <br/><br/><br/>

        Start/Finish working Times:
        <br/>
        Start Time:________________________ Finish Time:________________________

        <br/><br/>

        Total Encounter Time:______________ (rounded to the nearest 15 minutes)

        
        <br/><br/>

        Mileage/Parking Fees/Travel Time:
        <br/>
        Mileage:__________ (mileage not paid for interpreter being lost) Parking Fees:__________ (attach receipt)

        <br/><br/>

        Travel Time:__________ (you will be notified prior to your assignment if this field applies to you)

        <br/><br/>

        Comments/Encounter Summary: Write a brief summary of your session:

        <br/><br/>

        Name of Contact Person:_________________________ Signature of Contact Person:_____________________
    
    

</page>

