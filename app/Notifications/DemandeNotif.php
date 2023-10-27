<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeNotif extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $demandeId ;
    protected $userName ;
    protected $imagePath ;
    protected $body ;
    protected $routeName ;
    public function __construct($demandeId,$userName,$imagePath,$body,$routeName)
    {
        $this->demandeId= $demandeId ;
        $this->userName= $userName ;
        $this->imagePath= $imagePath ;
        $this->body= $body ;
        $this->routeName= $routeName ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'demandeId' => $this->demandeId,
            'userName' => $this->userName,
            'imagePath' => $this->imagePath,
            'body' => $this->body,
            'routeName' => $this->routeName,
        ];
    }
}
