<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{ trans('meridien.imports.list') }}
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-section">
            <div class="kt-section__content">
                <table class="table table-striped table-hover" id="imports_datatable">
                    <thead>
                    <tr>
                        <th width="">{{ trans('meridien.imports.type') }}</th>
                        <th width="">{{ trans('meridien.imports.user') }}</th>
                        <th width="">{{ trans('meridien.imports.name') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($imports as $import)
                        <tr>
                            <td>{{ $import->type->name }}</td>
                            <td>{{ $import->user->name }}</td>
                            <td>{{ $import->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm float-right" step="group" aria-label="...">
                                    @permission('imports.show')
                                    <a href="{{ route('admin.imports.show', $import->id) }}"
                                       class="btn btn-clean btn-icon btn-label-primary btn-icon-md " title="View">
                                        <i class="la la-eye"></i>
                                    </a>
                                    @endpermission
                                    @permission('imports.edit')
                                    <a href="{{ route('admin.imports.edit', $import->id) }}"
                                       class="btn btn-clean btn-icon btn-label-success btn-icon-md " title="Edit">
                                        <i class="la la-edit"></i>
                                    </a>
                                    @endpermission
                                    @permission('imports.destroy')
                                    <a href="javascript:void(0);"
                                       onclick="event.preventDefault();
                                           if(!confirm('Tem certeza que deseja deletar este item?')){ return false; }
                                           document.getElementById('delete-step-{{ $import->id }}').submit();"
                                       class="btn btn-clean btn-icon btn-label-danger btn-icon-md "
                                       title="Deletar">
                                        <i class="la la-remove"></i>
                                    </a>
                                    <form
                                        action="{{ route('admin.imports.destroy', $import->id) }}"
                                        method="POST" id="delete-step-{{ $import->id }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                    </form>
                                    @endpermission
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
