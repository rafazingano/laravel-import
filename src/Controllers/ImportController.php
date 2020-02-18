<?php

namespace ConfrariaWeb\Import\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{

    protected $data;
    protected $user;

    /**
     * ImportController constructor.
     * @param $data
     */
    public function __construct()
    {
        $this->data = [];
    }

    public function execute($id)
    {

        $import = resolve('ImportService')->execute($id);
        return redirect()
            ->route('admin.imports.show', $id)
            ->with('status', 'A integração foi enviada para a fila de processamento com sucesso!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['imports'] = resolve('ImportService')->all();
        return view(config('cw_import.views') . 'imports.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['types'] = resolve('ImportTypeService')->pluck('name', 'id');
        return view(config('cw_import.views') . 'imports.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $import = resolve('ImportService')->create($request->all());
        return redirect()
            ->route('admin.imports.edit', $import->id)
            ->with('status', 'Importação criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $import = resolve('ImportService')->find($id);
        $this->data['import'] = $import;
        return view(config('cw_import.views') . 'imports.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $import = resolve('ImportService')->find($id);
        $this->data['import'] = $import;
        $this->data['types'] = resolve('ImportTypeService')->pluck('name', 'id');
        $this->data['roles'] = resolve('RoleService')->pluck('name', 'id');
        $this->data['steps'] = resolve('CrmStepService')->pluck('name', 'id');
        $this->data['employees'] = resolve('MeridienUserService')->employees();
        $this->data['statuses'] = resolve('UserStatusService')->pluck('name', 'id');
        $this->data['task_statuses'] = resolve('TaskStatusService')->pluck('name', 'id');
        $this->data['task_types'] = resolve('TaskTypeService')->pluck('name', 'id');

        $this->data['view_type'] = Str::slug(Str::replaceLast('Service', '', $import->type->service)) . '::partials.form';

        return view(config('cw_import.views') . 'imports.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $import = resolve('ImportService')->update($request->all(), $id);
        if ($import && isset($request->run_on_save) && $request->run_on_save == 1) {
            $this->execute($import->id);
        }
        return redirect()
            ->route('admin.imports.edit', $import->id)
            ->with('status', 'Importação editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $import = resolve('ImportService')->destroy($id);
        return redirect()
            ->route('admin.imports.index')
            ->with('status', __('imports.destroy.successfully'));
    }

}
