<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    public function build()
    {
        return $this->view('emails.post_approved')
            ->subject('Your Post has been Approved')
            ->with([
                'title' => $this->post->title,
                'content' => $this->post->content,
            ]);
    }
}
