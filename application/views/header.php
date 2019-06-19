<!DOCTYPE html>
<html lang="EN">
    <head>
        <meta charset="UTF-8"/>
        <title>Tight Underpoints</title>
        <meta name="author" content="Daniel Hilbrand"/>
        <meta name="generator" content="Visual Studio Code"/>
        <meta name="description" content="Tight Underpoints - An application for DKP Management"/>
        <meta name="language" content="EN"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/logo.ico">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
            body {
                background-image: url(<?php echo base_url()?>assets/img/pattern.png);
                background-repeat: repeat;
            }
            .logo-text {
                color: #D74B27;
                font-size: 50px;
                font-weight: bold;
                text-shadow: #286d67 6px 6px 8px;
                -webkit-text-stroke: 1px black;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid p-3">
            <div class="row">
                <div class="mx-auto">
                    <?php
                        if (isset($this->session->logged_in)) {
                            echo "<a href='" . site_url();
                            switch ($this->session->type) {
                                    case 1:
                                        echo "admins'>";
                                        break;
                                    case 2:
                                        echo "officers'>";
                                        break;
                                    default:
                                        echo "members'>";
                                }
                        }
                    ?>
                    <img src="<?php echo base_url()?>assets/img/logo.PNG" alt="Responsive Logo" height="150px"><h1 class="logo-text d-inline-block ml-3">Tight Underpoints</h1>
                    <?php
                        if (isset($this->session->logged_in)) {
                            echo '</a>';
                        }
                    ?>
                </div>
            </div>
