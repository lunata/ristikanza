@extends('layouts.base')

@section('h1', trans('navigation.'. $corpus. '_texts'))

@include('texts._texts')
