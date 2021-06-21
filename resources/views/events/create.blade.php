@extends('templates.default')
@section('content')
    <h1>Event creation</h1>
    <div class="card p-3 col-">
        <form method="POST" action="{{route('events.create')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="eventTitle" class="form-label">Event title</label>
                <input type="text" name="eventTitle" class="form-control{{ $errors->has("eventTitle") ? ' is-invalid' : '' }}" id="eventTitle">
                @if($errors->has("eventTitle"))
                    <div class="invalid-feedback">
                        {{ $errors->first("eventTitle") }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="eventDate" class="form-label">Event date</label>
                <input type="date" name="eventDate" class="form-control{{ $errors->has("eventDate") ? ' is-invalid' : '' }}" id="eventDate">
                @if($errors->has("eventDate"))
                    <div class="invalid-feedback">
                        {{ $errors->first("eventDate") }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="eventText class="form-label">Event description</label>
                <textarea name="eventText" id="eventText" cols="30" rows="10" class="form-control{{ $errors->has("eventText") ? ' is-invalid' : '' }}" ></textarea>
                @if($errors->has("eventText"))
                    <div class="invalid-feedback">
                        {{ $errors->first("eventText") }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="title">Photo</label>
                <input type="file" name="photo" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" id="photo"  placeholder="Select photo">
{{--                @if ($errors->has('photo'))--}}
{{--                    <span class="help-block text-danger">--}}
{{--                            {{ $errors->first('photo')}}--}}
{{--                </span>--}}
{{--                @endif--}}
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
