@extends('emails.layout')

@section('content')
    <h1>Félicitations {{ $admin->nom }},</h1>

    <p>Un compte administrateur a été créé pour vous sur la plateforme <strong>{{ config('app.name') }}</strong>.</p>

    <p>Vous pouvez désormais vous connecter à l'interface de gestion en utilisant les accès confidentiels ci-dessous :</p>

    <div class="highlight-box">
        <span class="label">Email de connexion</span>
        <div class="value">{{ $admin->email }}</div>

        <span class="label">Mot de passe temporaire</span>
        <div class="value">{{ $plainPassword }}</div>
    </div>

    <p>Pour des raisons de sécurité, nous vous recommandons vivement de modifier ce mot de passe dès votre première
        connexion.</p>

    <a href="{{ config('app.frontend_url') }}/login" class="button">Se connecter</a>

    <div class="divider"></div>

    <p>Si vous avez des questions, n'hésitez pas à répondre à cet email ou à contacter l'équipe support.</p>

    <p>Cordialement,<br>L'équipe {{ config('app.name') }}</p>
@endsection
