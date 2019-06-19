<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Fenadoce 2019</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Marcando!</a>
    </div>
    <ul class="nav navbar-nav">
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-user"></span> </a></li>
      <li>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-in"></span>
          Sair
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>        
      </li>
    </ul>
  </div>
</nav>
  
<div class="container">

@yield('conteudo')  

</div>

</body>
</html>
