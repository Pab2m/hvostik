


function translit(text){
        text = text.toLowerCase();
	var space = '-'; 	
	var transl = { 
					'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh', 'з': 'z', 'и': 'i',
					'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't',
					'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': space, 'ы': 'y',
					'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya',
					
					' ': space, '_': space, '`': space, '~': space, '!': space, '@': space, '#': space, '$': space,
					'%': space, '^': space, '&': space, '*': space, '(': space, ')': space, '-': space, '\=': space,
					'+': space, '[': space, ']': space, '\\': space, '|': space, '/': space, '.': space, ',': space,
					'{': space, '}': space, '\'': space, '"': space, ';': space, ':': space, '?': space, '<': space,
					'>': space, '№': space					
				 }

    var result = '';
    var curent_sim = '';
    for(i=0; i < text.length; i++) {
        // Если символ найден в массиве то меняем его
		if(transl[text[i]] != undefined) {			
			if(curent_sim != transl[text[i]] || curent_sim != space){
				result += transl[text[i]];
				curent_sim = transl[text[i]];				
			}					
		}
		// Если нет, то оставляем так как есть
        else {
			result += text[i];
			curent_sim = text[i];
		}		
    }	
	
return	result;	
}


var ButtonActive = false;  
function SchetPost(){
    
         $.ajax({
          url: "/ajax/admin/schetpost",
          success: function(data) {
           var dataCount = JSON.parse(data); 
           $("span#sost0").text(dataCount[0]);
           $("span#sost1").text(dataCount[1]);
           $("span#sost2").text(dataCount[2]);
          }
          
                });   
}


function Sost0(date){ //на модерации
    $("#sostPost").attr("class","postModer col-md-12").html("На модерации");
    $("#panelInput").html('<input id="" class="PostTrue sost btn btn-default" data-id-so="1" type="button" value="Обубликовать объявлении"/>'
                          +'<input id="" class="PostDelete sost btn btn-default" data-id-so="2" type="button" value="Снять обьявление"/>'); 
      $("#aktiv-input-post").html('');             
                
}
function Sost1(date){ //обубликованное
    $("#sostPost").attr("class","postPublik col-md-12").html("Обубликованно");
    $("#panelInput").html('<input id="" class="PostFalse sost btn btn-default" data-id-so="0" type="button" value="На модерацию"/>'
                           +'<input id="" class="PostDelete sost btn btn-default" data-id-so="2" type="button" value="Снять обьявление"/>');
     $("#aktiv-input-post").html('Активно до:<br>'+
                                 '<input type="date" id="datepicker" class="input-time" placeholder="dd-mm-yyyy"  value="'+date+'"/>'+
                                 '<button id="date-save" class="btn btn-default" type="button">Сохранить</button>');  
}

function Sost2(date){// Снятое 
    $("#sostPost").attr("class","DeletPublik col-md-12").html("Снятое обьявление");
    $("#panelInput").html('<input id="" class="PostFalse sost btn btn-default" type="button" value="На модерацию"/>'
                          +'<input id="" class="PostTrue sost btn btn-default" type="button" value="Обубликовать объявлении"/>');
    $("#aktiv-input-post").html('Удалится после:<br>'+
                           '<input type="date" id="delet_post_time" class="input-time" placeholder="dd-mm-yyyy"  value="'+date+'"  />'+
                           '<button id="date-save" class="btn btn-default" type="button">Сохранить</button>');              
}

