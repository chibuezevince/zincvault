<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SiteSettingsController extends Controller
{
    public function displaySettingsPage()
    {
        return view('admin.settings');
    }

    public function updateSiteSettings()
    {
        $data = Validator::make(request()->all(), [
            'site_name' => 'required',
            'site_email' => 'required|email',
            'site_logo' => 'mimes:jpeg,jpg,png,gif|max:3072',
            'local_transfer_charge' => 'required|numeric|max:100',
            'international_transfer_charge' => 'required|numeric|max:100',
            'exchange_fee' => 'required|numeric|max:100',
        ]);    

        if ($data->fails()) 
        {
            return response()->json(['errors' => $data->errors()->all()]);
        }
        else
        {
            $data = $data->validated();
            $path = settings('site_logo');
            if (request()->hasFile('site_logo'))
        {
                $logo = $data['site_logo'];
                $logo_name = 'logo.png';
            if (File::exists($logo_name)) 
            {
                File::delete($logo_name);
                $path = $logo->move('logo', 'logo.png');
            }
            else
            {
                $path = $logo->move('logo', 'logo.png');
            }
        }
            Setting::firstWhere('name','site_name')->update([
                'value' => $data['site_name'],    
            ]);
            Setting::firstWhere('name', 'site_email')->update([
                'value' => $data['site_email'],    
            ]);
            
            Setting::firstWhere('name', 'site_logo')->update([
                'value' => asset($path),    
            ]);
            Setting::firstWhere('name','local_transfer_charge')->update([
                'value' => $data['local_transfer_charge']/100,    
            ]);
            Setting::firstWhere('name','international_transfer_charge')->update([
                'value' => $data['international_transfer_charge']/100,    
            ]);
            Setting::firstWhere('name','exchange_fee')->update([
                'value' => $data['exchange_fee'],    
            ]);
            return response()->json(['success' => 'Settings Updated Successfully']);
        }
    }
}
