<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\HighRainfallNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class HighRainfallNotificationTest extends TestCase
{
    protected function getRandomUser(): User
    {
        return User::factory()->create();
    }
    public function test_if_user_can_be_notified(): void
    {
        Notification::fake();

        $user = $this->getRandomUser();

        $message = "storm is coming";

        $notification = new HighRainfallNotification(highRainfall: $message);

        $user->notify(instance: $notification);

        Notification::assertSentTo(
            notifiable: $user,
            notification: HighRainfallNotification::class,
        );
    }
}
