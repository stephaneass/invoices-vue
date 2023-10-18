@props(['field', 'labelle', 'type'=>'text'])
<div class="col-md-6 mb-4"> 
    <div class="form-outline">
        <input type="{{$type}}" id="{{$field}}" name="{{$field}}" class="form-control form-control-lg" value="{{old($field)}}" />
        <label class="form-label" for="{{$field}}"> {{$labelle}} </label>
    </div>
    <x-error :field="$field" />
</div>