@extends('layouts.app')

@section('content')

    <form method="post" action='{{ url("/update") }}' >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $quiz->id }}{{ old('id') }}">
        <div style="width: 500px">
        <div class="form-group"  style="margin: 20px">
            <input required="required" placeholder="Enter title here" type="text" name="title" class="form-control"
                   value="@if(!old('title')){{$quiz->title}}@endif{{ old('title') }}"/>
        </div>
        <div class="form-group"  style="margin: 20px">
        <input type="text" name='description' class="form-control" value="{!! $quiz->description !!}">
        </div>
        <div class="form-group"  style="margin: 20px">
            <select name="category">
                @foreach($categories as $category)
                    @if($category->id === $selected)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        </div>
        <input type="submit" name='publish' class="btn btn-success" value="Update"/>
    </form>
@endsection
