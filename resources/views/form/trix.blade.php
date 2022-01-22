<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        @include('admin::form.error')

        <textarea class="form-control {{$class}}" id="{{$id}}" name="{{$name}}" placeholder="{{ $placeholder }}" {!!
            $attributes !!} style="display: none;">{{ old($column, $value) }}</textarea>
        <trix-editor input="{{$id}}"></trix-editor>

        @include('admin::form.help-block')

    </div>
</div>
