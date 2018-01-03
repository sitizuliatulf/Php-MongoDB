$("#fakultas").on("change", function(e) {
  var dummy_data = {
    "01": [
      {
        value: "11",
        name: "Manajemen"
      },
      {
        value: "12",
        name: "Akutansi"
      }
    ],
    "02": [
      {
        value: "21",
        name: "Perencanaan Wilayah & Kota"
      },
      {
        value: "22",
        name: "Teknik Industri"
      }
    ],
    "03": [
      {
        value: "31",
        name: "Sistem Informasi"
      },
      {
        value: "32",
        name: "Teknik Informatika"
      }
    ]
  };
  if (dummy_data[e.target.value]) {
    var html = "";
    dummy_data[e.target.value].forEach(function(val, key) {
      html += "<option value" + val.value + ">" + val.name + "</option>";
    });
    $("#jurusan").html(html);
  }
});
