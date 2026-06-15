<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BoqNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjek;
    public string $pesanUtama;
    public string $namaProyek;
    public string $namaPenerima;
    public ?string $linkAksi;

    public function __construct(string $subjek, string $pesanUtama, string $namaProyek, string $namaPenerima, ?string $linkAksi = null)
    {
        $this->subjek = $subjek;
        $this->pesanUtama = $pesanUtama;
        $this->namaProyek = $namaProyek;
        $this->namaPenerima = $namaPenerima;
        $this->linkAksi = $linkAksi;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjek,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.boq-notification',
        );
    }
}
