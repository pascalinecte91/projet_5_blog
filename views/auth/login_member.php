<?php if (!empty($error)): ?>
    <div class="dismiss_medium">
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
           <p> Merci de verifier les champs pour acceder aux membres !</p>
            
        </div>
    </div>

<?php endif; unset($_SESSION['error']);?> 
<div class="container">
    <div class="d-flex justify-content-center mb-5">
        <div class="row" id="login">
            <div class="col-12 text-left">
                <form  action ="<?= $router->url('login_member') ?>" method="POST" name="login_member" >
                    <h3 class="box-title text-center mt-3"> MEMBRES : Connectez-vous ici</h3><br>
                    <label for="Pseudo"> Pseudo</label>
                    <input type="text"  name="username" class="form-control my-3" required />
                    <label for="mot de passe">Mot de Passe</label>
                    <input type="password" name="password" class="form-control my-3" required />
                        <div class="d-flex justify-content-center"><br>
                        <button type="submit" name="connexion" class="btn btn-danger mt-5 ">LOGIN ->
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-emoji-smile" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1
                              .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0
                              .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z" />
                        </svg>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
                