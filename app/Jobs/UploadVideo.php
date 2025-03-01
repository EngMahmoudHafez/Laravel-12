<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class UploadVideo implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $videoPath,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->fileSize()=== 0){
            $this->release(now()->addMinutes());

            return;
        }

        // Upload the video
        $createResponse = Http::vimeo()->asJson()
            ->accept('application/vnd.vimeo.*+json;version=3.4')
            ->post('https://api.vimeo.com/me/videos', [
                'upload' => [
                    'approach' => 'tus',
                    'size' => $this->fileSize(),
                ],
            ]);

        if ($createResponse->json('upload.approach') === 'tus') {
            $this->delete();

            return;
        }
        while ($uploadOffset < $this->fileSize()) {
            $uploadResponse = $this->uploadVideo($uploadedLink, $uploadOffset);

            $uploadOffset = $uploadResponse->header('upload-Offset');
        }

        $verificationResponse = Http::vimeo()
            ->withHeaders('Tus-Resumable','1.0.0')
            ->accept('application/vnd.vimeo.*+json;version=3.4')
            ->head($uploadedLink);
        if($verificationResponse->header('upload-Length') === $verificationResponse->header('upload-Offset')){
            return;
        }

        $this->fail('Failed to upload video');
    }

    protected function uploadVideo(string $uploadedLink, int $uploadOffset): ?Response
    {
        return Http::vimeo()
            ->withHeaders('Tus-Resumable','1.0.0')
            ->accept('application/vnd.vimeo.*+json;version=3.4')
            ->patch($uploadedLink, [
                'upload' => [
                    'approach' => 'tus',
                    'size' => $this->fileSize(),
                    'offset' => $uploadOffset,
                ],
            ]);
    }
}
