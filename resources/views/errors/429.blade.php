@extends('errors::minimal')

@section('title', trans('app.too_many_requests'))
@section('code', '429')
@section('message', trans('app.too_many_requests'))
