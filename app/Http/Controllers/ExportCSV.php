<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class exportCSV extends Controller
{    
	public function index(){

		
		$data = array( array('data1','data12', 'data13'),
					   array('data21','data22','data23'),
					   array('data31','data32','data33')
					   );

	\Excel::create('datos', function($excel) use($data) {

    $excel->sheet('datos', function($sheet) use($data) {
        $sheet->fromArray($data,null,'A1',false);
    });

		})->export('csv');
	

	}


	public function vista(){

		return view('create');
	}
}
