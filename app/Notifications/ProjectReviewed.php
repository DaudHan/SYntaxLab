<?php

namespace App\Notifications;

use App\Models\ProjectSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectReviewed extends Notification
{
    use Queueable;

    protected $submission;

    /**
     * Create a new notification instance.
     */
    public function __construct(ProjectSubmission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Menentukan channel pengiriman notifikasi.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Menyimpan notifikasi di database
    }

    /**
     * Mengubah notifikasi menjadi format array yang akan disimpan.
     */
    public function toArray(object $notifiable): array
    {
        $statusText = $this->submission->status === 'APPROVED' ? 'telah disetujui' : 'memerlukan revisi';
        $lessonTitle = $this->submission->lesson->title;

        return [
            'message' => "Proyek Anda untuk pelajaran '{$lessonTitle}' {$statusText}.",
            'lesson_id' => $this->submission->lesson->id,
            'course_slug' => $this->submission->lesson->module->course->slug,
            'status' => $this->submission->status
        ];
    }
}