<?php

namespace LaravelRoad\IBGELocaltions\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ibge-locations:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the IBGE Locations resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->callSilent('vendor:publish', ['--tag' => 'ibge-locations-config', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'ibge-locations-migrations', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'ibge-locations-seeders', '--force' => true]);

        $this->call('migrate', ['--force' => true]);
        $this->call('db:seed', ['--class' => 'LocationsTableSeeder']);
    }
}
