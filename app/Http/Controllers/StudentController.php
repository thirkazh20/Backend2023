<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    //Membuat method index
    public function index(){
        //Mendapatkan semua data students
        $students = Student::all();

        //Jika data kosong maka kirim status code 204
        if($students->isEmpty()){
            $data = [
                'message' => 'Resource is empty'
            ];

            return response()->json($data, 204);
        }

        $data = [
            'message' => 'Get All Students',
            'data' => $students
        ];

        return response()->json($data, 200);
    }

    //Membuat method store
    public function store(Request $request){
        //Validasi data request
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'jurusan' => 'required'
        ]);

        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        $student = Student::create($input);
        $data = [
            'message' => 'Student is created succesfully',
            'data' => $student,
        ];
        return response()->json($data, 201);
    }

    //Membuat method show
    public function show($id){
        //Cari ID Student yang ingin didapatkan
        $student = Student::find($id);

        if ($student){
            $data = [
                'message' => 'Get Detail Student',
                'data' => $student
            ];
            //Mengambil data json dan kode 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];
            //Mengembalikan data json dan kode 400
            return response()->json($data, 404);
        }
    }

    //Membuat method update
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student) {
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan
            ];

            //Melakukan update input
            $student->update($input);

            $data = [
                'message' => 'Student is updated',
                'data' => $student
            ];

            //Mengembalikan data json dan kode 200
            return response()->json($data, 200);
        }
        else{
            $data = [
                'message' => 'Student not found'
            ];
            return response()->json($data, 404);
        }
    }

    //Membuat method delete
    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            
            $data = [
                'message' => 'Student is deleted',
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Student not found',
            ];
            return response()->json($data, 400);
        }
    }
}
