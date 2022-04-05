<div>

    <div class="text-right mt-2 mb-2">
        <a href="{{ route('quizzes.create') }}" class="btn btn-primary">
            <i class="icofont icofont-plus"></i>
            Add Quiz
        </a>
    </div>
    <div class="card redial-border-light redial-shadow mb-4">
        <div class="card-body">
            <div class="col-md-6">
                <h6 class="header-title pl-3 redial-relative">{{__('data.quiz.quiz')}}</h6>
            </div>
            <div class="col-md-6 text-right">
                <b> {!! __('data.table.count') !!}:</b> {!! $quizzes->total() !!}
            </div>
            <table class="table table-hover mb-0 redial-font-weight-500 table-responsive d-md-table">
                <thead class="redial-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('data.quiz.title')}}</th>
                    <th scope="col">{{__('data.quiz.count')}}</th>
                    <th scope="col">{{__('data.quiz.attempts')}}</th>
                    <th scope="col">{{__('data.quiz.time_limit')}}</th>
                    <th scope="col">{{__('data.quiz.starts_at')}}</th>
                    <th scope="col">{{__('data.quiz.ends_at')}}</th>
                    <th scope="col">{{__('data.quiz.content')}}</th>
                    <th scope="col">{{__('data.table.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quizzes as $quiz)
                    <tr>
                        <th scope="row">{!! $loop->iteration !!}</th>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ $quiz->count }}</td>
                        <td>{{ $quiz->attempts }}</td>
                        <td>{{ $quiz->time_limit }}</td>
                        <td>{{ $quiz->starts_at }}</td>
                        <td>{{ $quiz->ends_at }}</td>
                        <td>{{ $quiz->content }}</td>
                        <td>
                            <button class="btn btn-success m-1" wire:click="exportToExcel({{$quiz->id}})">
                                <i class="icofont icofont-spreadsheet"></i>
                            </button>
                            <a class="btn btn-primary" href="{{route('quizzes.edit',['quiz' => $quiz->id])}}">
                                <i class="icofont icofont-pencil"></i>
                            </a>
                            <a class="btn btn-primary m-1" href="{{route('quizzes.show',['quiz' => $quiz->id])}}">
                                <i class="icofont icofont-eye"></i>
                            </a>
                            <a class="btn btn-primary" href="{{route('quizzes.take.index',['quiz_id' => $quiz->id])}}">
                                <i class="icofont icofont-test-bulb"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-12 text-center mt-3">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>
</div>
