<!DOCTYPE html>
<html>
<head>
	<title>Laravel Category Treeview Example</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <link href="{{ asset('css/treeview.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@php($route = Request::route()->getName())
    
{{$route}}
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <!-- <li class="active"><a href="#">Home</a></li> -->
      <li class ="@if($route == 'category') {{ 'active' }} @endif"><a href="{{ url('category') }}">Category</a></li>
      <li class="@if($route == 'category-tree-view') {{ 'active' }} @endif"><a href="{{url('category-tree-view')}}">Add Category</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a  href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form></li>
    </ul>
  </div>
</nav>
        
<div class="content">
<div class="container"> 
    @yield('content') 
    </div>
</div>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/treeview.js')}}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
</body>
</html>