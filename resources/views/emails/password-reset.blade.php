@extends('emails.layout')

@section('content')
    <h1 style="color: #05299E; font-size: 24px; font-weight: 700; margin-bottom: 20px;">Réinitialisation de mot de passe</h1>
    
    <p>Bonjour,</p>
    
    <p>Nous avons reçu une demande de réinitialisation de mot de passe pour votre compte administrateur sur la plateforme <strong>{{ config('app.name') }}</strong>.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $url }}" class="button">Réinitialiser le mot de passe</a>
    </div>
    
    <div class="highlight-box">
        <p style="margin-bottom: 0;">Ce lien sécurisé expirera dans <strong>{{ $count }} minutes</strong>.</p>
    </div>
    
    <p>Si vous n'avez pas demandé de réinitialisation, ignorez simplement cet e-mail. Votre compte reste parfaitement sécurisé.</p>
    
    <div class="divider"></div>
    
    <p style="font-size: 12px; color: #64748b; line-height: 1.4;">
        Si le bouton ne fonctionne pas, vous pouvez copier et coller ce lien dans votre navigateur :<br>
        <a href="{{ $url }}" style="color: #f29004; word-break: break-all;">{{ $url }}</a>
    </p>
@endsection
