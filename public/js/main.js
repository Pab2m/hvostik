var UrlImg, post=new Object();

function Selekt_poisk(){var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  $('#poroda_select_add').on('change',function(){
          var str='/ajax/tip';
          $.ajax({
          url: str,
          success: function(data) {
         // $('li#divPoroda').html(data);
         $("li.cena").remove();
         $("li#li_tip").remove();
         $("#vozrast").after('<div class="form-group" id="tip_select">'+
    '<div class="col-md-6">'+data+'</div></div>');
          Selekt_poisk();
                                  }
                });
     
      });   
    $('li#divPorod a.chosen-single').on('click',function(){
    $('span#noPoroda').remove();
     $('span#noLi_tip').remove();
    $("li#divPorod a.chosen-single").removeAttr("style");
    });
     $('form#add input[name="pol"]').on('focus',function(){
    //$('span#noPoroda').remove();
    $("li#divPorod span#pol").removeAttr("style");
    });
    


    }
    
    $(document).ready(function(){
    
          Selekt_poisk();
        $('#region_select_add').on('change',function(){
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
        
        
         $('#category_select_add').change(function(){
              $("div#cot_select").remove();
              $("div#pol").remove();
            $("div#vozrast").remove();
            $('div#tip_select').remove();
//               $("li.cena").remove();
	var typeValue=this.options[this.selectedIndex].value;
        var url_ajax=null;
        if(typeValue==1){
            url_ajax='poroda_koshek'; 
        } else
        if(typeValue==3){
            url_ajax='poroda_sobak';
        } else 
        if((typeValue==11)){
            url_ajax='uslugi_select';
        }  else
        if(typeValue==14){
            url_ajax='tovari_select';
        } else 
        if(typeValue==16){
            url_ajax='drugii_jivotnih';
        }
    var str='/ajax/type/'+url_ajax;

          $.ajax({
          url: str,
          success: function(data) {
        if(data){
          $("div#categorij_select").after(data);
         // console.log(data);
          Selekt_poisk();
          }}
                });
        });
   $('form#add').on('change','#tip_select_add',function(){
          var tip_select=$('form#add select[name="tip_select_add"]').val();
          ///$("#tip_select").remove();
          if($("#cena_input")){
            var cena_add=$("#cena_add").val();
              $("div#cena_input").remove();
          }
          if(tip_select==7){
         
          $("#tip_select").after("<div class='form-group' id='cena_input'><div class='col-md-6'><input id='cena_add' class='form-control' type='text' name='cena' placeholder='Цена'></div></div>");
               if(cena_add!==0){
               $("#cena_add").val(cena_add);   
              }
          }
   });
   
var trueCategory, trueForm=true; 
//=========================POST============================================================
 function ValidaFormPostEdit(){ var trueForm=true;
   var name=$('form#add input[name="name"]');
    var email=$('form#add input[name="email"]');
    var region=$('form#add select[id="region_select_add"]');
    var site=$('form#add select[id="sity_select_add"]');
    var categoryVal=$('form#add select[id="category_select_add"]').val();
    var trueForm=true;
     console.log("categoryVal= "+categoryVal);
      console.log($('form#add select[id="category_select_add"]'));
    if(name.val()==false){
       name.after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
       name.css('border','1px solid red');
       trueForm=false;
       console.log('trueForm='+trueForm)
    } 
    if((email.val()==false)||(email.val()==null)){
       email.after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
       email.css('border','1px solid red');
       trueForm=false;
       console.log('trueForm='+trueForm)
    }
    if((region.val()==false)||(region.val()==null)){
       $('div#region .div-glyphicon').remove();
       $('div#region').append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
       trueForm=false;
       console.log('trueForm='+trueForm)
    }
    if((site.val()==false)||(site.val()==null)){
       $('div#site .div-glyphicon').remove();
       $("div#site").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
       trueForm=false;
       console.log('trueForm='+trueForm)
    }
    if((categoryVal==false)||(categoryVal==null)){
       $('div#categorij_select .div-glyphicon').remove();
       $("div#categorij_select").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
       trueCategory=false;
       trueForm=false;
    }else {trueCategory=true;}
    if(trueCategory){
         function radioPol(){
                 $('.padding_pol_8').css('border','1px solid red');
                 trueForm=false;
                 $('#pol').on('change', pol, function() {
                        $('.padding_pol_8').css('border','0px solid red');  
                            });
                                 }
          function radioVozrast(){
                 $('.padding_vozrast_8').css('border','1px solid red');
                 trueForm=false;
                 $('#vozrast').on('change', pol, function() {
                        $('.padding_vozrast_8').css('border','0px solid red');  
                            });
                                 }                          
       if(categoryVal==1){
         var porodaCot=$('form#add select[name="poroda_koshek"]'); 
         var pol=$('form#add input[name="pol"]:checked');
         var vozrast=$('form#add input[name="vozrast"]:checked');
         var tipVal=$('form#add select[name="tip_select_add"]').val();
             
         
         if(porodaCot.val()==false){
            $('div#cot_select .div-glyphicon').remove();
            $("div#cot_select").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
            trueForm=false;
         }
         if((pol.val()==false)||(pol.val()==undefined)){
             trueForm=false;
             radioPol();
         }
          if((vozrast.val()==false)||(pol.val()==undefined)){
             radioVozrast();
            trueForm=false;
         }
         if(tipVal==false){
              $("li#li_tip a.chosen-single").css('border','2px solid red');
               $('span#noLi_tip').remove();
              trueForm=false;
         }
         
       }else if(categoryVal==3){
           //alert('Выбраны собак');
           console.log("Собаки выбраны");
         var porodaCot=$('form#add select[name="poroda_sobak"]');
         var pol=$('form#add input[name="pol"]:checked');
         var vozrast=$('form#add input[name="vozrast"]:checked');
         var tipVal=$('form#add select[name="tip_select_add"]').val();
         console.log("porodaCot.val= "+porodaCot.val());
         if(porodaCot.val()==false){
            $("li#divPorod a.chosen-single").css('border','2px solid red');
            trueForm=false;
         }
         if((pol.val()==false)|| (pol.val()==undefined)){
             radioPol();
             trueForm=false;
         }
          if((vozrast.val()==false)||(vozrast.val()==undefined)){
            radioVozrast();
             trueForm=false;
         }
         if((tipVal==false)|| (tipVal==null)){
              $("li#li_tip a.chosen-single").css('border','2px solid red');
               $('span#noLi_tip').remove();
              trueForm=false;
       } 
   }else if(categoryVal==11){ //alert(Услуги)
        var uslugitipVal=$('form#add select[name="uslugi_select_add"]').val();
        if(uslugitipVal==false){
            $('div#cot_select .div-glyphicon').remove();
            $("div#cot_select").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
              trueForm=false;
        }
        $('#uslugi_select_add_chosen').on('click',function(){
         $('div#cot_select .div-glyphicon').remove();
});
    }else if(categoryVal==14){
        var categoryVal=$('form#add select[name="tovari_select_add"]').val();
        if((categoryVal==false)||(categoryVal==null)){
            $('div#cot_select .div-glyphicon').remove();
            $("div#cot_select").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
              trueForm=false;
        }
        $('#tovari_select_add_chosen').on('click',function(){
         $('div#cot_select .div-glyphicon').remove();});
        
    }}
        var  title=$('form#add input[name="title"]');
       if($('form#add input[name="title"]').val()==false){
       var input_title=$('div#input_title');
       title.after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
       title.css('border','1px solid red'); 
         trueForm=false;
         
     title.on('focus',function(){
    $('div#input_title span.glyphicon').remove();
    title.css('border','1px solid #ccc');
});
        }
        var post=$('form#add textarea[name="post"]');
      if(post.val()==false){
            post.css('border','1px solid red');
            trueForm=false;
          post.on('focus',function(){
          post.css('border','1px solid #ccc');   
        });
}  
     
 return trueForm;}  
     

$('form#add .add').on('click',function(){
    
$('body').after('<div id="htora"><div id="proces"><img  width="64" height="64" src="/img/loading-spinning-bubbles.svg"></div></div>');
console.log("trueForm= "+trueForm)
        if(trueForm){
     // Обаботка события нажатия на кнопку "Загрузить". Проходим по всем миниатюрам из списка,
    // читаем у каждой свойство file (добавленное при создании) и начинаем загрузку, создавая
    // экземпляры объекта uploaderObject. По мере загрузки, обновляем показания progress bar,
    // через обработчик onprogress, по завершении выводим информацию
        
         var imgList = $('ul#img-list');
         var i=0;
         if(imgList.find('li').length!==0){
                       var ImgAjaxN=0;
         LiLength =imgList.find('li').length;
         if(LiLength>4){
             LiLength=4;
         }
         $('input.img').remove();
         console.log($('input.img_delet'));
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
                     $("form#add").append("<input class='img' type='hidden' name='img[]' value='"+data+"'>");
                        //  console.log('ImgAjaxN='+ImgAjaxN);
                       // updateProgress(pBar, 100);
                       // console.log('Файл `'+uploadItem.file.name+'` загружен, полученные данные:<br/>*****<br/>'+data+'<br/>*****');
                    } else {
                     //   console.log('Ошибка при загрузке файла `'+uploadItem.file.name+'`:<br/>'+this.lastError.text);
                    }
                 if(ImgAjaxN==LiLength){
                   $('input.img').map(function(indx,element){
                       if($(element).val()==0){
                           alert('При загрузки файла под номером '+(indx+1)+' произошла ошибка!');
                       }
                   });      
              $('form#add').submit();
                 }                         
                }
            });
        });
        }else{
         $('form#add').submit();
      }
        }
