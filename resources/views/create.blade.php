@extends('layouts.app')

@section('content')
    <form action="/newQuiz" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div style="width: 500px">
        <div class="form-group" style="margin: 20px">
            <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title" class="form-control" />
        </div>
        <div class="form-group"  style="margin: 20px">
            <textarea name='description' class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group"  style="margin: 20px">
            <select name="category">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <input type="submit" name='create' class="btn btn-success" value = "Create"/>
    </form>
@endsection
