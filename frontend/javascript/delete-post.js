function delpost(id, title) {
  if (confirm("Are you sure you want to delete '" + title + "'")) {
    window.location.href = '../../backend/posts/delete-post.php?delpost=' + id;
  }
}