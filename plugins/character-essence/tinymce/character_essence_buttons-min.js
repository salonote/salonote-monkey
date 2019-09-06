// JavaScript Document
tinymce.create("tinymce.plugins.character_essence",{init:function(p,e){var a=this;a.url=e,
//replace shortcode before editor content set
//エディターコンテンツが読み込まれる前に　ショートコードの置き換え
p.onBeforeSetContent.add(function(e,t){t.content=a._do_spot(t.content)}),
//replace the image back to shortcode on save
//保存時にはショートコードそのものを保存する
p.onPostProcess.add(function(e,t){t.get&&(t.content=a._get_spot(t.content))}),
//キャラクターを追加 =============================================
p.addButton("character_essence",{title:"キャラクターを追加",label:"キャラクターを追加",icon:"icon dashicons-format-status",onclick:function(){
//JSONのURLを格納する
var e,t=(location.hostname+""+location.pathname).replace("wp-admin/post.php","wp-json/wp/v2/es_character");
//var json_url = current_url.replace('wp-admin/post.php','wp-content/themes/salonote-essence/lib/salonote-helper/plugins/character-essence/statics/json/character.json');
$url="//"+t,$.getJSON($url,function(e){var n=[];$.each(e,function(e,t){var a={};a.text=t.title.rendered,a.value=String(t.id),n.push(a)}),
//console.log(character_posts);
p.windowManager.open({title:"キャラクター",body:[{type:"listbox",name:"characterid",label:"キャラクター",values:n},{type:"listbox",name:"type",label:"表情",values:[{text:"ノーマル",value:"normal"},{text:"スマイル",value:"smile"},{text:"楽しい",value:"happy"},{text:"嬉しい",value:"pleased"},{text:"決め台詞",value:"seriously"},{text:"合っている",value:"correct"},{text:"間違っている",value:"mistaken"},{text:"わかった",value:"understand"},{text:"わからない",value:"question"},{text:"お礼を言う",value:"thanks"},{text:"お礼を言う",value:"thanks"},{text:"怒る",value:"angry"},{text:"おどろく",value:"surprised"},{text:"あせる",value:"panicked"},{text:"呆れる",value:"speechless"},{text:"困る",value:"upset"},{text:"悲しい",value:"sad"},{text:"苦しい",value:"trying"},{text:"あやまる",value:"sorry"},{text:"寝る",value:"sleep"}]},{type:"listbox",name:"position",label:"キャラクターの位置",values:[{text:"左",value:"left"},{text:"右",value:"right"}]},{type:"checkbox",name:"reverse",label:"反転",classes:"true"},{type:"textbox",name:"content",label:"会話内容",multiline:!0,minWidth:600,minHeight:300}],onsubmit:function(e){p.focus();
//console.log(e.data);
var t=e.data.characterid;if(null!=t){
/*
									var character_code = '[character id='+character_id;
									if( e.data.type ){
										 character_code += ' type='+e.data.type;
									}
									if( e.data.reverse ){
										 character_code += ' reverse=1';
									}
									char_short_code += ']';
									*/
var a=new Date,n,r=(location.hostname+""+location.pathname).replace("wp-admin/post.php","wp-content/themes/salonote-essence/lib/salonote-helper/plugins/character-essence/statics/json/character.json?timestamp="+a.getTime());$url="//"+r;
//console.log($url);
var c="",s=e.data.type;$.ajax({url:$url,dataType:"json",async:!1,
//data: {'data': 'data' },
success:function(e){c=e}}),console.log([c]);var i=c[t].images[s],o=e.data.content.replace(/\r\n/g,"<br />");o=(o=o.replace(/(\n|\r)/g,"<br />")).replace(/^(\n|\r)/g,"");var l='<div id="char_id_'+t+'" class="character_essence char_type_'+e.data.type+" char_reverse_"+e.data.reverse+" char_position_"+e.data.position+'"><img class="wp-image-'+t+'" src="'+i+'" /><div class="char_content"><p>'+o+"</p></div></div><p>&nbsp;</p>";p.selection.setContent(l)}}//onsubmit
})}).done(function(e){}).fail(function(e){}).always(function(e){})}// onclick
})},
// Replace view tags with their text.
// ショートコードの開始タグの置き換えコールバック
_do_spot:function(e){function t(e,t,a,n,r,c,s){
//console.log(match);
//IDがある場合 ===========================================
if(-1==t.indexOf())var i=s.replace(/\r\n/g,"<br />"),o='<div id="char_id_'+t+'" class="character_essence char_type_'+a+" char_reverse_"+n+" char_position_"+r+'"><img src="'+c+'" /><div class="char_content"><p>'+(i=i.replace(/(\n\n|\r\r)/g,"<br />"))+"</p></div></div>";
//書き出し ===========================================
return String(o)}if(!e)return e;
//正規表現パターン
var a,n=new RegExp('\\[character id=(.+?) type=(.+?) reverse=(.+?) position=(.+?) src="(.+?)"](.+?)\\[\\/character]',"gs");return e.replace(n,t)},
/*
	_do_spot_original : function(content) {
		return content.replace(/\[section([^\]]*)\]/g, function(a,b){
			return '<img src="/wp-content/plugins/tinymce-graphical-shortcode/tinymce-plugin/icitspots/images/t.gif" class="wpSpot mceItem" title="icitspot'+tinymce.DOM.encode(b)+'" />';
		});
	},
	*/
_get_spot:function(e){function t(e,t,a,n,r,c,s){
//IDがある場合 ===========================================
if(-1==t.indexOf())var i=s.replace(/\r\n/g,"<br />"),o="[character id="+t+" type="+a+" reverse="+n+" position="+r+' src="'+c+'"]'+(i=i.replace(/(\n\n|\r\r)/g,"<br />"))+"[/character]";
//書き出し ===========================================
return String(o)}if(!e)return e;
//正規表現パターン
var a,n=new RegExp('<div id="char_id_(.+?)" class="character_essence char_type_(.+?) char_reverse_(.+?) char_position_(.+?)"><img src="(.+?)" /><div class="char_content"><p>(.+?)</p></div></div>',"gs");return e.replace(n,t)},
//information =============================================
getInfo:function(){return{longname:"tinymce.plugins.character_essence",author:"HealingSolutions",authorurl:"https://www.healing-solutions.jp/",infourl:"https://www.healing-solutions.jp/",version:"1.0"}}}),tinymce.PluginManager.add("character_essence",tinymce.plugins.character_essence);