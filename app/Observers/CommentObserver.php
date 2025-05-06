<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\NewCommentNotification;
use Illuminate\Support\Facades\Log;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        Log::info('Comment created', $comment->toArray());
        $commentable = $comment->commentable;
        $owner = $commentable->course->user ?? null;

        if ($owner && $owner->id !== $comment->user_id) {
            $owner->notify(new NewCommentNotification($comment));
        }
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
