<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Role;

class InstallationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'control-the-work:installation {--language=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the application on your server';

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
     * @return mixed
     */
    public function handle()
    {
        try {
            // todo: check if some .env values are set
            // Get the language for the command
            $language = $this->option('language');
            if (config('locale.status')) {
                if (array_key_exists($language, config('locale.languages'))) {
                    App::setLocale($language);
                } elseif(null !== $this->option('language')) {
                    $this->error(__('The language (--language=parameter) is not between the application languages.'));
                    exit(1);
                }
            }

            // Check if there is a company
            $company = Company::all();
            if (!$company->isEmpty()) {
                if (!($this->confirm(__('The system has one company called ":name". If you continue all data will be erased. Do you want to continue?', [
                    'name' => $company->first()->name,
                ])))) {
                    exit(0);
                }
            }

            // Check if the roles exist and are correct
            $roles = Role::orderBy('name', 'ASC')->get();
            if (($roles->isEmpty()) ||
                (!(($roles[0]->name === 'Administrator') &&
                    ($roles[1]->name === 'Employee') &&
                    ($roles[2]->name === 'Labor union') &&
                    ($roles[3]->name === 'Supervisor')))) {
                $this->error(__('The installer doesn\'t find some required roles. Please, execute the migration first.'));
                exit(1);
            }

            $companyName = $this->ask(__('What is your company name?'));
            $email = $this->ask(__('What is the email of the administrator user that will be created?'));
            $password = $this->secret(__('What is the password for this user?'));

            // todo: validate the input

            // Remove the info from the tables of companies and users.
            Company::truncate();
            User::truncate();

            $this->info(__('Creating the company :companyName.', [
                'companyName' => $companyName,
            ]));
            $company = Company::create([
                'name' => $companyName,
            ]);
            $this->info(__('Creating the user with email :email.', [
                'email' => $email,
            ]));
            $user = User::create([
                'company_id' => $company->id,
                'email' => $email,
                'password' => bcrypt($password),
            ]);
            $user->sendEmailVerificationNotification();
            $this->info(__('Now you will receive a validation email in the address :email. Please, check your inbox.', [
                'email' => $email,
            ]));
        } catch (\Exception $exception) {
            exit($exception->getMessage() . PHP_EOL);
        }
    }
}
