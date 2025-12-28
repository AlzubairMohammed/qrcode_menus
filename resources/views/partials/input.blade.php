@isset($separator)
    <br />
    <h4 id="sep{{ $id }}" class="display-4 mb-0">{{ __($separator) }}</h4>
    <hr />
@endisset
@php
    $errorKey = isset($name_field) ? str_replace(['[', ']'], ['.', ''], $name_field) : $id;
@endphp
<div id="form-group-{{ $id }}" class="form-group{{ $errors->has($errorKey) ? ' has-danger' : '' }}  @isset($class) {{$class}} @endisset">
     @if(!(isset($type)&&$type=="hidden"))
        <label class="form-control-label" for="{{ $id }}">{{ __($name) }}@isset($link)<a target="_blank" href="{{$link}}">{{$linkName}}</a>@endisset</label>
    @endif
<input @isset($readonly) readonly @endisset @isset($accept) accept="{{ $accept }}" @endisset step="{{ isset($step)?$step:".01"}}" @isset($min) min="{{ $min }}" @endisset  @isset($max) max="{{ $max }}" @endisset type="{{ isset($type)?$type:"text"}}" name="{{ isset($name_field)?$name_field:$id }}" id="{{ $id }}" class="form-control form-control @isset($editclass) {{$editclass}} @endisset  {{ $errors->has($errorKey) ? ' is-invalid' : '' }}" placeholder="{{ __($placeholder) }}" value="{{ old($errorKey)?old($errorKey):(isset($value)?$value:(app('request')->input($id)?app('request')->input($id):null)) }}" <?php if($required) {echo 'required';} ?> >
    @isset($additionalInfo)
        <small class="text-muted"><strong>{{ __($additionalInfo) }}</strong></small>
    @endisset
    @if ($errors->has($errorKey))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($errorKey) }}</strong>
        </span>
    @endif
</div>
