@extends('layouts.login')

@section('content')

<div class="followlist-form">
    @foreach($other as $other)
       <div><img class="follows-icon" src="/images/{{$other->images}}"></div>
       <p>
           <div>Name</div>
           <div>{{$other->username}}</div>
       </p>
       <p>
           <div>bio</div>
           <div>{{$other->bio}}</div>
       </p>
       @if (in_array($other->id, array_column($array,'follow')))

                 <a href="/follows/{{$other->id}}/delete" class="follows-btn">フォローをはずす</a>
         @else

                 <a href="/follows/{{$other->id}}/create" class="follows-btn">フォローする</a>

         @endif
    @endforeach
</div>
<div >


    @foreach($list as $list)
       <div>
       <a href="/follows/{{$list->id}}/profile" ><img class="follow-post-icon" src="/images/{{$list->images}}"></a>
           <tr>
                <td>{{$list->username}}</td>
                <td>{{$list->posts}}</td>
                <td>{{$list->updated_at}}</td>
           </tr>


       </div>
    @endforeach


</div>


@endsection