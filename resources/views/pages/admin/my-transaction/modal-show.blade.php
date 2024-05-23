<div class="modal fade" id="showTransaction{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <label for="categoryName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        value="{{ $row->name }}" disabled>
                </div>
                <div class="col-12">
                    <label for="categoryName" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        value="{{ $row->email }}" disabled>
                </div>
                <div class="col-12">
                    <label for="categoryName" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        value="{{ $row->phone }}" disabled>
                </div>
                <div class="col-12">
                    <label for="categoryName" class="form-label">Address</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        value="{{ $row->address }}" disabled>
                </div>
                <div class="col-12">
                    <label for="categoryName" class="form-label">Payment</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        value="{{ $row->payment }}" disabled>
                </div>
                <div class="col-12">
                    <label for="categoryName" class="form-label">Payment URL</label>
                    <a href="{{ $row->payment_url }}" class="form-control">
                        {{ $row->payment_url }}
                    </a>
                </div>
                <div class="col-12">
                    <label for="categoryName" class="form-label">Status</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        value="{{ $row->status }}" disabled>
                </div>
                <div class="col-12">
                    <label for="categoryName" class="form-label">Total Price</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        value="{{ $row->total_price }}" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
