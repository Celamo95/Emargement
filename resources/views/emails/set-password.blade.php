<p>Bonjour,</p>

<p>Une demande de définition de mot de passe a été effectuée pour votre compte GEFOR.</p>

<p>Cliquez sur le lien ci-dessous pour définir votre mot de passe :</p>

{{-- On construit l'URL avec le token et l'email en paramètres --}}
{{-- L'utilisateur cliquera sur ce lien pour arriver sur le formulaire --}}

<a href="{!!route('set.password.form', ['token' => $token, 'email' => $email])!!}">
    Créer mon mot de passe
</a>

<p>Ce lien est valable 24h.</p>