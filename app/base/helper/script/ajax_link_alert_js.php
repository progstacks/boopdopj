<script>
$(<?="'#".$id."'"?>).click(function(event) { 
    event.preventDefault(); 
    $.ajax({
        url: $(this).attr('href'),
        success: function(response) {
            alert('Success!!!\n\n'+response);
        },
        error: function(response) {
            alert('Error!!!\n\n'+response);
        }
    });
    return false;
});
</script>