<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProjectNotification extends Notification
{
    use Queueable;

    public $project;
    public $action; // 'added' or 'removed'

    /**
     * Create a new notification instance.
     */
    public function __construct($project, $action)
    {
        $this->project = $project;
        $this->action = $action;
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
            'project_id' => $this->project->id,
            'title' => $this->project->name,
            'action' => $this->action,
        ];
    }
}
