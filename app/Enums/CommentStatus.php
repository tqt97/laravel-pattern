<?php

namespace App\Enums;

enum CommentStatus: int
{
    case PENDING = 0;
    case APPROVED = 1;
    case SPAM = 2;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::SPAM => 'Spam',
        };
    }

    public function isApproved(): bool
    {
        return $this === self::APPROVED;
    }
}
