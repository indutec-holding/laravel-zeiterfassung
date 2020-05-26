<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class TimeController extends Controller
{

    public function index()
    {

       // $employees = Location::with('employees')->where('name', 'Schwerte')->get();

        $location = Location::where('name', 'Schwerte')->find(1);

        $employees = $location->employees;


      // dd($location->employees);


        return view('welcome', [
            'employees' => $employees
        ]);
    }



    public function store(){

      $request = request()->validate([
        'mitarbeiter' => 'required',
        'foto' => 'required|min:255',
      ]);

      $last_time = DB::table('times')->where('personalnummer', $request['mitarbeiter'])->get()->last();

      if($last_time == null){
          Time::create([
              'start' => now(),
              'end' => '2000-01-01',
              'start_foto' => $request['foto'],
              'end_foto' => '',
              'personalnummer' => $request['mitarbeiter'],
              'location' => 'Schwerte',
          ]);
      } else if ($last_time->end == "2000-01-01 00:00:00"){
            DB::table('times')->where('personalnummer', $request['mitarbeiter'])->latest()->update([
                'end' => now(),
                'end_foto' => $request['foto'],
                ]);
        } else {
            Time::create([
                'start' => now(),
                'end' => '2000-01-01',
                'start_foto' => $request['foto'],
                'end_foto' => '',
                'personalnummer' => $request['mitarbeiter'],
                'location' => 'Schwerte',
            ]);
        }





        return redirect('/schwerte');
    }
}
