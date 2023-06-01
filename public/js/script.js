$("header .menu a").hover(
  function () {
    $(this).css("background-color", "orange");
  },
  function () {
    $(this).css("background-color", "inherit");
  }
);

$("header .feature a").hover(
  function () {
    $(this).addClass("bubble");
  },
  function () {
    $(this).removeClass("bubble");
  }
);

$("article.cart a.back").hover(
  function () {
    $(this).removeClass("text-decoration-none");
  },
  function () {
    $(this).addClass("text-decoration-none");
  }
);

$(".tombolDetail").on("click", function () {
  const id = $(this).data("id");
  const base_url = window.location.origin;


  $.ajax({
    url: base_url + "/moriarty/public/pages/getDetail",
    data: { id: id },
    method: "post",
    dataType: "json",
    success: function (data) {
      let harga = data.harga;
      harga = harga.substring(-3, 3) + "." + harga.substring(3, harga.length);
      $('#sampul').attr("src", base_url + "/moriarty/public/img/article/" + data.sampul);
      $('#nama').html(data.nama);
      $('#created').html(data.created_at);
      $('#harga').html("Harga: Rp. "+ harga);
      $('#stok').html("Stok: "+ data.stok);
      $('#ukuran').html("Ukuran: "+ data.ukuran);
    }
  });
});


$(".tombolAddMenu").on("click", function () {
  const base_url = window.location.origin;
  $('#menuModalLabel').html('Add New Menu');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/menu/addMenu");
  $("#id").val("");
  $("#menu").val("");
});

$(".tombolEditMenu").on("click", function () {
  const base_url = window.location.origin;
  $('#menuModalLabel').html('Edit Menu');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/menu/editMenu");
  const id = $(this).data("id");

  $.ajax({
    url: base_url + "/moriarty/public/menu/getMenu",
    data: { id: id },
    method: "post",
    dataType: "json",
    success: function (data) {
      $("#id").val(data.id);
      $("#menu").val(data.menu);
    },
  });
});

$(".tombolAddSubMenu").on("click", function () {
  const base_url = window.location.origin;
  $('#submenuModalLabel').html('Add New Sub Menu');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/menu/addSubMenu");
  $("#id").val("");
  $("#title").val("");
  $("#menu_id").val("");
  $("#url").val("");
});

$(".tombolEditSubMenu").on("click", function () {
  const base_url = window.location.origin;
  $('#submenuModalLabel').html('Edit SubMenu');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/menu/editSubMenu");
  const id = $(this).data("id");

  $.ajax({
    url: base_url + "/moriarty/public/menu/getSubMenu",
    data: { id: id },
    method: "post",
    dataType: "json",
    success: function (data) {
      $("#id").val(data.id);
      $("#title").val(data.title);
      $("#menu_id").val(data.menu_id);
      $("#url").val(data.url);
    },
  });
});


$('.form-check-input').on('click', function(){
  const base_url = window.location.origin;
  const menuId = $(this).data('menu');
  const roleId = $(this).data('role');

  $.ajax({
    url: base_url + "/moriarty/public/admin/changeaccess",
    type: 'post',
    data: {
        menuId: menuId,
        roleId: roleId
    },
    success: function() {
      document.location.href = base_url + "/moriarty/public/admin/role-access/" + roleId;
    }
  });
});

// EDIT ITEM

$(".tombolAdditem").on("click", function () {
  const base_url = window.location.origin;
  $('#itemModalLabel').html('Add New Item');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/admin/addNewItem");
  $("#id").val("");
  $("#nama").val("");
  $("#harga").val("");
  $("#stok").val("");
  $("#ukuran").val("");
  $("#sampul").val("");
});

$(".tombolEdititem").on("click", function () {
  const base_url = window.location.origin;
  $('#itemModalLabel').html('Edit Item');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/admin/editItem");
  const id = $(this).data("id");

  $.ajax({
    url: base_url + "/moriarty/public/admin/getItem",
    data: { id: id },
    method: "post",
    dataType: "json",
    success: function (data) {
      $("#id").val(data.id);
      $("#nama").val(data.nama);
      $("#harga").val(data.harga);
      $("#stok").val(data.stok);
      $("#ukuran").val(data.ukuran);
      $("#sampulLama").val(data.sampul);
    },
  });
});

