<div>

    <div class="text-right mt-2 mb-2">
        <a href="{{ route('quiz.store_question',['quiz_id' => $quiz_id]) }}" class="btn btn-primary">
            <i class="icofont icofont-plus"></i>
            Savol qo'shish
        </a>
    </div>

    <div class="card redial-border-light redial-shadow mb-4">
        <div class="card-body">
            <div class="col-md-6">
                <h6 class="header-title pl-3 redial-relative">{{__('data.quiz_questions.quiz_question')}}</h6>
            </div>
            <div class="col-md-6 text-right">
                <b> {!! __('data.table.count') !!}:</b> {!! $questions->total() !!}
            </div>
            <table class="table table-hover mb-0 redial-font-weight-500 table-responsive d-md-table">
                <thead class="redial-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('data.quiz_questions.type')}}</th>
                    <th scope="col">{{__('data.quiz_questions.level')}}</th>
                    <th scope="col">{{__('data.quiz_questions.content')}}</th>
                    <th scope="col">{{__('data.table.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <th scope="row">{!! $loop->iteration !!}</th>
                        <td>{{ $types[$question->type] }}</td>
                        <td>{{ $levels[$question->level] }}</td>
                        <td>{{ $question->content }}</td>
                        <td>
                            <a class="btn btn-primary"
                               href="{{route('quiz.edit_question',['question_id' => $question->id,'quiz_id' => $question->quiz_id])}}">
                                <i class="icofont icofont-pencil"></i>
                            </a>
                            <a class="btn btn-primary"
                               href="{{route('quiz.show_question',['question_id' => $question->id,'quiz_id' => $question->quiz_id])}}">
                                <i class="icofont icofont-eye"></i>
                            </a>
                            <button class="btn btn-danger" wire:click="delete({{$question->id}})">
                                <i class="icofont icofont-bin"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-12 text-center mt-3">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</div>
