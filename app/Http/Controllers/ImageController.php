<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Resources\ImageResource;


/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.3.0
this file is used for : linking the image model with the item's informations vue.

Wrote by : Miguel Moreira
updated by : Miguel Moreira
*/

class ImageController extends BaseController
{

    /**
     * @api {post} /api/images Add new image to the database
     * @apiName store
     * @apiGroup Image
     *
     * @apiParam {Number} item_id The id of the item that the image is linked to.
     * @apiParam {File} imagepath The image to add.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|numeric|min:1',
            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = Image::create($request->all());

        if ($request->hasFile('imagepath')) {
            //Move Uploaded File to public folder
            $destinationPath = 'images';

            // Add the id of the image to the name of the file to avoid conflicts
            $image->imagepath = $image->id . '_' . $request->imagepath->getClientOriginalName();

            $request->imagepath->move(public_path($destinationPath), $image->imagepath);
        }

        $image->save();

        return $this->sendResponse(new ImageResource($image), 'Image created successfully.');
    }

    /**
     * @api {delete} /api/images/:id delete an image from the database
     * @apiName destroy
     * @apiGroup Image
     *
     * @apiParam {Number} id The id of the image to delete.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Delete the image from the public folder
        if (file_exists(public_path($image->imagepath))) {
            unlink(public_path($image->imagepath));
        }


        $image->delete();

        return $this->sendResponse([], 'Image deleted successfully.');
    }

    /**
     * @api {get} /api/images/getItemImages/:id Get all the images of an item
     * @apiName getItemImages
     * @apiGroup Image
     *
     * @apiParam {Number} id The id of the item to get the images from.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function getItemImages($id)
    {
        $images = Image::where('item_id', $id)->get();

        return $this->sendResponse(ImageResource::collection($images), 'Images found successfully.');
    }
}
