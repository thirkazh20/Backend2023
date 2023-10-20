<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(){
        echo "Menampilkan Data Animals";
    }

    public function store(Request $request)
    {
        echo "Nama Hewan : $request -> nama";
        echo "<br>";
        echo "Menambahkan Hewan Baru";
    }

    public function update(Request $request, $id)
    {
        echo "Nama Hewan : $request -> nama";
        echo "<br>";
        echo "Mengupdate Data Hewan id $id";
    }

    public function destroy($id)
    {
        echo "Menghapus Data Hewan id $id";
    }
}
