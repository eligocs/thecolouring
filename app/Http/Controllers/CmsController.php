<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homebanner;
use App\Models\Bannercard;
use App\Models\Homewelcome;
use App\Models\Cartoonheading;
use App\Models\Cartoonimage;
use App\Models\Childrenheading;
use App\Models\Childrenimage;
use App\Models\Footer;
use App\Models\Footersocial;
use App\Models\Logo;
class CmsController extends Controller
{
    public function logo(){
        $logo = Logo::first();
        return view('page.admin.cms.logo', compact('logo'));
    }


    public function logocreate(Request $request){
        $this->validate($request, [
            'site_title' => 'required',
            'copyright' => 'required',
        ]);

        $check = Logo::first();
        if($check){

            $logoupdate;
            if($request->file('logo')){
                $logo = $request->file('logo');
                $dropzone =$logo->getClientOriginalName();
                $logo->move(public_path('upload/cms'), $dropzone);
                $logoupdate = $dropzone;
            }else{
                $logoupdate = $check->logo;
            }

            $updatelogo = Logo::where('id', 1)->update([
                'logo' => $logoupdate,
                'title' => $request->site_title,
                'description' => $request->tagline,
                'copyright' => $request->copyright,
                'headerscript' => $request->headerscript,
                'footerscript' => $request->footerscript
            ]);

            if($updatelogo){
                return redirect()->back()->with('message', 'Successfully Updated');
            }else{
                return redirect()->back()->with('error', 'something went wrong');
            }

        }else{

            $logo = $request->file('logo');
            $dropzone =$logo->getClientOriginalName();
            $logo->move(public_path('upload/cms'), $dropzone);

            $create = Logo::create([
                'logo' => $dropzone,
                'title' => $request->file('site_title'),
                'description' => $request->file('tagline'),
                'copyright' => $request->copyright,
                'headerscript' => $request->headerscript,
                'footerscript' => $request->footerscript
            ]);

            if($create == true){
                return redirect()->back()->with('message', 'Successfully Created');
            }

        }
        
    }


    public function bannerlist(){
        $list = Homebanner::get();
        return view('page.admin.cms.homebanner', compact('list'));
    }

    public function addbanner(){
        return view('page.admin.cms.addbanner');
    }

    public function editbanner(Request $request, $id){
        if($id){
            $edit = Homebanner::where('id', $id)->first();
            return view('page.admin.cms.editbanner', compact('edit'));
        }
    }

    public function bannerdelete($id)
    {
        if($id){
            $delete = Homebanner::where('id', $id)->delete();
            return redirect('/banner')->with('success', 'Successfully Deleted');
        }else{
            dd('something went wrong');
        }
    }

    public function bannercard()
    {
        $card = Bannercard::orderBy('id', 'DESC')->get();
        return view('page.admin.cms.bannercard', compact('card'));
    }

    public function updatebannercard(Request $request)
    {
        if($request->update_id){
            $this->validate($request, [
                'maintext' => 'required',
                'subtext' => 'required'
            ]);
            $update = Bannercard::where('id', $request->update_id)->first();
            $image;
            if($request->cartoonimage){
                $image = $request->cartoonimage;
            }else{
                $image = $update->cardimage;
            }
            $update = Bannercard::where('id', $request->update_id)->update([
                'cardimage' => $image,
                'maintext' => $request->maintext,
                'subtext' => $request->subtext,
            ]);
            if($update == true){
                return redirect('/bannercard')->with('success', 'Successfully updated');
            }else{
                dd('error');
            }

        }
    }

    public function editbannercard($id)
    {
        if($id){
            $edit = Bannercard::where('id', $id)->first();
            return view('page.admin.cms.editbannercard', compact('edit'));
        }else{  
            dd('seomething went wrong');
        }
    }
    public function editfootersocial($id)
    {
        if($id){
            $social = \DB::table('socialicons')->get();
            $edit = Footersocial::where('id', $id)->first();
            return view('page.admin.cms.editfootersocial', compact('edit', 'social'));
        }else{  
            dd('seomething went wrong');
        }
    }
    public function deletefootersocial($id)
    {
        if($id){
            $delete = Footersocial::where('id', $id)->delete();
            return redirect('/footericon')->with('success', 'Successfully Deleted');    
        }else{
            return redirect('/footericon')->with('error', 'Something went wrong');    
        }
    }
    public function bannerImageSave(Request $request){
        $image=$request->file('file');
        $dropzone =$image->getClientOriginalName();
        $image->move(public_path('upload/cms'), $dropzone);
        return true;
    }

