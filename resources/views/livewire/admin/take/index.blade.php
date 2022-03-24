<div>
    <div class="card redial-border-light redial-shadow mb-4">
        <div class="card-body">
            <div class="col-md-6">
                <h6 class="header-title pl-3 redial-relative">{{__('data.take.take')}}</h6>
            </div>
            <div class="col-md-6 text-right">
                <b> {!! __('data.table.count') !!}:</b> {!! $takes->total() !!}
            </div>
            <table class="table table-hover mb-0 redial-font-weight-500 table-responsive d-md-table">
                <thead class="redial-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('data.user.full_name')}}</th>
                    <th scope="col">{{__('data.take.score')}}</th>
                    <th scope="col">{{__('data.take.status')}}</th>
                    <th scope="col">{{__('data.quiz.starts_at')}}</th>
                    <th scope="col">{{__('data.quiz.ends_at')}}</th>
                    <th scope="col">{{__('data.table.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($takes as $take)
                    <tr>
                        <th scope="row">{!! $loop->iteration !!}</th>
                        <td>{{ $take->first_name . ' ' . $take->last_name }}</td>
                        <td>{{ $take->correct_answers }}</td>
                        <td>{{ __('data.take.statuses')[$take->status] }}</td>
                        <td>{{ $take->starts_at }}</td>
                        <td>{{ $take->ends_at }}</td>
                        <td>
                            <a class="btn btn-primary"
                               href="{{route('quizzes.take.show',['take_id' => $take->id ,'quiz_id' => $quiz_id])}}">
                                <i class="icofont icofont-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-12 text-center mt-3">
                {{ $takes->links() }}
            </div>
        </div>
    </div>
</div>
