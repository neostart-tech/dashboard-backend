@extends('emails.layout')

@section('content')
    <h1>Nouveau message de contact</h1>

    <p>Une nouvelle demande a été soumise via le formulaire de contact de <strong>{{ config('app.name') }}</strong>.</p>

    <h2>Détails du message</h2>

    <div class="highlight-box">
        <span class="label">Expéditeur</span>
        <div class="value">{{ $messageData->expediteur }}</div>

        <span class="label">Email</span>
        <div class="value"><a href="mailto:{{ $messageData->email }}" style="color: #05299E;">{{ $messageData->email }}</a>
        </div>

        <span class="label">Téléphone</span>
        <div class="value">{{ $messageData->telephone }}</div>

        <span class="label">Objet</span>
        <div class="value">{{ $messageData->objet ?? 'Sans objet' }}</div>
    </div>

    @if ($messageData->type || $messageData->budget || $messageData->date_prevue)
        <h2>Informations complémentaires</h2>
        <div class="highlight-box">
            @if ($messageData->type)
                <span class="label">Type de service</span>
                <div class="value">{{ $messageData->type }}</div>
            @endif

            @if ($messageData->budget)
                <span class="label">Budget</span>
                <div class="value">{{ $messageData->budget }}</div>
            @endif

            @if ($messageData->date_prevue)
                <span class="label">Date prévue</span>
                <div class="value">{{ $messageData->date_prevue }}</div>
            @endif
        </div>
    @endif

    <h2>Message</h2>
    <div class="highlight-box" style="border-left-color: #05299E;">
        <p style="margin-bottom: 0;">{{ $messageData->contenu }}</p>
    </div>

    <a href="{{ config('app.frontend_url') }}/admin/messages" class="button">Voir dans l'administration</a>
@endsection
