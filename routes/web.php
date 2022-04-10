<?php

use App\Http\Controllers\AccessProfileController;
use App\Http\Controllers\BoardMessageController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\ContractTemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GdprController;
use App\Http\Controllers\MirrorController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGdprController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ProposalRegistrationController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\ProspectRegistrationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitExcelController;
use App\Http\Controllers\UnitGroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/lang/{locale}', [LocalizationController::class, 'index']);

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::post('/register', [WelcomeController::class, 'register'])->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::resource('access_profiles', AccessProfileController::class)
    ->except('show')
    ->middleware(['auth', 'authorize:access_profiles']);

Route::resource('user_profile', UserProfileController::class)
    ->only(['index', 'update'])
    ->middleware(['auth']);

Route::resource('users', UserController::class)
    ->except(['show'])
    ->middleware(['auth', 'authorize:users']);

Route::resource('partners', PartnerController::class)
    ->except(['show'])
    ->middleware(['auth', 'authorize:partners']);
Route::post('/partners/{partner}/approve', [PartnerController::class, 'approvePartner'])
    ->name('partners.approve')
    ->middleware(['auth', 'authorize:partners']);

Route::resource('partners.brokers', BrokerController::class)
    ->except(['show'])
    ->middleware(['auth', 'authorize:brokers']);

Route::resource('products', ProductController::class)
    ->except(['show'])
    ->middleware(['auth', 'authorize:products']);

Route::resource('products.unit_groups', UnitGroupController::class)
    ->except(['show'])
    ->middleware(['auth', 'authorize:products']);

Route::resource('products.units', UnitController::class)
    ->except(['show'])
    ->middleware(['auth', 'authorize:products']);

Route::get('products/{product}/units_excel', [UnitExcelController::class, 'index'])
    ->name('products.units.excel')
    ->middleware(['auth', 'authorize:products']);

Route::get('products/{product}/units_excel/download', [UnitExcelController::class, 'download'])
    ->name('products.units.excel.download')
    ->middleware(['auth', 'authorize:products']);

Route::put('products/{product}/units_excel/upload', [UnitExcelController::class, 'upload'])
    ->name('products.units.excel.upload')
    ->middleware(['auth', 'authorize:products']);

Route::get('products/{product}/units_excel/cancel', [UnitExcelController::class, 'cancel'])
    ->name('products.units.excel.cancel')
    ->middleware(['auth', 'authorize:products']);

Route::get('products/{product}/units_excel/confirm', [UnitExcelController::class, 'confirm'])
    ->name('products.units.excel.confirm')
    ->middleware(['auth', 'authorize:products']);

Route::get('/mirrors', [MirrorController::class, 'index'])
    ->name('mirrors.index')
    ->middleware(['auth', 'authorize:mirrors']);

Route::get('/gdpr', [GdprController::class, 'index'])->name('gdpr.index')->middleware(['auth', 'authorize:gdpr']);
Route::post('/gdpr', [GdprController::class, 'store'])->name('gdpr.store')->middleware(['auth', 'authorize:gdpr']);

Route::get('/products/{product}/gdpr', [ProductGdprController::class, 'index'])->name('products.gdpr.index')->middleware(['auth', 'authorize:gdpr']);
Route::post('/products/{product}/gdpr', [ProductGdprController::class, 'store'])->name('products.gdpr.store')->middleware(['auth', 'authorize:gdpr']);

Route::resource('contract_templates', ContractTemplateController::class)
    ->except(['show'])
    ->middleware(['auth', 'authorize:products']);

Route::resource('board_messages', BoardMessageController::class)
    ->except(['show'])
    ->middleware(['auth', 'authorize:board_messages']);

Route::get('/prospects', [ProspectController::class, 'index'])->name('prospects.index')->middleware(['auth', 'authorize:prospects']);
Route::get('/prospects/{prospect}/data', [ProspectController::class, 'data'])->name('prospects.data')->middleware(['auth', 'authorize:prospects']);
Route::post('/prospects/{prospect}/data', [ProspectController::class, 'updateData'])->name('prospects.data.update')->middleware(['auth', 'authorize:prospects']);
Route::get('/prospects/{prospect}/data/document/{prospect_document}', [ProspectController::class, 'getDocument'])->name('prospects.data.get-document')->middleware(['auth', 'authorize:prospects']);
Route::get('/prospects/{prospect}/data/documents-zip', [ProspectController::class, 'getZipDocuments'])->name('prospects.data.get-zip-documents')->middleware(['auth', 'authorize:prospects']);

Route::post('/prospects/{prospect}/approve', [ProspectController::class, 'approve'])->name('prospects.approve')->middleware(['auth', 'authorize:prospects_status']);
Route::post('/prospects/{prospect}/open', [ProspectController::class, 'open'])->name('prospects.open')->middleware(['auth', 'authorize:prospects_status']);
Route::post('/prospects/{prospect}/reject', [ProspectController::class, 'reject'])->name('prospects.reject')->middleware(['auth', 'authorize:prospects_status']);
Route::delete('/prospects/{prospect}', [ProspectController::class, 'destroy'])->name('prospects.destroy')->middleware(['auth', 'authorize:prospects_delete']);

