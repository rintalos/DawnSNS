@extends('layouts.login')

@section('content')
<div class="followlist-form">
    <h1 class='follow-word'>Follow List</h1>
    @foreach($person as $person)
       <div> <a href="/follows/{{$person->id}}/profile"><img class="follows-icon" src="images/{{$person->images}}"></a></div>
    @endforeach
</div>
<div >


    @foreach($list as $list)
       <div>
       <a href="/follows/{{$list->id}}/profile" ><img class="follow-post-icon" src="images/{{$list->images}}"></a>
           <tr>
                <td>{{$list->username}}</td>
                <td>{{$list->posts}}</td>
                <td>{{$list->updated_at}}</td>
           </tr>


       </div>
    @endforeach


</div>
@endsection