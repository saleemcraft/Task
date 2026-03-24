<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel Crud |Saleem</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />
  </head>
  <body>
    <nav class="navbar navbar-expand bg-black">
      <div class="container-fluid">
        <a href="/" class="navbar-brand text-light">Laravel CRUD</a>
      </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
          @if($message=Session::get('success'))
          <div class="alert alert-success alert-dismissible fade show">
            <strong>Success </strong>{{$message}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
          </div>
          @endif
            @yield ('main')
        </div>
      <!--container end-->
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
