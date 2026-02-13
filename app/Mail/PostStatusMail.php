<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(Post $post, $status)
    {
        $this->post = $post;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->status === 'approved' ? 'Cerita Anda Telah Disetujui' : 'Cerita Anda Memerlukan Perbaikan';

        return new Envelope(
            subject: $subject . ' - VisitBatu',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.post-status',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
