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
        <div class="col-md-12">
            <div class="card redial-border-light redial-shadow mb-4">
                <div class="card-body">
                    <h6 class="header-title pl-3 redial-relative">{{__('data.quiz.new')}}</h6>
                    <form wire:submit.prevent="create">
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz.title')}}</label>
                            <input type="text" class="form-control" wire:model.defer="title"
                                   placeholder="{{__('data.quiz.title')}}"/>
                        </div>
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz.summary')}}</label>
                            <input type="text" class="form-control" wire:model.defer="summary"
                                   placeholder="{{__('data.quiz.summary')}}"/>
                        </div>

                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz.count')}}</label>
                            <input type="text" class="form-control" wire:model.defer="count"
                                   placeholder="{{__('data.quiz.count')}}"/>
                        </div>

                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz.attempts')}}</label>
                            <input type="text" class="form-control" wire:model.defer="attempts"
                                   placeholder="{{__('data.quiz.attempts')}}"/>
                        </div>


                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz.time_limit')}}</label>
                            <input type="text" class="form-control" wire:model.defer="time_limit"
                                   placeholder="{{__('data.quiz.time_limit')}}"/>
                        </div>


                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz.starts_at')}}</label>
                            <input type="text" id="starts_at" class="datetime form-control" wire:model.defer="starts_at">
                        </div>
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz.ends_at')}}</label>
                            <input type="text" id="ends_at" class="datetime form-control" wire:model.defer="ends_at">
                        </div>
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz.content')}}</label>
                            <textarea type="text" class="form-control" wire:model.defer="content"
                                      placeholder="{{__('data.quiz.content')}}"></textarea>
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
@section('scripts')
    <script>
        $('.datetime').each(function () {
            $(this).datepicker({
                'format': 'dd.mm.yyyy',
                'autoclose': true,
                'startDate': '-3d'
            }).on('changeDate', function(e) {
                e.value = e.target.value;
                var element = document.getElementById(e.target.id);
                element.dispatchEvent(new Event('input'));
                console.log(e);
            });
        });
    </script>
@endsection
