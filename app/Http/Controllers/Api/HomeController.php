<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Construction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $user, $construction;
    public function __construct(Construction $construction ,
                                User $user
                                )
    {
        $this->user = $user;
        $this->construction = $construction;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        $construction = $this->construction->get()->count();
        $user = $this->user->get()->count();
        return view('administrativo.home.index',compact('construction','user'));
    }
}
