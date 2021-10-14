<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
Use Alert;
Use Session;
use Auth;
use Redirect;
use Crypt;
use Illuminate\Support\Facades\Http;
use DotenvEditor;
use App\Blog;

class OtaUpdateController extends Controller
{
    public function update(Request $request)
    {

        if(Auth::check())
        {

            if(!empty(config('app.version')))
            {
                DotenvEditor::setKey('APP_VERSION', config('app.version'))->save();
            }


            DotenvEditor::setKey('ENABLE_INSTRUCTOR_SUBS_SYSTEM', 0)->save();

            ini_set('max_execution_time', '-1');

            ini_set('memory_limit', '-1');

            Artisan::call('migrate');

            \Artisan::call('migrate --path=database/migrations/update2_2');

            \Artisan::call('migrate --path=database/migrations/update2_3');

            \Artisan::call('migrate --path=database/migrations/update2_4');

            \Artisan::call('migrate --path=database/migrations/update2_5');

            \Artisan::call('migrate --path=database/migrations/update2_6');

            \Artisan::call('migrate --path=database/migrations/update2_7');

            \Artisan::call('migrate --path=database/migrations/update2_8');

            \Artisan::call('migrate --path=database/migrations/update2_9');

            \Artisan::call('migrate --path=database/migrations/update3_0_0');
            \Artisan::call('migrate --path=database/migrations/update3_1_0');
            \Artisan::call('migrate --path=database/migrations/update3_2_0');
            \Artisan::call('migrate --path=database/migrations/update3_3_0');
            \Artisan::call('migrate --path=database/migrations/update3_4_0');
            \Artisan::call('migrate --path=database/migrations/update3_5_0');


            Artisan::call('migrate', [
                '--path' => 'vendor/laravel/passport/database/migrations',
                '--force' => true,

            ]);

            \Artisan::call('passport:install');

            \Artisan::call('rename:video');


            try{
                $blogs = Blog::where('slug', NULL)->get();

                if($blogs != NULL)
                {
                    foreach ($blogs as $key => $blog) {
                        $slug = str_slug($blog['heading'],'-');
                        Blog::where('id', $blog->id)
                                ->update([
                                    'slug' => $slug
                                ]);
                    }
                }
               
            }
            catch(\Swift_TransportException $e){

            }

            $env_update = $this->changeEnv([
                'APP_DEBUG' => 'false'
            ]);

            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');


            Alert::success('Updated to version' . config('app.version'), 'Your App Updated Successfully !')->persistent('Close')->autoclose(12000);
            

            
            return redirect('/');
        }

        return Redirect::route('login')->withInput()->with('delete', trans('flash.PleaseLogin'));

    }

    public function getotaview()
    {
        return view('ota.update');
    }

    protected function changeEnv($data = array())
    {
        {
            if (count($data) > 0) {

                // Read .env-file
                $env = file_get_contents(base_path() . '/.env');

                // Split string on every " " and write into array
                $env = preg_split('/\s+/', $env);

                // Loop through given data
                foreach ((array) $data as $key => $value) {
                    // Loop through .env-data
                    foreach ($env as $env_key => $env_value) {
                        // Turn the value into an array and stop after the first split
                        // So it's not possible to split e.g. the App-Key by accident
                        $entry = explode("=", $env_value, 2);

                        // Check, if new key fits the actual .env-key
                        if ($entry[0] == $key) {
                            // If yes, overwrite it with the new one
                            $env[$env_key] = $key . "=" . $value;
                        } else {
                            // If not, keep the old one
                            $env[$env_key] = $env_value;
                        }
                    }
                }

                // Turn the array back to an String
                $env = implode("\n\n", $env);

                // And overwrite the .env with the new data
                file_put_contents(base_path() . '/.env', $env);

                return true;

            } else {

                return false;
            }
        }
    }
}
