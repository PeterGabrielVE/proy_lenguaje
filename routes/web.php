<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    //return view('welcome');
    return redirect('home');
});
Auth::routes();
Route::get('/home-test', 'HomeController@home_test');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/routes', 'HomeController@admin')->middleware('admin');

Route::post('logoutuser', 'HomeController@logoutUser');


//////////////////// Start All Job Routes ////////////////////
Route::get('jobs/start_date/{start_date}', 'JobsController@getJobWithStartDate')->where('start_date', '[0-9A-Za-z]+' );
Route::get('jobs/end_date/{end_date}', 'JobsController@getJobWithEndDate')->where('end_date', '[A-Za-z]+' );
Route::get('jobs/reqst_date/{request_date}', 'JobsController@getJobWithRequestDate')->where('request', '[A-Za-z]+' );

Route::get('jobs/filter_all', 'JobsController@getJobWithFilterAll');
Route::get('jobs/filter_start_end_date', 'JobsController@getJobStartEndDate');
Route::get('jobs/filter_req_date', ' JobsController@getJobRequestDate');
Route::get('jobs/search_by_po_no', 'JobsController@getJobSearchByPONumber');
Route::get('jobs/s', 'JobsController@getJobsMainSearch');
Route::get('jobs/searchJobByCity', 'JobsController@getJobsSearchByCity');
Route::get('jobs/{id}', 'JobsController@getJobWithID')->where('id', '[0-9]+' );
Route::get('jobs/f/{f_name}/l/{l_name}', 'JobsController@getContractorJobs')->where('id', '[0-9]+' );
Route::get('jobs/f/{f_name}/l/{l_name}/pg/{pageno}', 'JobsController@getContractorJobs')->where('id', '[0-9]+' );

Route::get('jobs/showWithID/{id}', 'JobsController@getJobWithID');

Route::get('jobs', 'JobsController@jobListWithPageNo')->name('all_jobs_route');;

Route::get('jobs/{id}', 'JobsController@getJobWithID')->name('single_job_route');;

Route::get('jobs/page/{pageno}', 'JobsController@jobListWithPageNo');
Route::get('jobs/edit/{id}', 'JobsController@getJobToEditWithID');
Route::put('jobs/edit/{id}', 'JobsController@editJobWithID');
Route::get('jobs/create/new', 'JobsController@getCreateJobView');
//Route::get('jobs/create', 'JobsController@getJobWithFilterAll');

Route::put('jobs/create', 'JobsController@createNewJobEntry');

Route::put('jobs/delete/{id}', 'JobsController@deleteJob');

Route::get('jobs/pdf/', 'JobsController@getInvoicePDF');
// Route::get('jobs/gencustomer/{id}', 'JobsController@generateCustomerForm');


Route::get('jobs/gencontractorform/{id}', 'JobsController@generateContractorForm');
Route::get('jobs/gencustomer/{id}', 'JobsController@generateCustomerForm');

Route::get('jobs/emailcontractor/{id}', 'JobsController@emailContractorAboutJob');
Route::get('jobs/emailcontractormanual/{id}/{email}/{message}', 'JobsController@emailContractorAboutJobManual');
Route::get('jobs/emailcustomermanual/{id}/{email}/{message}', 'JobsController@emailCustomerAboutJobManual');
Route::get('jobs/emailcustomer/{id}', 'JobsController@emailCustomerAboutJob');

Route::get('jobs/getservicesforcustomer/{customer_name}', 'JobsController@getAllServicesForCustomer');
Route::get('jobs/getmileageforcustomer/{customer_name}', 'JobsController@getAllMileageForCustomer');
// Route::get('jobs/getmileageforcustomer/{customer_name}', 'JobsController@getAllMileageServicesForCustomer');
Route::get('jobs/customerdetails/{customer_name}', 'JobsController@getCustomerDetails');
Route::get('jobs/srvrates/s/{service_name}/c/{company_name}', 'JobsController@getServiceRates');
Route::get('jobs/mileagerates/s/{service_name}/c/{company_name}', 'JobsController@getServiceRates');
Route::get('jobs/languages/get', 'JobsController@getLanguagesForView');

