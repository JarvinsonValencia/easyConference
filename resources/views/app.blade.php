<!DOCTYPE html>
<html>

@include('sections.head')

<body class="hold-transition sidebar-mini">
  <div class="wrapper" id="app">
  
                    
    @if (Auth::check())
      <App ruta= "{{route( 'basePath' )}}" :user="{{Auth::user()}}"></App>
    @else
      <Auth ruta= "{{route( 'basePath' )}}"></Auth>
    @endif

 
  </div>

  @include('sections.script')
</body>


</html>