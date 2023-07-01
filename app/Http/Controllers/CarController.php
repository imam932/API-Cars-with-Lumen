<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Image;


class CarController extends Controller
{
    // use SimpleUpload;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * List data
     */
    public function index() {
        $cars = Cache::get('car_list');
        if (!$cars){
            $cars = Car::with(['brand', 'images'])->paginate(10);
            Cache::put('car_list', $cars, $seconds = 10);
        }
        return response()->json($cars, 200);
    }

    /**
     * Create data.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'name'          => 'required|string',
                'description'   => 'required|string|min:100',
                'brand_id'      => 'required|string',
                'utama'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $car = Car::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'brand_id'      => $request->brand_id,
            ]);

            $slug = Str::slug($request->name);
            if($request->hasFile('utama')) {
                $file       = $request->file('utama');
                $path       = 'cars/';
                $fileName   = $slug.'-utama-'.date('d-F-Y-His').'.'.$file->extension();
                $file->move($path,$fileName);

                Image::create([
                    'car_id'    => $car->id,
                    'image'     => $path.$fileName,
                    'short_by'  => 0,
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Data added successfully'], 200);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    /**
     * Add image data.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add_image(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $car = Car::find($request->car_id);
            $images = $car->images();
            if ($images->count() > 10){
                return response()->json(['message' => 'Image upload has reached the limit'], 401);
            }
            $slug = Str::slug($car->name);
            if($request->hasFile('image')) {
                $file       = $request->file('image');
                $path       = 'cars/';
                $fileName   = $slug.'-'.date('d-F-Y-His').'.'.$file->extension();
                $file->move($path,$fileName);

                Image::create([
                    'car_id'    => $car->id,
                    'image'     => $path.$fileName,
                    'short_by'  => $request->short_by,
                    'created_at' =>  date('Y-m-d H:i:s')
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Data Image added successfully'], 200);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    /**
     * Update data.
     *
     * @param  Request  $request
     * @param  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'description'   => 'string|min:100',
            ]);

            $car = Car::find($id);
            if(auth()->user()->is_owner != 1 || (int)$car->created_by != auth()->user()->id){
                return response()->json(['message' => 'Can Update only owner'], 401);
            }

            $car->name          = $request->name;
            $car->description   = $request->description;
            $car->brand_id      = $request->brand_id;
            $car->save();

            return response()->json(['message' => 'Data update successfully'], 200);
        }
        catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    /**
     * Delete data.
     *
     * @param  $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $car = Car::find($id);
            if(auth()->user()->is_owner != 1 || (int)$car->created_by != auth()->user()->id){
                return response()->json(['message' => 'Can Delete only owner'], 401);
            }

            foreach ($car->images as $image) {
                if(file_exists($image->image)){
                    unlink($image->image);
                }
            }
            $car->images()->delete();
            $car->delete();
            DB::commit();
            return response()->json(['message' => 'Data delete successfully'], 200);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

}
