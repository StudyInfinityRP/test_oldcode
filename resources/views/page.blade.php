@extends('theme.master')
@section('title', "$page->title")
@section('content')
@include('admin.message')

@section('meta_tags')

<meta name="title" content="{{ $page->title }}">
<meta name="description" content="{{ $gsetting['meta_data_desc'] }} ">
<meta property="og:title" content="{{ $page->title }} ">
<meta property="og:url" content="{{ url()->full() }}">
<meta property="og:description" content="{{ $page->details }}">
<meta property="og:image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta itemprop="image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta property="twitter:title" content="{{ $page->title }} ">
<meta property="twitter:description" content="{{ $page->details }}">
<meta name="twitter:site" content="{{ url()->full() }}" />

<link rel="canonical" href="{{ url()->full() }}"/>
<meta name="robots" content="all">
<meta name="keywords" content="{{ $gsetting->meta_data_keyword }}">
    
@endsection

  <!-- main wrapper -->
  <section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ $page->title }}</h1>
    </div>
  </section>
  <section id="policy-block" class="privacy-policy-block">
    <div class="container">
      <div class="panel-setting-main-block">
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-12"> 
             
                <div class="info">{!! $page->details !!}</div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection