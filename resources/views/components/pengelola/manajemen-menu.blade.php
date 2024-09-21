@extends('components.layouts.pengelola_master')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    @livewire('menu-manager')
@endsection

@push('scripts')
    @livewireScripts
@endpush
