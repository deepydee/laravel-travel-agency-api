<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('Name of the new user');
        $user['email'] = $this->ask('Email of the new user');
        $user['password'] = $this->secret('Password of the new user');

        $roleName = $this->choice('Role of the new user', ['admin', 'editor'], 1);
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $this->error('Role not found');

            return -1;
        }

        $validator = Validator::make($user, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Password::defaults()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return;
        }

        $issuedTokenMessage = '';

        DB::transaction(function () use ($user, $role, &$issuedTokenMessage) {
            $user['password'] = bcrypt($user['password']);
            $newUser = User::create($user);
            $newUser->roles()->attach($role->id);

            switch ($role->name) {
                case 'admin':
                    $token = $newUser->createToken('admin-access', [
                        'travels:create',
                        'travels:update',
                        'travels:destroy',
                        'tours:create',
                        'tours:update',
                        'tours:destroy',
                    ]);
                    break;

                case 'editor':
                    $token = $newUser->createToken('editor-access', ['travels:update',]);
                    break;
            }

            $issuedTokenMessage ="Don't forget your access token: {$token->plainTextToken}";
        });

        $this->info("User {$user['email']} created successfully. $issuedTokenMessage");

        return 0;
    }
}
