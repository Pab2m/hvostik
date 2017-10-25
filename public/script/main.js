//var UrlImg, post=new Object();
function Cshtora(){
   var htmlHtora = '<div id="htora"><div id="proces"><img  width="64" height="64" src="/img/loading-spinning-bubbles.svg"></div></div>';
   var JqHtora = null;  
   this.GethtmlHtora = function(){
        return htmlHtora;
   }  
   this.False = function(){
      this.JqHtora.show().hide(300);
   }
    }
Cshtora.True = function(){
    var Ht = new Cshtora;
    $('body').after(Ht.GethtmlHtora);
    Ht.JqHtora = $("#htora");
    Ht.JqHtora.hide().show(300);
    return Ht;
} 


function Form(Object){
    this.id = Object.id || null,
    this.active = Object.active || true;        
    this.arryForm = {};
    this.length = 0;
    this.button = Object.button || null;
    if(Object.button instanceof  Button){
       Object.button.ObjectForm = this; 
    }
    if(this.id){
     this.QjObject = $(this.id);   
    }
      
    this.PushArray = function(object){ //PushArray 
          this.arryForm[object.name] = object; 
          this.length ++;
    },
     this.DeleteArray = function(object){
         delete this.arryForm[object.name];
         this.length --;
     };       
            
    this.Validacij = function(Objekt){
        var validateForma = true, validatePole = true;
        var Validate = function(Objekt){
            Objekt.ValidateNo();
            validatePole = false;
           return false; 
        };        
        var ObjektA = Objekt || this; 
      for(var key in ObjektA.arryForm){ 
        if(((!ObjektA.arryForm[key].value)||(ObjektA.arryForm[key].value==''))&&(ObjektA.arryForm[key].surely)){ 
           validateForma = Validate(ObjektA.arryForm[key]);
        }
        if((validatePole) && (ObjektA.arryForm[key] instanceof inputUl) && (ObjektA.arryForm[key].type === "email")){
          var reMail = /^(?!.*@.*@.*$)(?!.*@.*\-\-.*\..*$)(?!.*@.*\-\..*$)(?!.*@.*\-$)(.*@.+(\..{1,11})?)$/;
             if(!reMail.test(ObjektA.arryForm[key].value)){ 
               validateForma = Validate(ObjektA.arryForm[key]);
               }      
        }
         validatePole = true;
    } 
    return validateForma;}
     
    this.submit = function(){
       this.QjObject.submit();
    };
    

}
function SeletUl(Object){// #id,oberka,divContener - обязательны   
       this.id = Object.id || null,
       this.name =  Object.name || this.id.split('#')[1], 
       this.oberka = Object.oberka || false,// form#id
       this.oberkaJq = Object.oberkaJq || $(Object.oberka) || null,
       this.oberkaClass = Object.oberkaClass || false,
       this.parentDiv = Object.divContener || false;
       if(Object.QjObject === undefined){  
       this.QjObject = this.oberka !== false || this.id !== false ? $(this.oberka+" "+this.id): false;
       } else {this.QjObject = Object.QjObject;} 
       this.value = false,
       this.placeholder = Object.placeholder || false,
       this.html =  null,
       this.parent = Object.parent || null,
       this.child = [],
       this.json = null,
       this.ObjectForm = Object.ObjectForm || false,
       this.surely = Object.surely || false,
       this.metka = Object.metka,
       this.childEdit = function(){
           var edit = this.child.length;
           if((this.child.length === 1)||(this.child.length === 0)){
             return this;  
           } else{
            return  this.child[edit-2];}  
       },
       
      this.HtmlGet = function(){
          if((this.id!==false)){
          this.name = this.name === false ? this.id.split('#')[1]+"_name":this.name;  
          this.QjObject = $(this.id); 
          this.oberkaJq  = $(this.oberka);
          if(!this.placeholder){
          this.placeholder = this.QjObject.attr("data-placeholder");}
         }
         if(this.html == null){
            this.html = $(this.oberka).html();
         }
        // console.log(this.QjObject);
       },
       

       this.choneSelect = function(){
           $(this.id).chosen();
       },
               
      this.childSeletSQL = function(url, json, option, bd,Fn){
           var jsonTrue = json || false;
           var thisObject = this;
           
           if(this.parent.value !== false){     
           var FN = Fn || function(){};    
         if(!bd){
           if(this.parent.valueArray == null){
           url += '/'+this.parent.value;
            } else {url += '/'+this.parent.valueArray[this.parent.value]; }}
        else { url += '/'+bd;}
      $.ajax({
         url: url,
          success: function(data){
            var  dataArray = JSON.parse(data);
            var htmlOption ="<option value=''></option>\n";
            if(option){
               htmlOption += option;
            }
            for(var i=0; i<dataArray.length; i++){
               htmlOption += "<option value='"+dataArray[i]["id"]+"'>"+dataArray[i]["name"]+"</option>\n"
              }
           thisObject.html = "<div id='"+thisObject.oberka.split('#')[1]+"' class='"+thisObject.oberkaClass+"'>\n"+ //split обрезает #
                     "<select data-placeholder='"+thisObject.placeholder+"' style='' class='chosen-select' tabindex='7' id='"+thisObject.id.split('#')[1]+"' name='"+(thisObject.name || thisObject.id.split('#')[1]) +"'>\n"+
                     htmlOption+"</select>\n</div>";

         if(!jsonTrue){
             $(thisObject.parent.childEdit().oberka).after(thisObject.html);
             thisObject.HtmlGet();
          
             $(thisObject.oberka).hide().fadeIn(300);
             thisObject.choneSelect();
        } else {
            thisObject.Delete();
            $(thisObject.parent.childEdit().oberka).after(thisObject.html);
             $(thisObject.oberka).hide().show(300);
             thisObject.HtmlGet();
             thisObject.choneSelect();
             }
          FN();   
          }});
           }},
          
       this.JsonOptionSet = function(url, FN){
        var arr,json;
        var F = FN || function(){};
        var ObjectSelect = this;
         $.ajax({
          url: url,
          dataType:json,
          success: function(data){
              var htmlOption ="<option value=''></option>\n";
              for(var i=0; i<data.length; i++){
               htmlOption += "<option value='"+data[i]["id"]+"'>"+data[i]["name"]+"</option>\n"
              }
             ObjectSelect.QjObject.html(htmlOption);
             ObjectSelect.choneSelect();
             F();
             }
          });
    },
      this.ObjectChange =  function(ObjectFun){
      var  objetThis = this; 
      objetThis.QjObject.on("change", function(){  
      objetThis.value = objetThis.QjObject.val();
      if(ObjectFun){
         ObjectFun(objetThis); 
      }
     }); 
           };
             
   this.Delete = function(){
        if((this.oberka)&&(document.getElementById(this.oberka.split('#')[1]) !== null)){
        document.getElementById(this.oberka.split('#')[1]).remove();
        this.ObjectForm.DeleteArray(this);
    }};
    this.OptionSet = function(Object){
        if(Object.option){
        var optionHtml = this.QjObject.html();
            
        }
    };
    this.Set = function(id){
    if(id != undefined){   
    this.value = id;
    var Bd = this.QjObject.find("option[value='"+ this.value +"']");
    Bd.attr("selected","selected"); 
    $("div"+this.id+"_chosen span").text(Bd.text());
   }
    }
  if(this.ObjectForm !== false){
  this.ObjectForm.PushArray(this);
  };
  this.NameValue = function(){
   return  this.oberkaJq.find("a.chosen-single span").text();
  };
}
 
 SeletUl.prototype.ValidateNo = function(){ 
   this.oberkaJq.find('.chosen-single').css({border:"2px solid red"});
  var Object = this;
  var Fn = function(Object){
   $(Object.oberka).find('.chosen-single').css({border:"2px solid #24C8FF"});
  };  
  Object.QjObject.one("change",function(){
      Fn(Object);
  }); 
 }
