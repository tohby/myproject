<!-- Delete Modal -->
<div class="modal fade" id="delete{{$comment->id}}" tabindex="-1" role="dialog"
    aria-labelledby="delete{{$comment->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title font-weight-bold" id="deleteModalLabel">Are you sure you want to delete this
                    Comment ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                This action is not reversible.
            </div>
            <div class="modal-footer border-0">
                <form action="{{action("CommentController@destroy", "$comment->id")}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- delete modal end --}}