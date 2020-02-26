@extends('errors::minimal')

@section('title', trans('app.forbidden'))
@section('code', '403')
@section('message', trans($exception->getMessage() ?: 'app.forbidden'))
