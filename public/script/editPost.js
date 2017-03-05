var editPost = (function(){
    
      var deleteSelekt = function(Catalog){
                       var SeletUlTrue = false; 
                       Catalog.child.forEach(function(item, i){
                       if((item instanceof SeletUl)||(item instanceof inputUl)){
                          item.Delete();
                          SeletUlTrue = true; 
                        }});
                       if(SeletUlTrue){
                       Catalog.child = []; 
                       }
                        return SeletUlTrue;} 
                    
      function PorodaSelert(Poroda,childSeletSQLfunctP){ 
                            var childSeletSQLfunct = childSeletSQLfunctP || function(){};
                            var SeletUlTrue = deleteSelekt(Catalog);
                              Poroda.parent = Catalog;
                              Catalog.child.push(Poroda);
                              Poroda.childSeletSQL("/ajax/json/bd", SeletUlTrue, false,false,
                              function(){ 
                              Poroda.HtmlGet();
                              Poroda.ObjectChange();
                               
                               var Tip = new SeletUl({ObjectForm:FormEdit,id:"#tip_select",oberka:"#tip",oberkaClass:"col-md-6  form-group has-feedback",placeholder:"Тип объявления",surely:true});       
                                   Tip.parent = Catalog;
                                   Catalog.child.push(Tip); //function(url, json, option,bd,Fn
                                   Poroda.QjObject.parent().attr("style","clear: both;");

                                 Tip.childSeletSQL("/ajax/json/bd", SeletUlTrue, false, "tip", function(){
                                 Tip.QjObject.parent().attr("style","clear: both;");
                                 Tip.Set(root.tipId);
                                 delete root.tipId;
                                 Tip.ObjectChange(function(){ });  
                                 childSeletSQLfunct();
                                 });
 
                              });
  }               
      function TipSelect(bd){ var SeletUlTrue = deleteSelekt(Catalog);
                             var Tip = new SeletUl({ObjectForm:FormEdit,id:"#"+Catalog.valueArray[Catalog.value],oberka:"#searc_"+Catalog.valueArray[Catalog.value],oberkaClass:"col-md-6 form-group has-feedback",divContener:"form#searc-form",placeholder:"Тип обьявления",surely:true});
                                 Tip.parent = Catalog; Catalog.child.push(Tip);
                                 Tip.childSeletSQL("/ajax/json/bd",SeletUlTrue,false, bd,
                                 function(){
                                 Tip.Set(root.tipId);
                                 delete root.tipId;
                                 Tip.QjObject.parent().attr("style","clear: both;");
                                 Tip.ObjectChange(function(){ }); 
                                 });
  }
  var Sumbit = function(){
     if(FormEdit.Validacij()){ 
     Cshtora.True();
     Fails(FormEdit.QjObject, function(){
      FormEdit.submit();
     });
     }
   } 
   
    var FormEdit = new Form({id:"form#postEdit",button:new Button({id:"button_add", Fn:Sumbit})});
  
    
    var Id = new inputUl({ObjectForm:FormEdit ,ted:"input", id:"#id",surely:true});
    Id.htmlGet(); 
    var Email = new inputUl({ObjectForm:FormEdit ,ted:"input", id:"#email",maxSize:35, surely:true});
    Email.htmlGet();
    var Name = new inputUl({ObjectForm:FormEdit ,ted:"input", id:"#name", maxSize:30, surely:true});
    Name.htmlGet();
    var Phone = new inputUl({ObjectForm:FormEdit ,ted:"input", id:"#phone"});
    Phone.htmlGet();
    var Title = new inputUl({ObjectForm:FormEdit,teg:"input",id:"#title",oberka:"div#input_title",maxSize:120,surely:true});
    Title.htmlGet();
    var Post = new inputUl({ObjectForm:FormEdit,teg:"textarea",id:"#post",oberka:null,maxSize:1500,surely:true});
    Post.htmlGet();
    var privatEmail = new inputUl({id:"#privat_email",ObjectForm:FormEdit});
    privatEmail.htmlGet(); 
    var Region = new SeletUl({ObjectForm:FormEdit,id:"#region_select",oberka:"div#region", oberkaClass:"col-md-6 form-group has-feedback",placeholder:"Город",surely:true});
    Region.choneSelect();
    Region.Set(root.regionId);
    delete root.regionId;
   
    var Site = new SeletUl({ObjectForm:FormEdit,id:"#sity_select",oberka:"div#site", oberkaClass:"col-md-6 form-group has-feedback",placeholder:"Город",surely:true});
    Site.choneSelect();
    Site.Set(root.siteId);
    delete root.siteId;
    Site.parent = Region;
    Region.child.push(Site);
    Region.ObjectChange(
        function(){
           var SeletUlTrue = deleteSelekt(Region);
           Site.childSeletSQL("/ajax/sity/array", SeletUlTrue,false,false,
           function(){
               Site.QjObject.parent().attr("style","clear: both;");
               Site.ObjectChange(); 
           });
           if(SeletUlTrue){
               Region.child.push(Site);
           }
       });
    
    var htmlRadioInput1 = "<div id='input_pol' class='col-md-6 form-group'>\n"
                      +"<div class='border'>\n"
                      +"<h4>Пол животного</h4>\n"
                      +"<span>Мальчик</span>\n"
                      +"<input value='1' name='pol' type='radio'/>\n"
                      +"<span>Девочка</span>\n"
                      +"<input value='2' name='pol' type='radio'/>\n"
                      +"</div>\n"
                      +"</div>\n";   
    var htmlRadioInput2 = "<div id='input_vozrast' class='col-md-6 form-group'>\n"
                      +"<div class='border'>\n"
                      +"<h4>Возраст животного</h4>\n"
                      +"<span>Молодое животное</span>\n"
                      +"<input value='1' name='vozrast' type='radio'/>\n"
                      +"<span>Взрослое</span>\n"
                      +"<input value='2' name='vozrast' type='radio'/>\n"
                      +"</div>\n"
                      +"</div>\n";   
    
     var Catalog = new SeletUl({ObjectForm:FormEdit,id:"#category_select",oberka:"div#categorij",surely:true, oberkaClass:"col-md-6 form-group has-feedback",placeholder:"Категория",});
     Catalog.valueArray = {1:"poroda_koshek", 3:"poroda_sobak", 11:"uslugi_select", 14:"tovari_select", 16:"all_jvotnii"};
     Catalog.choneSelect(); 
     Catalog.Set(root.сategoryId);
     delete root.сategoryId;
     switch (Catalog.value){
          case 1:{
               var Poroda = new SeletUl({ObjectForm:FormEdit,id:"#"+Catalog.valueArray[Catalog.value],oberka:"div#poroda",oberkaClass:"col-md-6 form-group has-feedback", placeholder:"Порода кошек", surely:true});
                Poroda.choneSelect();
                PorodaSelert(Poroda,
                 function(){
                    Poroda.Set(root.porodaKoshkaId);
                    delete root.porodaKoshkaId; 
                    var Pol = new inputUl({name:"pol",ObjectForm:FormEdit,teg:"input",oberka:"div#input_pol",type:"radio"});
                    Catalog.child.push(Pol);
                    Pol.parent = Catalog;
                    Pol.QjObject = $(htmlRadioInput1);
                    Pol.QjObject.css({clear:"both"});
                    Pol.htmlSet();
                    Pol.ValueSetRadio(root.polId);
                    delete root.polId;
                    var Vozrast = new inputUl({name:"vozrast",ObjectForm:FormEdit,teg:"input",oberka:"div#input_vozrast",type:"radio"});
                    Catalog.child.push(Vozrast);
                    Vozrast.parent = Catalog;
                    Vozrast.QjObject = $(htmlRadioInput2);
                    Vozrast.QjObject.css({clear:"both"});
                    Vozrast.htmlSet();
                    Vozrast.ValueSetRadio(root.vozrastId);
                    delete root.vozrastId;
                  });

          break;}
    case 3:{
         var  Poroda = new SeletUl({ObjectForm:FormEdit,id:"#"+Catalog.valueArray[Catalog.value],oberka:"div#poroda",oberkaClass:"col-md-6 form-group has-feedback", placeholder:"Порода собак"});
                          PorodaSelert(Poroda,  function(){
                            var Pol = new inputUl({name:"pol",ObjectForm:FormEdit,teg:"input",oberka:"div#input_pol"});
                            Catalog.child.push(Pol);
                            Poroda.Set(root.porodaSobakId);
                            delete root.porodaSobakId;
                            Pol.parent = Catalog;
                            Pol.QjObject = $(htmlRadioInput1);
                            Pol.QjObject.css({"clear":"both"});
                            Pol.htmlSet();
                            Pol.ValueSetRadio(root.polId);
                            delete root.polId;
                            var Vozrast = new inputUl({name:"vozrast",ObjectForm:FormEdit,teg:"input",oberka:"div#input_vozrast"});
                            Catalog.child.push(Vozrast);
                            Vozrast.parent = Catalog;
                            Vozrast.QjObject = $(htmlRadioInput2);
                            Vozrast.QjObject.css({clear:"both"});
                            Vozrast.htmlSet();
                            Vozrast.ValueSetRadio(root.vozrastId);
                            delete root.vozrastId;
                          }); 
         break;}
     case 11:{   
            TipSelect('tovari_select');
             break;   }
    case 14:{   
           TipSelect('tovari_select');
           break; } 
    case 16:{deleteSelekt(Catalog);
             break;}     
      }
Catalog.ObjectChange(
   function(){
                                                
     switch (Catalog.value){

        case '1':{
                 var  Poroda = new SeletUl({ObjectForm:FormEdit,id:"#"+Catalog.valueArray[Catalog.value],oberka:"div#poroda",oberkaClass:"col-md-6 form-group has-feedback", placeholder:"Порода кошек", surely:true});
                  PorodaSelert(Poroda,
                 function(){
                    var Pol = new inputUl({name:"pol",ObjectForm:FormEdit,teg:"input",oberka:"div#input_pol",type:"radio"});
                    Catalog.child.push(Pol);
                    Pol.parent = Catalog;
                    Pol.QjObject = $(htmlRadioInput1);
                    Pol.QjObject.css({clear:"both"});
                    Pol.htmlSet();
                    var Vozrast = new inputUl({name:"vozrast",ObjectForm:FormEdit,teg:"input",oberka:"div#input_vozrast",type:"radio"});
                    Catalog.child.push(Vozrast);
                    Vozrast.parent = Catalog;
                    Vozrast.QjObject = $(htmlRadioInput2);
                    Vozrast.QjObject.css({clear:"both"});
                    Vozrast.htmlSet();
                  });
          break;}
                case '3':{
                          var  Poroda = new SeletUl({ObjectForm:FormEdit,id:"#"+Catalog.valueArray[Catalog.value],oberka:"div#poroda",oberkaClass:"col-md-6 form-group has-feedback", placeholder:"Порода собак"});
                          PorodaSelert(Poroda,  function(){
                            var Pol = new inputUl({name:"pol",ObjectForm:FormEdit,teg:"input",oberka:"div#input_pol"});
                            Catalog.child.push(Pol);
                            Pol.parent = Catalog;
                            Pol.QjObject = $(htmlRadioInput1);
                            Pol.QjObject.css({clear:"both"});
                            Pol.htmlSet();
                             var Vozrast = new inputUl({name:"vozrast",ObjectForm:FormEdit,teg:"input",oberka:"div#input_vozrast"});
                            Catalog.child.push(Vozrast);
                            Vozrast.parent = Catalog;
                            Vozrast.QjObject = $(htmlRadioInput2);
                            Vozrast.QjObject.css({clear:"both"});
                            Vozrast.htmlSet();
                          });                                  
                          break;}        
                case '11':{ TipSelect("tovari_select");
                          break;}
                case '14':{ TipSelect("tovari_select");
                          break;}
                case '16':{deleteSelekt(Catalog);
                           break;}
                case '17':{deleteSelekt(Catalog);
                           break;}   
                }
                         
 }); 
 if($("ul#img-list-server li").length !== 0){
     
 var DeleteImgNone = function(Parameter,elem){
 var ImgDeletNone = elem.parent();
     ImgDeletNone.find('img').attr("src", elem.data("imgNone"));
     $("input[value='"+ImgDeletNone.data("imgNone")+"']").remove();
     elem.text("Удалить").attr("class","img_delet delete_img btn botton_btn").attr("data-img-none",''); 
   
     }    
     
 var DeleteImg = function(Parameter,elem){//form#postEdit
     var imgDeletLi = elem.parent('li');
     FormEdit.QjObject.append("<input type='hidden' name='deletImg[]' value='"+imgDeletLi.find('img').attr("src").substring(1)+"'/>");
     elem.text("Отменить").attr("class","img_delet_none  btn botton_btn").attr("data-img-none",imgDeletLi.find('img').attr("src")); 
     imgDeletLi.find('img').attr("src","/images_post/delete_img.png");
     
     DeleteImgButtonNone = new Button({class:"img_delet_none", Fn:DeleteImgNone, delegirovanie:true, parentDiv:"img-container"});
     DeleteImgButton.QjObjectUpdating();
     }
     var DeleteImgButtonNone = null; 
     
     var DeleteImgButton = new Button({class:"img_delet", Fn:DeleteImg, delegirovanie:true, parentDiv:"img-container"});
     
 }
 
 var PostDelete = function(){
  var ModelData = {       
          title: "Удалить данные объявления?",
          bodyHtml: '<div class="row"><div class="col-md-11 col-sm-11">'+$("span.titlePost").text()+'</div></div>',
          ButtonOk:{class:"post-delet", text:"Удалить данное объявления?", Fn:function(){
                     // $("form#post-delete").submit();
                   var postDelete = new Form({id:"form#post-delete"});
                       postDelete.submit();
                      }},
          ButtonNone:{class:"post-NoDelet"}       
      };
 
      var ModelWin = new myModal(ModelData);
          ModelWin.Show();
        // console.log(ModelWin.ButtonOk.Fn);
 }
 
 var DeletePost = new Button({id:"button_post_delet", Fn: PostDelete});
     
    
})();