Route::get('jobs/getsinglecontractordetailswithid/{id}', 'JobsController@getContractorDetailsWithID');

Route::get('jobs/filter_date_range', 'JobsController@getDateRange');

Route::post('jobs/edit/upload','JobsController@upload');
Route::post('jobs/create/upload','JobsController@upload');
Route::post('jobs/edit/store','JobsController@storeUpload');



//////////////////// End All Job Routes ////////////////////

// ------------------------------------------------------------------------ //

//////////////////// Start All contractors Routes ////////////////////
Route::get('contractors/{id}', 'ContractorsController@getContractorWithID')->where('id', '[0-9]+' );
Route::get('contractors/showWithID/', 'ContractorsController@getContractorWithID2');
Route::get('contractors/s', 'ContractorsController@getContractorsMainSearch');
Route::get('contractors/searchbycity', 'ContractorsController@getContractorsCitySearch');
Route::get('contractors/searchbylanguage', 'ContractorsController@getContractorsLanguageSearch');
Route::get('contractors', 'ContractorsController@contractorsListWithPageNo')->name('all_contractors_route');
Route::get('contractors/filter_all', 'ContractorsController@getContractorsWithFilterAll');
Route::get('contractors/page/{pageno}', 'ContractorsController@contractorsListWithPageNo');
Route::get('contractors/edit/{id}', 'ContractorsController@getContractorToEditWithID');
Route::put('contractors/edit/{id}', 'ContractorsController@editContractorWithID');
Route::get('contractors/create', 'ContractorsController@getCreateContractorsView');
Route::put('contractors/create', 'ContractorsController@createContractor');
Route::post('contractors/title', 'ContractorsController@titleContractor');
Route::post('contractors/edit/title', 'ContractorsController@titleContractor');
Route::put('contractors/delete/{id}', 'ContractorsController@deleteContractor');
Route::get('contractors/showjobsbycontractor/f/{first_name}/l/{last_name}', 'ContractorsController@showJobsByContractorMethod');
// Route::get('contractors/sendbulkemail/{emails}/{message}', redirectIfNotLoggedIn());
// Route::get('contractors/sendbulkemail', 'ContractorsController@sendBulkEmailToContractors');
Route::put('contractors/sendbulkemail', 'ContractorsController@sendBulkEmailToContractors');
Route::post('contractors/create/upload','ContractorsController@upload');
Route::post('contractors/edit/upload','ContractorsController@upload');

//////////////////// End All contractors Routes ////////////////////


//////////////////// Start All services Routes ////////////////////
Route::get('services/{id}', 'ServicesController@getServicesWithID')->where('id', '[0-9]+' );
Route::get('services/showWithID/', 'ServicesController@getServicesWithID2')->where('id', '[0-9]+' );
Route::get('services/s/', 'ServicesController@getServicesMainSearch');
Route::get('services', 'ServicesController@servicesListWithPageNo');
Route::get('services/page/{pageno}', 'ServicesController@servicesListWithPageNo');
Route::get('services/edit/{id}', 'ServicesController@getServicesToEditWithID');
Route::put('services/edit/{id}', 'ServicesController@editServicesWithID');
Route::get('services/create', 'ServicesController@getCreateservicesView');
Route::put('services/create', 'ServicesController@createServices');
Route::put('services/delete/{id}', 'ServicesController@deleteServices');
//////////////////// End All services Routes ////////////////////


