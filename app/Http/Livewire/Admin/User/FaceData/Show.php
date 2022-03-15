<?php

namespace App\Http\Livewire\Admin\User\FaceData;

use App\Repository\Admin\ApiUser\EloquentApiUserRepository;
use App\Repository\Admin\Quiz\EloquentQuizRepository;
use App\Repository\Admin\User\FaceData\EloquentFaceDataRepository;
use App\Services\DBTransaction;
use App\Services\Photo;
use App\Services\SweetAlert;
use Livewire\Component;

class Show extends Component
{
    public $user_id;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function delete(int $id)
    {
        DBTransaction::run(function () use ($id) {
            (new EloquentFaceDataRepository())->delete($id);
            SweetAlert::alertSuccess($this, 'deleted successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });
    }


    public function render()
    {
        return view('livewire.admin.user.face-data.show',[
            'user' => (new EloquentApiUserRepository())->findWithFaceData($this->user_id),
            'photoservice' => new Photo(''),
        ]);
    }
}
