<div>
    <div class="col-md-12">
        <h2>{{$user->first_name . ' ' . $user->last_name}}</h2>
        <h4>{{$user->phone}}</h4>
        <h4>{{$user->email}}</h4>
    </div>
    <div class="col-md-12 mb-2 text-right">
        <a href="{{route('face_api.create',['user_id'=> $user->id])}}"
           class="btn btn-primary">{{__('data.face_data.add')}}</a>
    </div>
    <div class="card redial-border-light redial-shadow mb-4">
        <div class="card-body">
            <div class="col-md-6">
                <h6 class="header-title pl-3 redial-relative">{{__('data.face_data.face_data')}}</h6>
            </div>
            <div class="col-md-6 text-right">
                <b> {!! __('data.table.count') !!}:</b> {!! $user->photos->count() !!}
            </div>
            <table class="table table-hover mb-0 redial-font-weight-500 table-responsive d-md-table">
                <thead class="redial-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('data.face_data.photo')}}</th>
                    <th scope="col">{{__('data.table.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->photos as $photo)
                    <tr>
                        <th scope="row">{!! $photo->id !!}</th>
                        <td>
                            <img src="{{ $photoservice->getPhoto($photo->photo) }}" width="100">
                        </td>
                        <td>
                            <button class="btn btn-danger" wire:click="delete({{$photo->id}})">
                                <i class="icofont icofont-bin"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
