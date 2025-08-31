<?php

namespace App\Application\Controllers\Admin;

use App\Application\Model\Courses;
use App\Application\Model\FutureXIntegration;
use App\Application\Requests\Admin\Futurex\AddRequestFuturex;
use App\Application\Requests\Admin\Futurex\UpdateRequestFuturex;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\FuturexsDataTable;
use App\Application\Model\Futurex;
use Carbon\Carbon;
use Yajra\Datatables\Request;
use Alert;
use Illuminate\Support\Str;


class FuturexController extends AbstractController
{
    public function __construct(Futurex $model)
    {
        parent::__construct($model);
    }

    public function index(FuturexsDataTable $dataTable){
        return $dataTable->render('admin.futurex.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.futurex.edit' , $id);
    }

     public function store(AddRequestFuturex $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('admin/futurex');
     }


     public function update($id , UpdateRequestFuturex $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.futurex.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/futurex')->with('sucess' , 'Done Delete futurex From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'admin/futurex')->with('sucess' , 'Done Delete futurex From system');
    }




    public function serverupload($courseID ){

        $this->data['course'] = Courses::find($courseID);

//        if( $this->data['course']->futurexid){
//            dd($this->data['course']->futurexid);
//        }

        $future = new FutureXIntegration();

        $this->data['name'] = substr(strip_tags($this->data['course']['title']) ,0,500) ;

        $this->data['pacing'] = $this->data['course']['categories']['name'] ;
        $this->data['courseCategory'] = $future->getCourseCategory(); ;
        $this->data['estimatedLearningTime'] =  number_format((float) $this->data['course']->getCourseLengthAttribute() / 60 / 60, 2, '.', '');
        $this->data['courseLevel'] = $future->getCourseLevel();
        $this->data['cost'] = $this->data['course']['price_in_dollar'];
        $this->data['price'] = $this->data['course']['price_in_dollar'];
        $this->data['language'] = $future->getCourseLanguage();
        $this->data['skills'] = $future->getSkills();
        $this->data['translations'] = $this->data['language'];
        $this->data['instructors'] = [
            [
                'name' => $this->data['course']['instructor']['Fullname_en'],
                'title' => substr(strip_tags($this->data['course']['instructor']['title_en']), 0, 50),
                'photoUrl' => "https://igtsservice.com/uploads/files/medium/" . $this->data['course']['instructor']['image']
            ]
        ];
        $this->data['courseObjectives'] = [
             [
                 substr(strip_tags( $this->data['course']['willlearn_en']) ,0,50)
             ]
        ];

        $this->data['coursePlans'] = [];
        foreach ($this->data['course']['courselectures'] as $lecture) {
            $this->data['coursePlans'][] = [
                'title' => $lecture->title_en,
                'description' => ''
            ];
        };

        $this->data['tags'] =$future->getTags();
//        $future = new FutureXIntegration();
//        $future->enrollmentProgress($postdata);

        return view('admin.futurex.upload', $this->data);
    }



    public function serveruploadPost(\Illuminate\Http\Request $request , $courseID){
        $course = Courses::find($courseID);


        // إعداد coursePlans
        $coursePlans = [];
        foreach ($course['courselectures'] as $lecture) {
            $coursePlans[] = [
                'title' => $lecture->title_en,
                'description' => ''
            ];
        }

        //  tags
        $tagsArray = $request->tags;
        $tags = [];

        if($tagsArray){
            foreach ($tagsArray as $tag) {
                $tags[] = [
                    'id' => $tag
                ];
            }
        }


        // data
        $data = array(
            'courseId' => $course['futurexid'] ? $course["futurexid"] : $this->generateFuturexID(),
            'name' => substr(strip_tags($course['title_ar']), 0, 200),
            'summary' => substr(strip_tags($course['description_ar']), 0, 5000),
            'description' => substr(strip_tags($course['description_ar']), 0, 5000),
            'pacing' => $course['categories']['name_ar'],
            'courseCategory' => $request->courseCategory,
            'estimatedLearningTime' => number_format((float) $course->getCourseLengthAttribute() / 60 / 60, 2, '.', ''),
            'courseUrl' => "https://igtsservice.com/saml2/futurex/login?RelayState=https://igtsservice.com/enrollFuturex/" . $course['id'],
            'startsAt' => Carbon::parse($course['created_at'])->format('Y-m-d'),
            'endsAt' => "2025-12-06",
            'promoPhoto' => "https://igtsservice.com/uploads/files/medium/" . $course['promoPoster'],
            'courseLevel' => $request->courseLevel,
            'coursePricing' => null,
            'cost' => $course['price_in_dollar'],
            'price' => $course['price_in_dollar'],
            'language' => $request->language,
            'certificateType' => null,
            'prerequisites' => [
                [
                    'value' => ''
                ]
            ],
            'skills' => [
                [
                    'id' => $request->skills
                ]
            ],
            'translations' => [
                [
                    'id' => $request->translations
                ]
            ],
            'instructors' => [
                [
                    'name' => $course['instructor']['Fullname_ar'],
                    'title' => substr(strip_tags($course['instructor']['title_ar']), 0, 500),
                    'photoUrl' => "https://igtsservice.com/uploads/files/medium/" . $course['instructor']['image']
                ]
            ],
            'courseObjectives' => [
                [
//                    'value' => substr(strip_tags($course['willlearn_en']), 0, 50)
                ]
            ],
            'coursePlans' => $coursePlans,
            'tags' => $tags
        );


        $postdata = json_encode($data);
        $future = new FutureXIntegration();
        $futureCourse = $future->createCourse($postdata);
        $course->futurexid = $data['courseId'];
        $course->futurexcourseid = $futureCourse['content']['id'];
        $course->save();



        if($futureCourse['status']['success']){
            alert()->success($futureCourse['content']['link'] , $futureCourse['status']['message']);
        }else{
            alert()->alert($futureCourse , 'Error');
        }


        return redirect('lazyadmin/courses');


    }


    static function generateFuturexID(){
        do {
            $code = Str::random(20);
        } while (Courses::where('futurexid', $code)->exists());

        return $code;

    }


}