name.on('focus',function(){
    $('div#input_name span.glyphicon').remove();
    name.css('border','1px solid #ccc');
});

email.on('focus',function(){
    $('div#input_email span.glyphicon').remove();
    email.css('border','1px solid #ccc');
});

$('#region_select_add_chosen').on('click',function(){
$('div#region .div-glyphicon').remove();
});

$('#sity_select_add_chosen').on('click',function(){
$('div#site .div-glyphicon').remove();
});

$('#category_select_add_chosen').on('click',function(){
$('div#categorij_select .div-glyphicon').remove();
});


$('#poroda_select_add_chosen').on('click',function(){
$('div#cot_select .div-glyphicon').remove();
});

});
          
//====================================================Edit post ========================================
$('form#postEdit #button_add_annou').on('click',function(){
    var name=$('form#add input[name="name"]');
    var email=$('form#add input[name="email"]');
    var region=$('form#add select[id="region_select_add"]');
    var site=$('form#add select[id="sity_select_add"]');
    var categoryVal=$('form#add select[id="category_select_add"]').val();
    var trueForm=true;
     console.log("categoryVal= "+categoryVal);
      console.log($('form#add select[id="category_select_add"]'));
    if(name.val()==false){
       name.after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
       name.css('border','1px solid red');
       trueForm=false;
       console.log('trueForm='+trueForm)
    } 
    if((email.val()==false)||(email.val()==null)){
       email.after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
       email.css('border','1px solid red');
       trueForm=false;
       console.log('trueForm='+trueForm)
    }
    if((region.val()==false)||(region.val()==null)){
       $('div#region .div-glyphicon').remove();
       $('div#region').append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
       trueForm=false;
       console.log('trueForm='+trueForm)
    }
    if((site.val()==false)||(site.val()==null)){
       $('div#site .div-glyphicon').remove();
       $("div#site").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
       trueForm=false;
       console.log('trueForm='+trueForm)
    }
    if((categoryVal==false)||(categoryVal==null)){
       $('div#categorij_select .div-glyphicon').remove();
       $("div#categorij_select").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
       trueCategory=false;
       trueForm=false;
    }else {trueCategory=true;}
    if(trueCategory){
         function radioPol(){
                 $('.padding_pol_8').css('border','1px solid red');
                 trueForm=false;
                 $('#pol').on('change', pol, function() {
                        $('.padding_pol_8').css('border','0px solid red');  
                            });
                                 }
          function radioVozrast(){
                 $('.padding_vozrast_8').css('border','1px solid red');
                 trueForm=false;
                 $('#vozrast').on('change', pol, function() {
                        $('.padding_vozrast_8').css('border','0px solid red');  
                            });
                                 }                          
       if(categoryVal==1){
         var porodaCot=$('form#add select[name="poroda_koshek"]'); 
         var pol=$('form#add input[name="pol"]:checked');
         var vozrast=$('form#add input[name="vozrast"]:checked');
         var tipVal=$('form#add select[name="tip_select_add"]').val();
             
         
         if(porodaCot.val()==false){
            $('div#cot_select .div-glyphicon').remove();
            $("div#cot_select").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
            trueForm=false;
         }
         if((pol.val()==false)||(pol.val()==undefined)){
             trueForm=false;
             radioPol();
         }
          if((vozrast.val()==false)||(pol.val()==undefined)){
             radioVozrast();
            trueForm=false;
         }
         if(tipVal==false){
              $("li#li_tip a.chosen-single").css('border','2px solid red');
               $('span#noLi_tip').remove();
              trueForm=false;
         }
         
       }else if(categoryVal==3){
           //alert('Выбраны собак');
           console.log("Собаки выбраны");
         var porodaCot=$('form#add select[name="poroda_sobak"]');
         var pol=$('form#add input[name="pol"]:checked');
         var vozrast=$('form#add input[name="vozrast"]:checked');
         var tipVal=$('form#add select[name="tip_select_add"]').val();
         console.log("porodaCot.val= "+porodaCot.val());
         if(porodaCot.val()==false){
            $("li#divPorod a.chosen-single").css('border','2px solid red');
            trueForm=false;
         }
         if((pol.val()==false)|| (pol.val()==undefined)){
             radioPol();
             trueForm=false;
         }
          if((vozrast.val()==false)||(vozrast.val()==undefined)){
            radioVozrast();
             trueForm=false;
         }
         if((tipVal==false)|| (tipVal==null)){
              $("li#li_tip a.chosen-single").css('border','2px solid red');
               $('span#noLi_tip').remove();
              trueForm=false;
       } 
   }else if(categoryVal==11){ //alert(Услуги)
        var uslugitipVal=$('form#add select[name="uslugi_select_add"]').val();
        if(uslugitipVal==false){
            $('div#cot_select .div-glyphicon').remove();
            $("div#cot_select").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
              trueForm=false;
        }
        $('#uslugi_select_add_chosen').on('click',function(){
         $('div#cot_select .div-glyphicon').remove();
});
    }else if(categoryVal==14){
        var categoryVal=$('form#add select[name="tovari_select_add"]').val();
        if((categoryVal==false)||(categoryVal==null)){
            $('div#cot_select .div-glyphicon').remove();
            $("div#cot_select").append('<div class="col-md-1 div-glyphicon glyphicon glyphicon-remove  color-red"></div>');
              trueForm=false;
        }
        $('#tovari_select_add_chosen').on('click',function(){
         $('div#cot_select .div-glyphicon').remove();});
        
    }}
        var  title=$('form#add input[name="title"]');
       if($('form#add input[name="title"]').val()==false){
       var input_title=$('div#input_title');
       title.after('<span class="glyphicon glyphicon-remove form-control-feedback color-red"></span>');
       title.css('border','1px solid red'); 
         trueForm=false;
         
     title.on('focus',function(){
    $('div#input_title span.glyphicon').remove();
    title.css('border','1px solid #ccc');
});
        }
        var post=$('form#add textarea[name="post"]');
      if(post.val()==false){
            post.css('border','1px solid red');
            trueForm=false;
          post.on('focus',function(){
          post.css('border','1px solid #ccc');   
        });
}
$('body').after('<div id="htora"><div id="proces"><img  width="64" height="64" src="/img/loading-spinning-bubbles.svg"></div></div>');
console.log("trueForm= "+trueForm)
        if(trueForm){
     // Обаботка события нажатия на кнопку "Загрузить". Проходим по всем миниатюрам из списка,
    // читаем у каждой свойство file (добавленное при создании) и начинаем загрузку, создавая
    // экземпляры объекта uploaderObject. По мере загрузки, обновляем показания progress bar,
    // через обработчик onprogress, по завершении выводим информацию
        
         var imgList = $('ul#img-list');
         var i=0;
         if(imgList.find('li').length!==0){
                       var ImgAjaxN=0;
         LiLength =imgList.find('li').length;
         if(LiLength>4){
             LiLength=4;
         }
         $('input.img').remove();
         console.log($('input.img_delet'));
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
                     $("form#add").append("<input class='img' type='hidden' name='img[]' value='"+data+"'>");
                        //  console.log('ImgAjaxN='+ImgAjaxN);
                       // updateProgress(pBar, 100);
                       // console.log('Файл `'+uploadItem.file.name+'` загружен, полученные данные:<br/>*****<br/>'+data+'<br/>*****');
                    } else {
                     //   console.log('Ошибка при загрузке файла `'+uploadItem.file.name+'`:<br/>'+this.lastError.text);
                    }
                 if(ImgAjaxN==LiLength){
                   $('input.img').map(function(indx,element){
                       if($(element).val()==0){
                           alert('При загрузки файла под номером '+(indx+1)+' произошла ошибка!');
                       }
                   });      
              $('form#add').submit();
                 }                         
                }
            });
        });
        }else{
         $('form#add').submit();
      }
        }