var inputUl = function(ObjectA){
    this.teg = ObjectA.teg || null;
    this.id = ObjectA.id || null;
    this.oberka = ObjectA.oberka || null;
    this.name =  ObjectA.name || this.id.split('#')[1] || null;
    this.html = ObjectA.html || null;
    this.QjObject = ObjectA.QjObject || null;
    if(this.QjObject == null){
      if(this.id != null){
        if(this.oberka){
          this.QjObject = $(this.oberka+" "+this.id);  
        } else{this.QjObject = $(this.id);}
    } else if((this.name!=null) &&(this.teg !== null)){   
          this.QjObject = $(this.teg+" [name='"+this.name+"']");  
    } else if(this.html){ 
        this.QjObject = $(this.html);}
    }
    this.value = ObjectA.value || this.QjObject.val() || '';
    
    this.placeholder = ObjectA.placeholder || null,
    this.type = ObjectA.type || this.QjObject.attr("type") || null,
    this.class = ObjectA.class || null,
    this.maxSize = ObjectA.maxSize || null, 
    this.parent = ObjectA.parent || null,
    this.child = [],
    this.ObjectForm = ObjectA.ObjectForm || null,
    this.surely = ObjectA.surely || false,
    this.metka = ObjectA.metka;
    
    this.htmlGet = function(){
       if(this.QjObject){   
        this.name = this.QjObject.attr("name");
        this.type = this.QjObject.attr("type");
        this.placeholder = this.QjObject.attr("placeholder");
        this.value = this.QjObject.val();
        this.class = this.QjObject.attr("class");
      }else{console.log("Error htmlGet:"+this.QjObject); }
    };
    this.htmlSet = function(){ 
         $(this.parent.childEdit().oberka).after(this.QjObject);
         if(this.id != null){
        if(this.oberka){
          this.QjObject = $(this.oberka+" "+this.id);  
        } else{this.QjObject = $(+this.id);}
    } else if(this.name!=null){   
          this.QjObject = $(this.teg+"[name='"+this.name+"']");  
    }
    this.name = this.QjObject.attr("name"); 
    }; 
    this.val = function(value){
       this.value = value; 
       this.QjObject.val(value); 
    }
    this.ValueSetRadio = function(id) {
        if(id != undefined){
         var val = this.QjObject.filter("input[value="+id+"]");
         val.prop({checked:true});
        }
    };
    
     var zhis = this;
        if( this.ObjectForm!==null){
        this.ObjectForm.PushArray(this);
           
    }

     this.Delete =  function(){
            if((this.oberka)&&(document.getElementById(this.oberka.split('#')[1]) !== null)){
            document.getElementById(this.oberka.split('#')[1]).remove();
            if(this.ObjectForm!==null){
            this.ObjectForm.DeleteArray(this);}
        }}
    if(!this.QjObject){
          this.QjObject = $(this.id);  
    }
      
  if(this.QjObject.length){                 
  if((this.type =="radio")||(this.type  == "checkbox")){
        this.QjObject.on("change",function(){
           this.value = this.QjObject.val();
        });
  }else{  
  this.QjObject.on("focusout",function(){
           zhis.value = zhis.QjObject.val();
         });
  zhis.QjObject.on("input",function(){
  zhis.value = zhis.QjObject.val();
    if((zhis.maxSize)&&(zhis.value.length>zhis.maxSize)){
       zhis.QjObject.val(zhis.value.slice(0, -1));
    }
        });
 }}
 }
        
