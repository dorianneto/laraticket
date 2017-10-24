<div class="collapse clearfix" id="filterTicket">
    <div class="well">
        <form action="{{ route('ticket.index') }}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
                <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                    <label for="selectDepartment">{{ trans('form.department') }}</label>
                    <select name="department" id="selectSituation" class="form-control">
                        <option value="">{{ trans('miscellaneous.select_option_default') }}</option>
                        @foreach($departments as $department => $departmentId)
                            <option value="{{ $departmentId }}">{{ $department }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('department'))
                        <span class="help-block">
                            <strong>{{ $errors->first('department') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="selectCategory">{{ trans('form.category') }}</label>
                    <select name="category" id="selectSituation" class="form-control">
                        <option value="">{{ trans('miscellaneous.select_option_default') }}</option>
                        @foreach($categories as $category => $categoryId)
                            <option value="{{ $categoryId }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                    <label for="selectPriority">{{ trans('form.priority') }}</label>
                    <select name="priority" id="selectSituation" class="form-control">
                        <option value="">{{ trans('miscellaneous.select_option_default') }}</option>
                        @foreach($priorities as $priority => $priorityId)
                            <option value="{{ $priorityId }}">{{ $priority }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('priority'))
                        <span class="help-block">
                            <strong>{{ $errors->first('priority') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('situation') ? ' has-error' : '' }}">
                    <label for="selectSituation">{{ trans('form.situation') }}</label>
                    <select name="situation" id="selectSituation" class="form-control">
                        <option value="">{{ trans('miscellaneous.select_option_default') }}</option>
                        @foreach($situations as $situation)
                            <option value="{{ $situation }}">{{ trans("miscellaneous.$situation") }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('situation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('situation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> {{ trans('form.filter') }}</button>
                <a href="{{ route('ticket.index') }}" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> {{ trans('form.reset') }}</a>
                <a data-toggle="collapse" href="#filterTicket" class="btn btn-link">{{ trans('form.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
