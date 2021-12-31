<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\SeoSetting;
use App\Models\SvgCategory;
use App\Models\SvgFile;
use Illuminate\Support\Facades\Route;
class FrontLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $seo = '';
        $pageTitle = '';
        if(Route::getCurrentRoute()->uri() == 'about'){
            $pageTitle = 'About';
            $seo = SeoSetting::where('page','about')->first();
        }elseif(Route::getCurrentRoute()->uri() == 'contact'){
             $pageTitle = 'Contact';
            $seo = SeoSetting::where('page','contact')->first();
        }elseif(Route::getCurrentRoute()->uri() == 'blog'){
            $pageTitle = 'Blog';
            $seo = SeoSetting::where('page','blog')->first();
        }elseif(Route::getCurrentRoute()->uri() == 'sketches'){
            $pageTitle = 'Sketches';
            $seo = SeoSetting::where('page','sketches')->first();
        }elseif(Route::getCurrentRoute()->uri() == 'termsconditions'){
            $seo = SeoSetting::where('page','home')->first();
            $pageTitle = 'Terms & Conditions';
        }elseif(Route::getCurrentRoute()->uri() == 'policies'){
            $seo = SeoSetting::where('page','home')->first();
            $pageTitle = 'Privacy';
        }elseif(Route::getCurrentRoute()->uri() == 'user/login'){
            $seo = SeoSetting::where('page','home')->first();
            $pageTitle = 'Login';
        }elseif(Route::getCurrentRoute()->uri() == 'user/register'){
            $seo = SeoSetting::where('page','home')->first();
            $pageTitle = 'Register';
        }else{
             $uri = $_SERVER['REQUEST_URI'];
            $SvgCategory = SvgCategory::get();
            $SvgFile = SvgFile::get();
            $explodeArr = explode('/',$uri); 
            if( isset( $explodeArr[3] ) && !empty( $explodeArr[3] )){
                $seo = SvgFile::where('slug',$explodeArr[3])->first();
            }elseif( isset( $explodeArr[2] ) && !empty( $explodeArr[2]  )){
                $seo = SvgCategory::where('name',$explodeArr[2])->first();
            }else{
                $seo = SeoSetting::where('page','home')->first();
            }
        }
        return view('layouts.front',compact(['seo','pageTitle']));
    }
}
