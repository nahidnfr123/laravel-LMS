<div class="row">
    <div class="col-12 form-group">
        <label for="editorNote">Note</label>
        <textarea
            class="form-control @error('note') is-invalid @enderror"
            id="editorNote"
            placeholder="Enter Note"
            name="note"
            style="min-height: 200px"
        >{{old('note', $content->note ? $content->note->note : '')}}</textarea>
    </div>
</div>
