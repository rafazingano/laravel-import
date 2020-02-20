<?php


namespace MeridienClube\Meridien\Historics;

use MeridienClube\Meridien\Import;
use ConfrariaWeb\Historic\Contracts\HistoricContract;

class ImportCreatedHistoricContract implements HistoricContract
{
    protected $import;

    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    public function data()
    {
        return [
            'action' => 'created',
            'content' => 'Importação do arquivo ' . $this->import->name . ' criado com sucesso'
        ];
    }

    public function title()
    {
        return 'Importação criada';
    }

    public function user($collunn = null)
    {
        if($collunn == 'id'){
            return auth()->id();
        }
        return auth()->user();
    }
}