inputUl.inputUlSet = function(Object){
  if(Object.id){  
 var  NewinputUl = new inputUl(Object);
      NewinputUl.QjObject = $(NewinputUl.id);
      NewinputUl.oberka === null ? NewinputUl.QjObject.parent("div").attr("id"): NewinputUl.oberka;
      NewinputUl.class = NewinputUl.QjObject.parent("div").attr("class");
      NewinputUl.name = NewinputUl.QjObject.attr('name') || NewinputUl.id;
      NewinputUl.type = NewinputUl.QjObject.attr('type');
      NewinputUl.value = NewinputUl.QjObject.val();
      NewinputUl.placeholder = NewinputUl.QjObject.attr('placeholder');
      NewinputUl.metka = Object.metka;
      return NewinputUl;  
 }       
}
inputUl.prototype.ValidateNo = function(){
      this.QjObject.css({border:"1px solid red"});
      var Object = this;
     Object.QjObject.one("click",function(){
     Object.QjObject.css({border:"1px solid #ccc"});
  }); 
};

function Button(ObjectP){ 
       this.id = ObjectP.id || null,
       this.oberka = ObjectP.oberka || false,// form#id
       this.oberkaJq = $(ObjectP.oberka) || null,
       this.oberkaClass = ObjectP.oberkaClass || false,
       this.parentDiv = ObjectP.parentDiv || false,  
       this.class = ObjectP.class || null;
       this.text = ObjectP.text || null,
       this.html = ObjectP.html || null,
       this.ObjectForm = ObjectP.ObjectForm,
       this.Fn = ObjectP.Fn || null; 
       this.delegirovanie = ObjectP.delegirovanie || false;

       this.QjObjectUpdating = function(){
           if(this.id !== null){
              this.QjObject = $("#"+this.id);
           } else {
               if(this.class !== null){
                 this.QjObject = $("."+this.class);
               } else if(this.html != null ) {
                   this.QjObject = $(this.html);
               } else {
                  this.QjObject = null;  
               }
           }
       };

       if((ObjectP.QjObject === undefined) || (ObjectP.QjObject === null)){
       this.QjObjectUpdating();
       } else {
           this.QjObject = ObjectP.QjObject;
       };
      this.QjObjectUpdatingHtml = function(){
         if(this.html != null){
           this.QjObject = $(this.html);  
         } else {
            this.QjObject = null; 
         }  
       }; 
        /**
         * Проверить есть ли событие eventname на элементе element
         * @param object element jQuery-элемент
         * @param string eventname название события
         * @returns bool
         */
        var checkEvent = function(zhis) {
            /**
            * Получить список событий, которые висят на элементе
            * @param object element jQuery элемент
            * @returns object|false
            */
             var eventsList = function(zhis) { ;
            //В разных версиях jQuery список событий получается по-разному
           var events = $._data(zhis.QjObject.get(0), 'events');
            if (events !== undefined) return events;
              return events;
            }
            var events, ret = false;
            events = eventsList(zhis);
            if (events!==false) {
                for (var key in events) {
                    if (key == 'click') {
                        ret = true;
                    }
                }
            }
            return ret;
        }

          
     if(this.Fn != null){
      var Parameter = ObjectP.Fn.Parameter || {};
      var Function = ObjectP.Fn.Fn || ObjectP.Fn || null; 
      
      if((Function !== undefined) ||(Function !== null)){  
          
       var zhis = this; 
       if(!checkEvent(zhis)){
       if((this.delegirovanie) && (this.parentDiv !== false)){
        $("#"+this.parentDiv).on("click","."+this.class, function(){ 
            var elem = $(this); 
            Function(Parameter,elem,zhis);  
          });    
       } else {
           this.QjObject.on("click", function(){
               var elem = $(this);
               Function(Parameter,elem, zhis); 

           });
       }  
   }}

    }
   Object.defineProperty(this, "textEdit", {
        set: function(value) {
             this.text = value;
             this.QjObject.text(this.text);
            }
    });
    Object.defineProperty(this, "FunctionEdit", {
        set: function(ObjectP) {
            this.QjObject.unbind("click");
            Parameter = ObjectP.Parameter;
            Function = ObjectP.Fn.Fn;
          if((Function !== undefined) ||(Function !== null)){  
           var zhis = this;
       if((this.delegirovanie) && (this.parentDiv !== false)){
    
        $("#"+this.parentDiv).on("click","."+this.class, function(){
            var elem = $(this); 
            Function(Parameter,elem);   
          });    
       } else {
           this.QjObject.on("click", function(){
               var elem = $(this);
               Function(Parameter,elem); 
           });
       }  
   }
            }
    });
}

 
 function Fails(FormJq,Fn){
    // Обаботка события нажатия на кнопку "Загрузить". Проходим по всем миниатюрам из списка,
    // читаем у каждой свойство file (добавленное при создании) и начинаем загрузку, создавая
    // экземпляры объекта uploaderObject. По мере загрузки, обновляем показания progress bar,
    // через обработчик onprogress, по завершении выводим информацию
         var imgList = $('ul#img-list');
         var i=0;
         if(imgList.find('li').length!==0){
         var ImgAjaxN = 0;
         var LiLength =imgList.find('li').length;
         if(LiLength > 4){
             LiLength = 4;
         }
         $('input.img').remove();
         imgList.find('li').each(function(index) {
         var uploadItem = this;
         new uploaderObject({
                file:       uploadItem.file,
                url:        '/add_img',
                fieldName:  'my-pic',

                onprogress: function(percents) {
                 //   updateProgress(pBar, percents);
                },
                oncomplete: function(done, data) {
                    ImgAjaxN++;
                    if(done) {
                     FormJq.append("<input class='img' type='hidden' name='img[]' value='"+data+"'>");
                    } else {
                       console.log('Ошибка при загрузке файла `'+uploadItem.file.name+'`:<br/>'+this.lastError.text);
                    }
                 if(ImgAjaxN==LiLength){
                   $('input.img').map(function(indx,element){
                       if($(element).val()==0){
                           alert('При загрузки файла под номером '+(indx+1)+' произошла ошибка!');
                       }
                   });      
           //   $("form#add").submit();
             Fn();
             return true;
              
                 }                         
                }
            });
        });
        }else{
      //  $("form#add").submit();
      Fn();
        return true;
      }   
}

