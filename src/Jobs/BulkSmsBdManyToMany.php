<?php

namespace Nanopkg\LaravelBulkSmsBd\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Nanopkg\LaravelBulkSmsBd\Facades\BulkSmsBd;

/**
 * Class LaravelBulkSmsBdManyToMany
 *
 * @example
 * LaravelBulkSmsBdManyToMany::dispatch([
 *     ['to'=>'88017xxxxxxxx','message'=>'message'],
 * ]);
 *
 * @package Nanopkg\LaravelBulkSmsBd\Jobs
 */
class BulkSmsBdManyToMany implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $messages;

    /**
     * Create a new job instance.
     *
     * @param array $messages=[[to=>'88017xxxxxxxx',message=>'message']];
     * @return void
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            return  BulkSmsBd::ManyToMany($this->messages)->send();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}