<?php

use App\Http\Controllers\Admin\ContributionsController;
use App\Models\Contribution;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/admin/members', App\Http\Controllers\Admin\MembersController::class);
Route::resource('/admin/company', App\Http\Controllers\Admin\CompaniesController::class);

Route::get('/user', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user');

Route::resource('/admin/loans', App\Http\Controllers\Admin\LoansController::class);
Route::resource('/admin/loans_pay', App\Http\Controllers\Admin\LoansPayController::class);
Route::get('/findMembers', [App\Http\Controllers\Admin\LoansController::class, 'getMember']);
Route::get('/findCustomers', [App\Http\Controllers\Admin\CustomerController::class, 'getCustomer']);
Route::get('/getAccounts', [App\Http\Controllers\Admin\AccountsController::class, 'getAccounts']);
Route::get('/getAccGroup', [App\Http\Controllers\Admin\AccountsController::class, 'getAccGroup']);
Route::get('/getAccType', [App\Http\Controllers\Admin\AccountsController::class, 'getAccType']);
Route::get('/getAccTransType', [App\Http\Controllers\Admin\AccountsController::class, 'getAccTransType']);
Route::get('/getMonth', [App\Http\Controllers\Admin\Coop_processController::class, 'getMonth']);
Route::get('/getPayrollMonth1', [App\Http\Controllers\Reports\ReportsController::class, 'getPayrollMonth1']);
Route::get('/getProduct', [App\Http\Controllers\Admin\ProductsController::class, 'getProduct']);
Route::get('/admin/commSearch', [App\Http\Controllers\Admin\CommodityController::class, 'CommSearch'])->name('CommSearch');
Route::resource('/admin/branch', App\Http\Controllers\Admin\branch_locationsController::class);
Route::resource('/admin/orders', App\Http\Controllers\Admin\OrdersController::class);
Route::resource('/admin/withdrawers', App\Http\Controllers\Admin\withdrawersContoller::class);
Route::resource('/admin/deposit', App\Http\Controllers\Admin\depositsController::class);
Route::resource('/admin/receipt', App\Http\Controllers\Admin\receiptsController::class);
Route::resource('/admin/payments', App\Http\Controllers\Admin\paymentsController::class);
Route::resource('/admin/accounts', App\Http\Controllers\Admin\AccountsController::class);
Route::resource('/admin/products', App\Http\Controllers\Admin\ProductsController::class);
Route::resource('/admin/prod_category', App\Http\Controllers\Admin\Product_categoryController::class);
Route::resource('/admin/users', App\Http\Controllers\Admin\UsersController::class);
Route::resource('/admin/roles', App\Http\Controllers\Admin\RolesController::class);
Route::resource('/admin/permissions', App\Http\Controllers\Admin\permissionsController::class);
Route::resource('/admin/title', App\Http\Controllers\Admin\TitleControler::class);
Route::resource('/admin/coop_process', App\Http\Controllers\Admin\Coop_processController::class);
Route::resource('/admin/customer', App\Http\Controllers\Admin\CustomerController::class);
Route::resource('/admin/loanapprovalbin', App\Http\Controllers\Admin\LoansApprovalsController::class);
Route::resource('/admin/withdrawerapproval', App\Http\Controllers\Admin\WithdrawerApprovalController::class);
Route::resource('/admin/member_terminate', App\Http\Controllers\Admin\members_terminateController::class);
Route::resource('/admin/contributions', App\Http\Controllers\Admin\ContributionsController::class);
Route::resource('/admin/comm', App\Http\Controllers\Admin\CommodityController::class);
Route::resource('/admin/commperiod', App\Http\Controllers\Admin\CommPeriodController::class);

Route::resource('/admin/approval_stages', App\Http\Controllers\Admin\ApprovalStageController::class);
Route::resource('/admin/process_module', App\Http\Controllers\Admin\ProcessModuleController::class);
Route::resource('/admin/approval_flow', App\Http\Controllers\Admin\ApprovalFlowController::class);
Route::resource('/admin/approval_master', App\Http\Controllers\Admin\ApprovalMasterController::class);

// normal users route
Route::resource('/user/members', App\Http\Controllers\User\MembersController::class, ['as'=>'user']);
Route::resource('/user/loans', App\Http\Controllers\User\LoansController::class, ['as'=>'user']);
Route::resource('/user/comm', App\Http\Controllers\User\CommodityController::class, ['as'=>'user']);
Route::resource('/user/cart', App\Http\Controllers\User\CartController::class, ['as'=>'user']);
Route::get('/user/loantrack/{id}', [App\Http\Controllers\user\LoansController::class, 'track'])->name('user.loantrack');
Route::resource('/user/withdrawers', App\Http\Controllers\User\WithdrawerController::class, ['as'=>'user']);
Route::get('/user/withdrawertrack/{id}', [App\Http\Controllers\user\WithdrawerController::class, 'track'])->name('user.withdrawertrack');
Route::get('/user/statement_acc_search', [App\Http\Controllers\user\StatementAccController::class, 'StatementAccSearch'])->name('statement_acc_search');
Route::get('/user/statement_acc', [App\Http\Controllers\user\StatementAccController::class, 'StatementAcc'])->name('statement_acc');
Route::get('/user/statement_search_all', [App\Http\Controllers\user\StatementAccController::class, 'StatementAccSearchAll'])->name('statement_search_all');
Route::get('/user/search', [App\Http\Controllers\user\CommodityController::class, 'search'])->name('search');

//Route::get('/users1', [App\Http\Controllers\UsersController::class,'index'])->name('index');
Route::get('/users-list', [App\Http\Controllers\UsersController::class, 'usersList'])->name('usersList');

// Reports
Route::get('/members_search', [App\Http\Controllers\Reports\ReportsController::class, 'MembersSearch'])->name('members_search');
Route::get('/members_report', [App\Http\Controllers\Reports\ReportsController::class, 'MembersReport'])->name('members_report');
Route::get('/loans_search', [App\Http\Controllers\Reports\ReportsController::class, 'LoansSearch'])->name('loans_search');
Route::get('/loans_report', [App\Http\Controllers\Reports\ReportsController::class, 'LoansReport'])->name('loans_report');
Route::get('/loans_schedule_search', [App\Http\Controllers\Reports\ReportsController::class, 'LoansScheduleSearch'])->name('loans_schedule_search');
Route::get('/loans_schedule_report', [App\Http\Controllers\Reports\ReportsController::class, 'LoansScheduleReport'])->name('loans_schedule_report');
Route::get('/deposit_search', [App\Http\Controllers\Reports\ReportsController::class, 'DepositSearch'])->name('deposit_search');
Route::get('/deposit_report', [App\Http\Controllers\Reports\ReportsController::class, 'DepositReport'])->name('deposit_report');
Route::get('/withdraws_search', [App\Http\Controllers\Reports\ReportsController::class, 'withdrawerSearch'])->name('withdraws_search');
Route::get('/withdrawer_report', [App\Http\Controllers\Reports\ReportsController::class, 'withdrawerReport'])->name('withdrawer_report');
Route::get('/margin_search', [App\Http\Controllers\Reports\ReportsController::class, 'MarginSearch'])->name('margin_search');
Route::get('/margin_report', [App\Http\Controllers\Reports\ReportsController::class, 'MarginReport'])->name('margin_report');
Route::get('/receipts_search', [App\Http\Controllers\Reports\ReportsController::class, 'ReceiptsSearch'])->name('receipts_search');
Route::get('/receipts_report', [App\Http\Controllers\Reports\ReportsController::class, 'ReceiptsReport'])->name('receipts_report');
Route::get('/deductions_report', [App\Http\Controllers\Reports\ReportsController::class, 'DeductionsReport'])->name('deductions_report');
Route::get('/deductions_search', [App\Http\Controllers\Reports\ReportsController::class, 'DeductionSearch'])->name('deductions_search');

Route::get('search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('autocomplete', [App\Http\Controllers\SearchController::class, 'autocomplete'])->name('autocomplete');

Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'index']);
Route::post('change-password', [App\Http\Controllers\ChangePasswordController::class, 'store'])->name('change.password');

Route::get('admin/invoice/create',[App\Http\Controllers\InvoiceController::class,'create'])->name('create');
Route::get('admin/api/product', [App\Http\Controllers\InvoiceController::class, 'getAutocompleteData'])->name('product');

Route::get('file-import-export', [ContributionsController::class, 'fileImportExport'])->name('file-import-export');
Route::post('file-import', [ContributionsController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [ContributionsController::class, 'fileExport'])->name('file-export');

Route::get('fetch/record/{id}', 'Controller@fetchRecord');



Route::get('/admin', function () {
    return view('layouts/admin');
})->middleware('auth');



Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details));

    dd("Email is Sent.");
});
