<?php

namespace App\Http\Livewire\Admin\User;

use App\Repository\Admin\User\EloquentApiUserRepository;
use App\Repository\Admin\User\EloquentUserRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Hash;
use Livewire\Component;

class UserCreate extends Component
{
    public string $full_name = '';
    public string $email = '';
    public string $password = '';

    protected array $rules = [
        'full_name' => 'required|string|max:32',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:5',
    ];


    /**
     * Store a newly created user in database.
     *
     * @return void
     */
    public function create()
    {

        $validatedData = $this->validate();

        DBTransaction::run(function () use ($validatedData) {
            (new EloquentUserRepository())->create([
                'name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
            SweetAlert::alertSuccess($this, 'created successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });

        $this->reset();
    }


    /**
     * Render the component view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.admin.user.user-create');
    }
}
