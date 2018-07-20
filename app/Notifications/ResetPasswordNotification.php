<?php

namespace FTW\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        //
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Xin chào!')
                    ->subject('Link reset mật khẩu của bạn.')
                    ->line('Bạn nhận được email này bởi vì chúng tôi nhận được một yêu cầu reset mật khẩu cho tài khoản của bạn.')
                    ->action('Reset mật khẩu', url(config('app.url').route('password.reset', $this->token, false)))
                    ->line('Nếu bạn không yêu cầu reset mật khẩu, vui lòng bỏ qua email này.');
    }
}
