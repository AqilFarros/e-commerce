<!-- Basic Modal -->
<div class="modal fade" id="updateStatus{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.transaction.update', $row->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">{{ $row->name }} - {{ $row->phone }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="success">Success</option>
                                <option value="pending">Pending</option>
                                <option value="settlement">Settlement</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Basic Modal-->
