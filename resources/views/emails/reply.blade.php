@extends('emails.layout')

@section('content')
    <h1>Réponse à votre message</h1>

    <p>Bonjour,</p>
    <p>L'équipe <strong>{{ config('app.name') }}</strong> a répondu à votre demande concernant :
        <strong>{{ $originalMessage->objet }}</strong>.</p>

    <div class="highlight-box" style="border-left-color: #05299E;">
        {!! $replyContent !!}
    </div>

    <div class="divider"></div>

    <h2>Rappel de votre message :</h2>
    <div class="highlight-box" style="background-color: #f8fafc; border-left-color: #cbd5e1;">
        {!! nl2br(e($originalMessage->contenu)) !!}
    </div>

    <p>Si vous avez d'autres questions, n'hésitez pas à répondre directement à cet email.</p>

    <p>Cordialement,<br>L'équipe {{ config('app.name') }}</p>
@endsection
