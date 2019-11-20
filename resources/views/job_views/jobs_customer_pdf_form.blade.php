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
    min-height: 5px;
    height: 5px;
    margin: 2px 0;
}

table.table1{
    max-width: 650px;
}

h1{font-size: 22px;}
h2{font-size: 19px;}
h3{font-size: 18px;}
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
                <h1 style="text-indent: 100px;">Confirmation Form</h1>
            </td>
        </tr>
    </table>
    <br/><br/>

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
                   // echo str_replace("'", "", $all_jobs['Jobs_Contractor_ID']) . " / " . str_replace("'", "", $all_jobs['Jobs_Contractor_First_Name']) . " " . str_replace("'", "", $all_jobs['Jobs_Contractor_Last_Name']);

                   // echo getContractIDWithEmail($all_jobs['Jobs_Contractor_Email']) . " / " . str_replace("'", "", $all_jobs['Jobs_Contractor_First_Name']) . " " . str_replace("'", "", $all_jobs['Jobs_Contractor_Last_Name']);

                    echo $all_jobs['Jobs_Contractor_ID'];
                    // echo getContractIDWithEmail($all_jobs['Jobs_Contractor_Email']);

                ?>
            </td>
        </tr>
    </table>

    <br/><br/>
    <div class="thick-border"></div>

    <table class="table2" align="center">
        <tr>
            <td>
                Assignment Location:
            </td>
            <td>
                <?php
                    // echo str_replace("'", "", $all_jobs['Jobs_Assignment_Location']) . "<br/>" . str_replace("'", "", $all_jobs['Jobs_Assignment_Street_Address_1']) . " " . str_replace("'", "", $all_jobs['Jobs_Assignment_Street_Address_2'])." <br/>" . 
                    // str_replace("'", "", $all_jobs['Jobs_Assignment_City']) . " " . str_replace("'", "", $all_jobs['Jobs_Assignment_State']) . " " . str_replace("'", "", $all_jobs['Jobs_Assignment_Zip']);
                
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
                Record Numbers (Medical/Court):
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
                Additional Instuctions:
            </td>
            <td>
               <?php
                echo str_replace("'", "", $all_jobs['Jobs_Notes']);
                ?>
            </td>
        </tr>
            
    </table>

    <br/><br/>
    <div class="thick-border"></div>
        <h3 style="text-align: center;">
            Important Instructions
        </h3>
    <div class="thick-border"></div>

    <div style="text-align: center;">
        The above request has been confirmed and an interpreter assigned.
        <br/><br/>
        If you have any questions please e-mail us at info@beacon-link.com or call 470-315-4949
    </div>
    
</page>

