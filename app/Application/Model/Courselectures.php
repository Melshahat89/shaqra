<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;

 class Courselectures extends Model
{


    const Video_type_Videocipher = 0;
    const Video_type_Vimeo = 1;

   public $table = "courselectures";
   public function progress(){
		return $this->hasMany(Progress::class, "courselectures_id");
		}
   public function lectures3d(){
  return $this->hasMany(Lectures3d::class, "courselectures_id");
  }
   public function lecturequestions(){
  return $this->hasMany(Lecturequestions::class, "courselectures_id");
  }
     public function lecturequestionsApproved(){
   return $this->hasMany(Lecturequestions::class, "courselectures_id")->where('approve',1);
   }
   public function coursesections(){
  return $this->belongsTo(Coursesections::class, "coursesections_id");
  }
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
   public function courses(){
  return $this->belongsTo(Courses::class, "courses_id");
  }
  public function coursesnotes(){
   return $this->hasMany(Coursesnotes::class, 'lecture_id');
}
     protected $fillable = [
      'coursesections_id',
      'user_id',
      'courses_id',
        'title','slug','description','video_file','length','is_free','position',
        'vid_playbackInfo','vdocipher_id','start_date','webinar_link', 'event_id','video_type'
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
  }
