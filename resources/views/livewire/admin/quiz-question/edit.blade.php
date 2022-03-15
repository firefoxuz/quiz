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
                            <label class="redial-font-weight-600">{{__('data.quiz_questions.type')}}</label>
                            <select class="form-control" wire:model.defer="type" disabled>
                                <option value="" >{{__('data.quiz_questions.select')}}</option>
                                @foreach($types as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz_questions.level')}}</label>
                            <select class="form-control" wire:model.defer="level">
                                <option value="" >{{__('data.quiz_questions.select')}}</option>
                                @foreach($levels as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="redial-font-weight-600">{{__('data.quiz_questions.content')}}</label>
                            <textarea type="text" class="form-control" wire:model.defer="content"
                                      placeholder="{{__('data.quiz_questions.content')}}"></textarea>
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

