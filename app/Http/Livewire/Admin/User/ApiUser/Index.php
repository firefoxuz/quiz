<?php

namespace App\Http\Livewire\Admin\User\ApiUser;

use App\Repository\Admin\ApiUser\EloquentApiUserRepository;
use App\Services\DBTransaction;
use App\Services\Pagination;
use App\Services\SweetAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /**
     * Delete user
     * @return void
     * @var int $id The id of the user to be deleted
     */
    public function delete(int $id)
    {
        DBTransaction::run(function () use ($id) {
            (new EloquentApiUserRepository())->delete($id);
            SweetAlert::alertSuccess($this, 'deleted successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });
    }

    public function render()
    {
        return view('livewire.admin.user.api-user.index', [
            'users' => (new EloquentApiUserRepository())->paginate(Pagination::perPage('user'))
        ]);
    }
}
