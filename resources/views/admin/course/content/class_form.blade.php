@php
    $link  =  '';
    if($content->live_class && $content->live_class->link){
        $link =$content->live_class->link;
    }else if($content->recorded_class && $content->recorded_class->link){
        $link =$content->recorded_class->link;
    }
@endphp
<div class="row">
    <div class="col-12 col-sm-6 form-group">
        <label for="link">link</label>
        <input
            type="text"
            class="form-control @error('link') is-invalid @enderror"
            id="link"
            name="link"
            placeholder="link"
            value="{{old('link', $link)}}"
        >
    </div>
</div>