//////////////////// Start All invoices Routes ////////////////////
Route::get('invoices/{id}', 'InvoicesController@getInvoicesWithID')->where('id', '[0-9]+' );
Route::get('invoices/showWithID/', 'InvoicesController@getInvoicesWithID2')->where('id', '[0-9]+' );
Route::get('invoices/s/', 'InvoicesController@getInvoicesMainSearch');
Route::get('invoices', 'InvoicesController@invoicesListWithPageNo');
Route::get('invoices/page/{pageno}', 'InvoicesController@invoicesListWithPageNo');
Route::get('invoices/edit/{id}', 'InvoicesController@getInvoicesToEditWithID');
Route::put('invoices/edit/{id}', 'InvoicesController@editInvoicesWithID');
Route::get('invoices/create', 'InvoicesController@getCreateinvoicesView');
Route::put('invoices/create', 'InvoicesController@createInvoices');
Route::put('invoices/delete/{id}', 'InvoicesController@deleteInvoices');

Route::get('invoices/pdf/', 'InvoicesController@getInvoicePDF');
Route::get('invoices/generatepdf/', 'InvoicesController@generateInvoicePDF');
Route::get('invoices/exportinvoicetoexcel/{ids}', 'InvoicesController@exportInvoicesExcel');


//////////////////// End All invoices Routes ////////////////////


//////////////////// Start All Contractor Billing ////////////////////
Route::get('contractor-billings/{id}', 'ContractorBillingController@getContractorBillingsWithID')->where('id', '[0-9]+' );
Route::get('contractor-billings/showWithID/', 'ContractorBillingController@getContractorBillingsWithID2')->where('id', '[0-9]+' );
Route::get('contractor-billings', 'ContractorBillingController@contractorBillingsListWithPageNo');
Route::get('contractor-billings/page/{pageno}', 'ContractorBillingController@contractorBillingsListWithPageNo');
Route::get('contractor-billings/edit/{id}', 'ContractorBillingController@getContractorBillingToEditWithID');
Route::put('contractor-billings/edit/{id}', 'ContractorBillingController@editContractorBillingsWithID');
Route::get('contractor-billings/create', 'ContractorBillingController@getCreateContractorBillingView');
Route::put('contractor-billings/create', 'ContractorBillingController@createContractorBilling');
Route::put('contractor-billings/delete/{id}', 'ContractorBillingController@deleteContractorBilling');
//////////////////// Start All Contractor Billing ////////////////////


//////////////////// Start All customers Routes ////////////////////
Route::get('customers/{id}', 'CustomersController@getCustomersWithID')->where('id', '[0-9]+' );
Route::get('customers/showWithID/', 'CustomersController@getCustomersWithID2')->where('id', '[0-9]+' );
Route::get('customers', 'CustomersController@customersListWithPageNo');
Route::get('customers/page/{pageno}', 'CustomersController@customersListWithPageNo');
Route::get('customers/edit/{id}', 'CustomersController@getCustomersToEditWithID');
Route::put('customers/edit/{id}', 'CustomersController@editCustomersWithID');
Route::get('customers/create', 'CustomersController@getCreatecustomersView');
Route::put('customers/create', 'CustomersController@createCustomers');
Route::put('customers/delete/{id}', 'CustomersController@deleteCustomers');
Route::get('customers/s/', 'CustomersController@getCustomersMainSearch');
//////////////////// End All customers Routes ////////////////////


//////////////////// Start All users Routes ////////////////////
Route::get('users/{id}', 'UsersController@getUsersWithID')->where('id', '[0-9]+' );
Route::get('users/showWithID/', 'UsersController@getUsersWithID2')->where('id', '[0-9]+' );
Route::get('users', 'UsersController@usersListWithPageNo');
Route::get('users/page/{pageno}', 'UsersController@usersListWithPageNo');
Route::get('users/edit/{id}', 'UsersController@getUsersToEditWithID');
Route::put('users/edit/{id}', 'UsersController@editUsersWithID');
Route::get('users/create', 'UsersController@getCreateusersView');
Route::put('users/create', 'UsersController@createUsers');
Route::put('users/delete/{id}', 'UsersController@deleteUsers');
//////////////////// End All users Routes ////////////////////


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');