@extends('components.layouts.pengelola_master')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    {{-- @livewire('account-creator') --}}
    @livewire('akun-manager')
@endsection

@push('scripts')
    @livewireScripts
@endpush