    public function bannercreate(Request $request)
    {       
        if($request->update_id){
            $this->validate($request, [
                'text1' => 'required',
                'text2' => 'required'
            ]);
            $update = Homebanner::where('id', $request->update_id)->first();
            $image;
            if($request->bannerimage){
                $image = $request->bannerimage;
            }else{
                $image = $update->bannerimage;
            }
            $update = Homebanner::where('id', $request->update_id)->update([
                'bannerimage' => $image,
                'text1' => $request->text1,
                'text2' => $request->text2,
            ]);
            if($update == true){
                return redirect('/banner')->with('message', 'Successfully updated');
            }else{
                dd('error');
            }

        }else{

            $this->validate($request, [
                'bannerimage' => 'required',
                'text1' => 'required',
                'text2' => 'required'
            ]);
            $text1 = $request->text1;
            $text2 = $request->text2;
            $bannerimage = $request->bannerimage;
    
            $create = Homebanner::create([
                'bannerimage' => $bannerimage,
                'text1' => $text1,
                'text2' => $text2,
            ]);
            if($create == true){
                return redirect('/banner')->with('message', 'Successfully Created');
            }else{
                dd('error');
            }
        }      
    }

    public function welcome()
    {
        $welcome = Homewelcome::first();
        return view('page.admin.cms.welcome', compact('welcome'));
    }

    public function createwelcome(Request $request)
    {
        $welcomeimage;
        $check = Homewelcome::where('id', 1)->first();
        if($check){
            if($request->file('image')){
                $image = $request->file('image');
                $imagename = $image->getClientOriginalName();
                $image->move(public_path('upload/cms'), $imagename);
                $welcomeimage = $imagename;
            }else{
                $welcomeimage = $check->image;
            }
            $update = Homewelcome::where('id', 1)->update([
                'image' => $welcomeimage,
                'text' => $request->text,
                'description' => $request->description
            ]);
            if($update == true){
                return redirect('/welcome')->with('message', 'Successfull Updated');
            }else{
                return redirect('/welcome')->with('error', 'Something went wrong');

            }
        }else{
            $this->validate($request, [
                'image' => 'required',
                'text' => 'required',
                'description' => 'required'
            ]);

            $image = $request->file('image');
            $imagename = $image->getClientOriginalName();
            $image->move(public_path('upload/cms'), $imagename);
            $welcomeimage = $imagename;

            $add = Homewelcome::create([
                'image' => $welcomeimage,
                'text' => $request->text,
                'description' => $request->description
            ]);
    
            if($add == true){
                return redirect('/welcome')->with('message', 'Successfull Added');
            }else{
                return redirect('/welcome')->with('error', 'Something went wrong');

            }
        }        
    }

    public function cartoon()
    {
        $cartoon = Cartoonheading::first();
        $cartoon_image = Cartoonimage::orderBy('id', 'DESC')->get();
        return view('page.admin.cms.famouscartoon', compact('cartoon', 'cartoon_image'));
    }

    public function cartoonheading(Request $request)
    {
        $this->validate($request,[
            'heading' => 'required'
        ]);
        $check = Cartoonheading::where('id', 1)->first();
        if($check){
            $update = Cartoonheading::where('id', 1)->update([
                'heading' => $request->heading,
            ]);
            if($update == true){
                return redirect('/cartoon')->with('success', 'Successfully Updated');
            }else{
                return redirect('/cartoon')->with('error', 'Something went wrong');
            }
        }else{
            $add = Cartoonheading::create([
                'heading' => $request->heading
            ]);
            if($add == true){
                return redirect('/cartoon')->with('success', 'Successfully Added');
            }else{
                return redirect('/cartoon')->with('error', 'Something went wrong');
            }
        }
           
    }

    public function cartoonimages(Request $request)
    {
        if($request->update_id){
            $data = Cartoonimage::where('id', $request->update_id)->first();
            $image;
            if($request->cartoonimage){
                $image = $request->cartoonimage;
            }else{
                $image = $data->images;
            }
            Cartoonimage::where('id', $request->update_id)->update([
                'images' => $image,
                'text' => $request->text,
            ]);       
            return redirect('/cartoon')->with('success', 'Successfully Uploaded');
        }else{

            $this->validate($request,[
                'cartoonimage' => 'required',
                'text' => 'required'
            ]);
            Cartoonimage::create([
                'images' => $request->cartoonimage,
                'text' => $request->text,
            ]);       
            return redirect('/cartoon')->with('success', 'Successfully Uploaded');    
        }
    }