// EDIT LOOKBOOK
$(".tombolAddlookbook").on("click", function () {
  const base_url = window.location.origin;
  $('#lookbookModalLabel').html('Add New Lookbook');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/admin/addNewLookbook");
  $("#id").val("");
  $("#namalb").val("");
  $("#gambarp").val("");
  $("#gslide1").val("");
  $("#gslide2").val("");
  $("#gslide3").val("");
});

$(".tombolEditlookbook").on("click", function () {
  const base_url = window.location.origin;
  $('#lookbookModalLabel').html('Edit Lookbook');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/admin/editLookbook");
  const id = $(this).data("id");

  $.ajax({
    url: base_url + "/moriarty/public/admin/gettingLookbook",
    data: { id: id },
    method: "post",
    dataType: "json",
    success: function (data) {
      $("#id").val(data.id);
      $("#namalb").val(data.namalb);
      $("#posterLama").val(data.gambarp);
      $("#gslideLama1").val(data.gslide1);
      $("#gslideLama2").val(data.gslide2);
      $("#gslideLama3").val(data.gslide3);
    },
  });
});

// EDIT ROLE
$(".tombolAddRole").on("click", function () {
  const base_url = window.location.origin;
  $('#roleModalLabel').html('Add New Role');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/admin/addNewRole");
  $("#id").val("");
  $("#role").val("");
});

$(".tombolEditRole").on("click", function () {
  const base_url = window.location.origin;
  $('#roleModalLabel').html('Edit Lookbook');
  $(".modal-body form").attr("action", base_url + "/moriarty/public/admin/editRole");
  const id = $(this).data("id");

  $.ajax({
    url: base_url + "/moriarty/public/admin/getRole",
    data: { id: id },
    method: "post",
    dataType: "json",
    success: function (data) {
      $("#id").val(data.id);
      $("#role").val(data.role);
    },
  });
});

// IMAGE UPLOAD
function previewImg(){
    const sampul = document.querySelector('#sampul');
    const imgPreview = document.querySelector('.img-preview');
    
    const fileSampul = new FileReader();
    fileSampul.readAsDataURL(sampul.files[0]);
    
    fileSampul.onload = function(e) {
      imgPreview.src = e.target.result;
    }
}

function previewImgLb1(){
    const lbgambar1 = document.querySelector('#gambarp');

    const imgPreviewlb1 = document.querySelector('.img-previewlb1');


    const fileLb = new FileReader();
    fileLb.readAsDataURL(lbgambar1.files[0]);
    
    fileLb.onload = function(e) {
      imgPreviewlb1.src = e.target.result;
    }

}
function previewImgLb2(){
    const lbgambar2 = document.querySelector('#gslide1');

    const imgPreviewlb2 = document.querySelector('.img-previewlb2');

    const fileLb = new FileReader();
    fileLb.readAsDataURL(lbgambar2.files[0]);
    
    fileLb.onload = function(e) {
      imgPreviewlb2.src = e.target.result;
    }

}
function previewImgLb3(){
  const lbgambar3 = document.querySelector('#gslide2');

    const imgPreviewlb3 = document.querySelector('.img-previewlb3');

    const fileLb = new FileReader();
    fileLb.readAsDataURL(lbgambar3.files[0]);
    
    fileLb.onload = function(e) {
      imgPreviewlb3.src = e.target.result;
    }

}
function previewImgLb4(){
    const lbgambar4 = document.querySelector('#gslide3');

    const imgPreviewlb4 = document.querySelector('.img-previewlb4');

    const fileLb = new FileReader();
    fileLb.readAsDataURL(lbgambar4.files[0]);
    
    fileLb.onload = function(e) {
      imgPreviewlb4.src = e.target.result;
    }

}

function previewProfile(){
    const gambar = document.querySelector('#gambar');

    const imgProfile = document.querySelector('.img-profile');

    const fileProfile = new FileReader();
    fileProfile.readAsDataURL(gambar.files[0]);
    
    fileProfile.onload = function(e) {
      imgProfile.src = e.target.result;
    }

}


