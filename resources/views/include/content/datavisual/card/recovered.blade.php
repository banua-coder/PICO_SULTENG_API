@extends('layouts.card_case')
@section('card_case_title')
Sembuh
@overwrite
@section('card_case_border_color')
border-green-400
@overwrite
@section('card_case_new_bg_color')
bg-green-400
@overwrite
@section('card_case_bg_color')
bg-green-100
@overwrite
@section('local_case')
{{ $stats[sizeof($stats) - 1]->cumulative_recovered }}
@overwrite
@section('local_new_case')
{{ $stats[sizeof($stats) - 1]->recovered }}
@overwrite
@section('nasional_case')
{{ $count_data['ina_recovered'] }}
@overwrite
