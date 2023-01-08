<?php

namespace Nanopkg\LaravelBulkSmsBd\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Nanopkg\LaravelBulkSmsBd\Facades\BulkSmsBd;

/**
 * Class LaravelBulkSmsBdOneToOne
 *
 * @example BulkSmsBdOneToOne::dispatch(['88017xxxxxxxx','88018xxxxxxxx'], 'message');
 *
 * @author IQBAL HASAN <iqbalhasan.dev@gmail.com>
 *
 * @link https://iqbalhasan.dev Author Homepage
 *
 * @license LICENSE The MIT License
 */
class BulkSmsBdOneToMany implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $number;

    public $message;

    /**
     * Create a new job instance.
     *
     * @param  array  $number=['88017xxxxxxxx','88018xxxxxxxx']
     * @param  string  $message='message'
     * @return void
     */
    public function __construct(array $number, string $message)
    {
        $this->number = $number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            return  BulkSmsBd::oneToMany($this->number, $this->message)->send();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
