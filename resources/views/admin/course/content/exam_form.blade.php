<div class="row">
    <div class="col-12 form-group">
        <label for="editorDescription">description</label>
        <textarea
            class="form-control @error('description') is-invalid @enderror"
            id="editorDescription"
            placeholder="Enter Exam Description"
            name="description"
            style="min-height: 200px"
        >{{old('description', $content->exam ? $content->exam->description : '')}}</textarea>
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label for="per_question_mark">Per Question marks</label>
        <input
            type="number"
            class="form-control @error('per_question_mark') is-invalid @enderror"
            id="per_question_mark"
            name="per_question_mark"
            placeholder="per_question_mark"
            value="{{old('per_question_mark', $content->exam ? $content->exam->per_question_mark : '')}}"
        >
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label for="negative_mark">negative marks</label>
        <input
            type="number"
            class="form-control @error('negative_mark') is-invalid @enderror"
            id="negative_mark"
            name="negative_mark"
            placeholder="negative_mark"
            value="{{old('negative_mark', $content->exam ? $content->exam->negative_mark : '')}}"
        >
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label for="pass_mark">pass marks</label>
        <input
            type="number"
            class="form-control @error('pass_mark') is-invalid @enderror"
            id="pass_mark"
            name="pass_mark"
            placeholder="pass_mark"
            value="{{old('pass_mark', $content->exam ? $content->exam->pass_mark : '')}}"
        >
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label for="duration">duration</label>
        <input
            type="number"
            class="form-control @error('duration') is-invalid @enderror"
            id="duration"
            name="duration"
            placeholder="duration"
            value="{{old('duration', $content->exam ? $content->exam->duration : '')}}"
        >
    </div>
    <div class="col-12 col-sm-6 form-group">
        <label for="result_publish_time">result_publish_time</label>
        <input
            type="datetime-local"
            class="form-control @error('result_publish_time') is-invalid @enderror"
            id="result_publish_time"
            name="result_publish_time"
            placeholder="result_publish_time"
            value="{{old('result_publish_time', $content->exam ? $content->exam->result_publish_time : '')}}"
        >
    </div>
</div>
