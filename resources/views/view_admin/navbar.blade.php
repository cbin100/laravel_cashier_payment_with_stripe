<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{-- -}}<i class="far fa-comments"></i>{{-- --}}
                @php
                $is_read = \App\Models\Contact::where('folder', 'inbox')->where('is_read', 0)->count();
                @endphp
                <i class="far fa-envelope"></i>
                @if($is_read)
                {{-- --}}<span class="badge badge-danger navbar-badge">{{ $is_read }}</span> {{-- --}}
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @php
                $message_notifications = \App\Models\Contact::latest()->where('folder', 'inbox')->where('is_read', 0)->limit(5)->get();
                @endphp
                @if(!empty($message_notifications) && $message_notifications->count())
                @foreach($message_notifications as $message)
                <a href="{{ route('messages.show', $message->id) }}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        {{-- -}}<img src="{{ asset('t_admin/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">{{-- --}}
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{$message->name}}
                                <span class="float-right text-sm text-danger">{{-- -}}<i class="fas fa-star"></i> {{-- --}}</span>
                            </h3>
                            <p class="text-sm">{{$message->subject}}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                @endforeach
                @endif

                <div class="dropdown-divider"></div>
                <a href="{{ url('messages') }}" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>




        <!-- PROFILE Dropdown Menu -->
        <li class="nav-item dropdown">

        </li>





        <!--PROFILE Dropdown Menu-->

        <div class="user-info-dropdown">
            <div class="dropdown"> Hi,
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-name"> {{ Auth::user()->name }} </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="#profile"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="#profile"><i class="dw dw-settings2"></i> Setting</a>
                    <a class="dropdown-item" href="#faq.html"><i class="dw dw-help"></i> Help</a>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>




        <!--
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
             -->
    </ul>
</nav>
<!-- /.navbar -->

