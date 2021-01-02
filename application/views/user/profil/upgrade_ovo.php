<button onclick="open_modal();">Open modal with jQuery</button>
<!-- Start Modal -->
<div class="modal fade" id="theModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content here-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="hide_modal();">X</button>
                <h4 class="modal-title">Modal heading text</h4>
            </div>
            <div class="modal-body">
                <p>Modal content will be here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="hide_modal();">Close</button>
            </div>
        </div>

    </div>
</div>

</div>
<script type="text/javascript">
    function open_modal() {
        $('#theModal').modal('show');
    }

    function hide_modal() {
        $('#theModal').modal('hide');
    }
</script>