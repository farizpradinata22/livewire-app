<?php

use Illuminate\Support\Facades\Route;

// Homepage
use App\Livewire\Home\Index as HomeIndex;
use App\Livewire\Erm\Dashboard as ErmDashboard;
use App\Livewire\Erm\RiskRegister\Form as RiskRegisterForm;
use App\Livewire\Rmu\Settings as RmuSettings;
use App\Livewire\Erm\RiskRegister\Create;
use App\Livewire\Erm\RiskRegister\FormRR;

// Placeholder
use App\Livewire\Page\UnderConstruction;

// Home
Route::get('/', HomeIndex::class);

// ERM Dashboard
Route::get('/erm', ErmDashboard::class);

// Lainnya ke Under Construction
Route::get('/dashboard', UnderConstruction::class)->defaults('page', 'Dashboard');
Route::get('/framework', UnderConstruction::class)->defaults('page', 'Framework');
Route::get('/repository', UnderConstruction::class)->defaults('page', 'Repository');
Route::get('/kri', UnderConstruction::class)->defaults('page', 'Key Risk Indicator');
Route::get('/strategic-planning', UnderConstruction::class)->defaults('page', 'Strategic Planning');
Route::get('/loss-event-database', UnderConstruction::class)->defaults('page', 'Loss Event Database');
Route::get('/reports', UnderConstruction::class)->defaults('page', 'Reports');


// ERM Children
Route::prefix('erm')->group(function () {
    // Risk Register
    Route::get('/risk-register', RiskRegisterForm::class);
    Route::get('/erm/risk-register/create', Create::class)->name('erm.risk.create');

    // Risk Register Unit
    Route::get('/risk-register-unit', UnderConstruction::class)->name('erm.risk-register-unit');

    // Monitoring
    Route::get('/monitoring/mitigation', UnderConstruction::class)->name('erm.monitoring.mitigation');
    Route::get('/monitoring/actual', UnderConstruction::class)->name('erm.monitoring.actual');

    // RMU
    Route::get('/rmu/review-register', UnderConstruction::class)->name('erm.rmu.review-register');
    Route::get('/rmu/review-register-unit', UnderConstruction::class)->name('erm.rmu.review-register-unit');
    Route::get('/settings', \App\Livewire\Rmu\Settings::class)->name('erm.settings');

    // 3 URL berbeda, 1 komponen yang sama (layout ditentukan oleh NAMA ROUTE)
    Route::get('/risk-register/form/accordion', \App\Livewire\Erm\RiskRegister\FormRR::class)->name('rr.form.accordion');
    Route::get('/risk-register/form/wizard',    \App\Livewire\Erm\RiskRegister\FormRR::class)->name('rr.form.wizard');
    Route::get('/risk-register/form/tabs',      \App\Livewire\Erm\RiskRegister\FormRR::class)->name('rr.form.tabs');
 
});
