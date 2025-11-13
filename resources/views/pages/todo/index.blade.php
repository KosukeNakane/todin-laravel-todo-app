@extends('layouts.app')

@section('title', 'ToDo一覧 | Todin')

@section('content')
    <x-features.todo
        :tasks="$tasks"
        :sort="$sort"
        :sort-options="$sortOptions"
        :direction="$direction"
        :next-direction="$nextDirection"
    />
@endsection
