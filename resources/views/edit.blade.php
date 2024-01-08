@extends('admin.layouts.dashboard')
@section('title', textLang('title_edit', 'partner::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title_edit', 'partner::lang'),
    'description' => textLang('description_edit', 'partner::lang'),
    'btnback' => config('partner.routes.index')
])
@endcomponent

<div class="card">
    <form 
        action="{{ route(config('partner.routes.update'), ['partner' => $partner->id]) }}" 
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('partner::partials.form')

        <x-admin.elements.select 
            name="status" 
            :label="textLang('status', 'partner::lang.form')">
            <option 
                value="1" 
                @if ($partner->status == true) selected @endif>
            <span>{{ textLang('Actived') }}</span>
            </option>
            <option 
                value="0" 
                @if ($partner->status == false) selected @endif>
            <span>{{ textLang('Disabled') }}</span>
            </option>
        </x-admin.elements.select>
        
        <div class="flex items-center justify-end gap-3">
            <x-admin.elements.button
                class="mt-4 btn btn-sm btn-primary" 
                type="submit" 
                :title="textLang('Edit')" />
        </div>
    </form>
</div>
@endsection