<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function index()
	{
		// mengambil data dari table syllabus
		$syllabus = \DB::table('posts')->get();

		// mengirim data syllabus ke view index
		return view('welcome', ['syllabus' => $syllabus]);

	}
	
}