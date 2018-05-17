<!-- Modal -->
<div id="<?=$data_target?>_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header alert alert-success"  id="<?=$data_target?>_header">
        <h4 class="modal-title" id="<?=$data_target?>_modal_title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"  id="<?=$data_target?>_modal_body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"id="<?=$data_target?>_cancel">Cancel</button>
          <a class="btn btn-danger btn-ok" id="<?=$data_target?>_confirm">Delete</a>
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
            for (var element in reply){
              if (typeof reply[element].html !== 'undefined') {                  
                    $("#"+element).html(reply[element].html)
                }
                if (typeof reply[element].href !== 'undefined') {                  
                    $("#"+element).attr('href',reply[element].href)
                }
                if (typeof reply[element].class !== 'undefined') {                  
                    $("#"+element).attr('class',reply[element].class)
                }
            }
            $('#<?=$data_target?>_modal').modal('show');
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        },
        error: function(response) {
            alert('Error!!!\n\n'+response);
        }
    });
    return false;
});
</script>