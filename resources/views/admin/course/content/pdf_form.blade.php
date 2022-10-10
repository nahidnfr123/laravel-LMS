<div class="row">
    <div class="col-12 form-group">
        <label for="file">Pdf File</label>
        <input
            type="file"
            class="form-control @error('file') is-invalid @enderror"
            id="file"
            name="file"
        >
        {{$content->pdf ? $content->pdf->file : ''}}
    </div>
</div>
