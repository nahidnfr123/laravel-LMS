<div class="row">
    <div class="col-12 col-sm-6 form-group">
        <label for="start_time">Start At</label>
        <input
            type="datetime-local"
            class="form-control @error('start_time') is-invalid @enderror"
            id="start_time"
            name="start_time"
            placeholder="start_time"
            value="{{old('start_time', $content[$content->type] ? $content[$content->type]->start_time : '')}}"
        >
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label for="end_time">End At</label>
        <input
            type="datetime-local"
            class="form-control @error('end_time') is-invalid @enderror"
            id="end_time"
            name="end_time"
            placeholder="end_time"
            value="{{old('end_time', $content[$content->type] ? $content[$content->type]->end_time : '')}}"
        >
    </div>
</div>