name.on('focus',function(){
    $('div#input_name span.glyphicon').remove();
    name.css('border','1px solid #ccc');
});

email.on('focus',function(){
    $('div#input_email span.glyphicon').remove();
    email.css('border','1px solid #ccc');
});

$('#region_select_add_chosen').on('click',function(){
$('div#region .div-glyphicon').remove();
});

$('#sity_select_add_chosen').on('click',function(){
$('div#site .div-glyphicon').remove();
});

$('#category_select_add_chosen').on('click',function(){
$('div#categorij_select .div-glyphicon').remove();
});


$('#poroda_select_add_chosen').on('click',function(){
$('div#cot_select .div-glyphicon').remove();
});

});
    
    
    
var SpanUtch=$('#post_podr span.utch');
var MaxWidthSpanUtch=$(SpanUtch[0]).width();    
   
     for(var i=1; i<SpanUtch.length; i++){
       if($(SpanUtch[i]).width()>MaxWidthSpanUtch){
         MaxWidthSpanUtch=$(SpanUtch[i]).width();
       }
     } 
    var str="'"+MaxWidthSpanUtch+"px'";
     $('#post_podr span.utch').css('width',str);
         
    
     $('#button_div div#button').on('click',function(){
        // var url=document.location+'?';
        var url='/search/data?';
      console.log(url);
         var get=Array();
         if($('#text_div input#text').val()){
          get['textsearch']=$('#text_div input#text').val();  
           }
        if($('#sity_select_search').val()){
          get['sity_select_add']=$('#sity_select_search').val(); 
        }else if($('#region_select_search').val()){
           get['region_select_add']=$('#region_select_search').val();  
        }
        
    if($('#category_select_search').val()){
     get['category_select_add']=$('#category_select_search').val();
            if((get['category_select_add']==1)||(get['category_select_add']==3)){
                if($('#category_select_search').val() ){
                 get['category_select_add']=$('#category_select_search').val();  
                 if($('#tip_select_serch').val()){
                   get['tip_select_add']=$('#tip_select_serch').val();   
                 }
                }
            }else if(get['category_select_add']==11){
                if($('form#search select[name="uslugi_select_add"]').val()){
                  get['uslugi_select_add']=$('form#search select[name="uslugi_select_add"]').val(); 
                }
            }else if(get['category_select_add']==14){
                 if($('form#search select[name="tovari_select_add"]').val()){
                  get['tovari_select_add']=$('form#search select[name="tovari_select_add"]').val(); 
                }
            }else if(get['category_select_add']==16){
                
            }
        }
    for (var key in get) {
    var val = get [key];
    url+=key+'='+val+'&';
    //console.log(key+' = '+val);
                         }   
url=url.substring(0, url.length-1);
 //console.log(url);
  window.location.href=url;
     });   
         
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
   
 
   $('#region_select_search').on('change', function(){
      var regionValue=$('#region_select_search').val(); 
      if(regionValue!=0){
      var str='/ajax/sity_search/'+regionValue;
       $.ajax({
          url: str,
          success: function(data) {
             $('#searc_site').remove(); 
            $('div#searc_region').after('<div id="searc_site" class="col-md-3">'+data+'</div>');
            Selekt_poisk();
          }
        });}
      
   });
   
   $('#category_select_search').on('change', function(){ 
     var categoryValue=$('#category_select_search').val();
     if((categoryValue==1)||(categoryValue==3)){
             var str='/ajax/tip_search/tip';
          $.ajax({
          url: str,
          success: function(data) {
            $('#searc_tip').remove(); 
            var dom_site=$('div#searc_site');
            if(dom_site.length){
                dom_site.after('<div id="searc_tip" class="col-md-3">'+data+'</div>');
            } else{
            $('div#searc_category').after('<div id="searc_tip" class="col-md-3">'+data+'</div>');
                   }
          Selekt_poisk();
                                  }  
   });}else if(categoryValue==11){
   var str='/ajax/tip_search/uslugi_select';
          $.ajax({
          url: str,
          success: function(data) {
        if(data){
          $('#searc_tip').remove(); 
          $('div#searc_category').after('<div id="searc_tip" class="col-md-3">'+data+'</div>');
          Selekt_poisk();
          }}
                });}else if(categoryValue==14){
        var str='/ajax/tip_search/tovari_select';
          $.ajax({
          url: str,
          success: function(data) {
        if(data){
          $('#searc_tip').remove(); 
          $('div#searc_category').after('<div id="searc_tip" class="col-md-3">'+data+'</div>');
          Selekt_poisk();
          }}
                });
   }else{$('#searc_tip').remove();}
    
   
        }); 
        
