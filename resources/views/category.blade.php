@extends('layouts.main')
@section('content')
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">DELETE CATEGORY</h4>
            </div>
            <div class="modal-body">
                <label><strong>Are you sure you want to delete?</strong></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-close"> Cancel</i>
                </button>
                <button type="button" class="btn btn-success" id="btn_delete">
                    <i class="fa fa-check-circle"> Yes</i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exists" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel1">EXISTS</h4>
            </div>
            <div class="modal-body">
                <label><strong>This Category is already in use so can't delete.</strong></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-close"> Cancel</i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row  dataTable">
      <div class="col-xs-12 col-sm-6 col-lg-12" id="fleet_data">
        <div class="box">
          <div class="box-body table-responsive">
          <h5 class="success alert alert-success hidden animated"></h5>
            <table id="data_table" class="table table-bordered table-striped display  nowrap">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Action</th>
              </thead>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
</div>
@endsection