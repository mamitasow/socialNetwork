<?php $title = "Page de Profile"; ?>
<?php include('partials/_header.php'); ?>


<!-- Begin page content -->

<div id="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="card col-6">
                <div class="card-header">
                    BIENVENUE <?= e($user->pseudo) ?>!
                </div>
                <div class="card-body">
                    <h1 c lass="card-title text-center"> </h1>
                    <div class="row">
                        <div class="col-5">
                            <img src="<?= get_avatar_url($user->email) ?>" alt="Image de profil de <?= e($user->pseudo) ?>" class="circle">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <strong><?= e($user->pseudo) ?></strong> <br>
                            <a href="mailto:<?= e($user->email) ?>"><?= e($user->email) ?></a> <br>
                            <?=
                                $user->city && $user->country ? '<i class="fa fa-location-arrow"></i>&nbsp;' . e($user->city) . ' - ' . e($user->country) . ' <br> ' : '';
                            ?>
                            <a href="https://www.google.com/maps?q=<?= e($user->city) . ' - ' . e($user->country)?>" target="_blank">Voir sur Google Maps</a>
                        </div>
                        <div class="col-6">
                            <?=
                                $user->twitter ? ' <i class="fa fa-twitter"></i> <a href="//twitter.com/' . e($user->twitter) . '">@' . e($user->twitter) . '</a></br>' : '';
                            ?>
                            <?=
                                $user->github ? '<i class="fa fa-github"></i><a href="//github.com/' . e($user->twitter) . '">' . e($user->github) . '</a></br>' : '';
                            ?>
                            <?=
                                $user->sexe == "H" ? ' <i class="fa fa-male"></i>' : '<i class="fa fa-female"></i>';
                            ?>
                            <?=
                                $user->available_for_hiring ? 'Disponible pour emploi' : 'Non disponible pour emploi';
                            ?>
                        </div>
                    </div>
                    <div class="row">
            <div class="col-12 well">
                <h5>Petite biographie de <?= e($user->name)?> </h5>
           <p>
           <?= $user->bio? nl2br(e($user->bio)):"aucune biographie pour le moment...!";?>
           </p>
            </div>
        </div>
                </div>
            </div>
            
            <div class="card col-6">
                <div class="card-header">
                    Completer le profil
                </div>
                <div class="card-body">
                    <h1 class="card-title text-center"></h1>

                    <?php include('partials/_errors.php') ?>

                    <form method="post" class="well" autocomplete="off">
                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nom:<span class="text-danger">*</span></label>
                                    <input type="text" value="<?=get_input('name')?get_input('name'):e($user->name)  ?>" class="form-control" id="name" name="name" placeholder="sow" />
                                </div>
                                <div class="form-group">
                                    <label for="city">Ville:<span class="text-danger">*</span></label>
                                    <input type="text" value="<?= e($user->city) ?>" class="form-control" id="city" name="city" />
                                </div>

                                <div class="form-group">
                                    <label for="country">Pays:<span class="text-danger">*</span></label>
                                    <input type="text" value="<?= e($user->country)  ?>" class="form-control" id="country" name="country">
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sexe">Sexe:<span class="text-danger">*</span></label>
                                    <select name="sexe" id="sexe" class="form-control">
                                        <option value="H"<?= $user->sexe=="H"?"selected":""  ?> >Homme</option>
                                        <option value="F" <?= $user->sexe=="F"?"selected":""  ?>>Femme</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="twitter">twitter </label>
                                    <input type="text" value="<?= e($user->twitter)  ?>" class="form-control" id="twitter" name="twitter">
                                </div>
                                <div class="form-group">
                                    <label for="github">Github: </label>
                                    <input type="text" value="<?= e($user->github)  ?>" class="form-control" id="github" name="github">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="available_for_hiring"><span class="text-danger">*</span>
                                        <input type="checkbox" id="available_for_hiring" name="available_for_hiring" <?= $user->available_for_hiring?"check ed":""  ?>/>
                                        Disponible pour emploi?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="bio">Biographie:<span class="text-danger">*</span> </label>
                                    <textarea name="bio" id="bio" cols="30" rows="10" class="form-control" placeholder="Je suis un amoureux de la programmation.... "><?= e($user->bio) ?> </textarea>

                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Valider" name="update" />

                    </form>
                </div>
            </div>
           
        </div>
       
    </div>
</div>
<?php include('partials/_footer.php'); ?>