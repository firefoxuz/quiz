<div>
    <div class="card redial-border-light redial-shadow mb-4">
        <div class="card-body">
            <div class="col-md-6">
                <h6 class="header-title pl-3 redial-relative">{{__('data.user.api_user')}}</h6>
            </div>
            <div class="col-md-6 text-right">
                <b> {!! __('data.table.count') !!}:</b> {!! $users->total() !!}
            </div>
            <table class="table table-hover mb-0 redial-font-weight-500 table-responsive d-md-table">
                <thead class="redial-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('data.api_user.first_name')}}</th>
                    <th scope="col">{{__('data.api_user.last_name')}}</th>
                    <th scope="col">{{__('data.api_user.phone')}}</th>
                    <th scope="col">{{__('data.api_user.email')}}</th>
                    <th scope="col">{{__('data.api_user.registered_at')}}</th>
                    <th scope="col">{{__('data.table.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{!! $user->id !!}</th>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->registered_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('api_users.face_data.show',['user_id' => $user->id])}}">
                                <i class="icofont icofont-eye"></i>
                            </a>

                            <a class="btn btn-primary" href="{{route('api_users.show',['api_user' => $user->id])}}">
                                <i class="icofont icofont-pencil"></i>
                            </a>
                            <button class="btn btn-danger" wire:click="delete({{$user->id}})">
                                <i class="icofont icofont-bin"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-12 text-center mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