var myModal = function(ObjectP){
    var date = new Date();
    var id = 'myModal-'+ date.getTime();
    var htmLmyModal = '<div class="modal fade" id="'+id+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
                       +'<div class="modal-dialog">'
                       +'<div class="modal-content">'
                       +'<div class="modal-header">'
                       +'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
                       +'<h4 class="modal-title" id="myModalLabel">Название модали</h4>'
                       +'</div>'
                       +'<div class="modal-body">'
                       +'</div>'
                       +'<div class="modal-footer">'
                       +'<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>'
                       +'<button type="button" class="btn btn-primary">Сохранить изменения</button>'
                       +' </div>'
                       +'</div>'
                       + '</div>'
                       +'</div>'; 
    $("body").append(htmLmyModal);           
    this.myModal =  $("body #"+id);
  
   this.myModal.appendTo("body")
    this.title = ObjectP.title || '',
    this.bodyHtml ='<div class="row"><div class="col-md-11 col-sm-11">' + ObjectP.bodyHtml || '' + '</div></div>',

    this.Hide = function(){  
       this.ButtonOk.QjObject.unbind('click'); 
       this.myModal.modal('hide');
       };
     this.myModal.on('hidden.bs.modal', function(e){
         myModalActive = false;  
        $("body #"+id).remove();
     });
    this.Show = function(){    
       if(myModalActive){this.Hide();}
       this.myModal.modal('show');
       myModalActive = true; 
    };
    this.TitleEdit = function(title){
         this.title = title;
         this.myModal.find('h4').text(this.title);
    },
//    this.bodyHtmlEdit = function(bodyHtml){
//         this.bodyHtml = '<div class="row"><div class="col-md-11 col-sm-11">' + bodyHtml || '' + '</div></div>';
//         this.myModal.find('div.modal-body').html(this.bodyHtml);
//    },       
            
    this.ButtonCloseHide = function(){
        this.myModal.find("button.close").hide();
    };        
    var myModalActive = false;       
    var htmlModal = this.myModal.html();
    if(ObjectP.btnDefault == undefined){
        var zhis = this.myModal;
    var btnDefault = {};
    btnDefault.Parameter = {myModal:this};
    btnDefault.Fn = function(Parameter){
        Parameter.myModal.Hide();
    };
   } else {
      var btnDefault = ObjectP.btnDefaul;
    }
    ObjectP.ButtonNone = ObjectP.ButtonNone || {};
//    if(ObjectP.ButtonOk.Parameter == undefined){
//      ObjectP.ButtonOk.Parameter = {};  
//    }
    ObjectP.ButtonOk =  ObjectP.ButtonOk || {};
    ObjectP.ButtonOk.Parameter = ObjectP.ButtonOk.Parameter || {};
    ObjectP.ButtonOk.Parameter.myModal = this;
  
    this.ButtonNone = new Button({QjObject:this.myModal.find("button.btn-default"),Fn:btnDefault, id:ObjectP.ButtonNone.id || null, class:"btn-default btn "+ObjectP.ButtonNone.class, text:ObjectP.ButtonNone.text || "Отмена"});
    this.ButtonOk = new Button({QjObject:this.myModal.find("button.btn-primary"), Fn:ObjectP.ButtonOk|| null, id:ObjectP.ButtonOk.id || null, class:"btn-default btn "+ObjectP.ButtonOk.class, text:ObjectP.ButtonOk.text || "Ок"});

    this.ButtonNone.QjObject.text(ObjectP.ButtonNone.text);
    this.ButtonOk.QjObject.text(ObjectP.ButtonOk.text);
    this.myModal.find('h4').text(this.title);
    this.myModal.find('div.modal-body').html(this.bodyHtml);
    this.myModal.parent("button.close").on("click", function(){
        this.Hide();
    });

     Object.defineProperty(this, "titleEdit", {
        set: function(value) {
             this.title = value;
             if(myModalActive){
             var JQ = this.myModal.find('h4');
             JQ.fadeOut(200);
             JQ.text(this.title);
             JQ.fadeIn(200);
             }}
    });
        Object.defineProperty(this, "bodyHtmlEdit", {
        set: function(value) {
             this.bodyHtml = '<div class="row"><div class="col-md-11 col-sm-11">' + value + '</div></div>';
             if(myModalActive){
             var JQ = this.myModal.find('div.modal-body');
             JQ.fadeOut(300);
             JQ.html(this.bodyHtml);
             JQ.fadeIn(100);
            }
        }
    });
};

