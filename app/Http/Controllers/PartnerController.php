<?php

namespace Modules\Partner\app\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Partner\app\Models\Partner;
use Modules\Partner\app\Http\Requests\{
    PartnerUpdateRequest,
    PartnerStoreRequest
};
use Illuminate\Http\{Request, RedirectResponse};

class PartnerController
{

    public function index(Request $request, Partner $partner)
    {

        $search = $request->search;
        $qnt = $request->qnt ?? 10;

        $partners = $partner->where([
            ['title', 'like','%'.$search.'%'],
        ])->orderBy('id', 'ASC')->paginate($qnt)->withQueryString();
        
        return view('partner::index', [
            'partners' => $partners
        ]);
    }

    public function edit(Partner $partner)
    {
        if(!Auth::user()->permission('EDIT_PARTNER')){
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('action_not_permitted', 'messages')
            ]); 
        }

        return view('partner::edit', [
            'partner' => $partner
        ]);
    }

    public function create()
    {
        if(!Auth::user()->permission('CREATE_PARTNER')){
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('action_not_permitted', 'messages')
            ]); 
        }

        return view('partner::create');
    }

    // STORE

    public function store(
        PartnerStoreRequest $request, 
        Partner $partner
    ) : RedirectResponse 
    {

        $image = $request->file('image');
        
        if($image) {
            $upload = imageUploader($image);
            $partner->image = $upload;
        }

        $partner->title = $request->title;
        $partner->description = $request->description;
        $partner->body = $request->body;
        $partner->status = false;

        if(!$partner->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('create_danger', 'partner::lang.messages')
            ]);
        }

        return redirect()
            ->route(config('partner.routes.index'))
            ->with('toast', [
                'level'   => 'success',
                'message' => textLang('create_success', 'partner::lang.messages')
        ]);
    }

    // UPDATE

    public function update(
        PartnerUpdateRequest $request, 
        Partner $partner
    ) : RedirectResponse 
    {

        $image = $request->file('image');

        if($image) {
            $upload = imageUploader($image);
            $partner->image = $upload ? $upload : $partner->image;
        }

        $partner->title = $request->title ?? $partner->title;
        $partner->description = $request->description ?? $partner->description;
        $partner->body = $request->body ?? $partner->body;
        $partner->status = $request->status ?? $partner->status;

        if(!$partner->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('update_danger', 'partner::lang.messages')
            ]);
        }

        return redirect()
            ->route(config('partner.routes.index'))
            ->with('toast', [
                'level'   => 'success',
                'message' => textLang('update_success', 'partner::lang.messages')
        ]);
    }

    // DELETE
    
    public function destroy(Partner $partner): RedirectResponse 
    {
        
        if(!$partner->delete()) {
            return redirect()
                ->back()
                ->with(['toast' => [
                    'level'   => 'danger',
                    'message' => textLang('delete_danger', 'partner::lang.messages')
            ]]);
        }

        return redirect()
            ->back()
            ->with(['toast' => [
                'level'   => 'success',
                'message' => textLang('delete_success', 'partner::lang.messages')
        ]]);
    }
}
