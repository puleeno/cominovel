(function($){
  $(document).ready(function(){
    $('#post_parent').select2();
    $('#post_parent').on('change', function(e) {
      $.ajax({
        url: window.cominovel_chapter.endpoints.update_chapter_parent,
        method: 'PUT',
        data: {
          chapter_id: window.cominovel_chapter.current_id,
          parent: $(this).val(),
        },
        dataType: 'JSON',
      });
    });
  })
})(jQuery);