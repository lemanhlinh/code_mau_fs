submit_comment();

$(document).ready(function() {
  $('#submitbt_p').click(function() {
    //alert(123);
    if (checkFormsubmit_p())
      document.contact_popup.submit();
  })


  // update hits
  setTimeout(function() {
    var product_id = $('#product_id').val();
    $.get("/index.php?module=products&view=product&task=update_hits&raw=1", {
      id: product_id
    }, function(status) {});
  }, 3000);


});

function buy_add(product_id) {
  var quantity = $('#quantity').val();
  var lang = $('#lang').val();
  link = '/index.php?module=products&view=cart&task=buy_multi&id=' + product_id + '&quantity=' + quantity + '&lang=' + lang + '&Itemid=94';
  id_add = '';
  i = 0;
  if ($('.product_incentives')) {
    $('.product_incentives').each(function(index) {
      if ($(this).is(':checked')) {
        if (i > 0)
          id_add += ',';
        id_add += $(this).val();
        i++;
      }
    });
  }
  if (id_add) {
    link += '&add=' + id_add
  }
  window.location = link;
}

function favourite(id) {
  $.ajax({
    url: root + "index.php?module=products&view=favourites&task=add&raw=1&data=" + id,
    cache: false,

    success: function(json) {
      json = jQuery.trim(json);
      if (json == '1') {
        alert("Bạn đã lưu thành công vào danh mục yêu thích");
        return 0;
      } else if (json == '2') {
        alert("Sản phẩm này đã tồn tại trong danh mục yêu thích của bạn");
        return true;
      } else if (json == '3') {
        alert("Bạn phải đăng nhập thì mới được sử dụng chức năng này.");
        return true;
      } else {
        alert("Không lưu vào danh mục yêu thích");
        return true;
      }
    },
    error: function() {
      console.log('error');
      return false;
    }
  });
}


function submit_comment() {
  $('#commentbt').click(function() {
    if (!notEmpty("_txtcomment", "Bạn phải nhập nội dung"))
      return false;
    document.comment.submit();
  });
}

function checkFormsubmit_p() {
  $('label.label_error').prev().remove();
  $('label.label_error').remove();
  email_new = $('#email_new').val();

  if (!notEmpty("contact_name", "Bạn chưa nhập họ và tên")) {
    return false;
  }
  if (!lengthMin("contact_name", 6, '"Họ tên của bạn" phải 6 kí tự trở lên, vui lòng sửa lại!')) {
    return false;
  }

  if (!notEmpty("contact_phone", "Bạn chưa nhập số liên hệ"))
    return false;

  if (!isPhone("contact_phone", "Bạn chưa nhập đúng định dạng"))
    return false;
  if (!lengthMin("contact_phone", 8, '"Số điện thoại" phải 8 kí tự trở lên, vui lòng sửa lại!')) {
    return false;
  }

  if (!notEmpty("contact_address", "Bạn chưa nhập địa chỉ")) {
    return false;
  }

  if (!isNumeric("quantity", "Yêu cầu nhập số lượng sản phẩm,đúng định dạng số"))
    return false;

  if (!minprice("quantity", 1, 'Số lượng sản phẩm phải lớn hơn 0')) {
    return false;
  }
  //if(!notEmpty("contact_email","Bạn chưa nhập Email")){
  //		return false;
  //	}
  //	if(!emailValidator("contact_email","Emal không đúng định dạng")){
  //		return false;
  //	}


  if (!notEmpty("txtCaptcha_p", "Nhập mã xác minh"))
    return false;

  $.ajax({
    url: "/index.php?module=users&task=ajax_check_captcha&raw=1",
    data: {
      txtCaptcha: $('#txtCaptcha_p').val()
    },
    dataType: "text",
    async: false,
    success: function(data) {
      console.log(data);
      $('label.username_check').prev().remove();
      $('label.username_check').remove();
      if (data == '0') {
        invalid('txtCaptcha_p', 'Captcha là không chính xác.');
        //alert('Captcha is incorrect');
        //console.log('--------');
        return false;
      } else {
        valid('txtCaptcha_p');
        console.log('+++');
        document.contact_popup.submit();
        return true;
      }
    }
  });
}

var OrderUI = {
  _calculator_link: root + 'index.php?module=products&view=product&task=calculator&raw=1',
  get_districts: root + 'index.php?module=products&view=product&task=Get_Districts&raw=1',
  link_order: $('#link_order').val(),
  init: function(loadUserData) {
    this._Onload();
    this._Show_Districts();
  },

  _Onload: function() {
    var _self = this;
    var _sm = $('#sm-chargeable'); //sm-chargeable
    _sm.on('click', function(e){
        var total_order = $('#total_order').val();
        var districts = $('#districts').find(':selected').data('group'); //$('#districts').val();

        var type = $('#type').val();

        _self._calculator(total_order,districts,type);
    });

    var reset = $('#reset-chargeable');
    reset.on('click', function(e){
      $('.quantity span').text(0);
      $('.total-price span').text(0);
      $('#total_order').val(0);
    });

    return false;
  },

  _Show_Districts : function(){ // lay danh sach quan/huyen
    var _self = this;
    var districts = $('#districts');

    $(document).on('change', '#city', function(e) {
      var id = $(this).find(':selected').data('id');
      if(!id)
        return false;

      $.post(_self.get_districts, 
        {
          id: id,
        }, function(data) {
          if (data.success == true) {
            districts.html(data.html);
          }
        }, 'json');
    });

    return false;
  },

  _calculator: function(total_order = 0,group = 0,type = 0){
    var _self = this;
    var quantity = $('.quantity span'),
        total_ = $('.total-price span');

    $.post(_self._calculator_link, 
    {
      total_order: total_order,
      group: group,
      type: type,
    }, function(data) {
      if (data.success == true) {
        quantity.html(data.quantity);

        total_price = _self.addCommas(data.total_price);
        total_.html(total_price);
        $('#_quantity').val(data.quantity);
        $('#_total_price').val(data.total_price);
      }
    }, 'json');

    return false;
  },

  addCommas: function(nStr) {
      var _self = this;
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
  },

};

$(function() {
  OrderUI.init();
}); 
