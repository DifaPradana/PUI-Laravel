@extends('components.layouts.pengelola_master')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    @livewire('pengelola-dashboard')
@endsection

@push('scripts')
    @livewireScripts
@endpush
