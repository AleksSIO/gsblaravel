@extends ('modeles/visiteur')



<div class="flex flex-col items-center justify-center w-screen h-screen bg-blue-100 text-gray-700">
    <h1 class="font-bold text-2xl">Identification utilisateur</h1>
    <form class="flex flex-col bg-white rounded shadow-lg p-12 mt-12" method="POST" action="">
        {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        @includeWhen($erreurs != null , 'msgerreurs', ['erreurs' => $erreurs])
<<<<<<< HEAD
        <label class="font-semibold text-xs" for="usernameField">Username</label>
        <input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2" type="text" id="login" type="text" name="login">
        <label class="font-semibold text-xs mt-3" for="passwordField">Password</label>
        <input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2" type="password" id="mdp" type="password" name="mdp">
        <button class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700" type="submit" value="Valider" name="valider">Login</button>
    </form>
</div>
=======
        <p>
        <label for = "nom">Login*</label>
        <input id = "login" type = "text" name = "login"  size = "30" maxlength = "45" required >
        </p>
        <p>
        <label for = "mdp">Mot de passe*</label>
        <input id = "mdp"  type = "password"  name = "mdp" size = "30" maxlength = "45" required>
        </p>
       <input type = "submit" value = "Valider" name = "valider">
       <input type = "reset" value = "Annuler" name = "annuler">
        </p>
    </form>
</div>
@endsection


>>>>>>> bb521cac9355951549e0cee138ef59da0bd438ba
