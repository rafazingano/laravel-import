<?PHP

namespace ConfrariaWeb\Import\Repositories;

use ConfrariaWeb\Import\Models\ImportType;
use ConfrariaWeb\Import\Contracts\ImportTypeContract;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;

class ImportTypeRepository implements ImportTypeContract
{

    use RepositoryTrait;

    function __construct(ImportType $import)
    {
        $this->obj = $import;
    }

}
