@extends('layouts.app')

@section('title','Laravel Components')

@section('sidebar')
@parent
<p>サイドバーに追加できます。</p>
@endsection

@section('content')
<h1 class="text-2xl">Laravel Components</h1>
@endsection