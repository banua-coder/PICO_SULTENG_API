@extends('layouts.card_case')
@section('card_case_title')
'Meninggal'
@overwrite
@section('card_case_border_color')
border-yellow-400
@overwrite
@section('card_case_new_bg_color')
bg-yellow-400
@overwrite
@section('card_case_bg_color')
bg-yellow-100
@overwrite
@section('local_case')
{{ $stats[sizeof($stats) - 1]->cumulative_death }}
@overwrite
@section('local_new_case')
{{ $stats[sizeof($stats) - 1]->death }}
@overwrite
@section('nasional_case')
{{ $count_data['ina_death'] }}
@overwrite
