<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressRequest;
use App\Models\Address;
use App\Models\Location;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    private $address,$location;
    public function __construct(Address $address,Location $location)
    {
        $this->address = $address;
        $this->location = $location;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddressRequest  $request
     * @return JsonResponse
     */
    public function store(AddressRequest $request)
    {
        $dataLocation = [
            "neighborhood" => $request->neighborhood,
            "zipCode" => $request->zipCode,
            "city" => $request->city,
            "status" => $request->status
        ];

        $location = $this->location->create($dataLocation);

        $dataAddress = [
            "street" => $request->street,
            "number" => $request->number,
            "location" => $location->id,
            "status" => $request->status
        ];

        if(!$this->address->create($dataAddress))
            return response()->json(["error" => "Inserção de Endereço falhou!"], 500);

        return response()->json(["success" => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $address = $this->address->with('location')->find($id);

        return response()->json($address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $address = $this->address->with('location')->find($id);

        return response()->json($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddressRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(AddressRequest $request, $id)
    {
        $address = $this->address->find($id);

        if (isset($address)) {
            $idLocation = $address->location->id;

            $location = Location::find($idLocation);

            $dataLocation = [
                "neighborhood" => $request->neighborhood,
                "zipCode" => $request->zipCode,
                "city" => $request->city,
                "status" => $request->status
            ];

            $this->location->update($dataLocation);

            $dataAddress = [
                "street" => $request->street,
                "number" => $request->number,
                "location" => $location->id,
                "status" => $request->status
            ];

            $this->address->update($dataAddress);
            return response()->json(["success" => "Dados de Endereço atualizados com sucesso"], 201);
        }else{
            return response()->json(["error" => "Dados de Endereço não encontrados!"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $address = $this->address->find($id);

        if (isset($address)) {
            $idLocation = $address->location->id;

            $location = Location::find($idLocation);

            $location->status = 0;

            $this->location->save();

            $address->status = 0;

            if(!$this->address->save())
                return response()->json(["error" => "Falha na alteração do endereço!"], 500);

            return response()->json(["success" => true], 201);
        }else{
            return response()->json(["error" => "Falha na alteração do endereço!"], 500);
        }
    }
}
