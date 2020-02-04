<?PHP

namespace ConfrariaWeb\Import\Services;

use ConfrariaWeb\Import\Jobs\ImportJob;
use ConfrariaWeb\Import\Contracts\ImportContract;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;
use Illuminate\Support\Facades\Storage;

class ImportService
{
    use ServiceTrait;

    public function __construct(ImportContract $import)
    {
        $this->obj = $import;
    }

    public function prepareData(array $data)
    {
        $data['user_id'] = auth()->id();
        if (!isset($data['file'])) {
            unset($data['name'], $data['file']);
            return $data;
        }
        $fileName = time() . '.' . $data['file']->getClientOriginalExtension();
        $data['name'] = $data['file']->getClientOriginalName();
        $data['file'] = Storage::disk('public')
            ->putFileAs(
                'imports', $data['file'], $fileName, 'public'
            );
        $data['file'] = $fileName;
        return $data;
    }

    public function execute($id)
    {
        $import = $this->find($id);

        if ($import) {
            ImportJob::dispatch($import);
            $this->executeEvent($import, 'Queued');
            $this->executeSchedule($import, 'Queued');
            return true;
        }
        return false;
    }

}
