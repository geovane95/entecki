<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersToConstructions;
use App\Models\Construction;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class UsersToConstructionsController extends Controller
{
    private $usertoconstruction, $construction, $user;

    public function __construct(
        UsersToConstructions $usersToConstructions,
        Construction $construction,
        User $user
    )
    {
        $this->usertoconstruction = $usersToConstructions;
        $this->construction = $construction;
        $this->user = $user;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        if (request()->ajax()) {
            $data = $this->usertoconstruction->get()->where('construction','=',$id);
            return DataTables::of($data)

                ->addColumn('user-name', function ($data) {
                    $cli = $this->user->find($data->user);
                    return $cli->name;
                })
                ->addColumn('action', function ($data) {

                    $button = "<button type='button'
                    name='delete' id='delete_{$data->id}'
                    class='delete  btn btn-danger btn-sm ml-2'>Deletar</button>";

                    return $button;
                })->rawColumns(['action', 'user-name'])
                ->make(true);
        }

        $users = Arr::pluck($this->user->get()->where('status', '=', 1), 'name', 'id');
        $constructions = Arr::pluck($this->construction->get()->where('status', '=', 1), 'name', 'id');
        return view('administrativo.usertoconstruction.index', ['users' => $users, 'constructions' => $constructions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $id)
    {
        $datForm = [
            'user' => $request->user,
            'construction' => $id
        ];

        $usertoconstruction = $this->usertoconstruction->create($datForm);

        if (!$usertoconstruction)
            return response()->json(['error'=>'Falha ao atrelar este usere a essa obra.', 500]);

        return response()->json(['success'=>true],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $usertoconstruction = $this->usertoconstruction->find($id);

        if (!$usertoconstruction->delete())
            return response()->json(['error'=>'Falha ao desatrelar este usere a essa obra.', 500]);

        return response()->json(['success'=>true],200);
    }
}
