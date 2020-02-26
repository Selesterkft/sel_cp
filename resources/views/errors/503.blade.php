@extends('errors::minimal')

@section('title', trans('app.service_unavailable'))
@section('code', '503')
@section('message', trans($exception->getMessage() ?: 'app.service_unavailable'))
