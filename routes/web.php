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

// Resources declarations
Route::resource('reservations','ReserveController');
//Route::resource('test','MatchController');
Route::get('/about', 'PagesController@about')->name('about');

Route::resource('/admin/rooms','RoomsController');

Route::get('/', 'MatchController@index')->name('/');
Route::post('/next', 'MatchController@start')->name('next');
//Route::get('/start', 'MatchController@start'); //Search
// Route::get('/', 'PagesController@start');
//Route::get('/sched','MatchController@search');
Route::post('/start' , 'MatchController@step1_match'); //Search Output
Route::post('/sched', 'MatchController@step1_reserve'); //Form Start
Route::get('/sched', 'MatchController@step2_reserve')->name('sched'); // Form Output
Route::get('/sched', 'MatchController@success')->name('sched');
Route::post('/reserve', 'MatchController@step1_reserve')->name('reserve');
Route::post('/reserve', 'MatchController@step2_reserve')->name('reserve');
//Route::post('/sched', 'MatchController@step2_reserve');
Route::post('/info', 'matchController@postCreateStep2')->name('info');

//Wait List
Route::post('/waitlist','waitlistController@start')->name('waitlist');
Route::get('/waitlist','WaitlistController@start')->name('waitlist');
Route::post('/waitlist/reserve','WaitlistController@initialReserve')->name('waitlist/reserve');
Route::post('/waitlist/save','WaitlistController@addWaitlist')->name('waitlist/reserve');

//Search Employee
Route::get('/search', 'PagesController@search')->name('sched');


Route::get('/sched', 'matchController@success')->name('sched');

//Admin
Route::post('/home','adminController@adminMatch')->name('home');

Route::get('/admin/reservations','MatchController@reservations')->name('admin/reservations');
Route::get('/admin/reservations/today','AdminController@allReservations')->name('admin/reservations/today');
//Route::post('/sched' , 'MatchController@step2_reserve');

Route::get('/admin/reserve/manual/first','AdminController@ManualReserveStepOne')->name('admin/reserve/manual/first');
Route::post('/admin/reserve/manual/first','AdminController@manualReserveStepTwo')->name('admin/reserve/manual/first');
Route::post('/admin/reserve/manual/second','AdminController@manualReserveStepThree')->name('admin/reserve/manual/second');

Route::post('/reservations/edit/successful','AdminController@update')->name('reservations/edit/successful');
Route::post('/reservations/edit/cancel','AdminController@cancel')->name('reservations/edit/cancel');


//Rooms
Route::resource('admin/rooms','RoomsController');

//


/*Route::get('/about',function(){
    return view('pages.about');
});*/



Route::get('hello','HelloController@index');


// Sample Routes
Route::get('hello/{name}', function($name){
    echo 'Hello '.$name;
});

// Create
Route::post('test',function(){
    echo 'We just created an item';
});

// Read
Route::get('test',function(){
    echo '<form action="test" method="POST">';
    echo '<input type="submit">';
    echo '<input type="hidden" value"'.csrf_token().'"name="_token">';
    echo '</form>';
});

// Update
Route::put('test',function(){
    
});

// Delete
Route::delete('test',function(){
    
});
Auth::routes();

Route::get('/home', 'AdminController@home')->name('home');
