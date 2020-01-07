<?PHP

namespace ConfrariaWeb\Import\Repositories;

use ConfrariaWeb\Import\Contracts\ImportContract;
use ConfrariaWeb\Import\Models\Import;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;

class ImportRepository implements ImportContract
{

    use RepositoryTrait;

    function __construct(Import $import)
    {
        $this->obj = $import;
    }

}
