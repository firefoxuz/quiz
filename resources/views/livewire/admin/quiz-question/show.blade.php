<div>

    <div class="text-right mt-2 mb-2">
        <a href="{{ route('quiz.store_answer',['quiz_id' => $quiz_id, 'question_id' => $question_id]) }}"
           class="btn btn-primary">
            <i class="icofont icofont-plus"></i>
            Javob qo'shish
        </a>
    </div>

    <div class="card redial-border-light redial-shadow mb-4">
        <div class="card-body">
            <div class="col-md-6">
                <h6 class="header-title pl-3 redial-relative">{{__('data.quiz_answers.quiz_answer')}}</h6>
            </div>
            <div class="col-md-6 text-right">
                <b> {!! __('data.table.count') !!}:</b> {!! $answers->total() !!}
            </div>
            <table class="table table-hover mb-0 redial-font-weight-500 table-responsive d-md-table">
                <thead class="redial-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('data.quiz_answers.correct')}}</th>
                    <th scope="col">{{__('data.quiz_answers.content')}}</th>
                    <th scope="col">{{__('data.table.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($answers as $answer)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$answer->correct}}</td>
                        <td>{{ $answer->content }}</td>
                        <td>
                            <a class="btn btn-primary"
                               href="{{route('quiz.edit_answer',['question_id' => $answer->question_id,'quiz_id' => $answer->quiz_id, 'answer_id' => $answer->id])}}">
                                <i class="icofont icofont-pencil"></i>
                            </a>
                            <button class="btn btn-danger" wire:click="delete({{$answer->id}})">
                                <i class="icofont icofont-bin"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-12 text-center mt-3">
                {{ $answers->links() }}
            </div>
        </div>
    </div>
</div>
