<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

use App\Http\Controllers\AppointmentController; // Make sure to import the AppointmentController
use App\Http\Controllers\ContactController;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Service;

use App\Http\Controllers\UserController; 

Route::get('/users/search', [UserController::class, 'search']);

Route::get('/users', function () {
    $users = User::all();
    return response()->json($users);
});

Route::get('/appointments', function () {
    $appointments = Appointment::all();
    return response()->json($appointments);
});

Route::get('/servicesview', function () {
    $services = Service::all();
    return response()->json($services);
});




Route::put('/appointments/{id}/accept', [AppointmentController::class, 'accept']);
Route::put('/appointments/{id}/reject', [AppointmentController::class, 'reject']);

Route::post('/servicesadd', [ServiceController::class, 'store']); // Create a service
Route::put('/servicesedit/{id}', [ServiceController::class, 'update']); // Update a service
Route::delete('/servicesdel/{id}', [ServiceController::class, 'destroy']); // Delete a service
Route::post('/send-email', 'ContactController@sendEmail');

