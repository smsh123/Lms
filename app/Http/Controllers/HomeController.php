<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Blog;
use App\Models\User;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index(Request $request){
        $blogs =  Blog::getActiveBlogs();
        $courses =  Course::getCourseByType('class');
        $ebooks = Course::getCourseByType('ebook');
        $teachers = User::getUserByRole('Teacher');
        $successStories = Testimonial::getTestimonialByType('SV');
        $videoTestimonial = Testimonial::getTestimonialByType('V');
        $data = [
            'blogs' => !empty($blogs) ? $blogs : [],
            'courses' => !empty($courses) ? $courses :[],
            'ebooks' => !empty($ebooks) ? $ebooks : [],
            'teachers' => !empty($teachers) ? $teachers : [],
            'successStories' => !empty($successStories) ? $successStories : [],
            'videoTestimonial' => !empty($videoTestimonial) ? $videoTestimonial : [] 
        ];
        return view('index', $data);
    }
    public function contact(Request $request){
        $brandDetails = getBrandBySlug('aryabhatt-classes');
        $data = [
            'brandDetails' => !empty($brandDetails) ? $brandDetails : []
        ];
        return view('home.contact', $data);
    }
    public function about(Request $request){
        $brandDetails = getBrandBySlug('aryabhatt-classes');
        $data = [
            'brandDetails' => !empty($brandDetails) ? $brandDetails : []
        ];
        return view('home.about', $data);
    }
    public function terms(Request $request){
        $brandDetails = getBrandBySlug('aryabhatt-classes');
        $data = [
            'brandDetails' => !empty($brandDetails) ? $brandDetails : []
        ];
        return view('home.terms', $data);
    }
    public function privacy(Request $request){
        $brandDetails = getBrandBySlug('aryabhatt-classes');
        $data = [
            'brandDetails' => !empty($brandDetails) ? $brandDetails : []
        ];
        return view('home.privacy', $data);
    }
}
