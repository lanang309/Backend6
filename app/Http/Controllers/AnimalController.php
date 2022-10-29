<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public $animals =["Kucing", "Kelinci", "Monyet"];
        public function index() 
        {
            echo "Menampilkan data animals" . "<br>";
            foreach ($this->animals as $animal) {
                echo "-" . $animal . "<br>";
            }
        }
        public function store(Request $request)
         {
            echo "Menambahkan binatang baru" . "<br>";
            $data = $request->only('animal');
            array_push($this->animals, $data["animal"]);
            $this->index();
        }
        public function update(Request $request, $id)
         {
            
            echo "Mengupdate data hewan index ke " . $id . "<br>";
            $data = $request->only('animal');
            $this->animals[$id] = $data["animals"];
            $this->index();
        }
        public function destroy($id) {
            echo "Menghapus data hewan index ke " . $id ."<br>";
            unset($this->animals[$id]);
            $this->index();
        }
}
