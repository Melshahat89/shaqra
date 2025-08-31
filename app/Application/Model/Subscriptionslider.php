<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Subscriptionslider extends Model
{

  public $table = "subscriptionslider";


   protected $fillable = [
        'title','description','image','status','cta_text','cta_link'
   ];

	public function getTitleLangAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->{getCurrentLang()}  : $this->title;
	}
	public function getTitleEnAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->en  : $this->title;
	}
	public function getTitleArAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->ar  : $this->title;
	}
	public function getDescriptionLangAttribute(){
		return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->{getCurrentLang()}  : $this->description;
	}
	public function getDescriptionEnAttribute(){
		return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->en  : $this->description;
	}
	public function getDescriptionArAttribute(){
		return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->ar  : $this->description;
	}
	public function getCta_textLangAttribute(){
		return is_json($this->cta_text) && is_object(json_decode($this->cta_text)) ?  json_decode($this->cta_text)->{getCurrentLang()}  : $this->cta_text;
	}
	public function getCta_textEnAttribute(){
		return is_json($this->cta_text) && is_object(json_decode($this->cta_text)) ?  json_decode($this->cta_text)->en  : $this->cta_text;
	}
	public function getCta_textArAttribute(){
		return is_json($this->cta_text) && is_object(json_decode($this->cta_text)) ?  json_decode($this->cta_text)->ar  : $this->cta_text;
	}

}
