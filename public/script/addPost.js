var addPost = (function(){
    
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
                            var SeletUlTrue = deleteSelekt(CatalogAdd);
                              Poroda.parent = CatalogAdd;
                              CatalogAdd.child.push(Poroda);
                              Poroda.childSeletSQL("/ajax/json/bd", SeletUlTrue, false,false,
                              function(){ 
                              Poroda.HtmlGet();
                              Poroda.ObjectChange();
                               
                            var Tip = new SeletUl({ObjectForm:FormAdd,id:"#tip_select",oberka:"#tip",oberkaClass:"col-md-6  form-group has-feedback",placeholder:"Тип объявления",surely:true});       
                                Tip.parent = CatalogAdd;
                                CatalogAdd.child.push(Tip); //function(url, json, option,bd,Fn
                                Poroda.QjObject.parent().attr("style","clear: both;");
                                Tip.childSeletSQL("/ajax/json/bd", SeletUlTrue, false, "tip", function(){
                                Tip.QjObject.parent().attr("style","clear: both;");
                                Tip.ObjectChange(function(){ });  
                                childSeletSQLfunct();
                                 });
 
                              });
  }     
  function TipSelect(bd){ var SeletUlTrue = deleteSelekt(CatalogAdd);
                             var Tip = new SeletUl({ObjectForm:FormAdd,id:"#"+CatalogAdd.valueArray[CatalogAdd.value],oberka:"#searc_"+CatalogAdd.valueArray[CatalogAdd.value],oberkaClass:"col-md-6 form-group has-feedback",divContener:"form#searc-form",placeholder:"Тип обьявления",surely:true});
                                 Tip.parent = CatalogAdd; CatalogAdd.child.push(Tip);
                                 Tip.childSeletSQL("/ajax/json/bd",SeletUlTrue,false, bd,
                                 function(){
                                 Tip.QjObject.parent().attr("style","clear: both;");     
                                 Tip.ObjectChange(function(){ }); 
                                 });
  }
    var Sumbit = {};
    Sumbit.Parameter = {};
    Sumbit.Fn = function(){ 
     if(FormAdd.Validacij()){ 
       Cshtora.True();
       Fails(FormAdd.QjObject ,function(){
       FormAdd.submit();  
     });
     }
   } 
    
    var FormAdd = new Form({id:"form#add",button:new Button({id:"button_add_annou", Fn:Sumbit})});
    
    var Name = new inputUl({ObjectForm:FormAdd,teg:"input",id:"#name",oberka:"div#input_name",maxSize:30,surely:true});
    Name.htmlGet();
     var Email = new inputUl({ObjectForm:FormAdd,teg:"input",id:"#email",oberka:"div#input_email",maxSize:35,surely:true});
     Name.htmlGet();
     
     var Phone = new inputUl({ObjectForm:FormAdd,teg:"input",id:"#phone",oberka:"div#input_phone",surely:true});
     Phone.htmlGet();
     
     var Title = new inputUl({ObjectForm:FormAdd,teg:"input",id:"#title",oberka:"div#input_title",maxSize:120,surely:true});
     Title.htmlGet();
      
     var Post = new inputUl({ObjectForm:FormAdd,teg:"textarea",id:"#post",oberka:"div#input_post",maxSize:1500,surely:true});
     Post.htmlGet();
     
     var privatEmail = inputUl.inputUlSet({id:"#privat_email",ObjectForm:FormAdd});
     
     var RegionAdd = new SeletUl({ObjectForm:FormAdd,id:"#region_select",oberka:"div#region",surely:true});
     var SiteAdd='';
     RegionAdd.HtmlGet();
     RegionAdd.JsonOptionSet("/json/regions.json");
     
     RegionAdd.ObjectChange(
        function(){
           var SeletUlTrue = deleteSelekt(RegionAdd);
           SiteAdd = new SeletUl({ObjectForm:FormAdd,id:"#sity_select", oberka:"div#site",oberkaClass:"col-md-6 form-group has-feedback",placeholder:"Город",surely:true});
           SiteAdd.parent = RegionAdd;
           RegionAdd.child.push(SiteAdd);
           SiteAdd.childSeletSQL("/ajax/sity/array", SeletUlTrue,false,false,
           function(){
               SiteAdd.QjObject.parent().attr("style","clear: both;");
               SiteAdd.ObjectChange(); 
           });
        });
       var CatalogAdd = new SeletUl({ObjectForm:FormAdd,id:"#category_select",oberka:"div#categorij",surely:true});
       CatalogAdd.valueArray = {1:"poroda_koshek", 3:"poroda_sobak", 11:"uslugi_select", 14:"tovari_select", 16:"all_jvotnii"};
       CatalogAdd.HtmlGet();
       CatalogAdd.QjObject.parent().attr("style","clear: both;");
       CatalogAdd.JsonOptionSet("/json/category.json");
       CatalogAdd.ObjectChange(
        function(){
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
                                  
     switch (CatalogAdd.value){

        case '1':{
                 var  PorodaAdd = new SeletUl({ObjectForm:FormAdd,id:"#"+CatalogAdd.valueArray[CatalogAdd.value],oberka:"div#poroda",oberkaClass:"col-md-6 form-group has-feedback", placeholder:"Порода кошек", surely:true});
                  PorodaSelert(PorodaAdd,
                 function(){
                    var Pol = new inputUl({name:"pol",ObjectForm:FormAdd,teg:"input",oberka:"div#input_pol",type:"radio"});
                    CatalogAdd.child.push(Pol);
                    Pol.parent = CatalogAdd;
                    Pol.QjObject = $(htmlRadioInput1);
                    Pol.QjObject.css({clear:"both"});
                    Pol.htmlSet();
                    var Vozrast = new inputUl({name:"vozrast",ObjectForm:FormAdd,teg:"input",oberka:"div#input_vozrast",type:"radio"});
                    CatalogAdd.child.push(Vozrast);
                    Vozrast.parent = CatalogAdd;
                    Vozrast.QjObject = $(htmlRadioInput2);
                    Vozrast.QjObject.css({clear:"both"});
                    Vozrast.htmlSet();
                  });
                   break;}
         case '3':{
                var  PorodaAdd = new SeletUl({ObjectForm:FormAdd,id:"#"+CatalogAdd.valueArray[CatalogAdd.value],oberka:"div#poroda",oberkaClass:"col-md-6 form-group has-feedback", placeholder:"Порода собак",surely:true});
                PorodaSelert(PorodaAdd,  function(){
                var Pol = new inputUl({name:"pol",ObjectForm:FormAdd,teg:"input",oberka:"div#input_pol"});
                CatalogAdd.child.push(Pol);
                Pol.parent = CatalogAdd;
                Pol.QjObject = $(htmlRadioInput1);
                Pol.QjObject.css({clear:"both"});
                Pol.htmlSet();
                 var Vozrast = new inputUl({name:"vozrast",ObjectForm:FormAdd,teg:"input",oberka:"div#input_vozrast"});
                CatalogAdd.child.push(Vozrast);
                Vozrast.parent = CatalogAdd;
                Vozrast.QjObject = $(htmlRadioInput2);
                Vozrast.QjObject.css({clear:"both"});
                Vozrast.htmlSet();
              });                                  
              break;}        
                case '11':{ TipSelect("tovari_select");
                          break;}
                case '14':{ TipSelect("uslugi_select");
                          break;}
                case '16':{deleteSelekt(CatalogAdd);
                           break;}
                case '17':{deleteSelekt(CatalogAdd);
                           break;}   
                }

 

                         
 });
 
               
 })();
     