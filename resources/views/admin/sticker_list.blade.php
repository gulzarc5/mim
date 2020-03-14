@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Sticker List</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <div class="row">
                  @if (isset($stickers) && !empty($stickers))
                      @foreach ($stickers as $item)
                        <div class="col-md-55">
                            <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="{{asset('admin/images/sticker/thumb/'.$item->image.'')}}" alt="image">
                                <div class="mask">
                                <p style="opacity:0">Your Text</p>
                                <div class="tools tools-bottom">
                                    <a href="{{route('admin.delete_sticker',['id'=>$item->id])}}"><i class="fa fa-times"></i></a>
                                </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p>{{$item->name}}</p>
                            </div>
                            </div>
                        </div>                          
                      @endforeach
                  @endif
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
 @endsection