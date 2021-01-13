<?php

namespace App\Http\Controllers;

use App\Repositories\SistemaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $sistemaRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SistemaRepository $sistemaRepository)
    {
        $this->middleware('auth');
        $this->sistemaRepository = $sistemaRepository;
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipo === 3)
            {
                return redirect ()->route ('maia');
            }

            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

//    public function welcome()
//    {
//        return view ('welcome');
//    }


}
