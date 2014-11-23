<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--   <div class="row">
               <div class="col-md-1">.col-md-1</div>
               <div class="col-md-1">.col-md-1</div>
           </div>-->
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-2 col-xs-2">LOGO</div>
                <div class="col-md-2 col-xs-0"></div>
                <div class="col-md-4 col-xs-10">
                    <input type="text" class="form-control" placeholder="Procurar votação">
                </div>
                <div class="col-md-4 col-xs-0"></div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 sidebar">
                    <form action="" method="post">
                        <lable>
                            Email:<br>
                            <input type="email" name="email">
                        </lable><br>
                         <lable>
                            Password:<br>
                            <input type="password" name="password">
                        </lable><br>
                            <input type="submit" value="Login">
                        
                    </form>

                    <br><br><br><br>
                    
                    <form action="" method="post">
                        <lable>
                            Nome:<br>
                            <input type="text" name="full_name">
                        </lable><br>
                        <lable>
                            Email:<br>
                            <input type="email" name="email">
                        </lable><br>
                        <lable>
                            Password:<br>
                            <input type="password" name="password">
                        </lable><br>
                        <lable>
                            Repita a password:<br>
                            <input type="password" name="birthday">
                        </lable><br>
                        <lable>
                            Data nascimento:<br>
                            <input type="date" name="re_password">
                        </lable><br>
                        <input type="submit" value="Registar">
                    </form>

                    
                    




                </div>
                <div class="col-md-10">CONTEUDO CONTEUDO CONTEUDO CONTEUDO
                    CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO CONTEUDO 

                </div>





            </div>
            <button> MENU </button>

        </div>
        <style>
            @media (max-width: 992px) {
                .sidebar{
                    position:absolute;
                    left:-20%;
                    top:0;
                    bottom:0;
                    z-index:10;
                    width:20%;
                }
                .sidebar.active{
                    left:0;
                }
            }

            .sidebar{
                background:white;

                -webkit-transition: all 0.2s ease-in-out;
                -moz-transition: all 0.2s ease-in-out;
                -o-transition: all 0.2s ease-in-out;
                transition: all 0.2s ease-in-out;
            }

            
            input::-webkit-calendar-picker-indicator{
                display: none;
            }


            input[type="date"]::-webkit-input-placeholder{ 
                visibility: hidden !important;
            }
            
        </style>

        <!--       <div class="row">
                   <div class="col-md-8">.col-md-8</div>
                   <div class="col-md-4">.col-md-4</div>
               </div>
               <div class="row">
                   <div class="col-md-4">.col-md-4</div>
                   <div class="col-md-4">.col-md-4</div>
                   <div class="col-md-4">.col-md-4</div>
               </div>
               <div class="row">
                   <div class="col-md-6">.col-md-6</div>
                   <div class="col-md-6">.col-md-6</div>
               </div>
       
        -->


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


        <script type="text/javascript">
            $("button").on('click', function() {
                $(".sidebar").toggleClass("active");

            });
        </script>



        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>