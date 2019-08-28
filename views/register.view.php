<?php $title="Inscription";?>
<?php include('partials/_header.php');?>


<!-- Begin page content -->

<div id="main-content">
<div class="container-fluid">
<div class="card col-6">
  <div class="card-header">
    INSCRIPTION
  </div>
  <div class="card-body">
    <h1 class="card-title text-center">  Devenez dés a present membre!</h1>
   
   <?php include('partials/_errors.php') ?>

    <form data-parsley-validate method="post" class="well">
    <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" value="<?= get_input('name') ?>" class="form-control" id="name"  name="name" required="required"/>
  </div>
  <div class="form-group">
    <label for="pseudo">Pseudo:</label>
    <input type="text" data-parsley-trigger="keypress" data-parsley-minlength="3" value="<?= get_input('pseudo')?>" class="form-control" id="pseudo" name="pseudo" required="required"/>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" data-parsley-trigger="keypress" value="<?= get_input('email')?>" class="form-control" id="email" placeholder="name@example.com" name="email" required="required">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" data-parsley-minlength="6" data-parsley-trigger="keypress" class="form-control" id="password" placeholder="Password" name="password" required="required">
  </div><div class="form-group">
    <label for="password_confirm">Password Confirm </label>
    <input type="password" data-parsley-minlength="6" data-parsley-trigger="keypress"   class="form-control" id="password_confirm" placeholder="Password" name="password_confirm" required="required" data-parsley-equalto="#password">
  </div>
  <input type="submit" class="btn btn-primary" value="Inscription" name="register"/>

</form>
  </div>
</div>
  </div>
</div>
  <?php include('partials/_footer.php');?>

 