addEventListener("submit", function(event) {
  if (event.target.classList.contains("delete_comment")) {
    var elements = event.target.elements;
    if (!confirm("Are you sure you want to delete '" + elements.comment.value + "'?")) {
      event.preventDefault();
    }
  }
});