<?php

namespace App\Console\Commands\Houseify\Environments;

use Illuminate\Console\Command;
use App\Console\Commands\Houseify\CommandTrait;

class ResetCommand extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'houseify:reset {--dev}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the Dev environment.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('dev')) {
            $this->resetDev();
        }

        if (! $this->options()) {
            $this->info('no');
        }
    }

    private function resetDev()
    {
        $this->setColor('blue');
        $this->setColor('green');

        $this->newLine();

        $this->info('<blue>-- Resetting Local Environment --</blue>');

        $this->newLine();

        $this->line('<green>-- Cleaning Cache --</green>');
        $this->call('clear-compiled');
        $this->call('cache:clear');
        $this->call('route:clear');
        $this->call('config:clear');
        $this->call('view:clear');

        $this->newLine();

        $this->line('<green>-- Updating Composer Dependencies --</green>');
        exec('composer dumpautoload -o');
        exec('composer update');

        $this->newLine();

        $this->line('<green>-- Updating NPM Dependencies --</green>');
        exec('npm update');

        $this->newLine();

        $this->line('<green>-- Deleting Images --</green>');
        exec('rm -R ./storage/app/public');
        exec('rm -R ./public/storage');

        $this->newLine();

        $this->line('<green>-- Creating Symlink Storage/Public --</green>');
        $this->call('storage:link');
        exec('chmod -R 765 storage');

        $this->newLine();

        $this->line('<green>-- Scout Flush --</green>');
//        exec('php artisan scout:flush');

        $this->newLine();

        $this->line('<green>-- Refreshing Migrations + Seeds --</green>');
//        $this->call('migrate:refresh');
//        $this->call('db:seed');

        $this->newLine();

        $this->line('<green>-- Scout Import --</green>');
//        exec('php artisan scout:import');

        $this->newLine();

        $this->info('<blue>-- Houseify: Local Resetted! --</blue>');
    }
}
