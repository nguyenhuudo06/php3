<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyTestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $view;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data, string $view, string $subject)
    {
        $this->data = $data;
        $this->view = $view;
        $this->subject = $subject;
    }

    // Định nghĩa tiêu đề và các thuộc tính khác của emai
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    // Định nghĩa nội dung của email, bao gồm view được sử dụng và dữ liệu truyền vào view.
    public function content(): Content
    {
        return new Content(
            view: $this->view,
            with: ['data' => $this->data],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // Định nghĩa các tập tin đính kèm cho email.
    public function attachments(): array
    {
        return [];
    }
}
