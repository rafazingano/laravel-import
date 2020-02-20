<?php

namespace MeridienClube\Meridien\Historics;

use MeridienClube\Meridien\Import;
use ConfrariaWeb\Historic\Contracts\HistoricContract;

class ImportQueuedHistoricContract implements HistoricContract
{

    protected $import;

    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    public function data()
    {
        return [
            'action' => 'queued',
            'content' => 'Importação do arquivo ' . $this->import->name . ' foi enviada para a fila de processamento.'
        ];
    }

    public function title()
    {
        return 'Importação enfileirada';
    }

    public function user($collunn = null)
    {
        if($collunn == 'id'){
            return auth()->id();
        }
        return auth()->user();
    }

}
