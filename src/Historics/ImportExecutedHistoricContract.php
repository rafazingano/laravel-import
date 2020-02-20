<?php

namespace MeridienClube\Meridien\Historics;

use MeridienClube\Meridien\Import;
use ConfrariaWeb\Historic\Contracts\HistoricContract;

class ImportExecutedHistoricContract implements HistoricContract
{

    protected $import;

    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    public function data()
    {
        return [
            'action' => 'executed',
            'content' => 'Importação do arquivo ' . $this->import->name . ' foi executada.'
        ];
    }

    public function title()
    {
        return 'Importação executada';
    }

    public function user($collunn = null)
    {
        return $this->import->user_id;
        /*
        if($collunn == 'id'){
            return auth()->id();
        }
        return auth()->user();
        */
    }

}
