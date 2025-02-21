
document
  .getElementById("btn-show-spoil-comment")
  .addEventListener("click", function () {
    var parentElement = document.getElementById("comment-id-1");

    // دسترسی به عنصر فرزند با استفاده از شناسه
    var childElement = parentElement.querySelector("#text");
    childElement.classList.remove("blur-6"); // حذف کلاس highlight
  });

  document
  .getElementById("btn-show-spoil-comment")
  .addEventListener("click", function () {
    var parentElement = document.getElementById("comment-id-1");

    // دسترسی به عنصر فرزند با استفاده از شناسه
    var childElement = parentElement.querySelector("#spoil-alert");
    childElement.classList.add("d-none"); // حذف کلاس highlight
  });

 