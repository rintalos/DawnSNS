@extends('layouts.login')

@section('content')
<!-- モダール作成-->
<div class="modal-main">
  <div class="inner">

  </div>
</div>


<div class='text-form'>

  <p><img class="enter-icon" src="images/dawn.png"></p>

  {!! Form::open(['url' => 'post']) !!}

    <div>
       {!! Form::textarea('newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか...?','maxlength'=>'150']) !!}
    </div>
   <button type='submit' class='post-btn'><img src="images/post.png" class="send-image"></button>
  {!!Form::close() !!}
</div>
<div class="post-up">
　　　

    @foreach ($list as $list)
      <div class='post-form'>
      　
        <tr>
            <td><img class="enter-icon" src="images/{{$list->images}}"></td>
            <td class="post-name">{{ $list->username }}</td>
            <td class='post-post'>{{ $list->posts }}</td>
            <td class='post-created'>{{ $list->updated_at }}</td>
        </tr>


      @if (Auth::id() == $list->user_id)
         <button type="submit" class="delete-icon" ><a href= "/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')" ><img src="images/trash.png" onmouseover="this.src='images/trash_h.png'" onmouseout="this.src='images/trash.png'"></a></button>
         <button type="submit" class="edit-icon" id="login-show"data-target="{{$list->id}}" ><img src="images/edit.png"></button>

      @endif
         <div class="edit-modal-wrapper" id="{{$list->id}}">
             <div class="edit-back">
               <div class="modal">

               {!! Form::open(['url' => 'update']) !!}

                 <div>
                   {!! Form::textarea('upPost', $list->posts, ['required', 'class' => 'upform-control', 'maxlength'=>'150']) !!}
                   {!! Form::hidden('id', $list->id) !!}
                </div>
                   <button type='submit' class='up-post-btn'><img src="images/edit.png" class="send-image"></button>
               {!!Form::close() !!}
                 </div>
               </div>
            </div>
      </div>

    @endforeach

</div>

@endsection
