<div class="kt-portlet__body">
    <form action="{{route('comment.update')}}" method="post">
        @csrf
        <input name="id" value="{{ $comment->id }}" type="hidden">
        @csrf
        
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" name="followComment" rows="5"  id="comment">{{ $comment->follow_comment }}</textarea>
        </div>
        
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">
                @translate(Save)</button>
        </div>

    </form>
</div>
