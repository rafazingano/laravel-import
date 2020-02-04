<?php

namespace ConfrariaWeb\Import\Jobs;

use MeridienClube\Meridien\Events\ImportExecutedEvent;
use ConfrariaWeb\Import\Models\Import;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

//class ImportJob implements ShouldQueue
class ImportJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $import;

    /**
     * Create a new job instance.
     *
     * @param Import $import
     */
    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        try {

            if ($this->import) {

                //dd($this->import->type->service);
                $data = resolve($this->import->type->service)
                    ->set($this->import)
                    ->execute()
                    ->getReturn();

                dd($data);

                resolve('ImportService')->executeEvent($this->import, 'Executed');
                resolve('ImportService')->executeSchedule($this->import, 'Executed');

            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            throw $e;
        }
    }
}
