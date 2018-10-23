<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPictureMail extends Mailable {
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($name, $path, $image) {
    $this->name  = $name;
    $this->path  = $path;
    $this->image = $image;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build() {
    return $this->from('uecsrnd@gmail.com')
      ->subject('UE-CCSS Alumni Homecoming Uploads')
      ->view('send-picture-mail')
      ->with(
        [
          'name' => $this->name
        ])
      ->attach($this->path, [
        'as'   => $this->image->getClientOriginalName(),
        'mime' => $this->image->getMimeType()
      ]);
  }
}
