<x-admin.elements.input 
    name="image" 
    :label="textLang('image', 'partner::lang.form')"
    type="file" 
    :value="$partner->image ?? old('image')"
    accept=".png, .jpg, .jpeg">
    <small class="form-infos">
        {{ textLang('accepted_files') }}: .png .jpg and .jpeg
    </small>
</x-admin.elements.input>

<x-admin.elements.input 
    name="title" 
    :label="textLang('title', 'partner::lang.form')"
    value="{{ $partner->title ?? old('title') }}"
    required
    maxlength="255"
    minlength="3" />

<x-admin.elements.input 
    name="description" 
    :label="textLang('description', 'partner::lang.form')"
    value="{{ $partner->description ?? old('description') }}"
    required
    maxlength="255"
    minlength="3" />

<x-admin.elements.textarea 
    name="body" 
    :label="textLang('body', 'partner::lang.form')"
    cols="30" 
    rows="10"
    id="editor1"
    minlength="3">
    {{ $partner->body ?? old('body') }}
</x-admin.elements.textarea>