Route::middleware([])->group(function () {
    Route::get('/public/prospects/{product}/registration', [ProspectRegistrationController::class, 'index'])->name('prospects.registration.index');
    Route::post('/public/prospects/{product}/registration', [ProspectRegistrationController::class, 'checkBroker'])->name('prospects.registration.check-broker');
    Route::get('/public/prospects/{product}/customer-data/{prospect}', [ProspectRegistrationController::class, 'customerDataIndex'])->name('prospects.registration.customer-data');
    Route::post('/public/prospects/{product}/customer-data/{prospect}', [ProspectRegistrationController::class, 'customerDataStore'])->name('prospects.registration.customer-data.store');
    Route::get('/public/prospects/{product}/documents/{prospect}', [ProspectRegistrationController::class, 'documentsIndex'])->name('prospects.registration.documents');
    Route::post('/public/prospects/{product}/documents/{prospect}', [ProspectRegistrationController::class, 'documentsStore'])->name('prospects.registration.documents.store');
    Route::get('/public/prospects/{product}/co-participant/{prospect}', [ProspectRegistrationController::class, 'coParticipantIndex'])->name('prospects.registration.co-participant');
    Route::post('/public/prospects/{product}/co-participant/{prospect}', [ProspectRegistrationController::class, 'coParticipantStore'])->name('prospects.registration.co-participant.store');
    Route::get('/public/prospects/{product}/co-participant/{prospect}/documents', [ProspectRegistrationController::class, 'coparticipantDocumentsIndex'])->name('prospects.registration.co-participant.documents');
    Route::post('/public/prospects/{product}/co-participant/{prospect}/documents', [ProspectRegistrationController::class, 'coparticipantDocumentsStore'])->name('prospects.registration.co-participant.documents.store');
    Route::get('/public/prospects/{product}/review/{prospect}', [ProspectRegistrationController::class, 'reviewIndex'])->name('prospects.registration.review');
    Route::get('/public/prospects/{product}/terms/{prospect}', [ProspectRegistrationController::class, 'termsIndex'])->name('prospects.registration.terms');
    Route::post('/public/prospects/{product}/finish/{prospect}', [ProspectRegistrationController::class, 'finish'])->name('prospects.registration.finish');

    Route::get('/public/prospects/data-documents', [ProspectController::class, 'documentsIndex'])->name('prospects.data.documents');
    Route::post('/public/prospects/data-documents', [ProspectController::class, 'documentsStore'])->name('prospects.data.documents.store');
    Route::get('/docs', [ProspectController::class, 'docsIndex'])->name('prospects.data.documents.code');
});

Route::middleware([])->group(function () {
    Route::get('/public/proposals/{product}/registration', [ProposalRegistrationController::class, 'index'])->name('proposals.registration.index');
    Route::post('/public/proposals/{product}/check_code', [ProposalRegistrationController::class, 'checkCode'])->name('proposals.registration.check-code');
    Route::get('/public/proposals/{proposal}/fill', [ProposalRegistrationController::class, 'fill_proposal'])->name('proposals.registration.fill_proposal');
    Route::post('/public/proposals/{proposal}/fill', [ProposalRegistrationController::class, 'store_fill_proposal'])->name('proposals.registration.fill_proposal.store');
    Route::get('/public/proposals/{product}/{code}', [ProposalRegistrationController::class, 'confirm'])->name('proposals.registration.confirm');
    Route::get('/public/proposals/{product}/{code}/mirror', [ProposalRegistrationController::class, 'mirror'])->name('proposals.registration.mirror');
    Route::post('/public/proposals/{product}/{code}/book/{unit}', [ProposalRegistrationController::class, 'book'])->name('proposals.registration.book');
});

Route::get('/codes', [CodeController::class, 'index'])->name('codes.index')->middleware(['auth', 'authorize:codes']);
Route::put('/codes/{code}', [CodeController::class, 'update'])->name('codes.update')->middleware(['auth', 'authorize:codes']);

Route::get('/proposals', [ProposalController::class, 'index'])->name('proposals.index')->middleware(['auth', 'authorize:proposals']);
Route::get('/proposals/{proposal}/details', [ProposalController::class, 'show'])->name('proposals.show')->middleware(['auth', 'authorize:proposals']);

Route::post('/proposals/{proposal}/approve', [ProposalController::class, 'approve'])->name('proposals.approve')->middleware(['auth', 'authorize:proposals_status']);
Route::post('/proposals/{proposal}/open', [ProposalController::class, 'open'])->name('proposals.open')->middleware(['auth', 'authorize:proposals_status']);
Route::post('/proposals/{proposal}/reject', [ProposalController::class, 'reject'])->name('proposals.reject')->middleware(['auth', 'authorize:proposals_status']);
Route::delete('/proposals/{proposal}', [ProposalController::class, 'destroy'])->name('proposals.destroy')->middleware(['auth', 'authorize:proposals_delete']);

require __DIR__ . '/auth.php';
