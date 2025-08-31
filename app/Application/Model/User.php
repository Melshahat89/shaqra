<?php
namespace App\Application\Model;
use App\Mail\Otp;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Kreait\Firebase\Database;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
class User extends Authenticatable
{
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    const TYPE_ADMIN = 1;
    const TYPE_USER = 2;
    const TYPE_INSTRUCTOR = 3;
    const TYPE_INDIVIDUAL = 4;
    const TYPE_INSTITUTION = 5;
    const TYPE_BUSINESS = 6;
    const TYPE_EVENTS = 7;
    const TYPE_INSTITUTION_ADMIN = 8;
    const TYPE_ACCOUNTANT = 9;
    const TYPE_MARKETING = 10;
    const TYPE_PR = 11;
    const TYPE_SEO = 12;
    const TYPE_CUSTOMER_SERVICE = 13;
    const TYPE_HR = 14;
    const TYPE_SALES = 15;
    const TYPE_SALES_MANAGER = 16;
    const TYPE_CONSULTANT = 17;
    const TYPE_GROUP_ADMIN = 18;
    public $table = "users";
    public function futurex(){
        return $this->hasOne(Futurex::class, "user_id");
    }
    public function sectionquizstudentanswer(){
        return $this->hasMany(Sectionquizstudentanswer::class, "user_id");
    }
    public function sectionquizstudentstatus(){
        return $this->hasMany(Sectionquizstudentstatus::class, "user_id");
    }
    public function sectionquiz(){
        return $this->hasMany(Sectionquiz::class, "user_id");
    }
    public function spin(){
        return $this->hasMany(Spin::class, "user_id");
    }
    public function subscriptionuser(){
        return $this->hasMany(Subscriptionuser::class, "user_id");
    }
    public function coursesnotes(){
        return $this->hasMany(Coursesnotes::class, 'user_id');
    }
    public function progress()
    {
        return $this->hasMany(Progress::class, "user_id");
    }
    public function ticketsreplay()
    {
        return $this->hasMany(Ticketsreplay::class, "user_id");
    }
    public function tickets()
    {
        return $this->hasMany(Tickets::class, "user_id");
    }
    public function eventstickets()
    {
        return $this->hasMany(Eventstickets::class, "user_id");
    }
    public function eventsenrollment()
    {
        return $this->hasMany(Eventsenrollment::class, "user_id");
    }
    public function talklikes()
    {
        return $this->hasMany(Talklikes::class, "user_id");
    }
    public function masterrequest()
    {
        return $this->hasMany(Masterrequest::class, "user_id");
    }
    public function eventsreviews()
    {
        return $this->hasMany(Eventsreviews::class, "user_id");
    }
    public function eventsdata()
    {
        return $this->hasOne(Eventsdata::class, "user_id");
    }
    public function affiliate()
    {
        return $this->belongsTo(User::class, "affiliate_id");
    }
    public function lastLecture()
    {
        return $this->belongsTo(Courselectures::class, "last_lecture_id");
    }
    public function businessgroupsusersuser()
    {
        return $this->hasMany(Businessgroupsusers::class, "user_id");
    }
    public function businessgroupsusers()
    {
        return $this->belongsToMany(Businessgroupsusers::class, "businessgroups","user_id","user_id");
    }
    public function businessdata()
    {
        return $this->hasOne(Businessdata::class, "user_id");
    }
    public function businessGroupAdmin()
    {
        return $this->hasOne(Businessgroups::class, "user_id");
    }
    public function businessusersdata()
    {
        return $this->belongsTo(Businessdata::class, "businessdata_id");
    }
    public function instructorCourses()
    {
        return $this->hasMany(Courses::class, "instructor_id");
    }
    public function consultantConsultations(){
        return $this->hasMany(Consultations::class, "consultant_id");
    }
    public function getInstructorCoursesWithRelationsAttribute(){
        $courses = Courses::where('instructor_id', $this->id)->where('soon', 0)->where('type', '!=', Courses::TYPE_WEBINAR)->get();
        foreach($courses as $course){
            $courses = $courses->merge($course->courseincludedinothercourses);
        }
        $courses = $courses->filter(function($item){
            if($item->published == 1){
                return $item;
            }
        });
        return $courses;
    }
    public function getConsultantConsultationsAttribute(){
        $consultations = Consultations::where('consultant_id', $this->id)->where('published', 1)->get();
        return $consultations;
    }
    public function instructorTalks()
    {
        return $this->hasMany(Talks::class, "instructor_id");
    }
    public function quizstudentsstatus()
    {
        return $this->hasMany(Quizstudentsstatus::class, "user_id");
    }
    public function quizstudentsanswers()
    {
        return $this->hasMany(Quizstudentsanswers::class, "user_id");
    }
    public function searchkeys()
    {
        return $this->hasMany(Searchkeys::class, "user_id");
    }
    public function transactions()
    {
        return $this->hasMany(Transactions::class, "user_id");
    }
    public function transactionsInstructorAll()
    {
        return $this->hasMany(Transactions::class, "user_id");
    }
    public function transactionsConsultantAll(){
        return $this->hasMany(Transactions::class, "user_id");
    }
    public function transactionsInstructor()
    {
        return $this->hasMany(Transactions::class, "user_id")->where('type', Transactions::INSTRUCTOR);
    }
    public function transactionsAffiliate1()
    {
        return $this->hasMany(Transactions::class, "user_id")->where('type', Transactions::AFFILIATE1);
    }
    public function transactionsAffiliate2()
    {
        return $this->hasMany(Transactions::class, "user_id")->where('type', Transactions::AFFILIATE2);
    }
    public function transactionsAffiliate3()
    {
        return $this->hasMany(Transactions::class, "user_id")->where('type', Transactions::AFFILIATE3);
    }
    public function transactionsAffiliate4()
    {
        return $this->hasMany(Transactions::class, "user_id")->where('type', Transactions::AFFILIATE4);
    }
    public function payments()
    {
        return $this->hasMany(Payments::class, "user_id");
    }
    public function promotionactive()
    {
        return $this->hasMany(Promotionactive::class, "user_id");
    }
    public function promotionusers()
    {
        return $this->hasMany(Promotionusers::class, "user_id");
    }
    public function ordersposition()
    {
        return $this->hasMany(Ordersposition::class, "user_id");
    }
    public function orders()
    {
        return $this->hasMany(Orders::class, "user_id");
    }
    public function talksreviews()
    {
        return $this->hasMany(Talksreviews::class, "user_id");
    }
    public function lecturequestionsanswers()
    {
        return $this->hasMany(Lecturequestionsanswers::class, "user_id");
    }
    public function lecturequestions()
    {
        return $this->hasMany(Lecturequestions::class, "user_id");
    }
    public function courseenrollment()
    {
        return $this->hasMany(Courseenrollment::class, "user_id");
    }
    public function courselectures()
    {
        return $this->hasMany(Courselectures::class, "user_id");
    }
    public function coursereviews()
    {
        return $this->hasMany(Coursereviews::class, "user_id");
    }
    public function coursewishlist()
    {
        return $this->hasMany(Coursewishlist::class, "user_id");
    }
    public function partnership()
    {
        return $this->hasOne(Partnership::class, "user_id");
    }
    public function passedexams()
    {
        return $this->hasMany(Quizstudentsstatus::class, "user_id")->where('passed', 1);
    }
    public function categories2()
    {
        return $this->belongsTo(Categories::class, "categories");
    }
    public function getWeeklyTargetAttribute(){
        return Usertargets::where('user_id', Auth::user()->id)->where('type', Usertargets::TYPE_WEEKLY)->first();
    }
    public function logs(){
        return $this->hasMany(Log::class, 'user_id');
    }
    protected $fillable = [
        'name', 'email', 'password', 'group_id', 'api_token',
        'mobile', 'verified', 'activated', 'activation_code', 'activation_date', 'banned', 'hidden', 'first_name', 'last_name',
        'gender', 'birthdate', 'is_affiliate', 'affiliate_id', 'title', 'about', 'additional_info', 'description',
        'image', 'cover', 'instructorname',
        'slug', 'specialization', 'sub_specialization', 'other_specialization', 'businessdata_id', 'facebook_identifier', 'sort', 'categories', 'otp', 'country_id', 'last_ip',
        'last_lecture_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function permission()
    {
        return $this->belongsToMany('App\Application\Model\Permission', 'permission_user');
    }
    public function role()
    {
        return $this->belongsToMany('App\Application\Model\Role', 'role_user');
    }
    public function usersCoursesEnrollments()
    {
        return $this->belongsToMany(Courses::class, 'courseenrollment', 'user_id', 'courses_id');
    }
    public function usersBusinessCoursesEnrollments()
    {
        return $this->belongsToMany(Courses::class, 'courseenrollment', 'user_id', 'courses_id')
            ->where('businessdata_id',$this->businessdata_id);
    }
    public function group()
    {
        return $this->belongsTo('App\Application\Model\Group');
    }
    public function getFullnameLangAttribute()
    {
        return $this->firstname_lang . ' ' . $this->lastname_lang;
    }
    public function getFullnameArAttribute()
    {
        return $this->firstname_ar . ' ' . $this->lastname_ar;
    }
    public function getFullnameEnAttribute()
    {
        return $this->firstname_en . ' ' . $this->lastname_en;
    }
    public function getTitleLangAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->{getCurrentLang()} : $this->title;
    }
    public function getTitleEnAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->en : $this->title;
    }
    public function getTitleArAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->ar : $this->title;
    }
    public function getDescriptionLangAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ? json_decode($this->description)->{getCurrentLang()} : $this->description;
    }
    public function getDescriptionEnAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ? json_decode($this->description)->en : $this->description;
    }
    public function getDescriptionArAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ? json_decode($this->description)->ar : $this->description;
    }
    public function getAboutLangAttribute()
    {
        return is_json($this->about) && is_object(json_decode($this->about)) ? json_decode($this->about)->{getCurrentLang()} : $this->about;
    }
    public function getAboutEnAttribute()
    {
        return is_json($this->about) && is_object(json_decode($this->about)) ? json_decode($this->about)->en : $this->about;
    }
    public function getAboutArAttribute()
    {
        return is_json($this->about) && is_object(json_decode($this->about)) ? json_decode($this->about)->ar : $this->about;
    }
    public function getInstructornameLangAttribute()
    {
        return is_json($this->instructorname) && is_object(json_decode($this->instructorname)) ? json_decode($this->instructorname)->{getCurrentLang()} : $this->instructorname;
    }
    public function getInstructornameEnAttribute()
    {
        return is_json($this->instructorname) && is_object(json_decode($this->instructorname)) ? json_decode($this->instructorname)->en : $this->instructorname;
    }
    public function getInstructornameArAttribute()
    {
        return is_json($this->instructorname) && is_object(json_decode($this->instructorname)) ? json_decode($this->instructorname)->ar : $this->instructorname;
    }
    public function getAdditional_infoLangAttribute()
    {
        return is_json($this->additional_info) && is_object(json_decode($this->additional_info)) ? json_decode($this->additional_info)->{getCurrentLang()} : $this->additional_info;
    }
    public function getAdditional_infoEnAttribute()
    {
        return is_json($this->additional_info) && is_object(json_decode($this->additional_info)) ? json_decode($this->additional_info)->en : $this->additional_info;
    }
    public function getAdditional_infoArAttribute()
    {
        return is_json($this->additional_info) && is_object(json_decode($this->additional_info)) ? json_decode($this->additional_info)->ar : $this->additional_info;
    }
    public function getFirstnameLangAttribute()
    {
        return is_json($this->first_name) && is_object(json_decode($this->first_name)) ? json_decode($this->first_name)->{getCurrentLang()} : $this->first_name;
    }
    public function getFirstnameEnAttribute()
    {
        return is_json($this->first_name) && is_object(json_decode($this->first_name)) ? json_decode($this->first_name)->en : $this->first_name;
    }
    public function getFirstnameArAttribute()
    {
        return is_json($this->first_name) && is_object(json_decode($this->first_name)) ? json_decode($this->first_name)->ar : $this->first_name;
    }
    public function getLastnameLangAttribute()
    {
        return is_json($this->last_name) && is_object(json_decode($this->last_name)) ? json_decode($this->last_name)->{getCurrentLang()} : $this->last_name;
    }
    public function getLastnameEnAttribute()
    {
        return is_json($this->last_name) && is_object(json_decode($this->last_name)) ? json_decode($this->last_name)->en : $this->last_name;
    }
    public function getLastnameArAttribute()
    {
        return is_json($this->last_name) && is_object(json_decode($this->last_name)) ? json_decode($this->last_name)->ar : $this->last_name;
    }
    public function getInstructorRatingAttribute()
    {
        $Sum = $this->instructorCourses->sum('CourseSumRating');
        $Count = $this->instructorCourses->sum('CourseCountRating');
        return $Count ? round(($Sum / $Count), 1) : 0;
    }
    public function getConsultantRatingAttribute()
    {
        $Sum = $this->consultantConsultations->sum('ConsultationSumRating');
        $Count = $this->consultantConsultations->sum('ConsultationCountRating');
        return $Count ? round(($Sum / $Count), 1) : 0;
    }
    public function getInstructorLecturesAttribute()
    {
        return $this->instructorCourses->sum('CourseCountLectures');
    }
    public function getEnrolledCountStudentsAttribute()
    {
        return $this->instructorCourses->sum('CourseCountStudents');
    }
    public function getConsultationsCountStudentsAttribute(){
        return $this->consultantConsultations->sum('ConsultationCountStudents');
    }
    public function getinstructorCoursesViewsAttribute()
    {
        return $this->InstructorCoursesWithRelations->sum('visits');
    }
    public function getConsultantConsultationsViewsAttribute()
    {
        return $this->ConsultantConsultations->sum('visits');
    }
    static function getById($id = null)
    {
        $user_id = ($id == null) ? auth()->user()->id : $id;
        $factory = (new Factory)
            ->withServiceAccount(__DIR__ . '/../../../public/igts-17eb7-firebase-adminsdk-xf52q-4331e0c95c.json')
            ->withDatabaseUri('https://igts-17eb7.firebaseio.com');
        $database = $factory->createDatabase();
        $reference = $database->getReference('notifications/' . $user_id);
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        if ($value) {
            return $value;
        } else {
            return 'No Data Found';
        }
    }
    static function addNotification($users_arr, $title, $body, $link)
    {
        //  $factory = (new Factory)
        // ->withServiceAccount(__DIR__.'/../../../public/igts-17eb7-firebase-adminsdk-xf52q-4331e0c95c.json')
        // ->withDatabaseUri('https://igts-17eb7.firebaseio.com');
        //  $database = $factory->createDatabase();
        //  foreach ($users_arr as $user){
        //     $newPost = $database
        //         ->getReference('notifications/'.$user)
        //         ->push([
        //             'user_id' => $user,
        //             'title' => $title,
        //             'body' => $body,
        //             'is_read' => 0,
        //             'link' => $link,
        //             'timestamp' =>  time()
        //         ]);
        // }
        //   if ($newPost){
        //     return $newPost;
        // }else{
        //     return  'No Data Found';
        // }
    }
    static function readNotification($user_id, $notification_key)
    {
        $update = ['is_read' => 1];
        $factory = (new Factory)
            ->withServiceAccount(__DIR__ . '/../../../public/igts-17eb7-firebase-adminsdk-xf52q-4331e0c95c.json')
            ->withDatabaseUri('https://igts-17eb7.firebaseio.com');
        $database = $factory->createDatabase();
        $database->getReference('notifications/' . $user_id . '/' . $notification_key) // this is the root reference
        ->update($update);
        if ($database) {
            return $database;
        } else {
            return 'No Data Found';
        }
    }
    public function getOtpMailAttribute()
    {
        $user = User::findOrFail(Auth::user()->id);
        $otp = $this->generateRandomString(6);
        // update User
        $user->otp = $otp;
        $user->save();
        Mail::to($user->email)->send(new Otp($user, $otp));
        // alert()->success(trans('website.We sent you an Otp code. Check your email and click on the link to verify.'), trans('website.Success'));
        return true;
    }
    function generateRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function certificates()
    {
        return $this->hasMany(Quizstudentsstatus::class, 'user_id')->where('status', 4)->where('passed', 1)->whereNotNull('certificate');
    }
    public function getSubscriptionAttribute()
    {
        return $this->checkSubscriptionActive($this->id);
    }
    public function checkSubscriptionActive($userID){
        $now = Carbon::now()->toDateString();
        return Subscriptionuser::where('user_id',$userID)
            ->where('is_active',1)
            ->where(function ($query) {
                $query->where('b_type', Orders::TYPE_B2C)
                    ->orWhere('b_type', 1);
            })
//             ->where('b_type',Orders::TYPE_B2C)
            ->where(function($query) use ($now){
                $query->where('end_date', '>=', date($now))
                    ->where('start_date', '<=', date($now));
            })
            ->latest()->first();
    }
}
