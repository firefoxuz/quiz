<?php

namespace App\Http\Livewire\Admin\User;

use App\Repository\Admin\User\EloquentApiUserRepository;
use App\Repository\Admin\User\EloquentUserRepository;
use App\Services\DBTransaction;
use App\Services\Pagination;
use App\Services\SweetAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    /**
     * Delete user
     * @var int $id The id of the user to be deleted
     * @return void
     */
    public function delete(int $id)
    {
        DBTransaction::run(function () use ($id) {
            (new EloquentUserRepository())->delete($id);
            SweetAlert::alertSuccess($this, 'deleted successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });
    }

    /**
     * Render the view
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.admin.user.user-index', [
            'users' => (new EloquentUserRepository())->paginate(Pagination::perPage('user'))
        ]);
    }
}
