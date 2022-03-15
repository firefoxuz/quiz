<?php

namespace App\Http\Livewire\Admin\User\ApiUser;

use App\Repository\Admin\ApiUser\EloquentApiUserRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Carbon\Carbon;
use Hash;
use Livewire\Component;

class Update extends Component
{
    public int $api_user_id = 0;
    public string $first_name = '';
    public string $last_name = '';
    public string $phone = '';
    public string $email = '';
    public string $password = '';

    protected array $rules = [
        'first_name' => 'nullable|string|max:50',
        'last_name' => 'nullable|string|max:50',
        'phone' => 'nullable|string|max:15',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:5',
    ];

    public function mount($api_user_id)
    {
        $user = (new EloquentApiUserRepository())->find($this->api_user_id);
        $this->fill($user->toArray());
        return $this->api_user_id = $api_user_id;
    }

    public function update()
    {
        $validatedData = $this->validate();

        DBTransaction::run(function () use ($validatedData) {
            (new EloquentApiUserRepository())->update([
                'first_name' => $validatedData['first_name'] ?? null,
                'last_name' => $validatedData['last_name'] ?? null,
                'phone' => $validatedData['phone'] ?? null,
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ], $this->api_user_id);
            SweetAlert::alertSuccess($this, 'created successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.user.api-user.update',[

        ]);
    }
}