// Выбираем для удаления 
  $('span.post-delete').on('click',function(){ 
  var postDelSize = $('form#delete-posts input[name="delet[]"]').length;
  var postId=$(this).data('postId');

   post[postId]=$('div.post'+postId);
  var title=post[postId].find('.title_zag');
   post[postId].css('padding-bottom','8px');
  $('div.post'+postId).find('.row').css('display','none');
  $('div.post'+postId).append('<div class="row row-2"><div class="delete-post col-md-9">'+title.html()+'</div><div class="col-md-1"> <button type="button" value="'+postId+'" class="button-delet-post btn btn-default">Отмена</button></div></div></div>');
  var panelAnnoucement=$('#panel-annoucement');
  panelAnnoucement.css('display','block');
  panelAnnoucement.find('span#post-del-size').text(postDelSize+1);
  panelAnnoucement.find('form#delete-posts').append('<input name="delet[]" type="hidden" value="'+postId+'">');
  
});

  $('.post_lk').on('click','.button-delet-post', function(){
      var valuePostId=$(this).val();  
      var panelAnnoucement=$('#panel-annoucement');
      var postDelSize = $('form#delete-posts input[name="delet[]"').length;
      postDelSize--;
   //   console.log(postDelSize);  
          
    $('form#delete-posts input[value="'+valuePostId+'"]').remove();   
    delete post[valuePostId];
    $('div.post'+valuePostId).find('.row-1').css('display','block'); 
    $('div.post'+valuePostId).find('.row-2').remove();
 
   if(postDelSize<=0){  
   panelAnnoucement.css('display','none');
   panelAnnoucement.find('span#post-del-size').text(postDelSize);
   postDelSize=0;
   }else{
       panelAnnoucement.find('span#post-del-size').text(postDelSize);
   }
    });

