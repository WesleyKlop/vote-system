<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ManageUserCommand extends Command
{
    public final const DEFAULT_ADMIN_NAME = 'admin';
    public final const DEFAULT_ADMIN_PASSWORD = 'password';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'votesystem:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update or create the admin user of the vote system application';

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
     */
    public function handle(): int
    {
        $name = config('vote-system.admin_name') ?: self::DEFAULT_ADMIN_NAME;
        $password =
            config('vote-system.admin_password') ?:
            self::DEFAULT_ADMIN_PASSWORD;

        $user = User::updateOrCreate(
            ['name' => $name],
            ['password' => Hash::make($password)]
        );
        $this->info(
            'Created or updated the admin user with name: ' . $user->name
        );
        if ($this->shouldShowProductionWarning($name, $password)) {
            $this->warn(
                "Application running in production but is using the default credentials!!!\nWhat are you doing!?"
            );
        }

        return 0;
    }

    private function shouldShowProductionWarning(
        string $name,
        string $password
    ): bool {
        return config('app.env') === 'production' &&
            $name === self::DEFAULT_ADMIN_NAME &&
            $password === self::DEFAULT_ADMIN_PASSWORD;
    }
}
