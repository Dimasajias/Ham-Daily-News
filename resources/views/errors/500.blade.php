@extends('errors.layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Terjadi Kesalahan Server'))
@section('description', __('Maaf, sedang terjadi gangguan pada server kami (Kesalahan Internal). Tim teknis sedang menangani masalah ini. Silakan coba kembali dalam beberapa saat.'))