    public function addcartoonimages()
    {
        return view('page.admin.cms.addcartoonimages');
    }

    public function deletecartoonimages($id)
    {
        if($id){
            $delete = Cartoonimage::where('id', $id)->delete();
            return redirect('/cartoon')->with('success', 'Successfully Deleted');    
        }else{
            return redirect('/cartoon')->with('success', 'Something went wrong');    
        }
    }

    public function children()
    {
        $children = Childrenheading::first();
        $children_image = Childrenimage::orderBy('id', 'DESC')->get();
        return view('page.admin.cms.childrenwork', compact('children', 'children_image'));
    }

    public function childrenheading(Request $request)
    {
        $this->validate($request,[
            'heading' => 'required'
        ]);
        $check = Childrenheading::where('id', 1)->first();
        if($check){
            $update = Childrenheading::where('id', 1)->update([
                'heading' => $request->heading,
            ]);
            if($update == true){
                return redirect('/children')->with('success', 'Successfully Updated');
            }else{
                return redirect('/children')->with('error', 'Something went wrong');
            }
        }else{
            $add = Childrenheading::create([
                'heading' => $request->heading
            ]);
            if($add == true){
                return redirect('/children')->with('success', 'Successfully Added');
            }else{
                return redirect('/children')->with('error', 'Something went wrong');
            }
        }
    }

    public function childrenimages(Request $request)
    {
        $this->validate($request,[
            'childrenimage' => 'required'
        ]);
            foreach($request->childrenimage as $img){
                Childrenimage::create([
                    'images' => $img
                ]);
            }

            return redirect('/children')->with('success', 'Successfully Uploaded');
    }

    public function deletechildrenimages($id)
    {
        if($id){
            $delete = Childrenimage::where('id', $id)->delete();
            return redirect('/children')->with('success', 'Successfully Deleted');    
        }else{
            return redirect('/children')->with('success', 'Something went wrong');    
        }
    }

    public function editcartoonimages($id)
    {
        if($id){
            $edit = Cartoonimage::where('id', $id)->first();
            return view('page.admin.cms.editcartoonimage', compact('edit'));
        }else{
            dd('no id found');
        }
    }

    public function footer()
    {
        $footer = Footer::where('id', 1)->first();
        return view('page.admin.cms.footer', compact('footer'));
    }

    public function addfooter(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'email' => 'required',
        ]);

        $update = Footer::where('id', 1)->update([
            'location' => $request->location,
            'weekly' => $request->week,
            'timely' => $request->time,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        if($update == true){
            return redirect()->back()->with('message', 'Successfully Updated');
        }else{
            dd('something went wrong');
        }
    }
    
     public function footericon()
    {
        $social = \DB::table('socialicons')->get();
        $selected = Footersocial::join('socialicons', 'footersocials.social_id', '=', 'socialicons.id')->orderBy('footersocials.id', 'DESC')->select('footersocials.*', 'socialicons.name as social_name')->get();

        return view('page.admin.cms.footersocial', compact('social', 'selected'));
    }

    public function addfootersocial(Request $request)
    {
        $this->validate($request, [
            'icon' => 'required',
            'link' => 'required',
        ]);
        
        $check = Footersocial::where('social_id', $request->icon)->first();

        if($check){

            return redirect()->back()->with('error', 'Already Exists');

        }else{

            $add = Footersocial::create([
                'social_id' => $request->icon,
                'link' => $request->link
            ]); 
            
            if($add == true){
                return redirect('/footericon')->with('success', 'Added Successfully');
            }else{
                return redirect()->back()->with('error', 'Something Went Wrong');
            }
        }
    } 
    public function updatefootersocial(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'icon' => 'required',
            'link' => 'required',
        ]);
        
        $check = Footersocial::where('social_id', $request->icon)->first();
        if($check){
            $add = Footersocial::where('id',$request->id)->update([
                'link' => $request->link
            ]);
        }else{

            $add = Footersocial::where('id',$request->id)->update([
                'social_id' => $request->icon,
                'link' => $request->link
            ]); 
        }
        if($add == true){
                return redirect('/footericon')->with('success', 'Updated Successfully');
        }else{
                return redirect()->back()->with('error', 'Something Went Wrong');
        }
    } 
}
