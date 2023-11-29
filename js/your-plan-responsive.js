function toggleMenu() {
  if ($(window).width() > 720) {
    $(".popup-menu").hide();
  }
}
$(document).ready(function () {
  $("input").each(function (index) {
    $(this).css("width", $(this).val().length + 0.5 + "ch");
  });

  // Toggle the menu when the menu icon is clicked
  $("#menu-icon").click(function () {
    $(".popup-menu").slideToggle();
  });
  $(window).resize(function () {
    toggleMenu();
  });
  // Function to toggle the edit mode
  function toggleEditMode(editableField) {
    const isReadOnly = editableField.prop("readonly");
    if (isReadOnly) {
      editableField.removeAttr("readonly").focus();
    } else {
      editableField.prop("readonly", true);
    }
  }

  // Event listener for clicking the edit icon
  $(".edit-button").click(function () {
    $(this).removeClass().addClass("fa fa-spinner fa-spin  edit-button");

    const editableField = $(this)
      .closest(".category-item")
      .find(".editable-field");
    toggleEditMode(editableField);
  });
});
