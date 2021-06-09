<?php

namespace App\Console\Commands\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantSeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:seeds {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run seeds tenants';

    private $tenant;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ManagerTenant $tenant)
    {
        parent::__construct();

        $this->tenant = $tenant;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        if ($this->argument('id')) {
            $company = Company::find($this->argument('id'));

            if ($company) {
                $this->execCommand($company);
            }

            return;
        }

        $companies = Company::all();

        foreach ($companies as $company) {
            $this->execCommand($company);
        }
    }


    private function execCommand(Company $company)
    {

        $command = 'db:seed';

        $this->tenant->setConnection($company);

        $this->info("Connecting Company {$company->name}");

        Artisan::call($command);

        $this->info("End Connecting Company {$company->name}");

        $this->info('-------------------------------------------');
    }
}
