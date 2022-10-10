<div class="row">
    <div class="col-12 col-sm-6 form-group">
        <label for="link">link</label>
        <input
            type="text"
            class="form-control @error('link') is-invalid @enderror"
            id="link"
            name="link"
            placeholder="link"
            value="{{old('link', $content->live_class ? $content->live_class->link : '')}}"
        >
    </div>
</div>
