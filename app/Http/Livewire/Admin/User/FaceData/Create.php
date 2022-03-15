<?php

namespace App\Http\Livewire\Admin\User\FaceData;

use App\Repository\Admin\User\FaceData\EloquentFaceDataRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $user_id;

    public $photo;
    public string $model = '';

    protected array $rules = [
        'photo' => 'required|image|max:512',
        'model' => 'required|json',
    ];

    public function mount()
    {
        $this->user_id = request()->get('user_id');
    }

    public function create()
    {
        $validatedData = $this->validate();


        $photo = $this->photo->store('photos', 'public_folder');

        DBTransaction::run(function () use ($validatedData, $photo) {
            (new EloquentFaceDataRepository())->create([
                'user_id' => $this->user_id,
                'photo' => $photo,
                'model' => $validatedData['model'],
            ]);
            SweetAlert::alertSuccess($this, 'created successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
            dd($exception->getMessage(),$this->user_id);
        });

        $this->reset([
            'photo',
            'model',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.user.face-data.create');
    }
}
