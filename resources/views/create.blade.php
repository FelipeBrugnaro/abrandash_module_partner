@extends('admin.layouts.dashboard')
@section('title', textLang('title_create', 'partner::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title_create', 'partner::lang'),
    'description' => textLang('description_create', 'partner::lang'),
    'btnback' => config('partner.routes.index')
])
@endcomponent


<div class="card">
    <form 
        action="{{ route(config('partner.routes.store')) }}" 
        method="POST" 
        enctype="multipart/form-data">
        @csrf
        @include('partner::partials.form')
        <div class="flex items-center justify-end gap-3">
            <x-admin.elements.button
                class="mt-4 btn btn-sm btn-link" 
                type="reset" 
                :title="textLang('Reset')" />
            <x-admin.elements.button
                class="mt-4 btn btn-sm btn-primary" 
                type="submit" 
                :title="textLang('Create')" />
        </div>
    </form>
</div>
@endsection