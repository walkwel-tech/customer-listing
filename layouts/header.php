<!Doctype html>
<?php
require_once 'includes/config.php';
require_once 'includes/initialize.php';
?>
    <html lang="en">

    <head>
        <!--HTML specific data-->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Site Specific Data-->
        <title>
            <?php echo (!empty($page_title)) ? $page_title : SITE_TITLE; ?>
        </title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
            crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
            crossorigin="anonymous">


        <style>
            body,  .panel{
                background: lightgreen;
            }

            .table thead tr th {
                border-bottom: soild !important;
                border-bottom-color: white;
                border-bottom-width: 4px;
            }

            tbody td {
                color: yellow;
            }

            .panel-footer {
                background: lightgreen;
            }

        </style>



        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>

    </head>

    <body>
