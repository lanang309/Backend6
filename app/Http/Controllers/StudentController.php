<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(){

        //get all data in students table
        $students = Student::all();

        $data = [
            'message' => 'Get all student',
            'data' => $students
        ];

        //menggunakan response json laravel
        //otomatis set header content type json
        //otomatis mengubah data array ke json 
        //mengatur status code
        return response()->json($data, 200);
    }

    # menambahkan resource student
    # membuat method store
    public function store(Request $request)
    {
        # menangkap data request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        # menggunakan Student untuk insert data
        $student = Student::create($input);

        $data = [
            'message' => 'Student is created successfully',
            'data' => $student,
        ];

        # mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }

    // public function update(Request $request, $id){
    //     $input=[
    //         'nama' => $request->nama,
    //         'nim' => $request->nim,
    //         'email' => $request->email,
    //         'jurusan' => $request->jurusan,
    //    ];

    //    Student::find($id)->update($input);
    //    $student=Student::find($id);

    //    $data=[
    //     'message' => 'Student berhasil diupdate',
    //     'data' => $student,
    //    ];

    //    return response()->json($data,200);
    // }

    public function destroy($id){
        # cari data student yg ingin dihapus
        $student = Student::find($id);

        if ($student) {
            # hapus data student
            $student->delete();

            $data = [
                'message' => 'Student is deleted',
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    # mendapatkan detail resource student
    # membuat method show
    public function show($id){
        //cari data student
        $student=Student::find($id);
        //kondisi apabila data kosong
        if($student){
            $data = [
                'message'=>'Get detail student',
                'data'=>$student,
            ];
            //mengirim data bentuk json
            return response()->json($data,200);
        }else{
            $data = [
                'message'=>'Student not found'
            ];
            //mengirim data bentuk json
        return response()->json($data,404);
        }     
    }

    # mengupdate resource student
    # membuat method update
    public function update(Request $request, $id)
    {
        # cari data student yg ingin diupdate
        $student = Student::find($id);

        if ($student) {
            # mendapatkan data request
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan,
            ];

            # mengupdate data
            $student->update($input);

            $data = [
                'message' => 'Resource student updated',
                'data' => $student,
            ];

            # mengirimkan respon json dgn status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

}
