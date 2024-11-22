<?php

namespace App\Livewire\Notification;

use Livewire\Component;

class Notification extends Component
{
     public $notifications;

    protected $listeners = ['TestNotification' => 'refreshNotifications'];



    public function refreshNotifications($data)
    {

        $this->notifications = auth()->user()->unreadNotifications;
    }


    public function mount()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->unreadNotifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->notifications = auth()->user()->unreadNotifications;
        }
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function render()
    {
        return view('livewire.notification.notification');
    }
}
