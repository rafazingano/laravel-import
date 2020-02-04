<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{ trans('meridien.imports.form') }}
            </h3>
        </div>
    </div>

    <div class="kt-portlet__body">
        <div class="form-group">
            <label class="control-label">{{ trans('meridien.imports.type') }}<span class="required"> * </span></label>
            {!! Form::select('type_id', $types, isset($import)? $import->type : null, ['class' => 'form-control', 'required']) !!}
        </div>

        @empty($import)
        <div class="form-group">
            <label class="control-label">{{ trans('meridien.imports.file') }}<span class="required"> * </span></label>
            {!! Form::file('file', ['class' => 'form-control', 'required' => !isset($import)]) !!}
        </div>
        @endempty

        @includeIf(isset($view_type)? $view_type : NULL)

        <div class="form-group">
            {!! Form::checkbox('run_on_save', 1, false, ['class' => 'form-checkbox']) !!}
            <label class="control-label">{{ trans('meridien.imports.run_on_save') }}<span class="required"> ? </span></label>
        </div>

    </div>
    @include('meridien::partials.portlet_footer_form_actions')
</div>
