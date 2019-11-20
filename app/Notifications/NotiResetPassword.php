<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class NotiResetPassword extends ResetPassword
{

public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reset Password')
            ->greeting('Hello! ' . $notifiable->name)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation ('Regards');
    }

 }

