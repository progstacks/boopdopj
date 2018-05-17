<!-- Modal -->
<div id="<?=$data_target?>_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header alert alert-success" >
        <h4 class="modal-title" id="<?=$data_target?>_modal_title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"  id="<?=$data_target?>_modal_body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(<?="'#".$data_target."'"?>).click(function(event) { 
    event.preventDefault();
    $.ajax({
        url: $(this).attr('href'),
        success: function(response) {
            var reply = JSON.parse(response);
            for (var key in reply){
                $("#"+key).html(reply[key])
            }
            $('#<?=$data_target?>_modal').modal('show');
        },
        error: function(response) {
            alert('Error!!!\n\n'+response);
        }
    });
    return false;
});
</script>