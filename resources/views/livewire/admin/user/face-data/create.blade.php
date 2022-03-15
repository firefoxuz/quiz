<div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->messages() as $error)
                    <li> {{$error[0]}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{ route('api_users.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card redial-border-light redial-shadow mb-4">
                <div class="card-body">
                    <h6 class="header-title pl-3 redial-relative">{{__('data.face_data.add_face_model')}}</h6>
                    <form wire:submit.prevent="create">
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.face_data.photo')}}</label>
                            <input type="file" wire:model.defer="photo" id="imageUpload">
                        </div>
                        <div class="redial-divider my-4"></div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-xs">{{__('data.table.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('build', function (e) {
            @this.
            set('model', des_json);
        });
    </script>
</div>
