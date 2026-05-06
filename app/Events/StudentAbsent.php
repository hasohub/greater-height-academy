<?php

namespace App\Events;

use App\Models\StudentRecord;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentAbsent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $studentId;
    public $classId;
    public $sectionId;
    public $date;

    /**
     * Create a new event instance.
     */
    public function __construct(int $studentId, int $classId, int $sectionId, string $date)
    {
        $this->studentId = $studentId;
        $this->classId = $classId;
        $this->sectionId = $sectionId;
        $this->date = $date;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
