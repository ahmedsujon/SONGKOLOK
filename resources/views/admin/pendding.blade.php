<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
       <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />

       <style>

      
       	.content{
       		width: 100%;
       		padding: 60px 60px;
       		background: #3D9970;
       		margin-top: 100px;
       	}
       	.content h1{
       		color: #FFF;
       		text-align: center;
       	}
      
       </style>

    </head>
    <body class="bg-black">

       <div class="container">
    		<div class="wrapper content"> 
          <h1>{{Session('message')}}</h1>
    			<h1>Your Registration is pending.When admin approve your registration then you can entry the dashboard</h1>
    		</div>
       		
       </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>      

    </body>
</html>