function SostPost(sost){ 
    switch (sost.sost) {
    case 0: 
        Sost0(sost.date);
        break;
    case 1:
         Sost1(sost.date);
         break;
    case 2:
         Sost2(sost.date);
         break;
    }
}
function InputDate(){      
  var input1=$("#aktiv-input-post input");
    var picker1 = new Pikaday({
        field: input1[0],
        format: 'YYYY.MM.DD',     
    });
     }

 var TrTableActive = function(ObjectP){   
    var SpanJq = ObjectP.jQ;
    var ButtonsWrapJq = $("<div id='ButtonsWrap'></div>");
    var tdClick = SpanJq.parent("td");
    tdClick.append(ButtonsWrapJq); 
    var Buttons = {};  
    Buttons.Save = new Button({
            html: "<button id='save' class='btn btn-default optionButton'>Сохранить</button>"
        }); 
    Buttons.Cancelling = new Button({
            html:"<button id='cancelling' class='btn btn-default optionButton'>Отмена</button>"
        });
    Buttons.Delete = new Button({
            html:"<button id='delete' class='btn btn-default optionButton'>Удалить</button>"
        });  
    var InputEditName = new inputUl({
        id:"InputEdit",
        QjObject:$("<input id='InputEditName' class='form-control' value=''/>")}
    );          
    for(var key in Buttons){
           Buttons[key].QjObject.hide();
           Buttons[key].QjObject.val(value);
           ButtonsWrapJq.append(Buttons[key].QjObject);
           Buttons[key].QjObject.show(300);
    }  
    
    this.CancellingInput = function(addition){
        if(addition === undefined){
         var additionBool = false; 
        } else {
         var additionBool = true; 
        }
         for(var key in Buttons){
         Buttons[key].QjObject.hide(300).remove();
         delete  Buttons[key];
         }
         delete Buttons;
         this.active = false;
         SpanJq.fadeIn(250);
         InputEditName.QjObject.hide(200).remove();
         if(additionBool){
            if(tdName.is("span.addition")){
            tdName.find("span.addition").fadeOut(200).remove();     
            }
            tdName.append("<span class='addition'><sup>"+addition+"</sup></apan>"); 
         }
         name = InputEditName.value;
         SpanJq.attr({"data-name": name});
         tdName.fadeIn(300);
         delete InputEditName;
     };
     
    if(ObjectP.TrTableActive.active){
       ObjectP.TrTableActive.CancellingInput();  
       ObjectP.TrTableActive.active = false;
    } 
    var zhis = this;
    Buttons.Cancelling.QjObject.on("click", function(){
      ObjectP.ButtonsFn.Cancelling({zhis:zhis});
    });
    var name = SpanJq.attr('data-name'); 
    var value = SpanJq.attr('data-value'); 
    var trClick = tdClick.parent("tr");
    var tdName = trClick.find("div.name"); 
    SpanJq.fadeOut(250);  
    this.active = true;
    
    InputEditName.QjObject.hide();
    tdName.fadeOut(250);
    InputEditName.val(SpanJq.attr('data-name'));
    tdName.parent("td").append(InputEditName.QjObject);
    InputEditName.QjObject.fadeIn(300);  
     Buttons.Save.QjObject.on("click", function(){ 
         ObjectP.ButtonsFn.Save({InputEditName:InputEditName, name:name, value:value, zhis:zhis,tdName:tdName})});
     
    Buttons.Delete.QjObject.on("click",function(){
         ObjectP.ButtonsFn.Delete({InputEditName:InputEditName, value:value, htmlThis:this})
    }); 
     
    var inputName = tdClick.find("div.name");

    var inputNameContent =  inputName.find(".content");
    inputNameContent.hide(300);
    this.TrClick = function(){
        return trClick;
    };
    
    
 return this;
    }

     
 TrTableActive.Cancelling = function(elem){ 
    if($("div").is("#ButtonsWrap")){ 
        elem.parents("td").find("span").show(350);
           $("#ButtonsWrap").hide(300).empty();
    }
     }
     
function TableTdWidthMax(Object){
var ObjectP = Object || {};  
var Fn = {};
Fn.Parameter = ButtonActive;
Fn.Fn = function(Parameter,elem, zhis){}; 
this.ButtonOtion = new Button({class:"edit-pole",QjObject:ObjectP.ButtonOtionJq || $("span.edit-pole"), parentDiv:"table", delegirovanie:true});

var ButtonActive = {active:false};
this.ButtonOtion.QjObject.on("click", function(){
   ButtonActive = new TrTableActive({jQ:$(this), TrTableActive:ButtonActive, ButtonsFn:ObjectP.ButtonsFn});
});    

}
var TrTableActiveSite = function(ObjectP){  
    var activeSite = ObjectP.TrTableActive.active;
    TrTableActive.apply(this, arguments);
    var tdRegionJq = this.TrClick().find("td div.td-region");
    ObjectP.RegionClone.value = tdRegionJq.attr("data");
    var tdRegionJqHtml = tdRegionJq.html();
    tdRegionJq.html('');
    tdRegionJq.html(ObjectP.RegionClone.QjObject);
    ObjectP.RegionClone.choneSelect();
    ObjectP.RegionClone.Set(ObjectP.RegionClone.value); 
    this.HideRegion = function(){
        return tdRegionJq.html(tdRegionJqHtml);
    };
    
    this.CancellingInputSite = function(){
         this.CancellingInput.apply(this, arguments);
         this.HideRegion();
    };
    this.CancellingInputSite.prototype = Object.create(this.CancellingInput.prototype);
    this.CancellingInputSite.prototype.constructor = this.CancellingInputSite;
    if(activeSite){
       ObjectP.TrTableActive.HideRegion();  
    } 
    
}

    TrTableActiveSite.prototype = Object.create(TrTableActive.prototype);
    TrTableActiveSite.prototype.constructor = TrTableActiveSite;

function TableTdWidthMaxSite(Object){
var ObjectP = Object || {};  
var Fn = {};
Fn.Parameter = ButtonActive;
Fn.Fn = function(Parameter,elem, zhis){}; 
this.ButtonOtion = new Button({class:"edit-pole",QjObject:ObjectP.ButtonOtionJq || $("span.edit-pole"), parentDiv:"table", delegirovanie:true});

var ButtonActive = {active:false};

this.ButtonOtion.QjObject.on("click", function(){
var random = Math.floor(Math.random() * 51 + 50);
var RegionClone = new SeletUl({id:"#region_select_table_site"+random, oberkaJq:ObjectP.RegionClone.oberkaJq.clone()});
RegionClone.html = ObjectP.RegionClone.html;
RegionClone.QjObject = ObjectP.RegionClone.QjObject.clone().attr({id:"region_select_table_site"+random});
ButtonActive = new TrTableActiveSite({jQ:$(this), TrTableActive:ButtonActive, ButtonsFn:ObjectP.ButtonsFn, RegionClone:RegionClone});
});
}

