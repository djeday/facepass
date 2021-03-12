<?php

namespace App\Console\Commands;

use App\Data\Repository\FacebookUserRepository;
use App\Data\Repository\UserRepository;
use App\Domain\Facade\UserFacade;
use Exception;
use Illuminate\Console\Command;

class ImportUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from external api';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $importUsersFacade = new UserFacade(new UserRepository(), new FacebookUserRepository());
            $this->info($importUsersFacade->importUsers() . ' users successful imported');
        } catch (Exception $ex) {
            $this->info($ex->getMessage());
        }
    }
}
