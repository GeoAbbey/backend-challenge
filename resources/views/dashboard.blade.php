<a href="/logout">logout</a>
@if (count($talks > 0))
@foreach ($talks as $talk)
<form method="post" action="/talk/attendee/add">
    <input type="hidden" name="attendee_id" value="{{session()->get('user_id')}}" required/>
    <input type="hidden" name="talk_id" value="{{$talk->talk_id}}" required/>
    <p>{{$talk->talk_title}} </p>
    <input type="submit" value="Add Talk" />
</form>
@endforeach
@endif