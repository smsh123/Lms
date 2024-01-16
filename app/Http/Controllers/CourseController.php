<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseModuleMapping;
use App\Models\CourseTestimonialMapping;
use App\Models\CourseFaqMapping;
use App\Models\Module;
use App\Models\Category;
use App\Models\Tool;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Testimonial;

class CourseController extends Controller
{
    //
    public function index(Request $request){
        if(!User::hasPermissions(["View Course"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $courses = Course::searchByFields(['name' => $request->name]);
        } elseif(!empty($request->slug)){
            $courses = Course::searchByFields(['slug' => $request->slug]);
        }elseif(!empty($request->course_type)){
            $courses = Course::searchByFields(['course_type' => $request->course_type]);
        } else {
            $courses = Course::paginateWithDefault(10);
        }
        
        return view('cms.courses.index')->with('courses',$courses);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Course"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $categories = Category::all();
        $tools = Tool::all();
        $mentors = User::getUserByRole('Teacher');
        $data = [
            'mentors' => !empty($mentors) ? $mentors : [], 
            'categories'=>!empty($categories) && is_object($categories) ? $categories->toArray() : [],
            'tools'=>!empty($tools) && is_object($tools) ? $tools->toArray() : [],
            'page_group' => 'course'
        ];
        
        return view('cms.courses.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255|unique:courses',
        ]);
    
        $course = new Course;
        $course->category = $request->input('category');
        $course->name = $request->input('name');
        $course->meta_title = $request->input('meta_title');
        $course->meta_keywords = $request->input('meta_keywords');
        $course->meta_description = $request->input('meta_description');
        $course->name_hindi = $request->input('name_hindi');
        $course->slug = $request->input('slug');
        $course->batch_start_date = $request->input('start_date');
        $course->duration = $request->input('duration');
        $course->class_mode = $request->input('class_mode');
        $course->description = $request->input('description');
        $course->synopsis = $request->input('synopsis');
        $course->original_price = $request->input('original_price');
        $course->selling_price = $request->input('selling_price');
        $course->offer_type = $request->input('offer_type');
        $course->offer_unit = $request->input('offer_unit');
        $course->offer_value = $request->input('offer_value');
        $course->coupon_code = $request->input('coupon_code');
        $course->offer_details = $request->input('offer_details');
        $course->thumbnail_image = $request->input('thumbnail_image');
        $course->banner_image = $request->input('banner_image');
        $course->tags = !empty($request->input('tags')) ? explode(',',$request->input('tags')) : '';
        $course->mentors = $request->input('mentors');
        $course->course_type = $request->input('course_type');
        $course->highlights = $request->input('highlights');
        $course->tools = $request->input('tools');
        $course->skills = $request->input('skills');
        $course->is_public = 0;
    
        $course->save();
    
        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }
    public function listing(Request $request){
        $courses = Course::getCourseByType('class');
        $data = [
            'page_title' => 'Courses',
            'courses' => !empty($courses) ? $courses : [],
            'meta_title'=>'Explore our highly optimized and personlised courses',
            'meta_keywords'=>'skills courses, smart classes, online classes, courses',
            'meta_description'=>'Aryabhatt classes desing personlised courses that suits to every individuals. Lets explore our highly optimized and personlised courses to boost your career',
            'page_type' => 'course-page' 
        ];
        return view('course.index',$data);
    }
    public function ebookListing(Request $request){
        $courses = Course::getCourseByType('ebook');
        $data = [
            'page_title' => 'Ebooks',
            'courses' => !empty($courses) ? $courses : [],
            'meta_title'=>'Explore our highly optimized and personlised courses',
            'meta_keywords'=>'skills courses, smart classes, online classes, courses',
            'meta_description'=>'Aryabhatt classes desing personlised courses that suits to every individuals. Lets explore our highly optimized and personlised courses to boost your career',
            'page_type' => 'course-page' 
        ];
        return view('course.index',$data);
    }
    public function courseDetails(Request $request, $slug){
        $courseDescription = [];
        $courseDescription = Course::getCourseBySlug($slug);
        if(!empty($courseDescription)){
            $courseDescription = $courseDescription[0];
        }
        if(!empty($courseDescription)){
            $mentors = !empty($courseDescription['mentors']) ? $courseDescription['mentors'] : [];
            if(!empty($mentors)){
                foreach($mentors as $key => $mentor){
                    $id = !empty($mentor) ? $mentor : '';
                    $mentor_details = User::where('_id',$id)->first();
                    $mentors[$key] = (!empty($mentor_details) && is_object($mentor_details) ) ? $mentor_details->toArray() : [];
                }
            }

            $course_modules = CourseModuleMapping::getModulesByCourseId($courseDescription['_id']);
            $course_modules = !empty($course_modules) ? $course_modules[0] : [];
            if(!empty($course_modules['modules'])){
                foreach($course_modules['modules'] as $key => $module){
                    $id = !empty($module['moduleId']) ? $module['moduleId'] : ''; 
                    $module = Module::find($id);
                    $modules[$key] = (!empty($module) && is_object($module)) ? $module->toArray() : []; 
                }
            }
            $course_faqs = CourseFaqMapping::getFaqByCourseId($courseDescription['_id']);
            $course_faqs = !empty($course_faqs) ? $course_faqs[0] : [];
            if(!empty($course_faqs['faqs'])){
                foreach($course_faqs['faqs'] as $key => $faq){
                    $id = !empty($faq['faqId']) ? $faq['faqId'] : ''; 
                    $faq = Faq::find($id);
                    $faqs[$key] = (!empty($faq) && is_object($faq)) ? $faq->toArray() : []; 
                }
            }
            $course_testimonial = CourseTestimonialMapping::getTestimonialByCourseId($courseDescription['_id']);
            $course_testimonial = !empty($course_testimonial) ? $course_testimonial[0] : [];
            if(!empty($course_testimonial['testimonials'])){
                foreach($course_testimonial['testimonials'] as $key => $testimonial){
                    $id = !empty($testimonial['testimonialId']) ? $testimonial['testimonialId'] : ''; 
                    $testimonial = Testimonial::find($id);
                    $testimonials[$key] = (!empty($testimonial) && is_object($testimonial)) ? $testimonial->toArray() : []; 
                }
            }
            if(!empty($testimonials)){
                foreach($testimonials as $key => $testimonial){
                    $authorId = !empty($testimonial['user']) ? explode('-',$testimonial['user']) : '';
                    $review_user_id = '';
                    if(!empty($authorId)){
                        $review_user_id = $authorId[0];
                    }
                    $user_profile_info = User::find($review_user_id);
                    $testimonials[$key]['user_info'] = (!empty($user_profile_info) && is_object($user_profile_info)) ? $user_profile_info->toArray() : [];
                }
            }
            $course_tools = !empty($courseDescription['tools']) ? $courseDescription['tools'] : [];
           
            if(!empty( $course_tools)){
                foreach( $course_tools as $key => $tool){
                    $slug = !empty($tool) ? $tool : ''; 
                    $tool = Tool::getToolsBySlug($slug);
                    $tools[$key] = !empty($tool)  ? $tool[0] : []; 
                }
            }

            $skills = !empty($courseDescription['skills']) ? explode(',',$courseDescription['skills']) : [];
            $blogs = Blog::all();
        }
        $data = [
            'CourseDescription' => !empty($courseDescription) ? $courseDescription : [],
            'teachers' => !empty($mentors) ? $mentors : [],
            'modules' => !empty($modules) ? $modules : [],
            'tools' => !empty($tools) ? $tools : [],
            'skills' => !empty($skills) ? $skills : [],
            'blogs' => !empty($blogs) ? $blogs : [],
            'faqs' => !empty($faqs) ? $faqs : [],
            'testimonials'=>!empty($testimonials) ? $testimonials : [],
            'page_type' => 'course-details-page' 
        ];
        return view('course.details',$data);
    }

    public function courseEdit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Course"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
       
        $course = Course::find($id);
        $categories = Category::all();
        $tools = Tool::all();
        $mentors = User::getUserByRole('Teacher');
        $data = [
            'course' => !empty($course) ? $course : [],
            'mentors' => !empty($mentors) ? $mentors : [],
            'categories'=>!empty($categories) && is_object($categories) ? $categories->toArray() : [],
            'tools'=>!empty($tools) && is_object($tools) ? $tools->toArray() : [],
            'page_group' => 'course'
        ];
        // dd($course);
        return view('cms.courses.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id",'');
        $course = Course::find($id);
        
        $course->category = $request->input('category');
        $course->name = $request->input('name');
        $course->meta_title = $request->input('meta_title');
        $course->meta_keywords = $request->input('meta_keywords');
        $course->meta_description = $request->input('meta_description');
        $course->name_hindi = $request->input('name_hindi');
        $course->batch_start_date = $request->input('start_date');
        $course->duration = $request->input('duration');
        $course->class_mode = $request->input('class_mode');
        $course->description = $request->input('description');
        $course->synopsis = $request->input('synopsis');
        $course->original_price = $request->input('original_price');
        $course->selling_price = $request->input('selling_price');
        $course->offer_type = $request->input('offer_type');
        $course->offer_unit = $request->input('offer_unit');
        $course->offer_value = $request->input('offer_value');
        $course->coupon_code = $request->input('coupon_code');
        $course->offer_details = $request->input('offer_details');
        $course->thumbnail_image = $request->input('thumbnail_image');
        $course->banner_image = $request->input('banner_image');
        $course->tags = !empty($request->input('tags')) ? explode(',',$request->input('tags')) : [];
        $course->mentors = $request->input('mentors');
        $course->course_type = $request->input('course_type');
        $course->highlights = $request->input('highlights');
        $course->tools = $request->input('tools');
        $course->skills = $request->input('skills');
    
        $course->save();
    
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function changeStatus(Request $request, $id) {
        if(!empty($id)){
            $course = Course::find($id);
            $status = !empty($course->is_public) ? $course->is_public : 0 ;
            if($status == 1){
                $course->is_public = 0;
                $course->save();
                return redirect()->back()->with('success', 'Course unpublished successfully');
            } elseif($status == 0){
                $course->is_public = 1;
                $course->save();
                return redirect()->back()->with('success', 'Course published successfully');
            }
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Course"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $course = Course::find($id);
        $course->delete();
        return redirect()->back()->with('msg', 'Course Deleted Successfully!');
    }
    
}
