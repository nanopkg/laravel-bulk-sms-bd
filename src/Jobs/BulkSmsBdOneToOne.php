<?php

namespace Nanopkg\LaravelBulkSmsBd\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Nanopkg\LaravelBulkSmsBd\Facades\BulkSmsBd;

/**
 * Class LaravelBulkSmsBdOneToOne
 *
 * @example
 * LaravelBulkSmsBdManyToMany::dispatch(
 *  '88017xxxxxxxx',
 *  'message'
 * );
 *
 * @package Nanopkg\LaravelBulkSmsBd\Jobs
 */
class BulkSmsBdOneToOne implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $number;

    public $message;

    /**
     * Create a new job instance.
     * @param string $number='88017xxxxxxxx'
     * @param string $message='message'
     *
     * @return void
     */
    public function __construct($number, $message)
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
            return  BulkSmsBd::OneToOne($this->number, $this->message)->send();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
