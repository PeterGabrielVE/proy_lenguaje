<div class="bulk_email_box" id="bulk_email_box_id">
    <button class="btn btn-warning" id="add-selected-emails-id">Add Selected Emails</button>
    <div class="response_msg_0"></div>
    <?php
    // echo Form::open(array('url'=>'contractors/sendbulkemail/', 'files'=>true, 'method'=>'GET', 'id'=>'bulk_email_contractor_form_id'));
    echo Form::open(array('url'=>'contractors/sendbulkemail/', 'files'=>true, 'method'=>'PUT', 'id'=>'bulk_email_contractor_form_id'));
    ?> 
        <input type="hidden" id="bulk_email_contractor_form_id_url" value="{{url('/contractors/sendbulkemail')}}">
        <label for="bulk_email_emails_id">Emails:</label>
        <textarea name="bulk_email_emails" id="bulk_email_emails_id" class="form-control bulk_email_emails_cl"></textarea>
        <br/>
        <label for="bulk_email_textarea_id">Message:</label>
        <textarea name="bulk_email_textarea" id="bulk_email_textarea_id" class="form-control bulk_email_textarea_cl"></textarea>
        <br/>
        <input type="submit" name="bulk_email_submit" class="btn btn-success btn-send-email" value="Send Email">
    </form>
</div>
<button class="btn btn-success" id="send-bulk-email-id-show">Click Here To Show Bulk Email Form</button>
<button class="btn btn-danger" id="send-bulk-email-id-hide">Click Here To Hide Bulk Email Form</button>