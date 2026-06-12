<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
     /**
     * Le constructeur reçoit les données dont on a besoin dans le mail.
     * "public" devant les paramètres les rend automatiquement disponibles dans la vue.
     * $email = l'adresse du destinataire
     * $token = le token unique pour identifier l'utilisateur dans le lien
     */
    public function __construct(public string $email, public string $token)
    {
        //
    }

    /**
     * Get the message envelope.
     *  L'envelope définit les métadonnées du mail : sujet, expéditeur, destinataire.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Créer votre mot de passe',
        );
    }

    /**
     * Get the message content definition.
     * Le content définit quelle vue blade sera utilisée comme corps du mail.
     * 'emails.set-password' = resources/views/emails/set-password.blade.php
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.set-password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
