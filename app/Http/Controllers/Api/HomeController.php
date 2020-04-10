<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Construction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        if (auth()->user()->access_profile == 1) {
            $construction = $this->construction->get()->count();
        }else{
            $constructions = DB::select("select distinct c.id, c.name from constructions c join users_to_constructions uc on uc.construction = c.id where uc.user = " . auth()->user()->id);
            $construction = count($constructions);
        }
        $user = $this->user->get()->count();
        return view('administrativo.home.index',compact('construction','user'));
    }
}
