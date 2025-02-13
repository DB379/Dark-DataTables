$(document).ready(function () {
  // Toggle menu functionality
  const toggleButton = document.getElementById("toggleButton");
  const toggleMenu = document.getElementById("toggleMenu");

  toggleButton.addEventListener("click", (e) => {
    e.stopPropagation();
    toggleMenu.classList.toggle("active");
  });

  document.addEventListener("click", (e) => {
    if (!toggleMenu.contains(e.target)) {
      toggleMenu.classList.remove("active");
    }
  });

  // Initialize DataTable
  const table = $("#dataTable").DataTable({
    processing: true,
    serverSide: true,
    ordering: true, // Omogućava sortiranje
    order: [[0, "asc"]], // Početno sortiranje (prva kolona, uzlazno)
    ajax: {
      url: "/data/fetch",
      type: "POST",
    },
    pageLength: 10,
    columns: [
      {
        data: "id",
      },
      {
        data: "name",
        render: $.fn.dataTable.render.text(),
      },
      {
        data: "email",
        render: $.fn.dataTable.render.text(),
      },
      {
        data: "phone",
        render: $.fn.dataTable.render.text(),
      },
      {
        data: "city",
        render: $.fn.dataTable.render.text(),
      },
      {
        data: "age",
        render: $.fn.dataTable.render.text(),
      },
    ],
    initComplete: function () {
      // Load saved column visibility state
      const hiddenColumns = JSON.parse(
        localStorage.getItem("hiddenColumns") || "[]"
      );
      hiddenColumns.forEach((colIndex) => {
        table.column(colIndex).visible(false);
        $(`.column-checkbox[data-column="${colIndex}"]`).prop("checked", false);
      });
    },
  });

  // Column visibility toggle handling
  $(".column-checkbox").on("change", function () {
    const colIndex = $(this).data("column");
    const isVisible = $(this).is(":checked");

    // Update table
    table.column(colIndex).visible(isVisible);

    // Update localStorage
    let hiddenColumns = JSON.parse(
      localStorage.getItem("hiddenColumns") || "[]"
    );
    if (!isVisible) {
      if (!hiddenColumns.includes(colIndex)) {
        hiddenColumns.push(colIndex);
      }
    } else {
      hiddenColumns = hiddenColumns.filter((col) => col !== colIndex);
    }
    localStorage.setItem("hiddenColumns", JSON.stringify(hiddenColumns));
  });
});
