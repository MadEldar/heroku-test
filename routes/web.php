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
    return view('welcome');
});
Route::get('/student-list', function() {
    $conn = new mysqli('localhost', 'root', '', 'students');
    $sql = 'select * from students';
    $list = $conn -> query($sql) -> fetch_assoc();
    json_encode($list);
    $list = [
        [
            'student_id' => 1,
            'student_name' => 'Mark',
            'student_dob' => '01/06/1998',
            'student_address' => '48',
            'student_class' => 'TH1904A'
        ]
    ];
    return view('assignment01/student-list', [
        'list' => $list,
        'title' => 'Student list'
    ]);
});