//Для регистрации
//ObjectP.Password, ObjectP.PasswordRepeat  -  inputUl
var inputPasswordRegist = function(ObjectP){
    this.InputPassword = {};
    this.InputPassword.Password = ObjectP.Password;
    this.InputPassword.PasswordRepeat = ObjectP.PasswordRepeat;
    this.ObjectForm = ObjectP.ObjectForm;
    this.surely = true;
    var zhis = this;
    this.InputPassword.Password.glyphiconJq = this.InputPassword.Password.QjObject.parents(".form-group").find("div.col-sm-1");
    this.InputPassword.Password.InputValidate = new Object();
    this.InputPassword.Password.InputValidate.Yes = false;
    this.InputPassword.Password.InputValidate.No = false;
    
    this.InputPassword.PasswordRepeat.glyphiconJq = this.InputPassword.PasswordRepeat.QjObject.parents(".form-group").find("div.col-sm-1");
    this.InputPassword.PasswordRepeat.InputValidate = new Object();
    this.InputPassword.PasswordRepeat.InputValidate.Yes = false;
    this.InputPassword.PasswordRepeat.InputValidate.No = false;
   
    var glyphiconNoJqP = $('<span class="glyphicon glyphicon-remove margin0"></span>').css({color:"red"}).hide();
    var glyphiconYesJqP = $('<span class="glyphicon glyphicon-ok margin0"></span>').css({color:"green"}).hide();
    var glyphiconNoJqR = glyphiconNoJqP.clone();
    var glyphiconYesJqR = glyphiconYesJqP.clone();

    var glyphiconNo = function(glyphiconJq,glyphiconNoJq,glyphiconYesJq, Validate){
        if(Validate.No === false){
           glyphiconJq.append(glyphiconNoJq.css({display:"inline-block",opacity:0}).animate({opacity:1},600));
           Validate.No = true;
        if(Validate.Yes === true){
          glyphiconYesJq.animate({opacity:0},1000).css({display:"none"}).remove();  
          Validate.Yes = false;
        }}
       };
    
    var glyphiconYes = function(glyphiconJq,glyphiconNoJq, glyphiconYesJq, Validate){
        if(Validate.No === true){
        glyphiconNoJq.animate({opacity:0},1000).css({display:"none"}).remove();
        glyphiconJq.append(glyphiconYesJq.css({display:"inline-block",opacity:0}).animate({opacity:1},600));
        Validate.Yes = true;
        Validate.No = false;
        }
    };
    
    this.InputPassword.Password.QjObject.on("input",function(){
        if(zhis.InputPassword.Password.value.length < 6 ){
            glyphiconNo(zhis.InputPassword.Password.glyphiconJq,glyphiconNoJqP, glyphiconYesJqP, zhis.InputPassword.Password.InputValidate); 
        } else {glyphiconYes(zhis.InputPassword.Password.glyphiconJq, glyphiconNoJqP, glyphiconYesJqP, zhis.InputPassword.Password.InputValidate);}
        if(zhis.InputPassword.PasswordRepeat.InputValidate.Yes === true){
           glyphiconNo(zhis.InputPassword.PasswordRepeat.glyphiconJq,glyphiconNoJqR, glyphiconYesJqR, zhis.InputPassword.PasswordRepeat.InputValidate); 
        }
    });
    
    this.InputPassword.PasswordRepeat.QjObject.on("input",function(){
        if((zhis.InputPassword.Password.value !== zhis.InputPassword.PasswordRepeat.value) || (zhis.InputPassword.Password.InputValidate.Yes === false)){
            glyphiconNo(zhis.InputPassword.PasswordRepeat.glyphiconJq,glyphiconNoJqR, glyphiconYesJqR, zhis.InputPassword.PasswordRepeat.InputValidate);    
        } else { 
            glyphiconYes(zhis.InputPassword.PasswordRepeat.glyphiconJq, glyphiconNoJqR, glyphiconYesJqR, zhis.InputPassword.PasswordRepeat.InputValidate);
        }
    });
    this.ValidateNo = function(){
         var tr = false; 
         for (var key in this.InputPassword) {
              if(this.InputPassword[key].value == ''){
                 tr = true;  
                 this.InputPassword[key].ValidateNo(); 
              }    
         }
         if((tr) && (this.InputPassword.Password.value !== this.InputPassword.PasswordRepeat.value)){
            this.InputPassword.PasswordRepeat.ValidateNo(); 
         }  
    };
     Object.defineProperty(this, "value", {
            get: function() {
               if((this.InputPassword.Password.value == '') || (this.InputPassword.Password.value !== this.InputPassword.PasswordRepeat.value)){
                   return '';
                } else {
                return true;
                }
            }
    });

};

