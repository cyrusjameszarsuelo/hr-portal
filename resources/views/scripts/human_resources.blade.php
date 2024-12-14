<script>
  
  function getGenAnnouncementData(title, content_type, created_at, content, image) {
    var isContent = '';

    if (content !== '') {
      isContent = 'class="img-modal"';
    }

    $("#imageGeneralAnnouncement").html('<img src="'+image+'" width="100%" alt="" '+isContent+'>');
    $("#titleGeneralAnnouncement").html(title);
    $("#textGeneralAnnouncement").html(content);

  }

</script>