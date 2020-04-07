<?php

use App\Models\Address;
use App\Models\Construction;
use App\Models\Location;
use Illuminate\Database\Seeder;

class ConstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = Location::create([
            'neighborhood' => 'Bairro Teste',
            'zipCode' => '45564090',
            'city' => 566,
            'status' => 1
        ]);
        $address = Address::create([
            'street' => "Rua Teste",
            'number' => '435',
            'location' => $location->id,
            'status' => 1
        ]);

        Construction::create([
            'name' => "Obra Teste",
            'thumbnail' => "131521202003015e5bb56926c50.jpeg",
            'company' => 'KB Construtora',
            'business' => 1,
            'responsible' => 'KB Construtora',
            'cnpj' => '26215761000154',
            'regional' => 1,
            'contract_regime' => 'MOC',
            'reporting_regime' => 'Caixa',
            'work_number' => 'BN01',
            'status' => 1,
            'address' => $address->id
        ]);


        $location = Location::create([
            'neighborhood' => 'Bairro Teste 2',
            'zipCode' => '45564110',
            'city' => 566,
            'status' => 1
        ]);
        $address = Address::create([
            'street' => "Rua Teste 2",
            'number' => '566',
            'location' => $location->id,
            'status' => 1
        ]);

        Construction::create([
            'name' => "Obra Teste 2",
            'thumbnail' => "131521202003015e5bb56926c50.jpeg",
            'company' => 'KB Construtora',
            'business' => 1,
            'responsible' => 'KB Construtora',
            'cnpj' => '26215761000154',
            'regional' => 1,
            'contract_regime' => 'MOC',
            'reporting_regime' => 'Caixa',
            'work_number' => 'BN01',
            'status' => 1,
            'address' => $address->id
        ]);

        $location = Location::create([
            'neighborhood' => 'Bairro Teste 3',
            'zipCode' => '45564190',
            'city' => 566,
            'status' => 1
        ]);
        $address = Address::create([
            'street' => "Rua Teste 3",
            'number' => '566',
            'location' => $location->id,
            'status' => 1
        ]);

        Construction::create([
            'name' => "Obra Teste 3",
            'thumbnail' => "131521202003015e5bb56926c50.jpeg",
            'company' => 'KB Construtora',
            'business' => 1,
            'responsible' => 'KB Construtora',
            'cnpj' => '26215761000154',
            'regional' => 1,
            'contract_regime' => 'MOC',
            'reporting_regime' => 'Caixa',
            'work_number' => 'BN01',
            'status' => 1,
            'address' => $address->id
        ]);

        $location = Location::create([
            'neighborhood' => 'Bairro Teste 4',
            'zipCode' => '45564290',
            'city' => 566,
            'status' => 1
        ]);
        $address = Address::create([
            'street' => "Rua Teste 4",
            'number' => '566',
            'location' => $location->id,
            'status' => 1
        ]);

        Construction::create([
            'name' => "Obra Teste 4",
            'thumbnail' => "131521202003015e5bb56926c50.jpeg",
            'company' => 'KB Construtora',
            'business' => 1,
            'responsible' => 'KB Construtora',
            'cnpj' => '26215761000154',
            'regional' => 1,
            'contract_regime' => 'MOC',
            'reporting_regime' => 'Caixa',
            'work_number' => 'BN01',
            'status' => 1,
            'address' => $address->id
        ]);
    }
}
