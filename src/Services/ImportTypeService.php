<?PHP

namespace ConfrariaWeb\Import\Services;

use ConfrariaWeb\Import\Contracts\ImportTypeContract;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;

class ImportTypeService
{
    use ServiceTrait;

    public function __construct(ImportTypeContract $import)
    {
        $this->obj = $import;
    }

}
