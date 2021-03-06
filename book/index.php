<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" href="css/custom.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- normalize CSS -->
    <link rel="stylesheet" href="css/extra/normalize.min.css">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" media="screen" href="css/css_bootstrap/bootstrap.min.css">
    <!-- icone from awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>Books </title>
</head>
<body>
<div class="jumbotron">
    <h1>Wypożyczalnia książek</h1>
    <p>Witaj w mojej wypożyczalni książek</p>
</div>

<!-- div okalajacy cala szerokosc strony-->
<div class="container">
    <div class="row">
       <div class="col-md-12 col-lg-12">
        <!-- formularz dodający książki zawierający nazwy autora i opis -->
           <form action="" class="form-horizontal"> <!-- form-horisontal formatuje tak aby lable były w linii z input -->
               <div class="form-group">
                   <lable for="bookName" class="col-sm-3">Nazwa książki: </lable>
                   <div class="col-sm-9">
                       <input type="text" name="bookName" id="bookName" class="form-control" >
                   </div>
               </div>

               <div class="form-group">
                   <lable for="bookAuthor" class="col-sm-3">Autor książki: </lable>
                   <div class="col-sm-9">
                       <input type="text" name="bookAuthor" id="bookAuthor" class="form-control" >
                   </div>
               </div>

               <div class="form-group">
                   <lable for="bookDescription" class="col-sm-3">Opis książki: </lable>
                   <div class="col-sm-9">
                       <textarea name="bookDescription" id="bookDescription" class="form-control" ></textarea>
                   </div>
               </div>

               <div class="form-group">
                   <div class="col-sm-3"></div>
                   <div class="col-sm-9">
                       <button type="submit" class="btn btn-default codersAjax" data-method="POST">
                           <i class="fa fa-plus-circle"></i>&nbsp;Dodaj książkę <!-- <i> dowolny element liniowy-->
                       </button>
                       <button type="submit" class="btn btn-default codersAjaxAll" data-method="GET">
                           <i class="fa fa-book"></i>&nbsp;Zobacz książki <!-- <i> dowolny element liniowy-->
                       </button>
                   </div>
               </div>
           </form>
       </div>
    </div>
    <div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="books">

                </div>
            </div>
        </div>

    </div>

</div>
<!-- Modal offer-->
<div class="modal fade" id="alert_small" tabindex="-1" role="dialog" aria-labelledby="alert_small">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="alert alert-success">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-title"><b>Błąd</b></div>
                </div>
                <div class="modal-text"></div>
            </div>
        </div>
    </div>
</div>


<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/js_bootstrap/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>

