@extends('errors::minimal')

@section('title', trans('app.server_error'))
@section('code', '500')
@section('message', trans('app.server_error'))