$('button.allNone').on('click',function(){
    $('form#delete-posts input[name="delet[]"]').remove();
    $('div.post_lk').find('.row-1').css('display','block');
    $('div.post_lk').find('.row-2').remove();
   panelAnnoucement.css('display','none');
   panelAnnoucement.find('span#post-del-size').text(postDelSize);
   postDelSize=0;
});

 $('button.allDelet').on('click', function(){ 
var myModal = $('#myModal');  
    myModal.find('h4').text('Удалить данные объявления?');
    myModal.find('div.modal-body').html('');
    myModal.find('button.btn-primary').text("Удалить все выбранные");
    myModal.find('button.btn-default').text("Отменить");    
    var deletePosts='';
    for (var post_S in post) {   
    deletePosts+='<div class="row row-'+post_S+'"><div class="col-md-11 col-sm-11">'+post[post_S].find('.title_zag a').text()+'</div><div class="col-md-1 col-sm-1"><span class="glyphicon glyphicon-remove del-none color-red" data-post-id="'+post_S+'" title="Отменить"></span></div></div>';    
     }
    myModal.find('div.modal-body').html(deletePosts);
    myModal.modal('show');
    
});
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
       
    //console.log(delNoneId);
});    
      
$("button#button_post_delet").on("click",function(){
    var myModal = $('#myModal');  
    myModal.find('h4').text('Удалить данные объявления?');
    myModal.find('button.btn-primary').attr("class","btn-primary btn post-delet").text("Удалить данное объявления?");
    myModal.find('button.btn-default').attr("class","btn-default btn post-NoDelet").text("Отменить"); 
    myModal.find('div.modal-body').html('<div class="row"><div class="col-md-11 col-sm-11">'+$("span.titlePost").text()+'</div></div>');
    myModal.modal('show');
});      
  
$("button.post-delet").on("click",function(){
    $("form#post-delete").submit();
});  
      
   });
   

   
   
$(window).load(function (){
        var divImg=$('.img'); 
        var max=$(divImg[0]).innerHeight() 
       divImg.each(function(index,element){
           if(max<$(element).innerHeight()){
              max=$(element).innerHeight(); 
           }
        });
        divImg.height(max);
        
        
}); 

