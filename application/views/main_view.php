<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portfolio</title>

    <link href="<?= base_url() ?>css/<?= $theme ?>/bootstrap.css" rel="stylesheet">

    <link href="<?= base_url() ?>css/1-col-portfolio.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
              <!--  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> -->
                <a class="navbar-brand" href="#"><?= $title ?></a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
               <!--     <li><a href="#about">About</a>
                    </li>
                    <li><a href="#services">Services</a>
                    </li>
                    <li><a href="#contact">Contact</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Portfolio</h1>
            </div>

        </div>
<?php
foreach($results as $data) {
    echo '<div class="row">

            <div class="col-lg-7 col-md-7">
                <a href="'.$data->link.'">
                    <img class="img-responsive" src="'.$data->image_url.'" alt="">
                </a>
            </div>

            <div class="col-lg-5 col-md-5">
                <h3>'.$data->title.'</h3>
                <h4>'.$data->subheader.'</h4>
                <p>'.$data->text.'</p>
                <a class="btn btn-primary" href="'.$data->link.'">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>

        </div>

        <hr>';
}
?>

        <div class="row text-center">

            <div class="col-lg-12">
                <ul class="pagination">
                    <?= $links ?>
                </ul>
            </div>

        </div>

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Robin Rijkeboer 2014</p>
                    <p>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- JavaScript -->
    <script src="<?= base_url() ?>js/jquery-1.10.2.js"></script>
    <script src="<?= base_url() ?>js/bootstrap.js"></script>

</body>

</html>
