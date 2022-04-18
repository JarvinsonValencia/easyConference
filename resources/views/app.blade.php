<!DOCTYPE html>
<html>

@include('sections.head')

<body class="hold-transition sidebar-mini">
  <div class="wrapper" id="app">
    <App ruta= "{{route( 'basePath' )}}"></App>

  </div>

  @include('sections.script')
</body>


</html>