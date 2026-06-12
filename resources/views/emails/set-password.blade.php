<p>Bonjour,</p>

<p>Votre compte GEFOR a été créé.</p>

<p>Cliquez sur le lien ci-dessous pour définir votre mot de passe :</p>

{{-- On construit l'URL avec le token et l'email en paramètres --}}
{{-- L'utilisateur cliquera sur ce lien pour arriver sur le formulaire --}}

<a href="{{ url('/set-password?token=' . $token . '&email=' . $email) }}">
    Créer mon mot de passe
</a>

<p>Ce lien est valable 24h.</p>