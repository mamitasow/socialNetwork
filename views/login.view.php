<?php $title="Connexion";?>
<?php include('partials/_header.php');?>


<!-- Begin page content -->

<div id="main-content">
<div class="container-fluid">
<div class="card col-6">
  <div class="card-header">
    CONNEXION
  </div>
  <div class="card-body">
    <h1 class="card-title text-center"> Connexion!</h1>
   
   <?php include('partials/_errors.php') ?>

    <form data-parsley-validate method="post" class="well">
  <div class="form-group">
    <label for="identifiant">Pseudo ou Adresse électronique</label>
    <input type="text" data-parsley-trigger="keypress" data-parsley-minlength="3" value="<?= get_input('identifiant')?>" class="form-control" id="identifiant" name="identifiant" required="required"/>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" data-parsley-minlength="6" data-parsley-trigger="keypress" class="form-control" id="password" placeholder="Password" name="password" required="required">
  </div>
 
  <input type="submit" class="btn btn-primary" value="Connexion" name="login"/>

</form>
  </div>
</div>
  </div>
</div>
  <?php include('partials/_footer.php');?>

 