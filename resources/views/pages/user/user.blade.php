@extends('layouts.app')

@section('title', 'ユーザー設定 | Todin')

@section('content')
    <x-features.user :user="$user" />
@endsection
