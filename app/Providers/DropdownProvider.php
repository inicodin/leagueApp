<?php
namespace App\Providers;
use App\Post; // write model name here 
use App\Sport;
use Illuminate\Support\ServiceProvider;
class DropdownProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('class_array', Post::all());//where('idsport','1')->get()
        });
        view()->composer('*',function($view){
            $view->with('class_array_sport', Sport::all());
        });
    }
 
}
