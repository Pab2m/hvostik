var search = (function(){ 

yepnope("/script/jquery.history.js");

  if($("script").is("#get-search")){
    var searchData = root.search;
    console.log(root.search);
    delete root.search;
    if( searchData.post !==''){
     TextSerch.val(searchData.post);
    }   
  }
  

  var deleteSelekt = function(Catalog){
                       var SeletUlTrue = false; 
                       Catalog.child.forEach(function(item, i){
                       if(item instanceof SeletUl){
                          item.Delete();
                          SeletUlTrue = true; 
                        }});
                       if(SeletUlTrue){
                       Catalog.child = []; 
                       }
                        return SeletUlTrue;}                      
  
 function PorodaSelert(Poroda,childSeletSQLfunctP, TipDataArg){ 
                            var childSeletSQLfunct = childSeletSQLfunctP || function(){};
                            var  TipData =  TipDataArg || false;
                            var SeletUlTrue = deleteSelekt(Catalog);
                              Poroda.parent = Catalog;
                              Catalog.child.push(Poroda);
                              Poroda.childSeletSQL("/ajax/json/bd",SeletUlTrue, "<option value=0>Все породы</option>",false,
                              function(){
                                 childSeletSQLfunct();
                                 Poroda.HtmlGet();
                                 Poroda.QjObject.parent().attr("style",'');
                               var Tip = new SeletUl({ObjectForm:SearchForm,id:"#tip_select_serch", name:"tip_select" ,metka:["Tip"], oberka:"#searc_tip",oberkaClass:"col-md-3",divContener:"form#searc-form",placeholder:"Тип объявления"});       
                                   Tip.parent = Catalog;
                                   Catalog.child.push(Tip); //function(url, json, option,bd,Fn
                                 Tip.childSeletSQL("/ajax/json/bd", SeletUlTrue, false, "tip", function(){
                                 Tip.HtmlGet();
                                 Tip.QjObject.parent().attr("style",'');    
                                 Tip.ObjectChange(function(){ }); 
                                 if(TipData){
                                    if(searchData.tip_select != undefined){
                                     Tip.Set(searchData.tip_select); 
                                     }  
                                 }
                                 });
                              });
  } 
  
function TipSelect(bd, TipDataArg){ var SeletUlTrue = deleteSelekt(Catalog);
                             var TipData = TipDataArg || false;
                             var Tip = new SeletUl({ ObjectForm:SearchForm, id:"#"+Catalog.valueArray[Catalog.value], name:bd ,oberka:"#searc_"+Catalog.valueArray[Catalog.value],oberkaClass:"col-md-3",divContener:"form#searc-form",placeholder:"Тип обьявления"});
                                 Tip.parent = Catalog; Catalog.child.push(Tip);
                                 Tip.childSeletSQL("/ajax/json/bd",SeletUlTrue,"<option value=0>Все типы</option>", bd,
                                 function(){
                                 Tip.HtmlGet();
                                 Tip.QjObject.parent().attr("style",'');      
                                 Tip.ObjectChange(function(){ }); 
                                 if(TipData){
                                     if((searchData.uslugi_select != undefined) || (searchData.tovari_select != undefined)){
                                     var uslugiTovari = searchData.uslugi_select || searchData.tovari_select;
                                       Tip.Set(uslugiTovari); 
                                    } 
                                 }
                                 });
  }
  
  var UrlGetSearch = function(){
        var urlGet = "/search/data/get/?";
        var DataGet = {};
        DataGet.length = 0;
        for(var key in SearchForm.arryForm){
            if((SearchForm.arryForm[key].value !== false) && (SearchForm.arryForm[key].value !== '')){
                urlGet += key+"="+SearchForm.arryForm[key].value+"&";
                DataGet[key] = SearchForm.arryForm[key].value;
                DataGet.length ++;
            }
        }
     urlGet = urlGet.slice(0, -1); 
     if(DataGet.length !== 0){
     history.pushState(null, null, urlGet); 
     }
     return DataGet;
  }
   var DataSearchGet = function(){
     var htmlDataSearchGet = ''; 
       if(TextSerch.value){
          htmlDataSearchGet += "<div>"+TextSerch.value+"</div>/n"; 
       }
       
   } 
  
  var Sumbit = function(){
    var DataGet = UrlGetSearch();
    if(DataGet.length !== 0){
      var Ht = Cshtora.True();
      delete DataGet.length;
      var success = function(data){
          Ht.False();
          var content = $("#content-left");
              content.hide(300);
              content.html(data);
              content.show(300);
              
 //             console.log(data);
         }
   var  error = function(){
       console.log("Error search AJAX!!!");
       Ht.False();
   }  
        $.ajax({
          url: "/search/data/ajax/",
          data: DataGet,
          success: success,
          error: error,
          dataType: "html"
        });
    }
  }
    

 var SearchForm = new Form({id:"form#formSearch",button: new Button({id:"button-search", Fn:Sumbit})}); 
 var TextSerch = inputUl.inputUlSet({id:"#text", name:"post" ,metka:["TextSerch"], teg:"input",maxSize:100,ObjectForm:SearchForm,surely:true});  
         //Переделать под jquery deferred www.youtube.com/ watch?v= i8QQSJaBQdY
 var Region = new SeletUl({ObjectForm:SearchForm,id:"#region_select_search", name:"region_select" ,metka:["Region"] ,oberka:"div#searc_region",oberkaClass:"col-md-3",divContener:"form#searc-form"}),Site,Catalog;
 Region.HtmlGet();
 Region.JsonOptionSet("/json/regions.json", function(){
        if((searchData != undefined) && ((searchData.region_select != undefined) || (searchData.region_select != undefined))){
          Region.Set(searchData.region_select);     
           var SeletUlTrue = deleteSelekt(Region);
           Site = new SeletUl({ObjectForm:SearchForm, id:"#site_select_search", name:"sity_select", metka:["Site"], oberka:"div#searc_site",oberkaClass:"col-md-3",divContener:"form#searc-form",placeholder:"Город"});
           Site.parent = Region; 
           Region.child.push(Site);
           Site.QjObject.parent().attr("style","clear:both;");
           Site.childSeletSQL("/ajax/sity/array", false, false,false,
           function(){
               Site.HtmlGet();
               Site.QjObject.parent().attr("style",'');
               if(searchData.region_select != undefined){
                   Site.Set(searchData.sity_select);   
               }
               Site.ObjectChange(
                    function(){});
           });
         }
});
Region.ObjectChange(
        function(){
           var SeletUlTrue = deleteSelekt(Region);
           Site = new SeletUl({ObjectForm:SearchForm,id:"#site_select_search", name:"sity_select", metka:["Site"], oberka:"div#searc_site",oberkaClass:"col-md-3",divContener:"form#searc-form",placeholder:"Город"});
           Site.parent = Region; 
           Region.child.push(Site);
           Site.childSeletSQL("/ajax/sity/array", SeletUlTrue,false,false,
           function(){
           Site.HtmlGet();
           Site.QjObject.parent().attr("style",'');
               Site.ObjectChange(
                    function(){ });
           });

        }
);


var Catalog = new SeletUl({ObjectForm:SearchForm,id:"#category_select_search", name:"category_select", metka:["Catalog"], oberka:"#searc_category",oberkaClass:"col-md-3",divContener:"form#searc-form"});
    Catalog.valueArray = {1:"poroda_koshek", 3:"poroda_sobak", 11:"uslugi_select", 14:"tovari_select", 16:"all_jvotnii", 17:"all"};
    Catalog.HtmlGet();
    Catalog.JsonOptionSet("/json/category.json", function(){
      if((searchData != undefined) && (searchData.category_select != undefined)){
          Catalog.Set(searchData.category_select);     
          
           if((searchData != undefined) && (searchData.category_select != undefined)){
                                   
        var PorodaShort = function(){ 
                         var fidOberka = $(Poroda.oberka).find(Poroda.id+"_chosen");
                         fidOberka.hide().css({"float":"left"}); 
                         fidOberka.find('a').hide();
                          var oberkaJq = $(Poroda.oberka);
                          var oberkaJqClass = oberkaJq.attr("class");
                          oberkaJq.attr("class","");
                          oberkaJq.append("<div class='z-stavka on'title='Выбрать породу'  data-placement='bottom' ><span class='glyphicon glyphicon-play'></span></div>");
                          oberkaJq.find(".z-stavka");//.tooltip('show');
                          
                          var porodaShow = function(){ 
                              
                                fidOberka.find('a').show();  
                                fidOberka.append(fidOberka.find('.chosen-drop'));
                                oberkaJq.attr("class",oberkaJqClass);
                                fidOberka.show(300);//poroda_koshek_chosen
                                $("div.z-stavka").hide(300);
                                Poroda.HtmlGet();
                                Poroda.QjObject.parent().attr("style",'');
                                Poroda.ObjectChange(function(){ });
                            }
                                              
                            if((searchData != undefined) && ((searchData.poroda_koshek != undefined) || (searchData.poroda_sobak != undefined))){
                                var porodaVal = searchData.poroda_koshek || searchData.poroda_sobak;
                                porodaShow();
                                Poroda.Set(porodaVal);
                            } else {
                                oberkaJq.on("click",".on",function(){ 
                                porodaShow();
                            });       
                            }
                            
                                }
                                

               switch (searchData.category_select){
                        case 1:{ 
                                  var Poroda = new SeletUl({ObjectForm:SearchForm,id:"#"+Catalog.valueArray[searchData.category_select], name:"poroda_koshek", metka:["Poroda"], oberka:"#searc_"+Catalog.valueArray[searchData.category_select],oberkaClass:"col-md-3",parentDiv:"form#searc-form", placeholder:"Порода кошек"});
                                  PorodaSelert(Poroda, PorodaShort, true); 
                          
                                  break;}
                        case 3:{
                                  var Poroda = new SeletUl({ObjectForm:SearchForm, id:"#"+Catalog.valueArray[Catalog.value], name:"poroda_sobak" , metka:["Poroda"], oberka:"#searc_"+Catalog.valueArray[Catalog.value],oberkaClass:"col-md-3",parentDiv:"form#searc-form", placeholder:"Порода собак"});
                                  PorodaSelert(Poroda, PorodaShort, true);
                                  break;}        
                        case 11:{ TipSelect("tovari_select", true);
                                  break;}
                        case 14:{ TipSelect("uslugi_select", true);
                                  break;}
                        case 16:{deleteSelekt(Catalog);
                                   break;}
                        case 17:{deleteSelekt(Catalog);
                                   break;}   
                        }
         
    }
      }
    });    

   
   Catalog.OptionSet({option:"Все"});
   Catalog.ObjectChange(
        function(){ var bd = Catalog.valueArray[Catalog.value]; 
    var PorodaShort = function(){ 
                         var fidOberka = $(Poroda.oberka).find(Poroda.id+"_chosen");
                         fidOberka.hide().css({"float":"left"}); 
                         fidOberka.find('a').hide();
                          var oberkaJq = $(Poroda.oberka);
                          var oberkaJqClass = oberkaJq.attr("class");
                          oberkaJq.attr("class","");
                          oberkaJq.append("<div class='z-stavka on'title='Выбрать породу'  data-placement='bottom' ><span class='glyphicon glyphicon-play'></span></div>");
                          oberkaJq.find(".z-stavka");//.tooltip('show');
                          oberkaJq.on("click",".on",
                            function(){ 
                                fidOberka.find('a').show();  
                                fidOberka.append(fidOberka.find('.chosen-drop'));
                                oberkaJq.attr("class",oberkaJqClass);
                                fidOberka.show(300);//poroda_koshek_chosen
                                $(this).hide(300);  
                                Poroda.HtmlGet();
                                Poroda.QjObject.parent().find(Poroda.id+"_chosen").css({overflow:"visible"});
                                Poroda.ObjectChange(function(){ });
                            });    
                                }
                    switch (Catalog.value){
                        case '1':{ 
                                  var Poroda = new SeletUl({ObjectForm:SearchForm,id:"#"+Catalog.valueArray[Catalog.value], name:"poroda_koshek", metka:["Poroda"], oberka:"#searc_"+Catalog.valueArray[Catalog.value],oberkaClass:"col-md-3",parentDiv:"form#searc-form", placeholder:"Порода кошек"});
                                  PorodaSelert(Poroda,PorodaShort); 
                                  //TipSelect();
                                  break;}
                        case '3':{
                                  var Poroda = new SeletUl({ObjectForm:SearchForm, id:"#"+Catalog.valueArray[Catalog.value], name:"poroda_sobak" , metka:["Poroda"], oberka:"#searc_"+Catalog.valueArray[Catalog.value],oberkaClass:"col-md-3",parentDiv:"form#searc-form", placeholder:"Порода собак"});
                                  PorodaSelert(Poroda,PorodaShort);
                                  break;}        
                        case '11':{ TipSelect("uslugi_select");
                                  break;}
                        case '14':{ TipSelect("tovari_select");
                                  break;}
                        case '16':{deleteSelekt(Catalog);
                                   break;}
                        case '17':{deleteSelekt(Catalog);
                                   break;}   
                        }

        });
             

                        
    })();