$(document).ready(function(){
    
 if($("div").is("#AllSelect-admin")){
 
 var FalseFormSelect = new Form({});     
 var Countrys = new SeletUl({id:"#countrys_select_add", oberka:"#countrys", ObjectForm:FalseFormSelect});  
 var Region = new SeletUl({id:"#region_select_add", oberka:"#site_select", ObjectForm:FalseFormSelect});
 var Site = new SeletUl({id:"#sity_select_admin", oberka:"#region", ObjectForm:FalseFormSelect});
 var Categorij = new SeletUl({id:"#category_select_admin", oberka:"#categorij_select_admin", ObjectForm:FalseFormSelect});
 var Cot = new SeletUl({id:"#poroda_select_add_cot", oberka:"#cot_select", ObjectForm:FalseFormSelect});
 var Sob = new SeletUl({id:"#poroda_select_add_sobak", oberka:"#sob_select", ObjectForm:FalseFormSelect});
 var Tip = new SeletUl({id:"#tip_select_add", oberka:"#tip", ObjectForm:FalseFormSelect});
 var Tovari = new SeletUl({id:"#tovari-add", oberka:"#tovari", ObjectForm:FalseFormSelect});
 var Uslugi = new SeletUl({id:"#uslugi-add", oberka:"#uslugi", ObjectForm:FalseFormSelect});
 
 for(var key in FalseFormSelect.arryForm){
     FalseFormSelect.arryForm[key].HtmlGet();
     FalseFormSelect.arryForm[key].choneSelect();
}
}   
  if($("div").is("#table_select_updata")){ 
      if($("button").is("#button-json-updat")){
        var NewJsonButtonFn = {};
        NewJsonButtonFn.Fn = function(Parameter,elem,zhis){ 
         $.ajax({
       url: "/ajax/admin/json/update",
       type: "POST",
       data: {value_p:  zhis.QjObject.val()},
       success: function(msg){
       $("#date-json-fail").html(msg);
       $("span#red-taim").css("color","red");
        setTimeout(function() {  $("span#red-taim").css("color","#000"); }, 2000);
     },
        error: function(){
        alert("Ошибка при выполнения запроса");
        } 
     });
};
var NewJsonButton = new Button({id:"button-json-updat", oberka:"#json-panel", Fn:NewJsonButtonFn});
    NewJsonButton.value = NewJsonButton.QjObject.val();
}
      var ButtonsFn = {};
      ButtonsFn.Save = function(Object){  
            var ButtonOk = {};
            var SavemyModal = undefined;
             ButtonOk.Parameter = {select:$("#table_select_updata table").attr("data-select"), value:Object.InputEditName.value, id:Object.value};
             ButtonOk.Fn = function(Parameter){
                $.post("/fyurer/select/detail",
                     { 
                       id: Parameter.id, 
                       select: Parameter.select,
                       name: Parameter.value,
                       name_en: translit(Parameter.value)
                     },
                 function(Data){
                  Parameter.myModal.Hide();   
                  Data = JSON.parse(Data);
                   var ButtonOk = {}; 
                      ButtonOk.Parameter = {TrTableActive:Object.zhis};
                      ButtonOk.Fn = function(Parameter){
                                    Parameter.myModal.ButtonNone.QjObject.show(200);
                                    Parameter.myModal.ButtonOk.textEdit = "Сохранить изменения";
                                    Parameter.TrTableActive.CancellingInput();
                                    Parameter.myModal.Hide();
                                    };
                 if(Data.reply === 1){
                      
                      var Modal = new myModal({title:"Все хорошо!!!", bodyHtml: Data.html,ButtonOk:ButtonOk});
                          Modal.ButtonNone.textEdit = "Ок";
                          Modal.ButtonOk.QjObject.hide();
                      var ObjectP = {}; 
                      ObjectP.Parameter = {TrTableActive:Object.zhis};
                      ObjectP.Fn = {Fn:function(Parameter){
                                    Object.tdName.text(Data.data);
                                    Parameter.TrTableActive.CancellingInput("изменен"); 
                                    Modal.ButtonOk.QjObject.show();
                                    Modal.ButtonNone.textEdit = "Отмена";
                                    }
                      };
                      Modal.ButtonNone.FunctionEdit = ObjectP;
                      Modal.Show();                                          
                 } else {
                  if(Data.reply === 0){
                      var Modal = new myModal({title:"Упс!!! Ошибочка!!!", bodyHtml: "<b>Во время выполнения запроса произошла ошибка!</b>",ButtonOk:ButtonOk});
                      Modal.ButtonOk.textEdit = "ОК";
                      Modal.ButtonNone.QjObject.hide();
                      Modal.Show();
                  } else {
                     if(Data.reply === 2){
                      var ButtonOk = {}; 
                      ButtonOk.Parameter = {TrTableActive:Object.zhis};
                                   ButtonOk.Fn = function(Parameter){
                                   Parameter.myModal.Hide();
                                    };                         
                      var Modal = new myModal({title:"Сообщаем!!!", bodyHtml: Data.html,ButtonOk:ButtonOk});
                      Modal.ButtonOk.textEdit = "ОК";
                      Modal.ButtonNone.QjObject.hide();
                      Modal.Show();  
                     } 
                  } 
                 }
             }
             );
 };
             var SavemyModal = new myModal({title:"Сохранить внесеные изменения?", bodyHtml:"<p>Внести в изменения в Базу Данных?</p><p>"+Object.name+" на <b>"+Object.InputEditName.value+"</b></p>",ButtonOk:ButtonOk});
             SavemyModal.Show();
      };
      ButtonsFn.Cancelling = function(Object){
          Object.zhis.CancellingInput()();
      };
      ButtonsFn.Delete = function(Object){
           var ButtonOk = {};
             var DeleteModal = undefined;
              ButtonOk.Parameter = {select:$("#table_select_updata table").attr("data-select"), id:Object.value, value:Object.InputEditName.value, trDelet:$(Object.htmlThis).parents("tr")};
              ButtonOk.text = "Да";
              ButtonOk.Fn = function(Parameter){
                        Parameter.myModal.Hide();
                        $.post("/fyurer/select/delete",
                          { 
                          id: Parameter.id, 
                          table: Parameter.select
                          },
                          function(Data){
                              if(Data == 0){
                                 var ButtonDeleteOk = {};
                                 var DeleteError = undefined;
                                 ButtonDeleteOk.Parameter = {}; 
                                 ButtonDeleteOk.text = "Ок";
                                 ButtonDeleteOk.Fn = function(Parameter){
                                 Parameter.myModal.Hide();    
                                 };
                                 var DeleteModalError = new myModal({title:'Вовремя удаления произошла ошибка!!!', bodyHtml:"", ButtonOk:ButtonDeleteOk});
                                 DeleteModalError.ButtonNone.QjObject.remove();
                                 DeleteModalError.Show();
                              } else if(Data == 1){
                                Parameter.trDelet.slideUp(300, function () { 
                                         Parameter.trDelet.remove();
                                 });
                              }
                          }
                         );
             };
            var DeleteModal = new myModal({title:'Вы диствительно хотите удалить "'+Object.InputEditName.value+'"', bodyHtml:"", ButtonOk:ButtonOk});
            DeleteModal.Show();
      };
        if($("table").is("#table-noregion")){ 
      
      TableTdWidthMax({ButtonsFn:ButtonsFn});      
      
      var bd = $("#table_select_updata table").attr("data-select");
      var ButtonAddSelectFn = {};
    ButtonAddSelectFn.Fn = function(Parameter){
     var table = $("#table_select_updata table"); 
     var ButtonAddSelectModalHtml = '';
     var TableTrHtml = function(Object){
                var html = '<tr class="add">\n'
                        +'<td><div class="N"><div>Нов.</div></div></td>\n'
                        +'<td><div class="value id"><div class="content">'+Object.id+'</div></div></td>\n'
                        +'<td><div class="name"><div class="content">'+Object.name+'</div></div></td>\n'  
                        +'<td class="option"><span class="edit-pole glyphicon glyphicon-cog" data-value="'+Object.id+'" data-name="'+Object.name+'"></span></td>\n'
                        +'</tr>\n';
                return html;}; 
     if(bd === "regions"){
         ButtonAddSelectModalHtml += "<div  class='row'>\n"
         +"<div  class='col-md-6'>\n"
         +"<b>Страна:</b>"
         +"</div>\n"
         +"<div class='col-md-6'>\n"
         +"<select id='countrys' class='form-control' name='countrys'>\n"
         +"<option value='1'>Россия</option>\n"
         +"</select>\n"
         +"</div>\n"
         +"</div>\n"
         +"<div id='formAddSelect' class='row'>\n"
         +"<div class='col-md-12'>\n"
         +"<input id='InputAddSelect' name='InputAddSelect' placeholder='Новый Регион' class='form-control' value='' style=''/>\n"
         +"</div>\n"
         +"</div>";
            
     } else{
         var  ButtonAddSelectModalHtmllPaceholder = function(placeholder){
             ButtonAddSelectModalHtml += 
            "<div id='formAddSelect' class='row'>\n"
            +"<div class='col-md-12'>\n"
            +"<input id='InputAddSelect' name='InputAddSelect' placeholder='"+placeholder+"' class='form-control' value='' style=''/>\n"
            +"</div>\n"
            +"</div>";
            return ButtonAddSelectModalHtml};
         if(bd === "countrys"){
            ButtonAddSelectModalHtml = ButtonAddSelectModalHtmllPaceholder('Новая Страна');
    
         } else {
             if(bd === "category"){
                  ButtonAddSelectModalHtml = ButtonAddSelectModalHtmllPaceholder('Новая Категори');
             } else {if((bd === "poroda_koshek") || (bd === "poroda_sobak")){
                  ButtonAddSelectModalHtml = ButtonAddSelectModalHtmllPaceholder('Новая Порода'); 
             } else {
                 if(bd === "tip"){
                      ButtonAddSelectModalHtml = ButtonAddSelectModalHtmllPaceholder('Новый Тип'); 
                 } else {
                     if((bd === 'tovari_select') || (bd === 'uslugi_select')){
                         ButtonAddSelectModalHtml = ButtonAddSelectModalHtmllPaceholder('Новый Товар или Услуга'); 
                     }
                 }
             }
         }
        }
     }
     var ButtonAddSelectModalButtonOk = {Parameter:{select:bd},Fn:function(Parameter){ 
           var InputAddSelect = new inputUl(
                   {id:"#InputAddSelect",
                    QjObject:Parameter.myModal.myModal.find('#InputAddSelect')}
                   );
                var DataAdd = {};
                if(bd === "regions"){
                var Countrys = new SeletUl({id:"#countrys", QjObject:Parameter.myModal.myModal.find('#countrys')});
                    Countrys.value = Countrys.QjObject.val();    
                DataAdd = {table:bd,
                           ArrayValue:JSON.stringify([InputAddSelect.value, Countrys.value, translit(InputAddSelect.value)]),    
                           ArrayKey:JSON.stringify(['name','country_id','name_en'])};
                } else {
                    if((bd === "countrys") || (bd === "category") || (bd === "poroda_koshek") || (bd === "poroda_sobak") || (bd === "tip") || (bd === 'tovari_select')|| (bd === 'uslugi_select')){
                       DataAdd = {table:bd,
                                 ArrayValue:JSON.stringify([InputAddSelect.value, translit(InputAddSelect.value)]),    
                                 ArrayKey:JSON.stringify(['name','name_en'])}; 
                    } 
                }
                
           if(InputAddSelect.value !== ''){
                 $.post("/fyurer/select/detail/addnotdubal",
                     { 
                       table: Parameter.select, 
                       searchTr: 'name',
                       value: InputAddSelect.value
                     },
                 function(Data){
                        var ModalErrorButtonOk = {Parameter:{}, Fn:function(Parameter){
                            Parameter.myModal.Hide();     
                         }, text:"Закрыть"};
                     if(Data > 0){
                         var ModalError = new myModal({title:"Данное поле в базе данных уже есть", bodyHtml:'',ButtonOk:ModalErrorButtonOk}); 
                             ModalError.Show();
                     } else {
                         if(Data == 0){
                             $.post("/fyurer/select/detail/add",
                               DataAdd,
                               function(Data){
                               var tr = $(TableTrHtml(JSON.parse(Data)));    
                                 tr.insertBefore(table.find('tr')[1]); 
                               TableTdWidthMax({ButtonOtionJq:tr.find("span.edit-pole"), ButtonsFn:ButtonsFn}); 
                               Parameter.myModal.Hide();
                               });
                         } else if(Data < 0){
                         var ModalError = new myModal({title:"Ошибка", bodyHtml:'',ButtonOk:ModalErrorButtonOk}); 
                             ModalError.Show();
                         }
                     }
                 });
           } 
     },text:"Записать в базу"};
     
     var ButtonAddSelectModal = new myModal({title:"Добавить новый объект в базу данных?", bodyHtml:ButtonAddSelectModalHtml,ButtonOk:ButtonAddSelectModalButtonOk});
         ButtonAddSelectModal.Show();
  };
  
var ButtonAddSelect = new Button({QjObject:$("button#button-create-element"), Fn:ButtonAddSelectFn});
  } else {
     if($("div").is("#region-region")){ 
     var Region = new SeletUl({id:"#region_select_amin_site", oberka:"#region-region"});
     Region.HtmlGet();
     Region.choneSelect();
     
     Region.ObjectChange(function(objetThis){
        var ButtonsFnSite = {};
        
        ButtonsFnSite.Save = function(ObjectP){
                   var ButtonOk = {};
                   var SavemyModal = undefined;
                   var TrJq = ObjectP.zhis.TrClick();
                   var RegionSelectJq = TrJq.find("select");
                   ButtonOk.Parameter = {select:$("#table_select_updata table").attr("data-select"), value:ObjectP.InputEditName.value, id:ObjectP.value, option:RegionSelectJq.val()};
                   ButtonOk.Fn = function(Parameter){
                  $.post('/fyurer/select/site/edit',
                     { 
                       id: Parameter.id, 
                       select: Parameter.select,
                       name: Parameter.value,
                       name_en: translit(Parameter.value),
                       region_id: Parameter.option
                     },
                    function(Data){
                        Data = JSON.parse(Data);
                        SavemyModal.Hide();
                        delete SavemyModal;
                        var SavemyModalOkButton = {};
                        if(Data.reply == 1){
                            SavemyModalOkButton.Parameter = {};
                            SavemyModalOkButton.Fn = function(ParameterOk){
                            var region = RegionSelectJq.find("option[value='"+Parameter.option+"']").text();     
                            ObjectP.zhis.CancellingInputSite();
                            TrJq.find("div.td-region").text(region).attr({data:Parameter.option});
                            ParameterOk.myModal.Hide();    
                            };
                            var SavemyModalOk = new myModal({title:"Приказ выпалнин!", bodyHtml:Data.html,ButtonOk:SavemyModalOkButton});
                            SavemyModalOk.ButtonOk.textEdit = "Ок";
                            SavemyModalOk.ButtonNone.QjObject.hide();
                            SavemyModalOk.Show();
                        }
                    });              
                                    };
             var bodyHtml =  "<p>Внести в изменения в Базу Данных?</p>\n\
                              <p>Регион: "+RegionSelectJq.find("option[value='"+ButtonOk.Parameter.option+"']").text()+"</p>\n\
                              <p>Город: "+ButtonOk.Parameter.value+"</p>";     
             var SavemyModal = new myModal({title:"Сохранить внесеные изменения?", bodyHtml:bodyHtml,ButtonOk:ButtonOk});
             SavemyModal.Show();                         
        };
        
        ButtonsFnSite.Delete = ButtonsFn.Delete;
        
        ButtonsFnSite.Cancelling = function(Object){
          Object.zhis.CancellingInputSite();
        };
        
       
        $("table#site").remove();       
        var RegionNameValue = objetThis.NameValue(); 
        var divTb =$("div#table");
        divTb.html("<img width='34' height='34' src='/img/loading-spinning-bubbles.svg'/>");
        var tabHtml =  '<table class="table" id="site" data-select="citys">\n'
                      +'<thead>\n'
                      +'<tr>\n'
                      +'<td>#</td><td>Регион</td><td>id/value</td><td>name</td><td>Опции</td>\n'
                      +'</tr>\n'
                      +'</thead>\n';
        $.post(
               "/fyurer/select/delete/site/table",
                {region:objetThis.value},
                function(data){
                    var SiteArray = JSON.parse(data);
                    var tr = ''; 
                    SiteArray.forEach(function(item,i){
                    tr += '<tr>\n'
                           +'<td class="" targets="0">'+ (i+1) +'</td>\n'
                           +'<td><div class="td-region" data="'+objetThis.value+'">'+RegionNameValue+'</div></td>\n'
                           +'<td><div class="value id"><div class="content">'+item.id+'</div></div></td>\n'
                           +'<td><div class="name"><div class="content">'+ item.name +'</div></div></td>\n'
                           +'<td class="option"><span class="edit-pole glyphicon glyphicon-cog" data-value="'+item.id+'" data-name="'+item.name+'"></span></td>\n'
                           +'</tr>\n';
                    });
                    tr = tabHtml + tr +'</table>\n';
                   var JQtr = $(tr);
                       JQtr.hide();
                       divTb.html('');
                       divTb.append(JQtr);
                       TableTdWidthMaxSite({RegionClone:Region, ButtonsFn:ButtonsFnSite});
                       JQtr.show(300);
                       JQtr.DataTable({paging: true, columnDefs:[{width:"20px",targets:0}]});
                       
                } 
              );
                }); 
         
        var ButtonAddSelect = new Button({QjObject:$("button#button-create-element"), Fn:function(){
            var ButtonAddSelectModalHtml = "<div  class='row'>\n"
                                           +"<div  class='col-md-6'>\n"
                                           +"<b>Регион:</b>"
                                           +"</div>\n"
                                           +"<div class='col-md-6'>\n"
                                           +"<div id='region_add_site'>\n"
                                           +Region.html+"\n"
                                           +"</div>\n"
                                           +"</div>\n"
                                           +"</div>\n"
                                           +"<div id='formAddSelect' class='row'>\n"
                                           +"<div class='col-md-12'>\n"
                                           +"<input id='InputAddSite' name='InputAddSite' placeholder='Новый Город' class='form-control' value='' style=''/>\n"
                                           +"</div>\n"
                                           +"</div>";
           
     var ButtonOk = {};
         ButtonOk.Parameter = {};
         ButtonOk.Fn = function(Parameter){
            var validate = true;

            if(!Parameter.RegionCloneAdd.value){ 
                Parameter.RegionCloneAdd.ValidateNo();
                validate = false;
            }
            if(Parameter.InputAddSite.value == ''){
                 validate = false;
                 Parameter.InputAddSite.ValidateNo();      
            }
            if(validate){
                $.post("/fyurer/select/detail/add",
                      {
                       table:"citys",  
                       ArrayKey:JSON.stringify(["region_id","name", "name_en"]),
                       ArrayValue:JSON.stringify([Parameter.RegionCloneAdd.value, Parameter.InputAddSite.value, translit(Parameter.InputAddSite.value)])
                      },
                      function(Data){
                        var SavemyModalButtonOk = {};
                            SavemyModalButtonOk.Parameter = {};
                        SavemyModalButtonOk.Fn = function(Parameter){
                            Parameter.myModal.Hide();
                        };
                        SavemyModalButtonOk.text ="Ок"
                          if(Data !== 0){
                             Data = JSON.parse(Data);
                            $.ajax({
                              url:"/ajax/region/"+Data.region_id+"/name",
                              success:function(data){
                               var regionStr,tabHtml;
                               regionStr = data;
                               tabHtml = '<table class="table" id="site" data-select="citys">\n'
                                    +'<thead>\n'
                                    +'<tr>\n'
                                    +'<td>id</td><td>Регион</td><td>name</td>\n'
                                    +'</tr>\n'
                                    +'</thead>\n'
                                    +'<tr>\n'
                                    +'<td>'+Data.id+'</td>\n'
                                    +'<td>'+regionStr+'</td>\n'
                                    +'<td>'+Data.name+'</td>\n'
                                    +'</tr>\n';
                                Parameter.myModal.Hide();
                                var myModalOk = new myModal({title:"Данные внесены в БД!", bodyHtml:tabHtml,ButtonOk:SavemyModalButtonOk});
                                myModalOk.ButtonNone.QjObject.hide(); 
                                myModalOk.Show();
                                },
                                error:function(){
                               alert("Ошибка");
                                }
                             });
                        } else {
                                Parameter.myModal.Hide();
                               var myModalOk = new myModal({title:"Ошибка!", bodyHtml:'',ButtonOk:SavemyModalButtonOk});
                                myModalOk.ButtonNone.QjObject.hide(); 
                                myModalOk.Show();
                        }
                      });
            }
         };
         
         var ButtonAddSelectModal = new myModal({title:"Добавить новый объект в базу данных?", bodyHtml:ButtonAddSelectModalHtml, ButtonOk:ButtonOk});
         ButtonAddSelectModal.Show();
         var SelectJq = ButtonAddSelectModal.myModal.find('select').attr({id:"region-add-site"});
         var RegionCloneAdd = new SeletUl({id:"#region_select_add_site", QjObject:SelectJq, oberka:'#region_add_site',oberkaJq:SelectJq.parent("div#region_add_site")});
         RegionCloneAdd.QjObject.chosen();
         RegionCloneAdd.ObjectChange(function(){});
         var InputAddSite = new inputUl({id:"#InputAddSite",QjObject:ButtonAddSelectModal.myModal.find("input#InputAddSite")});
         ButtonOk.Parameter.InputAddSite = InputAddSite; ButtonOk.Parameter.RegionCloneAdd = RegionCloneAdd;
        }}); 
      }
     var ButtonAddSite = new Button({QjObject:$("button#button-create-element"), Fn:ButtonAddSelectFn}); 
  
  } 
  }

 
 $("#panelInput").on("click","input.sost", function(){
     var idSo = $(this).data("idSo");
      $("#sostPost").html("<img width='34' height='34' src='/img/loading-spinning-bubbles.svg'/>");       
      $.post("/ajax/admin/postsost",
     {
    idPost:  $("input#PostId").val(),
    sost:   idSo
  },
  function(data){
      data = JSON.parse(data);
            SostPost(data);
            SchetPost();
            InputDate();
            $("#date-save").hide();
            $("#aktiv-input-post input").attr("class","btn btn-default");
  }
         ); 
   
   });
$("form#postEdit").on("change", "#aktiv-input-post input", function(){
    $(this).attr("class","btn btn-default red");
    $("#date-save").show(400); 
});   
   
$("form#postEdit").on("click", "button#date-save", function(){
    var input = $("#aktiv-input-post input");
    $.post("/ajax/admin/datepost",
     {
    post_id: $("#PostId").val(),    
    input_id: input.attr("id"),     
    value:  input.val()
  },
  function(data){
   if(data){
    $("#aktiv-input-post input").attr("class","btn btn-default");
    $("#date-save").hide(400); 
   }  
      
  }
         ); 

});

$("button#postControl").on("click",function(){
    var snjtPostCount,deletPostCount,snjtPost;
         $.get("/ajax/admin/postsost/control",
  function(data){
      data = JSON.parse(data);
      var snjtPost = JSON.parse(data[0]);
      var deletPost = JSON.parse(data[1]);
      if(data[0]!="0"){  snjtPostCount = snjtPost.length;} else {snjtPostCount = 0;}
      if(data[1]!="0"){ deletPostCount = deletPost.length;} else { deletPostCount = 0;}     
        var str = "<div class='row'>"
                  +"<div class='col-mg-12'>Объявлений на снятия: <b>"+snjtPostCount+"</b> шт<br>"
                 +"Объявлений на удаление: <b>"+deletPostCount+"</b> шт<br></div>"
                 +"</div>"
                 +"<div class='row'>"
                 +"<div class='col-md-12'>"
                 +"<button id='otchet-sostpost' class='btn btn-default'>Посмотреть отчет по объявленниям</button>"
                 +"</div></div>"
                 +"<div class='row'>"
                 +"<div class='col-md-12'>"
                 +"<button id='apdeitSostPost' class='btn btn-default'>Удалить/Снять объявленния</button>"
                 +"</div></div>" 
                
      $("#div-sost-posts").html(str);  
      
 $("#postAdmin").on("click","#otchet-sostpost",function(){
  
    var myModal = $('#myModal');  
    myModal.find('h4').text('Объявленния на снятия|удаления');
    myModal.find('button.btn-primary').attr("class","btn-primary btn").attr("id","abteitPostOk").text("Снять/Удалить");
    myModal.find('button.btn-default').attr("class","btn-default btn").text("Отменить"); 
    var str1 ="<h3>Эте объявленния подляжат снятию</h3>"
            +'<table class="table table-bordered">'
            +'<tr><td>#</td><td>title</td><td>автор</td></tr>';
    for(var i=0;i<snjtPostCount;i++){
        str1+="<tr><td>"+(i+1)+"</td><td><a class='windOpen' href='/fyurer/post/windopen/"+snjtPost[i]['id']+"'>"+snjtPost[i]['title']+"</a></td><td>"+snjtPost[i]['email']+"</td></tr>";
    }
    str1+="</table>";
    var str2 ="<h3>Эте объявленния подляжат удаления</h3>"
            +'<table class="table table-bordered">'
            +'<tr><td>#</td><td>title</td><td>автор</td></tr>';
    for(var i=0;i<deletPostCount;i++){
        str2+="<tr><td>"+(i+1)+"</td><td><a class='windOpen' href='/fyurer/post/windopen/"+deletPost[i]['id']+"'>"+deletPost[i]['title']+"</a></td><td>"+deletPost[i]['email']+"</td></tr>";
    }
    str2+="</table>";
     myModal.find('div.modal-body').html('<div class="row" id="table"><div class="col-md-11 col-sm-11">'+(str1+str2)+'</div></div>');           
     myModal.modal('show');
});
         
  }
         ); 
 
 $("#myModal").on("click","a.windOpen",function(event){
     event.preventDefault();
    var url = $(this).attr('href');
    var name = $(this).text();
   //  window.open(url, name);
  var newWin = window.open(url, 'example', 'width=auto,height=auto');
  newWin.onload = function() {
  div.style.fontSize = '30px'
  body.insertBefore();
  newWin.document.write("<script>window.opener.document.getElementById('navebar_id').style.display = 'none';</script>");
} 
 });
 
});

$("#postAdmin").on("click","#apdeitSostPost",function(){
var myModal = $('#myModal');  
    myModal.find('h4').text('Вы действительно хотите снять/удалить текущии объявленния?');
    myModal.find('button.btn-primary').attr("class","btn-primary btn").attr("id","abteitPostOk").text("Снять/Удалить");
    myModal.find('button.btn-default').attr("class","btn-default btn").text("Отменить");
    
    myModal.modal('show');
    

    
    
});

 $("#myModal").on("click","#abteitPostOk",function(){

   $.post("/ajax/admin/apdeitpost",
    function(data){
            data = JSON.parse(data);  
           if(data){
    var myModal = $('#myModal');          
    myModal.find('h4').text('Было изменения в состаянии объявленния?');
    myModal.find('button.btn-primary').attr("class","btn-primary btn").attr("id","Ok").hide();
    myModal.find('button.btn-default').attr("class","btn-default btn").text("Ок");
    
           }  

          }
         ); 
   }); 
$("form#form-staticpage-add #buttonAdd").on("click", function(){
    var formTrue = true;
    var title = $("form#form-staticpage-add #title"); 
    var post = $("form#form-staticpage-add #post");
 if(title.val()==''){
     title.after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
     title.css('border','1px solid red');
     formTrue = false; 
     }
if(post.val()==''){
     post.css('border','1px solid red');
     formTrue = false;   
}     
  if(formTrue==true){
    $("form#form-staticpage-add").submit();  
  }
  
  title.on("focus",function(){
    title.css('border','1px solid #CCC'); 
    $("#input_name div.col-sm-10 span.glyphicon-remove").remove();
  });
 post.on("focus",function(){
    post.css('border','1px solid #CCC'); 
  });
    

});  

$("form#form-staticpage-edit #buttonEdit").on("click", function(){
    var formTrue = true; 
    var title = $("form#form-staticpage-edit #title"); 
    var post = $("form#form-staticpage-edit #post");
 if(title.val()==''){
     title.after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
     title.css('border','1px solid red');
     formTrue = false; 
     }
if(post.val()==''){
     post.css('border','1px solid red');
     formTrue = false;   
}     
  if(formTrue==true){
    $("form#form-staticpage-edit").submit();  
  }
  
  title.on("focus",function(){
    title.css('border','1px solid #CCC'); 
    $("#input_name div.col-sm-10 span.glyphicon-remove").remove();
  });
 post.on("focus",function(){
    post.css('border','1px solid #CCC'); 
  });
});

 $('#region_select_admin').on('change',function(){
	var regionValue=this.options[this.selectedIndex].value;  
	var str='/ajax/sity/'+regionValue;
       $.ajax({
          url: str,
          success: function(data) {
           $('div#site_select').html(data);
            Selekt_poisk();
          }
        });
         
        });

        
   
 
});