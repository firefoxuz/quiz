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
        <div class="col-md-6">
            <div class="card redial-border-light redial-shadow mb-4">
                <div class="card-body">
                    <h6 class="header-title pl-3 redial-relative">{{__('data.user.new')}}</h6>
                    <form wire:submit.prevent="create">
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.user.full_name')}}</label>
                            <input type="text" class="form-control" wire:model.defer="full_name" placeholder="{{__('data.user.full_name')}}" />
                        </div>
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.user.email')}}</label>
                            <input type="text" class="form-control" wire:model.defer="email" placeholder="{{__('data.site.login.email')}}" />
                        </div>
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.site.login.password')}}</label>
                            <input type="password" class="form-control" wire:model.defer="password" placeholder="{{__('data.site.login.password')}}" />
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

</div>
