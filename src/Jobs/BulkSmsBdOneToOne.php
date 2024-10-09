<?php

namespace Nanopkg\BulkSmsBd\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Nanopkg\BulkSmsBd\Facades\BulkSmsBd;

/**
 * Class BulkSmsBdOneToOne
 *
 * @example BulkSmsBdOneToOne::dispatch('88017xxxxxxxx', 'message');

 *
 * @author IQBAL HASAN <iqbalhasan.dev@gmail.com>
 *
 * @link https://iqbalhasan.dev Author Homepage
 *
 * @license LICENSE The MIT License
 */
class BulkSmsBdOneToOne implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $number;

    public $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $number, string $message)
    {
        $this->number = $number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            BulkSmsBd::OneToOne($this->number, $this->message)->send();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
