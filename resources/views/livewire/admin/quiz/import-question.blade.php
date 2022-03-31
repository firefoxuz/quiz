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
        <div class="col-md-7">
            <div class="card redial-border-light redial-shadow mb-4">
                <div class="card-body">
                    <h6 class="header-title pl-3 redial-relative">{{__('data.quiz.import')}}</h6>

                    <div class="form-group">
                        <label class="redial-font-weight-600">{{__('data.quiz_questions.quiz_question')}}</label>
                        <textarea type="text" id="text" class="form-control"
                                  placeholder="{{__('data.quiz.template')}}" style="height: 500px;"></textarea>
                    </div>
                    <div class="redial-divider my-4"></div>
                    <div class="text-right">
                        <button type="button" onclick="format()"
                                class="btn btn-primary btn-xs">{{__('data.quiz.format')}}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card redial-border-light redial-shadow mb-4">
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div id="view">

                        </div>
                        @if($questions)
                            @foreach($questions as $question)
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td><h6>&nbsp;&nbsp;{{$loop->iteration}}. {{$question['question']}} </h6></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--                                    @dump($question)--}}
                                    @foreach($question['answers'] as $answer)
                                        <tr>
                                            <td class="{{$answer['is_correct'] ? 'correct' : ''}}">
                                                {{$answer['answer']}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        @endif
                        <button type="submit" class="btn btn-primary btn-xs">{{__('data.table.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
@section('scripts')
    <script !src="">


        function format() {
            const tests = [];
            let test = {
                question: '',
                answers: [],
            };
            var text = document.getElementById('text').value
            var split_text = text.split('++++');
            if (split_text[split_text.length - 1] === '') {
                split_text.pop();
            }
            split_text.forEach(function (line, index) {
                line.split('====').forEach(function (s, i) {
                    if (i === 0) {
                        test.question = trim(s);
                    } else {
                        s = trim(s);
                        is_correct = isCorrect(s);
                        ans = deleteHashTag(s);
                        test.answers.push({answer: ans, is_correct: is_correct});
                    }
                })

                tests.push(test);
                test = {
                    question: '',
                    answers: [],
                };
            });
            Livewire.emit('format', tests);
            console.log(tests);
        }

        function trim(text) {
            return text.replace(/^\s+|\s+$/g, '').replace(/\n/g, ' ');
        }

        function deleteHashTag(text) {
            return text.replace(/#/g, '');
        }

        function isCorrect(text) {
            return text[0] === '#';
        }

    </script>
@endsection
