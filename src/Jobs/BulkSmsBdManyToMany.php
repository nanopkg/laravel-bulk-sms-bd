<?php

namespace Nanopkg\BulkSmsBd\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Nanopkg\BulkSmsBd\Facades\BulkSmsBd;

/**
 * Class BulkSmsBdManyToMany
 *
 * @example
 * BulkSmsBdManyToMany::dispatch([
 *     ['to'=>'88017xxxxxxxx','message'=>'message'],
 * ]);
 *
 * @author IQBAL HASAN <iqbalhasan.dev@gmail.com>
 *
 * @link https://iqbalhasan.dev Author Homepage
 *
 * @license LICENSE The MIT License
 */
class BulkSmsBdManyToMany implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $messages;

    /**
     * Create a new job instance.
     *
     * @param  array  $messages=[[to=>'88017xxxxxxxx',message=>'message']];
     * @return void
     */
    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            BulkSmsBd::ManyToMany($this->messages)->send();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
