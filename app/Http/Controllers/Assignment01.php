<?php

namespace App\Http\Controllers;

use mysqli;

class Assignment01 extends Controller
{
    public function studentList() {
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
    }
}
