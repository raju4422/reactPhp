<?php

namespace App\Controllers;


class ThemeController extends BaseController
{



	public function index(){
		echo view('layout/base');
	}


	public function about(){
		echo view('pages/about');
	}

	public function services(){
		echo view('pages/services');
	}


	public function portfolio(){
		echo view('pages/portfolio');
	}


	public function pricing(){
		echo view('pages/pricing');
	}


	public function contact(){
		echo view('pages/contact');
	}




}

?>