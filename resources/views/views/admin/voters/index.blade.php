@extends('layouts.admin')

@section('content')
    <voter-management-page
        :voters='@json($voters)'
        update-route="{{ route('admin.voters.update') }}"
        :errors='@json($errors)'
        delete-route="{{ route('admin.voters.destroy', ['voter' => ':id' ]) }}"
    ></voter-management-page>
@endsection