$(document).ready(function(){
    $(function() { 
        var WindowHeight = $(window).height(); 
        var TitleY = $("#content-left").offset().top;
        if(WindowHeight <= TitleY){
            setTimeout(function(){ window.scrollTo( 0, TitleY)});
    }});
     
     
if($("div").is("#add_post")){
    yepnope("/script/addPost.js");
}
if($("div").is("#edit_post")){
    yepnope("/script/editPost.js");
}
if($("form").is("#formSearch")){
    yepnope("/script/search.js");  
}
if($("form").is("#form-registr")){
   var Sumbit = {};
   Sumbit.Parameter = {};
   Sumbit.Fn = function(){
       if(registracionForm.Validacij()){
          registracionForm.submit(); 
       }
   }; 
   var registracionButton = new Button({id:"registracion", Fn:Sumbit});
   var registracionForm = new Form({id:"#form-registr",button:registracionButton});

   var email = new inputUl({teg:"input", id:"#inputEmail3",name:"email",type:"text",ObjectForm:registracionForm,surely:true});
   var reMail = /^(?!.*@.*@.*$)(?!.*@.*\-\-.*\..*$)(?!.*@.*\-\..*$)(?!.*@.*\-$)(.*@.+(\..{1,11})?)$/;
       email.QjObject.focusout(function(){
             if(!reMail.test(email.value)){
                 email.ValidateNo();
                 email.value = '';
               } 
       });
   
   var password = new inputUl({teg:"input", id:"#inputPassword3", name:"",ObjectForm:registracionForm}); 
   var passwordRegist =  new inputUl({teg:"input", id:"#repeat_inputPassword3", name:"",ObjectForm:registracionForm});
   var inputPassword = new inputPasswordRegist({Password:password, PasswordRepeat:passwordRegist});
 
} 
         
      
//Редактирование         
   $('li.li_delet').on('click','div.deletImg_ser',function(){
       var N=$(this).data('fooBar');
       var imgUrl=$(this).parent().children('img').attr('src');
       $("form#add").append("<input class='img_delet' type='hidden' name='img_delet[]' value='"+N+"'>");
       $(this).text('Отменить').attr({'class':'otm_deletImg_ser','data-foo-url':imgUrl});
       $(this).parent().children('img').attr('src','/images_post/delete_img.png');
   
     });   
   
   
 $('li.li_delet').on('click','.otm_deletImg_ser',function(){
      $('input.img_delet[value="'+$(this).data('fooBar')+'"]').remove();
      console.log($(this).data('fooUrl'));
      $(this).parent().children('img').attr('src',$(this).data('fooUrl'));
      $(this).text('Удалить').attr({'class':'deletImg_ser','data-foo-url':''});

   });  
   
if($("div").is("#announcement")){ 
    var panelAnnoucement = function(ObjectP){ 
        this.QjObject = $("#panel-annoucement");
        var show = false;
        var postDel = this.QjObject.find('span#post-del-size');
        var DeletPostLength = 0;
          
        this.DeletInput = function(value){
             if(value === undefined){
                this.PanelFrom.QjObject.find("input").remove(); 
                DeletPostLength = 0;
             } else {
                this.PanelFrom.QjObject.find("input[value='"+value+"']").remove();
               if(DeletPostLength !== 0) DeletPostLength--;
             }            
        };  
        this.postDelSize = function(){
             postDel.text(DeletPostLength);
        };
        this.Show = function(){
            if(!show){
             this.QjObject.show(300);
             this.postDelSize();
             show = true;}
        };
        this.Hide = function(){
           if(show){ 
             this.QjObject.hide(300);
             show = false; 
             } 
        };
         var actionButtonFn = {}, cancellationButtonFn = {};
        if(ObjectP.actionButtonFn != undefined){
           actionButtonFn = ObjectP.actionButtonFn;
           actionButtonFn.Parameter.zhis = this;
        } else {actionButtonFn.Parameter = {}; actionButtonFn.Fn = function(){};}
        if(ObjectP.cancellationButtonFn != undefined){
           cancellationButtonFn = ObjectP.cancellationButtonFn;
           cancellationButtonFn.Parameter.zhis = this;
        } else {cancellationButtonFn.Parameter = {zhis:this}; cancellationButtonFn.Fn = function(Parameter){ 
            Parameter.zhis.Hide();  
        };}
        this.actionButton = new Button({QjObject:this.QjObject.find("#panel-annoucement-action"),Fn:actionButtonFn});
        this.cancellationButton = new Button({QjObject:this.QjObject.find("#panel-annoucement-cancellation"), Fn:cancellationButtonFn});
        this.PanelFrom = new Form({id:"#delete-posts"});
        this.AddInput = function(value, name){ 
             this.PanelFrom.QjObject.append('<input name="'+name+'" type="hidden" value="'+value+'">');
             DeletPostLength++; 
             this.postDelSize(DeletPostLength);
        };
        this.deletInput = function(option){//"input[value="88"]"
             var InputDelet = this.PanelFrom.QjObject.find(option);
             InputDelet.remove();
             DeletPostLength -= InputDelet.length;
             if(DeletPostLength <= 0){
                this.Hide(); 
             }
             this.postDelSize();
             
        };
        };
         var actionButtonFn = {};
         actionButtonFn.Parameter = {};
         actionButtonFn.Fn = function(Parameter,elem,zhis){
                             var OptionAnnouncementDeletMyModal = new myModal({
                                 title: "Вы действительно хотите удалить "+Parameter.zhis.PanelFrom.QjObject.length+" объявления(ий)!!!",
                                 bodyHtml:'',
                                 ButtonOk:{text:"Удалить",
                                           Parameter:{},
                                           Fn:function(){
                                           Parameter.zhis.PanelFrom.submit();
                                           }}
                             });
                             OptionAnnouncementDeletMyModal.Show();
                                     };
        var cancellationButtonFn = {};
        cancellationButtonFn.Parameter = {};
        cancellationButtonFn.Fn= function(Parameter,elem,zhis){
                for (var key in Parameter.Announcement) {
                         Parameter.Announcement[key].delete.hide(300).remove();
                         Parameter.Announcement[key].post.find('.row').show(300);
                }
                Parameter.zhis.deletInput("input[name='delet[]']");
                Parameter.zhis.Hide()
        };
    var AnnoucementPanel = new panelAnnoucement({actionButtonFn:actionButtonFn, cancellationButtonFn:cancellationButtonFn});  

    var ArrayButtonPost = {}, Announcement = {}; 
    var FspanPostDelete = {};
        FspanPostDelete.Parameter = {ArrayButtonPost:ArrayButtonPost, Announcement:Announcement};
        FspanPostDelete.Fn = function(Parameter,elem,zhis){
             var postId = elem.data('postId');
             Parameter.Announcement[postId] = {};
             Parameter.Announcement[postId].post = $('div.post'+postId);
             var title = Announcement[postId].post.find('.title-annoucement div.post-a-h3');
             var textPost = Announcement[postId].post.find('.title_zag');
             Parameter.Announcement[postId].post.find('.row').hide(300);
             Parameter.Announcement[postId].post.append('<div class="row row-2 post-dell"><div class="delete-post col-md-10">'+title.html()+textPost.html()+'</div><div class="col-md-2"><button type="button" value="'+postId+'" class="button-delet-post btn btn-default">Отменить</button></div></div></div>');
             Parameter.Announcement[postId].delete = Parameter.Announcement[postId].post.find(".delete-post").parent("div.row");
             var ArrayButtonPost = {};
             var ArrayButtonPostFn = {};
             ArrayButtonPostFn.Parameter = FspanPostDelete.Parameter;
             $.extend(actionButtonFn.Parameter, ArrayButtonPostFn.Parameter);
             $.extend(cancellationButtonFn.Parameter, ArrayButtonPostFn.Parameter);
             ArrayButtonPostFn.Fn = function(Parameter,elem,zhis){ 
                AnnoucementPanel.deletInput("input[value='"+elem.val()+"']");   
                Parameter.Announcement[postId].delete.hide(300);
                Parameter.Announcement[postId].delete.remove();
                Parameter.Announcement[postId].post.find('.row').show(300);
             };
             FspanPostDelete.Parameter.ArrayButtonPost[postId] = new Button({QjObject:Parameter.Announcement[postId].post.find("button"), Fn:ArrayButtonPostFn});
             AnnoucementPanel.AddInput(postId, "delet[]");
             AnnoucementPanel.Show();
        };
    var spanPostDelete = new Button({QjObject:$("span.post-delete"),Fn:FspanPostDelete});
   
}      
        
$('#myModal').on("click","button.btn-primary",function(){;
    var formDeletePost=$("#delete-posts");
    if(formDeletePost.find("input[name='delet[]']").length>0){
       formDeletePost.submit();
    }
});

$('div.modal-body').on('click','.del-none',function(){
  var delNoneId = $(this).data('postId');
      postDelSize=$('div.modal-body .del-none').length; 
      postDelSize--; 
      var myModal = $('#myModal'); 
      myModal.find('div.modal-body .row-'+delNoneId).remove();
      if(postDelSize<=0){
         myModal.modal('hide'); 
         $('#panel-annoucement').css('display','none');
      }
   $('form#delete-posts input[value="'+delNoneId+'"]').remove();
   var postNoneDel=$('div.post'+delNoneId);
       postNoneDel.find('.row-1').css('display','block');
       postNoneDel.find('.row-2').remove();
       $('#panel-annoucement').find('span#post-del-size').text(postDelSize);
});    
      
 $("#myModal").on("click","#DeletPost",function(){
     $("form#post-delete").submit();
 }); 
 
 $("button#email_pusk").on("click",function(){
    var myModal = $('#myModal');  
    myModal.find('h4').text('Отправить сообщение');
    myModal.find('button.btn-primary').attr("class","btn-primary btn").attr("id","emailOk").text("Отправить");
    myModal.find('button.btn-default').attr("class","btn-default btn").text("Отменить"); 
    var forma='<form id="formEmail" class="form-horizontal" enctype="multipart/form-data" role="form" accept-charset="UTF-8" action="" method="POST">'
              +'<div class="form-group  has-feedback" id="divVasEmail">'
              +'<div class="col-sm-12">'
              +'<input type="text" value="'+$('#user span').text()+'" name="email" class="form-control" id="vasEmail" placeholder="Ваше Email">'
              +'</div></div>'
              +'<div class="form-group  has-feedback" id="divVasEmail">'
              +'<div class="col-sm-12">'
              +'<input type="text" value="'+$('div#post_podr h1').text()+'" name="title" class="form-control" id="titleEmail" placeholder="Заголовок">'
              +'</div></div>'
              +'<div class="form-group  has-feedback" id="divVasEmail">'
              +'<div class="col-sm-12">'
              +'<textarea cols="50" name="text" rows="8" class="form-control" id="post" placeholder="Текст письма"></textarea>'
              +'</div></div>'
              +'</form>'
              +'</div>';
     myModal.find('div.modal-body').html('<div class="row"><div class="col-md-11 col-sm-11 formDiv">'+forma+'</div></div>');
     myModal.modal('show');
 });
 
 $("#myModal").on("click","button#emailOk", function(){ 
     var Value = new Object;
      Value['emailOt'] = $("input#vasEmail");
      Value['title'] =  $("#titleEmail");
      var Text =  $("textarea#post");
      var ValueTrue = true;
    for (var key in Value){
        if(Value[key].val()==''){
            Value[key].after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
            Value[key].css("border","1px solid red");
            Value["falseVal"]=true;
           ValueTrue = false;
        }
    }
    if(Text.val()==''){
            Text.css("border","1px solid red");
            ValueTrue = false;
        var TextValue = true;
        }
    if(!ValueTrue){
        if(Value["falseVal"]){
     Value['emailOt'].on("click",function(){
         Value['emailOt'].parent("div").find("span.glyphicon").remove();
         Value['emailOt'].css("border","1px solid #CCCCCC");
     });        
       }  
       if(Value["title"]){
        Value['title'].on("click",function(){
         Value['title'].parent("div").find("span.glyphicon").remove();
         Value['title'].css("border","1px solid #CCCCCC");
     });  
       }
      if(TextValue){
       Text.on("click",function(){
       Text.css("border","1px solid #CCCCCC");
     });  
          
      } 
}
  if(ValueTrue){
     $.post("/ajax/user/message",
     {
    email:  Value['emailOt'].val(),
    title:  Value['title'].val(),
    text:   Text.val(),
    idPost: $("input#PostId").val(),
  },
  function(data){
      if(data){
          $("div.formDiv").html("Ваше сообщение отправлина");
          $('#myModal button.btn-primary').hide();
          $('#myModal button.btn-default').text("Закрыть");
      }
  }
         ); 
  }
    
 });

      
   });
   

