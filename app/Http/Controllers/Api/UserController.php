<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\City;
use App\Models\Location;
use App\Models\State;
use App\Models\User;
use App\Models\AccessProfile;
use App\Models\UsersToConstructions;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
    private $user,
            $access_profile,
            $address,
            $location,
            $state,
            $city;
    public function __construct(User $user,
                                AccessProfile $access_profile,
                                Address $address,
                                Location $location,
                                State $state,
                                City $city)
    {
        $this->user = $user;
        $this->access_profile = $access_profile;
        $this->address = $address;
        $this->location = $location;
        $this->state = $state;
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $this->user->find(auth()->user()->id)->profile;

        if ($request->access_profile){
            $data = $this->user->with('profile')->get()->where('access_profile','=',$request->access_profile);
        }else{
            $data = $this->user->with('profile')->get();
        }

        if(request()->ajax())
        {
            return DataTables::of($data)
                ->addColumn('access-profile-name',function($data){
                    $prof = $this->access_profile->find($data->access_profile);
                    return $prof->name;
                })
                ->addColumn('action',function($data){
                    $button = "<button type='button'
                    name='edit' id='{$data->id}'
                    class='edit btn btn-primary btn-sm'>Editar</button>";

                    $button .="<button type='button'
                    name='delete' id='{$data->id}'
                    class='delete  btn btn-danger btn-sm ml-2'>Deletar</button>";

                    return $button;
                })->rawColumns(['action','access-profile-name'])
            ->make(true);
        }

        $access_profile = Arr::pluck($this->access_profile->get(), 'name', 'id');
        $state = Arr::pluck($this->state->get()->where('status', '=', 1), 'name', 'id');
        $city = Arr::pluck($this->city->get()->where('status', '=', 1), 'name', 'id');
        $user = Arr::pluck($this->user->get()->where('id', '<>', 3), 'name', 'id');
        return view('administrativo.users.index', ['access_profile' => $access_profile,'state' => $state, 'city' => $city, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(UserRequest $request)
    {
        $data = [
            "name"=>$request->name,
            "company"=>$request->company,
            "email"=>$request->email,
            "password"=>\Hash::make($request->password),
            "access_profile"=>$request->access_profile,
            'email_verified_at'=>now(),
        ];

        $this->user->create($data);

        return response()->json(['success'=>'Sucesso ao Criar'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $data = $this->user->with('profile')->get()->where('access_profile','=',$id);

        if(request()->ajax())
        {
            return DataTables::of($data)
                ->addColumn('access-profile-name',function($data){
                    $prof = $this->access_profile->find($data->access_profile);
                    return $prof->name;
                })
                ->addColumn('action',function($data){
                    $button = "<button type='button'
                    name='edit' id='{$data->id}'
                    class='edit btn btn-primary btn-sm'>Editar</button>";

                    $button .="<button type='button'
                    name='delete' id='{$data->id}'
                    class='delete  btn btn-danger btn-sm ml-2'>Deletar</button>";

                    return $button;
                })->rawColumns(['action','access-profile-name'])
                ->make(true);
        }

        $access_profile = Arr::pluck($this->access_profile->get(), 'name', 'id');
        $state = Arr::pluck($this->state->get()->where('status', '=', 1), 'name', 'id');
        $city = Arr::pluck($this->city->get()->where('status', '=', 1), 'name', 'id');
        $user = Arr::pluck($this->user->get()->where('id', '<>', 3), 'name', 'id');
        return view('administrativo.users.index', ['access_profile' => $access_profile,'state' => $state, 'city' => $city, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $user = $this->user->with('profile')->find($id);

        if(!$user)
                 return response()->json(['error'=>'Não foi encontrado nenhum usuário!'],500);

             return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
        $user = $this->user->find($id);

        if(!$user || $user->id == auth()->user()->id)
                return response()->json(['error'=>'User not found or user logged in'],500);

        $data = [
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>$user->password,
                "access_profile"=>$request->access_profile,
                'email_verified_at'=>now(),
                ];

        $user->update($data);

        return response()->json(['success'=>'Sucesso ao Atualizar'],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if(!$user || $user->id == auth()->user()->id)
                return response()->json(['error'=>'User not found or user logged in'],500);

        $usertoconstructions = UsersToConstructions::where('user','=',$user->id)->get();

        foreach ($usertoconstructions as $usertoconstruction){
            $utc = UsersToConstructions::find($usertoconstruction->id);
            $utc->delete();
        }

        $user->delete();

        return response()->json(['success'=>'success'],204);
    }

    public function list(){
        $data = $this->user->with('profile')->get();

        return response()->json($data);
    }


}
