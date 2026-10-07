<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class Timetable extends Mailable
{
    use Queueable, SerializesModels;

    protected Collection $timetableEvents;
    protected Carbon $startDate;
    protected Carbon $endDate;

    public function __construct(
        Collection $timetableEvents,
        Carbon $startDate,
        Carbon $endDate
    ) {
        $this->timetableEvents = $timetableEvents;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Timetable',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.timetable',
            with: [
                'timetableEvents' => $this->timetableEvents,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}