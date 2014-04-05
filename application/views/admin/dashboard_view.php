<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= base_url() ?>/favicon.ico">

    <title>Administrator Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>css/<?= $theme ?>/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url() ?>css/dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?= $title ?> - <small>Welcome <b><?= $user ?></b>!</small></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?= base_url() ?>admin/index">Dashboard</a></li>
            <li><a href="<?= base_url() ?>admin/add">Add</a></li>
            <li><a href="<?= base_url() ?>admin/logout">Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right" method="POST">
            <input type="text" class="form-control" name="search" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="<?= base_url() ?>admin/index">Overview</a></li>
            <li><a href="<?= base_url() ?>admin/add">Add Project</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Project Title</th>
                  <th>Project Link</th>
                  <th>Language</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    foreach($results as $data) {
                        echo '<tr>
                              <td>'.$data->id.'</td>
                              <td>'.$data->title.'</td>
                              <td>'.$data->link.'</td>
                              <td>'.$data->language.'</td>
                              <td><a class="btn btn-primary" href="'.base_url().'admin/edit/'.$data->id.'">Edit</a></td>
                            </tr>';
                    }
                    ?>
              </tbody>
            </table>
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <?= $links ?>
                </ul>
            </div>
        </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>js/docs.min.js"></script>
  </body>
</html>
