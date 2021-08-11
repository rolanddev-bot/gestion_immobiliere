<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="{{url('/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <style>
            button{
           background-color:#DC143C;
           font-size:26px;
           color: white;
           border-radius: 20px;
				
           }
			button:hover{
				background-color:#FF143C;
				border:none
			}
        </style>
    </head>
    <body class="bg-info">
 <br><br><br><br><br>

     <div style="text-align: center;">
<p align="center">
<img src="{{  url('assets/img/zenys_logo2.png') }}" alt="" class="logo_zenys">
</p>
        
        
        <a href="{{url('login')}}">
			<button type="button" id="button_gestion" style="height: 120px; width:300px;">GESTION LOCATIVE</button>
		 </a>
           
            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
         <a href="{{url('login')}}">
            <button  type="button" style="height: 120px; width:300px">TRANSACTION</button>
         </a>
         </div> <br><br>
         
        



    </div>
    <script type="text/javascript" src="{{url('/assets/messcripts/dashboard.js')}}"></script>

    </body>

</html>
