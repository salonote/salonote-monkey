<?php




function replace_headline_text_content( $content ){
	global $theme_opt;

	if( !empty($theme_opt['base']['headline_1']) ){
		$content = str_replace('<h1>','<h1 class="'.$theme_opt['base']['headline_1'].'">',$content);
	}
	if( !empty($theme_opt['base']['headline_2']) ){	
		$content = str_replace('<h2>','<h2 class="'.$theme_opt['base']['headline_2'].'">',$content);
	}
	if( !empty($theme_opt['base']['headline_3']) ){	
		$content = str_replace('<h3>','<h3 class="'.$theme_opt['base']['headline_3'].'">',$content);
	}
	if( !empty($theme_opt['base']['headline_4']) ){	
		$content = str_replace('<h4>','<h4 class="'.$theme_opt['base']['headline_4'].'">',$content);
	}
	
	return $content;
}




function markdown_char($content){

	if(strpos($content,'[char') === false) return $content;
	
	$default_char = [];
	
	
	//念のためキャラクター情報を取得しておく
	$args = array(
		'post_type' 			=> 'es_character',
		'posts_per_page' 	=> 2,
	);
	$char_post = get_posts($args);
	if( !empty($char_post) ){
		$default_char[0] = get_post_meta( $char_post[0]->ID, 'es_character_upload_images', true );
		$default_char[1] = get_post_meta( $char_post[1]->ID, 'es_character_upload_images', true );
	}else{
		$fields_arr = array(
			'normal' 		 => 'ノーマル',
			'smile'  		 => 'スマイル',
			'happy'  		 => '楽しい',
			'pleased'  	 => '嬉しい',
			'seriously'  => '決め台詞',
			'correct'  	 => '合っている',
			'mistaken'   => '間違っている',
			'understand' => 'わかった',
			'question'   => 'わからない',
			'thanks'  	 => 'お礼を言う',
			'angry'  		 => '怒る',
			'surprised'  => 'おどろく',
			'panicked'   => 'あせる',
			'speechless' => '呆れる',
			'upset' 		 => '困る',
			'sad'		 		 => '悲しい',
			'trying'		 => '苦しい',
			'sorry' 		 => 'あやまる',
			'sleep'  		 => '寝る',
		);
		foreach( $fields_arr as $key => $value ){
			$default_char[0][$key] = CHARACTER_ESSENCE_PLUGIN_URI . '/statics/images/female/female_' . $key .'.jpg';
		}
		foreach( $fields_arr as $key => $value ){
			$default_char[1][$key] = CHARACTER_ESSENCE_PLUGIN_URI . '/statics/images/male/male_' . $key .'.jpg';
		}
	}
	
	
	//コンテンツ生成開始
	$char_content = '';

	$match_arr = preg_match_all('/\[cha(.+?)?\](.+?)\[\/char\]/s',$content,$match_txt, PREG_PATTERN_ORDER );
	//echo '<pre>match_txt'; print_r($match_txt); echo '</pre>';


	$check_char = '';
	$position = '';
	$char_content .= '';

	foreach( $match_txt[0] as $match_key => $match_content ){
		
		$check_key = $match_key-1;

		$set_content = $match_txt[1][$match_key];
		if( strpos($set_content,' ') !== false ){
			$char_set = explode(' ',$set_content);		
		}else{
			$char_set = [];
		}
		
		$char_set_arr = [];
		
		//echo '<pre>char_set'; print_r($char_set); echo '</pre>';

		foreach( $char_set as $set_key => $set_value ){
			$set_value_item = explode('=',$set_value);
			if( !empty($set_value_item[1]) && strpos($set_value_item[0],'[') === false  ){
				$char_set_arr[$match_key][$set_value_item[0]] = $set_value_item[1];
			}
		}

		//echo '<pre>char_set_arr'; print_r($char_set_arr); echo '</pre>';

		$char_content .= '[character';
		
		if( !empty($char_set_arr[$match_key]['id'])){
			$char_content .= ' id='.$char_set_arr[$match_key]['id'];
		}else{
			$char_content .= ' id=0';
		}
		
		if( !empty($char_set_arr[$match_key]['t'])){
			$char_content .= ' type='.$char_set_arr[$match_key]['t'];
		}else{
			$char_content .= ' type=normal';
		}

		if( !empty($char_set_arr[$match_key]['r']) && strpos($char_set_arr[$match_key]['r'],'t') !== false){
			$char_content .= ' reverse=true';
		}else{
			$char_content .= ' reverse=false';
		}


		if( !empty($char_set_arr[$match_key]['p']) && strpos($char_set_arr[$match_key]['p'],'r') !== false){
			$char_content .= ' position=right';
			$position = 'right';
		}else{
			
			

			
			if( $check_key >= 0 && $position === 'left'){
				$char_content .= ' position=right';
				$position = 'right';
			}else{
				$char_content .= ' position=left';
				$position = 'left';
			}
		}
		
		if( !empty($char_set_arr[$match_key]['c']) && strpos($char_set_arr[$match_key]['c'],'t') !== false){
			$char_content .= ' circled=true';
		}else{
			$char_content .= ' circled=false';
		}

		

		$id 	= !empty($char_set_arr[$match_key]['id']) ? $char_set_arr[$match_key]['id'] : null ;
		$type = !empty($char_set_arr[$match_key]['t']) ? $char_set_arr[$match_key]['t'] : 'normal' ;
		
		if( !empty($char_set_arr[$match_key]['src']) ){
			$src = $char_set_arr[$match_key]['src'];
		}else{
			if( $check_char === 'female' ){
				$src = $default_char[1][$type];
				$check_char = 'male';
			}else{
				$src = $default_char[0][$type];
				$check_char = 'female';
			}
			
		}
		
		$es_character_upload_images = get_post_meta( $id, 'es_character_upload_images', true );


		if( !empty( $es_character_upload_images ) ){
			$char_content .= ' src="'.$es_character_upload_images[$type].'"';
		}elseif( !empty( $src ) ){
			$char_content .= ' src="'.$src.'"';
		}
		
		$char_content .= ']';
		$char_content .= str_replace('[char]','',$match_txt[2][$match_key]);
		$char_content .= '[/character]';


	}
	

	

	return $char_content;
	
}





?>