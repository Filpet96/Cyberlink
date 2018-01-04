addEventListener("submit", function(event) {
  if (event.target.classList.contains("deletepost")) {
    var elements = event.target.elements;
    if (!confirm("Are you sure you want to delete '" + elements.postTitle.value + "'?")) {
      event.preventDefault();
    }
  }
});