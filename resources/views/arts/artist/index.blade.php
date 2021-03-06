

@extends('layouts.admin')


@section('title')
admin Dashboard
@endsection



@section('content')

<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Artists</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">

                <table class="table">
                <thead>
                    <tr>
                    <th>name</th>
                    <th >email</th>
                    <th >phone</th>
                    <th>delete</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($artists as $artist)
                        <tr>
                        <td ><a href="/artists/{{$artist->id}}">{{$artist->name}}</a></td>
                        <td>{{$artist->email}}</td>
                        <td>{{$artist->phone}}</td>
                        <td><a href="/artist/{{$artist->id}}/delete">X</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    

                </div>
              </div>
            </div>
          </div>


          
       
        </div>
      </div>


@endsection





@section('script')


@endsection


