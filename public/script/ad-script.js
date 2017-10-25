$(function() { 
        var img = $(".img");
        var image = $('#image');
	$('.image').on('click', function(event) {
                event.preventDefault();
                var imageRel = $(this).attr('href');
                var zhis = $(this);
        zhis.parent(".min_foto").fadeIn(0, function(){
                                     $(".min_foto.displaynone").fadeOut(0, function(){
                                        var showImg = image.find(".show");
                                        showImg.fadeOut(100, function(){
                                        showImg.removeClass("show").addClass("hide");
                                        image.find("img[src='"+imageRel+"']").parent("a").removeClass("hide").fadeIn(200, function(){
                                        image.find("img[src='"+imageRel+"']").parent("a").addClass("show");
                                           });             
                                        });
                                     }).removeClass("displaynone");
            }).addClass("displaynone");
	});

         img.fancybox({
            openEffect	: 'fade', /* none, fade, elastic */
            closeEffect	: 'fade',
            openSpeed :  300, /* ms, "slow", "normal", "fast"*/
             closeSpeed : 300,
             /* mouseWheel : false,*/
             helpers : {
                  /*title : null */
                 title : {
                      type : 'inside' /* 'float', 'inside', 'outside', 'over', 'null' */
                }
            }
        });
var EmailShow = {};
    EmailShow.Parameter = {};
    EmailShow.Fn = function(Parameter,elem,zhis){
      $.post("/post/email-secret",
            {"email-secret": elem.attr("email-secret")},
         function(data){
            var email = $("<span id='postEmail'>"+data+"</span>").hide(); 
            elem.after(email);
            elem.fadeOut(300, function(){
                email.fadeIn(300);
            });
         }
     ); 
};        
var ButtonEmail = new Button({id:"show-email", Fn:EmailShow});
var ButtonShow = {};
ButtonShow.Parameter = {};
ButtonShow.Fn = function(Parameter,elem,zhis){
         elem.fadeOut(300, function(){
         $("#post-img-phone").fadeIn(300);
     });
};
var ButtonPhone = new Button({id:"show-fone", Fn:ButtonShow});
var EmailPusk = {};
EmailPusk.Paremeter = {};
EmailPusk.Fn = function(){
var bodyHtml = '<form id="formEmail" class="form-horizontal" enctype="multipart/form-data" role="form" accept-charset="UTF-8" action="" method="POST">'
              +'<div class="form-group  has-feedback" id="divVasEmail">'
              +'<div class="col-sm-12">'
              +'<input value="'+$('#user span').text()+'" name="email" class="form-control" id="vasEmail" type="email" placeholder="Email">'
              +'</div></div>'
              +'<div class="form-group  has-feedback" id="divVasEmail">'
              +'<div class="col-sm-12">'
              +'<input type="text" value="'+$('div#post_podr h1').text()+'" name="title" class="form-control" id="titleEmail" placeholder="Заголовок">'
              +'</div></div>'
              +'<div class="form-group  has-feedback" id="divVasEmail">'
              +'<div class="col-sm-12">'
              +'<textarea cols="50" name="text" rows="8" class="form-control" id="post-email" placeholder="Текст письма"></textarea>'
              +'</div></div>'
              +'</form>';
      var ButtonOk = {};
      ButtonOk.Parameter = {};
      ButtonOk.Fn = function(Parameter){ 
      var FormEmailPul = new Form({id:"#formEmail"}); 
      var emailOt = new inputUl({QjObject:$("input#vasEmail"),id:"vasEmail",name:"email",teg:"input",surely:true,ObjectForm:FormEmailPul}); 
          emailOt.QjObject.tooltip('show')        
      var titleOt = new inputUl({QjObject:$("input#titleEmail"),id:"titleEmail",name:"title",teg:"input",surely:true, ObjectForm:FormEmailPul});
      var postOt = new inputUl({QjObject:$("#post-email"),id:"post",teg:"textarea",name:"text",surely:true,ObjectForm:FormEmailPul});
          if(FormEmailPul.Validacij()){ 
              $.post("/ajax/user/message",
                         {
                             email:emailOt.value,
                             title:titleOt.value,
                             text:postOt.value,
                             idPost:$("input#PostId").val(),
                        },
                        function(data){
                                 if(data){
                                     Parameter.myModal.titleEdit = "Ваше сообщение отправлено!";
                                     Parameter.myModal.ButtonOk.QjObject.fadeOut(200, function(){
                                     Parameter.myModal.bodyHtmlEdit = "";
                                     });
                                  } else {
                                     Parameter.myModal.titleEdit = "Произошла ошибка!";
                                     Parameter.myModal.ButtonOk.QjObject.fadeOut(200, function(){
                                     Parameter.myModal.bodyHtmlEdit = "Проверти данные, которые вы вводите.";
                                     });
                                  } 
                          });
               };  
};
    ButtonOk.text = "Отправить";
    var ModalWin = new myModal({title:"Отправить сообщение", bodyHtml:bodyHtml,ButtonOk:ButtonOk});
    ModalWin.Show();
};
var ButtonEmailPusk = new Button({id:"email-pusk-post", Fn:EmailPusk});
});