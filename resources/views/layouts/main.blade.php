<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Cex Test</title>

  <link href="/assets/css/site.css" rel="stylesheet">
  <style>
      .error{
          color:red
      }    
  </style>
  @yield('styles')

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
    <div class="container">
        
         <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Cex Test</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="<?php echo strlen(\Request::route()->getName())<=0? 'active' : ''; ?>"><a href="/">Home</a></li>
             
           
            </ul>
            <ul class="nav navbar-nav navbar-right">
            
               
              <li class="<?php echo strpos(\Request::route()->getName(),'profiles')!==false ? 'active' : ''; ?>"><a href="/profiles" >Manage Profile</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
         
       <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        @yield('content')
      </div>     
        
        
    </div>




<script src="/assets/js/site.js"></script>

@yield('scripts')

</body>
</html>