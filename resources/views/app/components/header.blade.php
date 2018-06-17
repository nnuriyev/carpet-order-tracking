<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{--<img src="{{asset('admin-assets/images/img.jpg')}}" alt="">--}}
                        {{Auth::user()->name}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right" style="width: 120px">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out pull-right"></i> Çıxış
                            </a>
                        </li>
                    </ul>
                </li>
                @php($notifications = Auth::user()->getUnreadNotification())
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        @if($notifications->count() > 0)
                        <span class="badge bg-green">{{$notifications->count()}}</span>
                        @endif
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        @foreach($notifications as $notif)
                        {{dump($notif['order'])}}
                        <li>
                        <a href="{{route('notificationRead', $notif['notification']->id)}}">
                            <span class="image"><img src="{{Storage::url($notif['order']->getImage())}}"></span>
                            <span>
                                <span>{{$notif['user']->name}}</span>
                                <span class="time">{{ date('d-m-Y h:i', strtotime($notif['notification']->created_at)) }}</span>
                            </span>
                            <span class="message">
                                ID-si <b>{{$notif['order']->id }}</b> olan sifariş 
                                <b>{{$notif['orderLevel']->name}}</b> mərhələsindədir.
                            </span>
                        </a>
                        </li>
                        @endforeach
                        
                    </ul>
                </li>
            </ul>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </nav>
    </div>
</div>