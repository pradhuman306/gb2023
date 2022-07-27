<?php

namespace App\Imports;
use App\Models\Record;
use App\Models\Student;
use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use session;

class StudentsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(collection $rows)
    {
        $count=0;
        foreach ($rows as $row) 
        {
            if($count!=0){
            $data=Student::create([
            'student_id'  => $row[0],
            'scholar_no'  => $row[1],
            'name'  => $row[2],
            'father_name'  => $row[3],
            'mother_name'  => $row[4],
            'dob'  => $row[5],
            'address'  => $row[6],
            'aadhar_no'  => $row[7],
            'samarg_id'  => $row[8],
            'mobile_no'  => $row[9],
            'mobile_no2'  => $row[10],
            'account_no'  => $row[11],
            ]);

            $id=$data->id;
            Record::create([
                'students_id' => $id,
                'class_name' => $row[12],
                'session' => $row[13],
            ]);
        }
            $count++;
        }
       
        
    }
}
