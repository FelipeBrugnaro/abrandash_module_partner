@extends('admin.layouts.dashboard')
@section('title', textLang('title', 'partner::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title', 'partner::lang'),
    'description' => textLang('description', 'partner::lang'),
])
@if(Auth::user()->permission('CREATE_PARTNER'))
@slot('btncreate', config('partner.routes.create'))
@endif
@endcomponent

<div class="card">
    <x-admin.elements.table
        :paginate="$partners->links('admin.components.paginate')">
        <x-slot:thead>
            <th>{{ textLang('image', 'partner::lang.thead') }}</th>
            <th>{{ textLang('title', 'partner::lang.thead') }}</th>
            <th>{{ textLang('status', 'partner::lang.thead') }}</th>
        </x-slot:thead>
        <x-slot:tbody>
                @foreach ($partners as $key => $partner)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>
                        <img
                            class="rounded w-10 h-10" 
                            src="{{ $partner->image }}" 
                            alt="{{ $partner->title }}">
                    </td>
                    <td>{{ $partner->title }}</td>
                    <th>
                        <x-admin.elements.status :status="$partner->status" />
                    </th>
                    <x-admin.elements.table.action>
                        @slot('buttons')
                            @if(Auth::user()->permission('EDIT_PARTNER'))
                            <li>
                                <x-admin.elements.link 
                                    :title="textLang('Edit')" 
                                    :href="route(config('partner.routes.edit'), ['partner' => $partner->id])"  
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="pencil" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements-link>
                            </li>
                            @endif
                            @if(Auth::user()->permission('DELETE_PARTNER'))
                            <li>
                            <form 
                                class="block full"
                                action="{{ route(config('partner.routes.delete'), ['partner' => $partner->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <x-admin.elements.button 
                                    type="submit" 
                                    :title="textLang('Delete')" 
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="trash" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements.button>
                            </form>
                            </li>
                            @endif
                        @endslot
                    </x-admin.elements.table.action>
                <tr>
                @endforeach
        </x-slot:tbody>
    </x-admin.page.table.table>
</div>
@endsection