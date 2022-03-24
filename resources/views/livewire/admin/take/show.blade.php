<div>
    <h3>{{ $take->user->first_name . ' ' . $take->user->last_name }}</h3>
    <h4>{{ $take->user->phone }}</h4>
    <h5>{{__('data.quiz.title')}}: {{ $take->quiz->title }}</h5>
    <h5>{{__('data.quiz_answers.correct')}}: {{ $take->correct_answers }}</h5>

{{--    @dd($questions)--}}

    @foreach($questions as $question)
        <div class="col-12 col-md-12 mb-4">
            <div class="card redial-border-light redial-shadow">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td><h5>&nbsp;&nbsp; {{$question['question']}}</h5></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($question['answers'] as $answer)
                            <tr>
                                <td>&nbsp;&nbsp; {{$answer['content']}}</td>
                            </tr>
                        @endforeach
                        <tr class="{{$question['is_correct'] ? 'correct' : 'error'}}">
                            <td>
                                &nbsp;&nbsp; {{$question['user_answer']}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach


    <style>
        .error {
            color: white !important;
            background-color: #dc3545 !important;
        }

        .correct {
            color: white !important;
            background-color: #28a745 !important;
        }
    </style>
</div>
