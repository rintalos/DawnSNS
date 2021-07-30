@extends('layouts.login')

@section('content')
<div class='text-form'>
{!! Form::open(['url' => 'search']) !!}
    <div>
       {!! Form::text('search', null, ['required', 'class' => 'search-form', 'placeholder' => 'ユーザー名']) !!}
    </div>
   <button type='submit' class='found-btn'>検索</button>
  {!!Form::close() !!}
</div>
@foreach ($person as $person)
      <div class='search-list'>
         <p class='search-box'><img class="enter-icon" src="images/dawn.png"></p>
         <div class='search-names'>{{ $person->username }}</div>


         @if (in_array($person->id, array_column($array,'follow')))

                 <a href="/follows/{{$person->id}}/delete" class="unfollows-btn">フォローをはずす</a>
         @else

                 <a href="/follows/{{$person->id}}/create" class="follows-btn">フォローする</a>


         @endif

      </div>



@endforeach



@endsection
