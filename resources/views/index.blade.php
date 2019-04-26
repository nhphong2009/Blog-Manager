{{-- kế thừa từ trang master --}}
@extends('layouts.master') 

@section('title_index')
    <title>Blog - Zent</title>
@endsection

{{-- thay đổi nội dung phần content --}}
@section('content')

	<!-- CONTENT -->
	<div class="content col-xs-8">
    	<!-- ARTICLE  -->  
    	{{-- kiểm tra sự tồn tại của dữ liệu trước khi dùng --}}
		@if(isset($posts)) 
			{{-- in tất cả bài viết ra bằng foreach --}}
			@foreach ($posts as $post)
				
		    	<article>
		        	<div class="post-image">
		            	<img src="/storage/images/{{ $post->thumbnail }}" alt="{{ $post->thumbnail }}">
		                <div class="category"><a href="/{{$post->slug}}">IMG</a></div>
		            </div>
		            <div class="post-text">
		            	<span class="date">{{ $post->created_at }}</span>
		                <h2><a href="/{{$post->slug}}">{{ $post->title }}</a></h2>
		                <p class="text">
		                	{!! $post->description !!}
                            <a href="/{{$post->slug}}"><i class="icon-arrow-right2"></i></a>
		                </p>                                 
		            </div>
		            <div class="post-info">
                        @if(Auth::user()->id == $post->user_id)
    		            	<div class="post-by">Post By <a href="/{{$post->slug}}">{{Auth::user()->name}}</a></div>
    		                <div class="extra-info">
    		                	<a href="#"><i class="icon-facebook5"></i></a>
    		            		<a href="#"><i class="icon-twitter4"></i></a>
    		            		<a href="#"><i class="icon-google-plus"></i></a>
    		                    <span class="comments">25 <i class="icon-bubble2"></i></span>
    		                </div>
    		                <div class="clearfix"></div>
                        @endif
		            </div>
		        </article>
				
			@endforeach
	    @endif
               
    
    </div>
    

@endsection