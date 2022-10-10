<div class="row">
    <div class="col-12 form-group">
        <label for="editor">Question</label>
        <textarea
            class="form-control @error('question') is-invalid @enderror"
            id="editor"
            placeholder="Enter the Question"
            name="question"
            style="min-height: 200px"
        >{{old('question', $content->assignment ? $content->assignment->question : '')}}</textarea>
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label for="total_mark">Total marks</label>
        <input
            type="number"
            class="form-control @error('total_mark') is-invalid @enderror"
            id="total_mark"
            name="total_mark"
            placeholder="total_mark"
            value="{{old('total_mark', $content->assignment ? $content->assignment->total_mark : '')}}"
        >
    </div>
</div>

