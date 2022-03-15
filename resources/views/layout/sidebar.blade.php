<nav id="sidebar" class="card redial-border-light px-2 mb-4">
    <div class="sidebar-scrollarea">
        <ul class="metismenu list-unstyled mb-0" id="menu">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard pr-1"></i> Dashboard</a></li>
            <li>
                <a class="has-arrow" href="#" data-toggle="collapse" aria-expanded="false"><i
                            class="icofont icofont-test-tube-alt pr-1"></i> {{__('data.quiz.quiz')}}</a>
                <ul class="collapse list-unstyled">
                    <li><a href="{{route('quizzes.index')}}" class="icofont icofont-list"> {{__('data.quiz.quiz')}}</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="#" data-toggle="collapse" aria-expanded="false"><i
                            class="icofont icofont-ui-user pr-1"></i> {{__('data.user.api_user')}}</a>
                <ul class="collapse list-unstyled">
                    <li><a href="{{route('api_users.index')}}" class="icofont icofont-list"> {{__('data.user.list')}}</a></li>
                    <li><a href="{{route('api_users.create')}}" class="icofont icofont-plus"> {{__('data.user.new')}}</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="#" data-toggle="collapse" aria-expanded="false"><i
                            class="icofont icofont-ui-user pr-1"></i> {{__('data.user.user')}}</a>
                <ul class="collapse list-unstyled">
                    <li><a href="{{route('user.index')}}" class="icofont icofont-list"> {{__('data.user.list')}}</a></li>
                    <li><a href="{{route('user.create')}}" class="icofont icofont-plus"> {{__('data.user.new')}}</a></li>
                </ul>
            </li>
            <li>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <a onclick="" ><i class="icofont icofont-exit"></i> {{__('data.site.logout')}}</a>
                </form>
            </li>
        </ul>
    </div>
</nav>
