<?php if(!class_exists('Rain\Tpl')){exit;}?><!doctype html>
<html lang="pt">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="/res/site/css/bootstrap.css">
       <!--  <link rel="stylesheet" type="text/css" href="css/cover.css"> -->
    <link rel="stylesheet" type="text/css" href="/res/site/css/all.css">
    <link rel="stylesheet" type="text/css" href="/res/site/css/style.css">
    <link rel="stylesheet" type="text/css" href="/res/site/css/hover1.css">
    <link rel="stylesheet" type="text/css" href="/res/site/css/magnificpopup.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900&display=swap" rel="stylesheet">
 <link href='https://fonts.googleapis.com/css?family=Raleway:400,700|Merriweather' rel='stylesheet' type='text/css'>
    <title>Glen Leão | Design & Dev</title>
  </head>
  <body>
    <!-- jumbotron -->
    <div class="jumbotron jumbotron-fluid mb-0" style="background: #2c446e;">
  <div class="container topo">
    <h1>GLEN LEÃO | Design & Dev</h1>
    <p>Identidade visual e Desenvolvimento Web</p>
  </div>
</div>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav mx-auto">
     <?php require $this->checkTemplate("categoria-menu");?>
    </div>
  </div>

</nav>
<!-- /navbar -->