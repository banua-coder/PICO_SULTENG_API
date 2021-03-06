@extends('layouts.card_api_data')
@section('card_api_title')
@lang('home.hospital')
@overwrite
@section('card_api_width')
1/3
@overwrite
@section('card_api_caption')
@lang('home.hospital_desc')
@overwrite
@section('card_api_url')
{{ route('hospital.index') }}
@overwrite
@section('card_api_url_v2')
{{ route('v2.hospital.index') }}
@overwrite
{{-- Put Your API Card Data Here --}}
