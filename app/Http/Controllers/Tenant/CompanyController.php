<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{

    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    

    public function store(Request $request)
    {
        $company = $this->company->create([
            'name' => 'Magazine Luiza',
            // 'domain' => Str::random(5) . 'empresax.com',
            'domain' => 'magazine-tenancy.local',
            'bd_database' => 'magazine_tenant',
            // 'bd_database' => 'teste_banco_externo',
            'bd_hostname' => env('DB_HOST'),
            'bd_username' => env('DB_USERNAME'),
            'bd_password' => env('DB_PASSWORD'),
        ]);


        if ($rodaApenasMigrationsDatabaseExterno = false) {
            event(new DatabaseCreated($company));
        } else {
            event(new CompanyCreated($company));
        }

        dd($company);
    }
}
