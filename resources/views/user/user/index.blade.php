@extends('layouts.home')

@section('title.ユーザー')

@section('content')
 <div class="p-10 row">
  <p class="display-5 font-weight-bold py-4 mx-auto">フレンドと有意義なコミュニケーションを楽しみましょう。</p>
 </div>
 <div class="d-flex justify-content-between flex-wrap px-2">

       @foreach($friends as $friend)
        @if(isset($friend->avatar))
         <div class="d-flex flex-row pb-3">
          <table>
           <thead>
            <tr>
             <th></th>
             <th></th>
             <th></th>
            </tr>
           </thead>
           <tr>
            <td>
            <div class="my-auto mx-1" width="25%">
             <div class="my-auto" style="width:60px;height:60px;">
              <div class="rounded-circle shadow-lg p-1">
               <img src="{{ $friend->avatar }}" class="rounded-circle" width="50" height="50">
              </div>
             </div>
            <h class="font-weight-bold">{{ $friend->name }}</h>
           </div>
            </td>
            <td><div class="my-auto"><h class="ml-1 pr-2">{{ $friend->text }}</h></div></td>
            <td>
             <div class="d-flex flex-column px-2">
              <div class="mb-1">@include('parts.follow_button',['user'=>$friend])</div>
              <div class="mt-1"><a class="btn btn-primary" href="{{ action('User\UserController@talk', ['id' => $friend->id] ) }}">トーク</a></div>
             </div>
            </td>
           </tr>
          </table>
         </div>
        @elseif(!isset($friend->avatar))
         <div class="d-flex flex-row pb-3">
          <table>
           <thead>
            <tr>
             <th></th>
             <th></th>
             <th></th>
            </tr>
           </thead>
           <tr>
            <td>
            <div class="my-auto mx-1" width="25%">
             <div class="my-auto" style="width:60px;height:60px;">
              <div class="rounded-circle shadow-lg p-1">
               <img src="https://tokumeikaigi.s3.us-east-2.amazonaws.com/unknown.jpg" class="rounded-circle" width="50" height="50">
              </div>
             </div>
            <h class="font-weight-bold">{{ $friend->name }}</h>
           </div>
            </td>
            <td><div class="my-auto"><h class="ml-1 pr-2">{{ $friend->text }}</h></div></td>
            <td>
             <div class="d-flex flex-column px-2">
              <div class="mb-1">@include('parts.follow_button',['user'=>$friend])</div>
              <div class="mt-1"><a class="btn btn-primary" href="{{ action('User\UserController@talk', ['id' => $friend->id] ) }}">トーク</a></div>
             </div>
            </td>
           </tr>
          </table>
         </div>
        @else
       @endif
       @endforeach
 </div>
 <div class="p-10 row">
  <p class="display-5 font-weight-bold py-4 mx-auto">まだフレンドではない仲間を発見しましょう。</p>
 </div>
 <div class="row d-flex justify-content-between px-4">
@if(isset($users))
    <table>
     <thead>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
     </thead>
        @foreach($users as $user)
         @if(isset($user->avatar))
         <tr>
          <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="{{ asset('storage/image/' . $user->avatar) }}" class="rounded-circle" width="50" height="50"></div></td>
          <td width="25%">{{ $user->name }}</td>
          <td>{{ $user->text }}</td>
          <td><div>@include('parts.follow_button',['user'=>$user])</div></td>
         </tr>
         @elseif(!isset($user->avatar))
         <tr>
          <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="https://tokumeikaigi.s3.us-east-2.amazonaws.com/unknown.jpg" class="rounded-circle" width="50" height="50"></div></td>
          <td width="25%">{{ $user->name }}</td>
          <td>{{ $user->text }}</td>
          <td><div>@include('parts.follow_button',['user'=>$user])</div></td>
         </tr>
         @else
        @endif
        @endforeach
    </table>
@endif
   <div class="float-right m-4">
    <form action="{{ action('User\UserController@index') }}" method="get">
     <div class="form-group row">
      <label>ユーザー検索</label>
      <div>
       <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
      </div>
      <div>
       {{ csrf_field() }}
       <input type="submit" class="btn btn-primary" value="検索">
      </div>
     </div>
    </form>
   </div>
 </div>
 <div>
  <ul class="nav nav-tabs nav-justified mt-5 mb-2">
   <li class="nav-item nav-link {{ Request::is('users/*/followers') ? 'active' : '' }} "><a href="{{ route('followers',['id'=>Auth::id()]) }}" class="">フォロワー<br><div class="badge badge-secondary"></div></a></li>
   <li class="nav-item nav-link {{ Request::is('users/*/followings') ? 'active' : '' }} "><a href="{{ route('followings',['id'=>Auth::id()]) }}" class="">フォロー中<br><div class="badge badge-secondary"></div></a></li>
  </ul>
 </div>
 <div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection
