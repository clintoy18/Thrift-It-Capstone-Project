<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    // Ensure user is authenticated and matches the channel ID
    if (!$user) {
        return false;
    }
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.user.{id}', function ($user, $id) {
    // Ensure user is authenticated and matches the channel ID
    if (!$user) {
        return false;
    }
    return (int) $user->id === (int) $id;
});

Broadcast::channel('notifications-channel.{userId}', function ($user, $userId) {
    // Ensure user is authenticated and matches the channel ID
    if (!$user) {
        return false;
    }
    return (int) $user->id === (int) $userId;
});
